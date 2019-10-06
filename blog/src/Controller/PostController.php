<?php

namespace App\Controller;

use App\Entity\Post;
use App\Form\Type\PostType;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
  /**
    * @Route("/", name="home")
    */
  public function index()
  {

    $posts = $this->getDoctrine()->getRepository(Post::class)->findAll();

    return $this->render("posts/index.html.twig", [
      "posts" => $posts
    ]);
  }
  /**
    * @Route("/create-post", name="create_post")
    */
  public function create(Request $request)
  {

    $post = new Post();
    $form = $this->createForm(PostType::class, $post);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $post = $form->getData();
      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->persist($post);
      $entityManager->flush();

      return $this->redirectToRoute("home");

    }

    return $this->render("posts/create-post.html.twig", [
      "form" => $form->createView()
    ]);

  }
  /**
    * @Route("/edit-post/{id}", name="edit_post")
    */
  public function edit(Request $request, $id)
  {

    $post = $this->getDoctrine()->getRepository(Post::class)->find($id);

    $form = $this->createForm(PostType::class, $post);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {

      $entityManager = $this->getDoctrine()->getManager();
      $entityManager->flush();

      return $this->redirectToRoute("home");

    }

    return $this->render("posts/edit-post.html.twig", [
      "form" => $form->createView()
    ]);

  }
  /**
    * @Route("/show-post/{id}", name="show_post")
    */
  public function show(Post $post) {
    return $this->render("posts/show-post.html.twig", [
      "post" => $post
    ]);
  }
  /**
    * @Route("delete-post/{id}");
    */
  public function delete(Request $request, $id)
  {

    $entityManager = $this->getDoctrine()->getManager();
    $post = $this->getDoctrine()->getRepository(Post::class)->find($id);
    $entityManager->remove($post);
    $entityManager->flush();

    $response = new Response();
    $response->send();

  }
}
