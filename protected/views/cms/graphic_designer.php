<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<!--Start content----------------------------------------------------------->

<div class="inner-container">
    <div class="inner-left">
        <div class="inner-page">
            <h4><?php echo $page_title; ?></h4>
            <!--        code for page content -->
            <?php echo $page_content; ?>
        </div>
        <a href="<?php echo $this->createUrl('fundraise/index') ?>" class="button-tab">Start a Fundraiser</a>
        <a href="<?php echo $this->createUrl('fundraiser/locatefundraiser') ?>" class="button-tab">Explore Fundraisers</a>
	<a href="<?php echo $this->createUrl('cms/careers') ?>" class="button-tab">Back</a>
    </div>
    <?php echo $this->renderPartial('/layouts/cms_sidebar'); ?>
</div>
