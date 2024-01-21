<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
       <!-- Code for the meta title -->
   <?php if (!empty($this->metaTitle)) { ?>
        <title><?php echo CHtml::encode($this->metaTitle); ?></title>
    <?php } else { ?>
        <title>Top Donors Reward Program</title>
    <?php } ?>
   <!-- bootsrap css link  -->
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet"
      integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">
   <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/rewards/css/style.css">
</head>

<body>

   <!-- header block -->
   <div class="container-fluid p-0 text-center position-relative">
      <div class="row mx-0">
         <div class="col-md-12 px-0">
            <div class="top-reward-block">
               <div class="bg-head bg-top-block index-bg-head">

                  <div class="top-nav m-auto">
                     <nav class="navbar navbar-expand-lg">
                        <div class="container-fluid d-flex justify-content-center">
                           <button class="navbar-toggler " type="button" data-bs-toggle="collapse"
                              data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                              aria-expanded="false" aria-label="Toggle navigation">
                              <span class=""> <img src="<?php echo Yii::app()->request->baseUrl; ?>/css/rewards/images/Frame.svg" alt=""></span>
                           </button>
                           <div class="collapse navbar-collapse" id="navbarSupportedContent">
                              <?php $action = Yii::app()->controller->action->id; ?>
                              <ul class=" list-unstyled justify-content-between gap-14 flex-wrap   d-flex">
                                 <li>
                                    <a class="text-white text-decoration-none <?php echo ($action == 'donors') ? 'active' : ''; ?>" href="<?php echo Yii::app()->createUrl('rewards/donors'); ?>">
                                       TDRP for Donors
                                    </a>
                                 </li>
                                 <li>
                                    <a class="text-white text-decoration-none <?php echo ($action == 'fundraisers') ? 'active' : ''; ?>" href="<?php echo Yii::app()->createUrl('rewards/fundraisers'); ?>">TDRP for
                                       Fundraisers</a>
                                 </li>
                                 <li>
                                    <a class="text-white text-decoration-none <?php echo ($action == 'history') ? 'active' : ''; ?>" href="<?php echo Yii::app()->createUrl('rewards/history'); ?>">Historic
                                       Rewards</a>
                                 </li>
                                 <li>
                                    <a class="text-white text-decoration-none <?php echo ($action == 'testimonials') ? 'active' : ''; ?>" href="<?php echo Yii::app()->createUrl('rewards/testimonials'); ?>">Testimonials</a>
                                 </li>
                              </ul>
                           </div>
                        </div>
                     </nav>
                  </div>

                  <div class="star-img mx-auto index-star">
                     <a href="<?php echo Yii::app()->createUrl('/rewards'); ?>" class=""><img src="<?php echo Yii::app()->request->baseUrl; ?>/css/rewards/images/Badge.svg" alt=""></a>
                  </div>

               </div>
               <!-- end of bg-head -->
            </div>
         </div>
      </div>
   </div>

   <?php echo UtilityHtml::get_reward_flash_messages(); ?>

   <?php echo $content;  ?>
   <!-- footer block -->
   <div class="container-fluid p-0 text-center footer-main home-footer">
      <div class="row mx-0">
         <div class="col-md-12 px-0">
            <div class="footer-bg">
               <div class="footer-text position-relative">
                  <img class="desk-footer position-relative" src="<?php echo Yii::app()->request->baseUrl; ?>/css/rewards/images/footer-bg.png" alt="">
                  <img class="mob-footer position-relative" src="<?php echo Yii::app()->request->baseUrl; ?>/css/rewards/images/mobile-footer.svg" alt="">
                  <!-- <p class=" m-0 text-white secondary-font copyright-text position-absolute">Copyright 2023 giveyourbit. All Rights Reserved</p> -->
                  <p class=" m-0 text-white secondary-font copyright-text position-absolute">Copyright 2023 DajEd RollOutTech.  All Rights Reserved</p>                  
               </div>
            </div>
         </div>
      </div>
   </div>

   <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
   <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.min.js"></script>
   <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
</body>

</html>