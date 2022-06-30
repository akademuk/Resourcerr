var checkbox = document.querySelector( '#myInput' );
var icon = document.querySelector( '#menuicon i' );
var listener = function( e ) {
  if( e.target != checkbox && e.target != icon ) {
    checkbox.checked = false;
    document.removeEventListener( 'click', listener );
   
  }
};

checkbox.addEventListener( 'click', function(){
  if( this.checked ) {
    document.addEventListener( 'click', listener );
    document.querySelector("body").style.overflow = 'hidden';
  } 
});