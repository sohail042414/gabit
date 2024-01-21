<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.bxslider.css" rel="stylesheet" type="text/css">
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.bxslider.min.js"></script>
<style>
    .slider1{
        width:600px;
        height:500px;
    }
    .slide{
        width:100%;        
    }
</style>
<div class="slider1">   
    <?php if(!empty($case_update->document1)){ ?>
        <div class="slide">
            <embed src="<?php echo SITE_ABS_PATH_CASE_UPDATES_DOCS.$case_update->document1; ?>" width="700px" height="430px" />
        </div>
    <?php } ?>
    <?php if(!empty($case_update->document2)){ ?>
        <div class="slide">
            <embed src="<?php echo SITE_ABS_PATH_CASE_UPDATES_DOCS.$case_update->document2; ?>" width="700px" height="430px" />
        </div>
    <?php } ?>  
    <?php if(!empty($case_update->document3)){ ?>
        <div class="slide">
            <embed src="<?php echo SITE_ABS_PATH_CASE_UPDATES_DOCS.$case_update->document3; ?>" width="700px" height="430px" />
        </div>
    <?php } ?>                    
</div>
<script>
    $(document).ready(function () {
        $('.slider1').bxSlider({
            slideWidth: 700,
            minSlides: 1,
            maxSlides: 3,
            slideMargin: 50,
            infiniteLoop: false,
            hideControlOnEnd: false
        });
    });
</script>