<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<!--Start content----------------------------------------------------------->
<div class="inner-container">
    <div class="inner-left">
    <div class="inner-page">
        <h4><?php echo $page_title; ?></h4>

        <div class="i-left-img" style="display:none;"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abut-slider-mini.png"
                                     alt=""/></div>

        <!--        code for page content -->
        <?php echo $page_content; ?>
</div>
        <a href="<?php echo $this->createUrl('fundraise/index') ?>" class="button-tab">Start a Fundraiser</a>
        <a href="<?php echo $this->createUrl('fundraiser/locatefundraiser') ?>" class="button-tab">Explore
            Fundraisers</a>

        <?php if( Yii::app()->request->urlReferrer == SITE_ABS_PATH."index.php/cms/media_reviews") {?>
	<a href="<?php echo $this->createUrl('cms/media_reviews') ?>" class="button-tab">Back</a>
	<?php } ?>
    </div>
    <?php echo $this->renderPartial('/layouts/cms_sidebar'); ?>
</div>
