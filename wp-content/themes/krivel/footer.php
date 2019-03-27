
    <!-- Footer -->
    <footer>
      <div class="container">
        <div class="row">
          <div class="col-xs-12 text-center">
           <h2>Спасибо</h2>
           <em>Copyright &copy; <?php echo date('Y'); ?> Персональный сайт Алексея Кривеля</em>
          </div>
        </div>
      </div>
    </footer>
    <!-- /Footer -->

<?php wp_footer(); ?>
<!-- Slideshow Background  -->
<script>
    $.vegas('slideshow', {
        delay:5000,
        backgrounds:[
          <?php foreach (get_field('bg', 'options') as $bg): ?>
             { src:'<?= $bg['bg_img'] ?>', fade:2000 },
          <?php endforeach; ?>
            // { src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/1.jpg', fade:2000 },
            // { src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/2.jpg', fade:2000 },
            // { src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/3.jpg', fade:2000 },
            // { src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/4.jpg', fade:2000 },
            // { src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/5.jpg', fade:2000 },
            // { src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/6.jpg', fade:2000 },
            // { src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/7.jpg', fade:2000 },
            // { src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/8.jpg', fade:2000 },
            // { src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/9.jpg', fade:2000 },
            // { src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/10.jpg', fade:2000 },
            // { src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/11.jpg', fade:2000 },
            // { src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/12.jpg', fade:2000 },
            // { src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/13.jpg', fade:2000 },
        ]
        })('overlay', {
        // src:'<?php echo get_bloginfo('template_url'); ?>/assets/images/bg/overlay2.png'
    });

</script>
<!-- /Slideshow Background -->

<!-- Mixitup : Grid -->
    <script>
		$(function(){
            $('#Grid').mixitup();
        });
    </script>
<!-- /Mixitup : Grid -->	

    <!-- Custom JavaScript for Smooth Scrolling - Put in a custom JavaScript file to clean this up -->
    <script>
      $(function() {
        $('a[href*=#]:not([href=#])').click(function() {
          if (location.pathname.replace(/^\//,'') == this.pathname.replace(/^\//,'') 
            || location.hostname == this.hostname) {

            var target = $(this.hash);
            target = target.length ? target : $('[name=' + this.hash.slice(1) +']');
            if (target.length) {
              $('html,body').animate({
                scrollTop: target.offset().top
              }, 1000);
              return false;
            }
          }
        });
      });
    </script>
  <div id="sbox-overlay" aria-hidden="true" tabindex="-1" style="z-index: 65555; opacity: 0;"></div>
  </body>

</html>