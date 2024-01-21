<?php echo $this->renderPartial('/layouts/cms_banner'); ?>

<!--Start content----------------------------------------------------------->

<div class="inner-container">
    <div class="inner-left">
        <div class="inner-page">
            <!--        code for page content -->
            <?php echo $page_content; ?>
        </div>
        <a href="<?php echo $this->createUrl('fundraise/index') ?>" class="button-tab">Start a Fundraiser</a>
        <a href="<?php echo $this->createUrl('fundraiser/locatefundraiser') ?>" class="button-tab">Explore Fundraisers</a>

	<?php if( Yii::app()->request->urlReferrer == SITE_ABS_PATH."index.php/cms/how_this_work") {?>
	<a href="<?php echo $this->createUrl('cms/how_this_work') ?>" class="button-tab">Back</a>
	<?php } ?>
    </div>
    <div id="media_right">
    <?php echo $this->renderPartial('/layouts/cms_sidebar'); ?>
    </div>


</div>
