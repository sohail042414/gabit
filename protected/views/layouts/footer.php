<div class="inner-container">
    <!--<h4>Partners</h4>-->
</div>

<div class="footer-slider" style="height:160px;">
    <?php $patners = Patner::model()->findAll(array("select" => "*", "condition" => "status =  'Y'  "));
    if (!empty($patners)) {
    ?>
        <ul id="scroller" style="height:160px;">
            <?php foreach ($patners as $patner_row) {
                $image_path = SITE_ABS_PATH_HOME_SLIDER . $patner_row->patner_image;
            ?>
                <li><a href="javascript::void();">
                        <img style="width:200px; height:150px;" src="<?php echo $image_path ?> " /></a>
                </li>
            <?php } ?>
        </ul>
    <?php } ?>
</div>
</div>

<!--Start footer----------------------------------------------------------->
<div class="footer">
    <div class="section-min-slider footer-main">
        <ul>
            <li>
                <h5>Giveyourbit</h5>
            </li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/how_this_work'); ?>">How This works</a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/aboutus') ?>">About Giveyourbit</a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/support_and_contact_centre') ?>">Support & Contact Centre</a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/media_reviews') ?>">Media </a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/fees') ?>"> Fees</a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('/stories/index') ?>">Success Stories</a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/careers') ?>">Careers</a></li>
        </ul>
        <ul>
            <li>
                <h5>Categories</h5>
            </li>
            <?php $category = FundraiserType::model()->findAll(array('order' => 'id ASC'));
            if (!empty($category)) {
                foreach ($category as $category_row) {
                    $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', trim($category_row->fundraiser_type));
                    $title = str_replace("'", '', $title);
                    $title = strtolower($title);
            ?>
                    <li>
                        <a class="has-loader" href="<?php echo $this->createUrl('fundraiser/category', array('id' => $category_row->id, 'category_name' => $title)) ?>"> <?php echo $category_row->fundraiser_type; ?></a>
                    </li>

            <?php }
            }
            ?>
        </ul>
        <ul>
            <li>
                <h5>Resources</h5>
            </li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/step_by_step_guide_to_fundraising'); ?>">Step by Step Guide to Fundraising</a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/fundraising_suggestions') ?>">Fundraising Suggestions</a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/leveraging_social_media') ?>">Leveraging Social Media</a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/press_featured_fundraisers'); ?>">Press-Featured Fundraisers</a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/general_information'); ?>">General Information</a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/press_support'); ?>">Press Center</a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/how_to'); ?>">How To's</a></li>
        </ul>
        <ul>
            <li>
                <h5>Fundraising For Cancer</h5>
            </li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/what_is_cancer'); ?>"> What is Cancer ?</a><br /><a href="<?php echo $this->createUrl('cms/paying_for_cancer_treatment'); ?>">Paying For Cancer Treatment</a><br /><br /></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/medical_partners'); ?>">Medical Partners</a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/diseases_and_deiagnoses_centre'); ?>">Diseases & Diagnoses Centre</a></li>
        </ul>
        <ul>
            <li>
                <h5>Crowd Funding</h5>
            </li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/about_crowdfunding'); ?>">About Crowdfunding</a></li>
            <li><a class="has-loader" href="<?php echo $this->createUrl('cms/benefits_crowdfunding'); ?>">Benefits of Crowdfunding</a></li>
            <br />
            <!-- Begin code for the Subscribe user-->
            <li class="newsletter_container">
                <div class="newslatter_cls">
                    <?php
                    echo CHtml::textField('newsletter_email', '', array('size' => 10, 'id' => 'newsletter_email', 'placeholder' => 'Enter email'));
                    echo CHtml::Button('Subscribe', array('id' => 'btn_subscribe')); ?>
                </div>
                <div class="clear"></div>
                <span id="error_email"></span>
                <div class="mautts_logo">
                    <!-- <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/mautts.jpg"/> -->
                    <!-- <img style="width:63px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/mattus-new.png"/> -->
                    <!-- <img style="width:63px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/matus-logo-black.jpeg"/> -->
                    <!-- <img style="width:63px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/mattus-logo-clear.jpeg"/> -->
                    <img style="width:45px;margin-top:10px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/mautts-bgnon.png" />

                </div>
            </li>

            <!-- End of code for the Subscribe user-->
        </ul>

    </div>
</div>

<script>
    var navigation = responsiveNav(".nav-collapse");
</script>

<div id="back-to-top" style="display:none;" title="Scroll Back to Top"><a href="#top"></a></div>
<!--<script type="text/javascript" src="js/scrolltopcontrol.js"></script>-->
<div class="footer-bottom">
    <div class="footer-midl">
        <p class="footer-p-teg"><a href="<?php echo $this->createUrl('cms/terms_of_service'); ?>"> Terms of Service</a>
            I <a href="<?php echo $this->createUrl('cms/privacy_policy'); ?>">Privacy Policy</a>
        </p>
        <p class="footer-p-teg freepik">Images: Designed by <a href="https://www.freepik.com/" target="__blank"><b>Freepik</b></a></p>
        <p class="footer-p-teg2">© <?php echo date('Y', time()); ?> DajEd RollOutTech, All Rights Reserved</p>
    </div>
</div>

<!--Start footer----------------------------------------------------------->