  <!-- content block -->
  <div class="container-fluild p-0 content-block mt-5">


    <div class="main-testimonal-slider">
      <div class="container">
        <h2 class="same-heading same-heading-pb">
          Testimonials
        </h2>
        <div class="inner-testimonal-container fade-container position-relative">
          <?php foreach($testimonials as $test){ ?>
          <div class="testimonal-slider d-flex align-items-center justify-content-between mt-4 fade-item">
              <div class="img-text d-flex justify-content-center align-items-center">
                <div class="testimonal-img">
                  <?php if(!empty($test->testimonial_picture)){ ?>
                      <?php echo UtilityHtml::get_testimonial_picture_from_path($test->testimonial_picture); ?>
                  <?php }else{ ?>
                  <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/rewards/images/testimonial-img.png">
                  <?php } ?>
                </div>
                <div class="testimonal-img-text">
                  <h5><?php echo $test->testimonial_by; ?></h5>
                </div>
              </div>
              <div class="testimonal-text position-relative">
                <p><?php echo $test->testimonial_text; ?></p>
              </div>
            </div>
          <?php } ?>

        </div>
      </div>
    </div>

    <div class="white-block"></div>

  </div>

  <script>
    document.addEventListener("DOMContentLoaded", function () {
      const fadeItems = document.querySelectorAll(".fade-item");

      function fadeInOnScroll() {
        fadeItems.forEach((item) => {
          const itemTop = item.getBoundingClientRect().top;
          const itemBottom = item.getBoundingClientRect().bottom;

          const opacity = (itemTop > 0 && itemTop < window.innerHeight) || (itemBottom > 0 && itemBottom < window.innerHeight)
            ? 1
            : 0;

          item.style.opacity = opacity;
        });
      }

      fadeInOnScroll();

      window.addEventListener("scroll", fadeInOnScroll);
    });
  </script>