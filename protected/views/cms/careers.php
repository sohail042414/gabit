<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<!--Start content----------------------------------------------------------->

<div class="inner-container">
    <div class="inner-left">
        <div class="inner-page">
            <!--        code for page content -->
            <?php 
		        $page_content = str_replace('#DIGITAL_MEDIA#',$this->createUrl('cms/digital_media'), $page_content);
                $page_content = str_replace('#SOFTWARE_OPNING#',$this->createUrl('cms/software_engineer'), $page_content);
                $page_content = str_replace('#GRAPHIC_DESIGNER#',$this->createUrl('cms/graphic_designer'), $page_content);
                $page_content = str_replace('#COMMUNITY_EVANGELIST#',$this->createUrl('cms/community_evangelist'), $page_content);
                echo $page_content;
 	        ?>
            
            </div>
        <a href="<?php echo $this->createUrl('fundraise/index') ?>" class="button-tab">Start a Fundraiser</a>
        <a href="<?php echo $this->createUrl('fundraiser/locatefundraiser') ?>" class="button-tab">Explore Fundraisers</a>
    </div>
    <div id="media_right">
    <?php echo $this->renderPartial('/layouts/cms_sidebar'); ?>
    </div>
</div>
