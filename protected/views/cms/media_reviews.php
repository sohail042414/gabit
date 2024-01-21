<style type="text/css">
/*.f-team{height:1610px; overflow:hidden; width:100%; padding:25px 0 0 0px; margin-bottom:30px;}*/
</style>

<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<!--Start content----------------------------------------------------------->

<div class="inner-container">
<div class="inner-left">
    <div class="inner-page">

        <!--        code for page content -->
        <?php 
            $cms_data_content = str_replace('#SITE_PATH#', SITE_ABS_PATH, $page_content);
            echo $cms_data_content;
        ?>

        <!--<a href="mailto:media@mobitrustint.com" class="button-tab button-tab1">media@mobitrustint.com</a>
        <div class="clear">&nbsp;</div>

		<p><strong>Reviews:</strong></p>

        <div class="review-col1">
        	<p>
            A business whose product is a smile on people’s faces<br />
            September 11, 2015<br />
            <strong><a href="#">Vanguard</a></strong>


            <p>
            ‘Nigeria’ How one company is affecting many lives<br />
            January 08, 2016<br />
            <strong><a href="#">Forbes</a></strong>
            </p>

        </div>

        <div class="review-col2">
        	<p>
            Nigeria joins the world of Crowdfunding<br />
            September 21, 2015<br />
            <strong><a href="#">BBC</a></strong>
            </p>
        </div>


        <p>If you want MobiTrust at your event, you may complete the form <a href="#" class="page-link">here</a> and we will contact you to signify our interest.</p>-->
      <a href="<?php echo $this->createUrl('cms/aboutus' ,array('back'=>1)) ?>" class="link2">About Us</a>
      <a href="<?php echo $this->createUrl('cms/support_and_contact_centre',array('back'=>1)) ?>" class="link2">Support and Contact Centre</a>
      <a href="<?php echo $this->createUrl('cms/view_our_brand_resources') ?>" class="link2">View Our Brand Resources</a>



    </div>
    <div class="start_explore_fundraiser">
    <a href="<?php echo $this->createUrl('fundraise/index') ?>" class="button-tab">Start a Fundraiser</a>
    <a href="<?php echo $this->createUrl('fundraiser/locatefundraiser') ?>" class="button-tab">Explore
                Fundraisers</a>
    </div>
    </div>


    <div id="media_right">
    <?php echo $this->renderPartial('/layouts/cms_sidebar'); ?>
    </div>

</div>



</div>
