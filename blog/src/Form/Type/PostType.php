<?php

namespace App\Form\Type;

use App\Entity\Post;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use SYmfony\Component\Form\FormBuilderInterface;

class PostType extends AbstractType
{
  public function buildForm(FormBuilderInterface $builder, array $options)
  {
    $builder->add("title", TextType::class, [ "attr" => ["class" => "form-control"] ])
            ->add("text", TextareaType::class, [
              "attr" => [ "class" => "form-control"],
              "required" => false
              ])
            ->add("save", SubmitType::class, [ "attr" => ["class" => "btn"] ]);
  }

  public function configureOptions(OptionsResolver $resolver)
  {
    $resolver->setDefaults([
      'data_class' => Post::class
    ]);
  }
}
