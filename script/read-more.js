$( ".read-more-btn" ).click(function() {
  $( ".read-more" ).slideToggle( "fast" );
      var $this = $(this);
        $this.toggleClass("open");

        if ($this.hasClass("open")) {
            $this.html("Less");
        } else {
            $this.html("Read more");
        }
});