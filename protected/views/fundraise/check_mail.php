<style type="text/css">
 .lead_tab ul li{
    flex-grow: 0 !important;
    margin-right: 33px;
}

.lead_tab ul li:last-child{
    margin-right: 0;
}

</style>
<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
<!--<meta name="viewport" content="width=device-width" />-->

<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">
    
    <div class="lead_support">
        <h4>Invite Friends</h4>
        <div class="lead_tab">
            <ul>
                <li ><a href="<?php echo $this->createUrl('Fundraise/index'); ?>">Setup Fundraiser</a></li>                        
                
                <?php  $user_fundraiser_count = SetupFundraiser::model()->count("user_id = ".Yii::app()->frontUser->id." ");
                       if($user_fundraiser_count==0){ 
                ?>
                <li class="txt_blur"><a href="#" style="color:#6bafcb !important">View/Manage My Fundraiser</a></li>                        
                <li class="txt_blur"><a href="#" style="color:#6bafcb !important">Request Fund Transfer</a></li>                        
                <?php }else{?>
                <li><a href="<?php echo $this->createUrl('fundraiser/managefundraiser'); ?>">View/Manage My Fundraiser</a></li>                        
                <li><a href="<?php echo $this->createUrl('fundraise/fund_transfer'); ?>">Request Fund Transfer</a></li>
                <?php } ?> 
                <li><a href="<?php echo $this->createUrl('fundraise/enter_testimonial'); ?>">Enter Testimonial</a></li>
                <li class="active"><a href="<?php echo $this->createUrl('Fundraise/invite',array('type'=>'email'));  ?>">Invite Friends</a></li>  
                <li><a href="<?php echo $this->createUrl('site/notifications'); ?>">Notifications</a><?php $notification_count = UtilityHtml::get_notification_count_for_user(); if(!empty($notification_count)) { echo '<span>'.$notification_count.'</span>'; } ?></li>                        
            </ul>
        </div>
    </div>

    <div class="dashboard_content">
   
            <div class="inner-page">

                <div id="check_mail_innerleft" class="inner-left">
                <div id="check_email_provider">
                    <?php echo UtilityHtml::get_flash_message(); ?>
<!--                    <h4>Promote your Fundraiser with your Contacts</h4>-->
<!--                    <i>If you select your email service provider, we will send invitation to all the contacts in your address book.</i>-->
                    <p class="text_style_checkmail">Promote this fundraiser to your contacts by adding your email or choosing a service provider.</p> 
               
                 
                        <!--<h4>Start a Fundraiser</h4>-->
              
                        <?php
                        $form = $this->beginWidget('CoreGxActiveForm', array(
                            'id' => 'invite_friends-form',
                            'enableAjaxValidation' => false,
                            'enableClientValidation' => true,
                            'htmlOptions' => array(
                                'enctype' => 'multipart/form-data'
                            ),
                            'clientOptions' => array(
                                'validateOnSubmit' => true,
                                'validateOnChange' => true,
                            ),
                        ));
                       //$model = new CheckEmail();
                        
                        ?>
                        
                        
                        <div class="box-body">
                            <?php echo $form->hiddenField($model, 'user_id', array('type' => "hidden", 'value' => Yii::app()->frontUser->id)); ?>
                            <?php
                            $id=Yii::app()->frontUser->id;
                            $fund_supp_data = Yii::app()->db->createCommand()
                                    ->select(array('sf.*'))
                                    ->from('setup_fundraiser sf')
                                   // ->from(array('supporter', 'setup_fundraiser'))
                                    ->join('supporter sp', 'sp.fundraiser_id=sf.id')
                                    ->where('sp.user_id=:user_id', array(':user_id'=> $id))
                                    ->queryAll();  
