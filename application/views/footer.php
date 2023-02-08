<?php
defined('BASEPATH') OR exit('No direct script access allowed');
?>
    
    <script>
    $(window).on("load",function(){
      $(".loader").fadeOut();

    });
  </script>
  <!-- Menu Toggle Script -->
  <script>
    $("#menu-toggle").click(function(e) {
      e.preventDefault();
      $("#wrapper").toggleClass("toggled");
    });
  </script>
    <script src="<?php echo base_url('assets/bootstrap-4.3.1/js/bootstrap.min.js') ?>"></script>
  </body>
</html>