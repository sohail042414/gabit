<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<!--Start content----------------------------------------------------------->
<div class="inner-container">
    <div class="inner-left">
        <div class="inner-page">
            <!--        code for page content -->
            <?php echo $page_content; ?>
            
            <div class="clear"></div>
            <p>
            <a href="<?php echo Yii::app()->createUrl('cms/learn_about_raising_money_for_yourself_or_a_loved_one'); ?>" class="link1">Learn about raising money for yourself or a loved one</a><br/>
            <a href="<?php echo Yii::app()->createUrl('cms/learn_about_supporting_a_fundraising_campaign_or_two'); ?>" class="link1">Learn about supporting a fundraising campaign or two</a><br/>
            <a href="<?php echo Yii::app()->createUrl('cms/learn_about_donating_to_a_fundraising_campaign'); ?>" class="link1">Learn about donating to a fundraising campaign</a>
			</p>
            
            <?php
            $topic = Topic::model()->findAll();
            foreach ($topic as $topic_row) {
                if (!empty($topic_row->fundraiserQuestions)) {
                    ?>
                    <div class="topic_<?php echo $topic_row->topic_type; ?> fundraiser_box">
                        <h4><?php echo $topic_row->topic_type; ?></h4>
                        <ul class="fund_poin">
                            <?php
                            foreach ($topic_row->fundraiserQuestions as $Questions) {
                                $answer = FundraiserAnswer::model()->find(array('select' => 'id', 'condition' => 'questions_id = ' . $Questions->id . ' '));
                                if (!empty($answer)) {
                                    ?>
                                    <li>
                                        <a href="<?php echo $this->createUrl('cms/question_detail', array('que' => $Questions, 'title' => $topic_row->topic_type, 'subject' => $Questions->subject, 'last_date' => $Questions->updated_date, 'id' => $Questions->id,'back'=> '1')); ?>"
                                           class="link1"><?php echo $Questions->questions_text; ?></a></li>
                                    <!--                                <li><a class="link1" href="#">--><?php //echo $Questions->questions_text;
                                    ?><!--</a></li>-->
                                <?php }else{
                                    echo '<li class="only_question">'.$Questions->questions_text.'</li>';
                                }
                            }
                            ?>
                        </ul>
                    </div>
                <?php
                }
            }
            ?>
        </div>
        
        <a href="<?php echo $this->createUrl('fundraise/index') ?>" class="button-tab">Start a Fundraiser</a>
        <a href="<?php echo $this->createUrl('fundraiser/locatefundraiser') ?>" class="button-tab">Explore Fundraisers</a>

	<?php 

	if( Yii::app()->request->urlReferrer == SITE_ABS_PATH."index.php/cms/media_reviews" && $_REQUEST['back']==1) {?>
	<a href="<?php echo $this->createUrl('cms/media_reviews') ?>" class="button-tab">Back</a>
	<?php } ?>
    </div>
    <div class="inner-right">
        <div class="inner-right-col">
            <div class="i-right-ttl">Send us a message! </div>
            <div class="percent_line1"></div>
            <p><a href="<?php echo $this->createUrl('fundraiser/sendmsg_supportcenter', array('id' => $fundraiser_object->id, 'fundraiser_name' => $fundraiser_object->fundraiser_title)); ?>"
                  class="donate-btn donation_form message_btn"><img src="<?php echo SITE_ABS_PATH."images/message-btn.png"; ?>" alt=""/></a>
                <?php 
                $contact_data= Settings::model()->find();
                ?>
                <strong><?php echo $contact_data->phone_no; ?></strong><br>
                <?php echo $contact_data->address;?>
            </p>
                
    </div>
    </div>
        
    <div class="inner-right1">
        <div class="i-right-ttl">Follow us </div>
        <div class="percent_line1"></div>
        <a class="link1" target="_blank" href="https://www.facebook.com/Giveyourbit-476073536087038/">Facebook</a></br>
        <a class="link1" target="_blank" href="https://twitter.com/giveyourbit">Twitter</a></br>
        <a class="link1" target="_blank" href="https://www.linkedin.com/company/Giveyourbit">Linked In</a><br/>
        <a class="link1" target="_blank" href="https://www.youtube.com/channel/UCa23bsMB9vTtJCFdlJGNsEA">Youtube</a><br/>            
        <a class="link1" target="_blank" href="https://www.instagram.com/giveyourbit/">Instagram</a>
    </div>

    <div class="inner-right2">
        <div id="sidebar" class="f-team">
            <div class="f-team-ttl">Featured Fundraisers</div>        
                <div class="section-slider-main-div">
                    <div id="slider-col2">
                        <div class="loader" style="display: none">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/admin/ajax-loader1.gif"/></a>
                        </div>
                        <div class="Fundraisers" id="ajaxload">
                            <?php
                                $featured_fundraisers = Fundraiser::model()->findAll(array('select' => '*', 'condition' => 'feature_flag = "Y" AND status = "Y" ORDER BY rand() LIMIT 1'));
                                if (!empty($featured_fundraisers)) {
                                    foreach ($featured_fundraisers as $fundraiser) { 
                                        $percentage = $fundraiser->getDonationPercentage();
                                ?>                                                                    
                                        <div class="slide">
                                            <h4 class="teg-h4"><?php echo $fundraiser->getTypeName(); ?></h4>
                                            <div class="section-img">
                                                <?php echo $fundraiser->getRewardStartImage(); ?>
                                                <a href="<?php echo $fundraiser->getURL(); ?>">
                                                    <img style="height: 221px;" src="<?php echo $fundraiser->getImageURL(); ?>">
                                                </a>
                                            </div>
                                            <h4 class="teg1-h4 teg1-color"><?php echo $fundraiser->getGoalAmount(); ?></h4>
                                            <div class="slider-bottom-img ">
                                                <div class="percent_line" style="width:<?php echo $percentage; ?>"></div>
                                            </div>
                                            <div class="parsen">
                                                <p class="left-teg1"><?php echo  $percentage; ?> </p>
                                                <p class="right-teg1"><?php echo  $fundraiser->getDaysLeft(); ?>
                                            </div>
                                            <a href="<?php echo $fundraiser->getURL(); ?>">
                                                <h4 class="teg1-h4 teg4-h4">Case No. <?php  echo $fundraiser->id ?> <br> <?php echo $fundraiser->fundraiser_title  ?> </h4>                                        
                                            </a>
                                        </div>
                                    </a>
                                <?php } ?> 
                            <?php } ?>
                        </div>
                    </div>
                </div>        
        </div>
    </div>
        

</div>
   