//                            echo "<pre>";
//                            p($fund_supp_data);die;
                           
                            ?>
                            <?php 
                            $fundraiser_data= SetupFundraiser::model()->findAll('user_id='.Yii::app()->frontUser->id);
                            $map = new CMap();
                            $map->mergeWith (array($fund_supp_data,$fundraiser_data));
                            
                            $mrp_fund = array();
                            $i=0;
                            foreach ($map as $mrp_data){
                                foreach ($mrp_data as $valaaa){
                                    
                                    if(!empty($valaaa['fundraiser_title'])){
                                        $mrp_fund[$valaaa['id']] = $valaaa['fundraiser_title'];
                                    } else {
                                        $mrp_fund[$valaaa->id] = $valaaa->fundraiser_title;
                                    }
                                    $i++;
                                }
                            }
                            ?>
                            
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'fundraiser'); ?>
                                <?php //echo $form->dropDownList($model, 'fundraiser', GxHtml::listDataEx(SetupFundraiser::model()->findAllByAttributes(array('user_id' =>Yii::app()->frontUser->id ))),array('prompt' => '-- Please Select Fundraiser --')); ?>
                                <?php echo $form->dropDownList($model, 'fundraiser',$mrp_fund,array('prompt' => '-- Please Select Fundraiser --')); ?>
                                <?php echo $form->error($model, 'fundraiser'); ?>
                            </div>
                            <div class="form-group" id="check_mail"  >
                                <?php echo $form->labelEx($model, 'email'); ?>
                                <?php echo $form->textField($model, 'email', array('maxlength' => 45,'placeholder'=>'Enter Email Address.')); ?>
                                <?php echo $form->error($model, 'email'); ?>
                            </div>
                            

                        
                            <div class="box-footer">
                                <?php
                                echo GxHtml::submitButton(Yii::t('app', 'Continue'), array('class' => 'btn_send_ans'));
                                ?>
                            </div>
                            <p class="text_style_checkmail">If you select your email service provider, we will send invitation to all the contacts in your address book.</p> 

                        </div>    
                        <?php
                        $this->endWidget();
                    
                    ?>
                    
                </div>
                </div>
                <div id="invite_links_with_si">
<!--                    <div id="social_icons_cls">
                        <a href="#"><span>Facebook</span> <p><img src="<?php echo SITE_ABS_PATH."images/fb.png"; ?>" alt=""/></p></a>
                        <a href="#"><span>Twitter</span> <p><img src="<?php echo SITE_ABS_PATH."images/tw.png"; ?>" alt=""/></p></a>
                        <a href="#"><span>Google+</span> <p><img src="<?php echo SITE_ABS_PATH."images/gp.png"; ?>" alt=""/></p></a>
                        <a href="#"><span>Linkedin</span> <p><img src="<?php echo SITE_ABS_PATH."images/in.png"; ?>" alt=""/></p></a>
                        <a href="#"><span>More</span> <p><img src="<?php echo SITE_ABS_PATH."images/pl.png"; ?>" alt=""/></p></a>
                    </div>-->
                <div class="inner-right">
<!--                   <div class="form-group">
                        <a href="<?php //echo $this->createUrl('Fundraise/yahoo_contacts'); ?>"
                           class="btn_question">Yahoo Mail</a>

                    </div>
                    <div class="form-group">
                        <a href="<?php //echo $this->createUrl('Fundraise/gmail_contacts'); ?>"
                           class="btn_question">Gmail</a>
                    </div>
                    
                    
                    <div class="form-group">
                        <a href="<?php //echo $this->createUrl('Fundraise/hotmail_contacts'); ?>"
                           class="btn_question">Hotmail</a>
                    </div>-->

                    <!-- <div class="form-group">
                        <a href="<?php //echo $this->createUrl('Fundraise/invite',array('type'=>'email')); ?>"
                           class="btn_question yahoo_mail_btn" id="select_fundraiser">Yahoo Mail</a>

                    </div>
                    <div class="form-group">
                        <a href="<?php //echo $this->createUrl('Fundraise/invite',array('type'=>'email')); ?>"
                           class="btn_question gmail_btn" id="select_fundraiser">Gmail</a>
                    </div>
                    
                    
                    <div class="form-group">
                        <a href="<?php //echo $this->createUrl('Fundraise/invite',array('type'=>'email')); ?>"
                           class="btn_question hotmail_btn" id="select_fundraiser">Hotmail</a>
                    </div> -->

                    <div class="form-group">
                        <a href="<?php echo $this->createUrl('Fundraise/invite_friends',array('type'=>'email')); ?>"
                           class="btn_question">Invite by Email</a>
                    </div>

                    <div class="form-group">
                        <a href="<?php echo $this->createUrl('Fundraise/invite_friends',array('type'=>'contact')); ?>"
                           class="btn_question">Invite by Phone</a>
                    </div>

                </div>
                </div>
            </div>
    </div>

</div>



<script type="text/javascript">
    $('.yahoo_mail_btn').on('click', function () {
         window.alert('Please Select Fundraiser, enter your YAHOO ID and click continue.');
    });
    $('.gmail_btn').on('click', function () {
         window.alert('Please Select Fundraiser, enter your GMAIL ID and click continue. ');
    });
    $('.hotmail_btn').on('click', function () {
         window.alert('Please Select Fundraiser, enter your Hotmail ID and click continue.');
    });
    
</script>

