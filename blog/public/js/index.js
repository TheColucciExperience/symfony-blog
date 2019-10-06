
window.addEventListener( 'load', function initScript() {

  const deleteBtnEls = window.document.querySelectorAll( '.js-delete-btn' );

  Array.from( deleteBtnEls ).forEach( btn => {
    btn.addEventListener( 'click', e => {
      deletePost( btn.dataset.id );
    } );
  } );

} );

function deletePost(postId) {

  window.fetch( `/delete-post/${ postId }`, { method: 'DELETE' } )
        .then( res => window.location.reload() );

}
