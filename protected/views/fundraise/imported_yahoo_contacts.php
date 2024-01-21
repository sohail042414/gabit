<style type="text/css">
    .box-body {
        margin-top: 40px;
    }
    #ans_response1 {
        color: green;
        float: left;
        font-size: 15px;
        font-weight: 600;
        margin: 0 0 20px;
    }
    #fundraise_form input.upload_file{border:none !important;}
    @media only screen and (max-width: 480px){
        #fundraise_form input.upload_file{ margin-top:10px !important;}
    }
</style>

<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
<!--<meta name="viewport" content="width=device-width" />-->

<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">
    
    <div class="lead_support">
        <h4>Request Fund Transfer</h4>
        <div class="lead_tab">
            <ul>
                <li ><a href="<?php echo $this->createUrl('Fundraise/Question'); ?>">Setup Fundraiser</a></li>                        
                <li><a href="<?php echo $this->createUrl('fundraiser/managefundraiser'); ?>">View/Manage My Fundraiser</a></li>                        
                <li ><a href="<?php echo $this->createUrl('fundraise/fund_transfer'); ?>">Request Fund Transfer</a></li>                        
                <li class="active"><a href="<?php echo $this->createUrl('Fundraise/Invite_friends',array('type'=>'email'));  ?>">Invite Friends</a></li>  
                <li><a href="<?php echo $this->createUrl('site/notifications'); ?>">Notifications</a><?php $notification_count = UtilityHtml::get_notification_count_for_user(); if(!empty($notification_count)) { echo '<span>'.$notification_count.'</span>'; } ?></li>                        
            </ul>
        </div>
    </div>

    <div class="dashboard_content">
   
            <div class="inner-page">
                <div class="inner-left">
                <div id="fundraise_form">
                   
                    <h4>Promote your Fundraiser with your Contacts</h4>
           
                    <p>Promote this fundraiser by adding your email and choosing a service provider.
                        
                    </p> 
                     <?php echo UtilityHtml::get_flash_message(); ?>
                        <!--<h4>Start a Fundraiser</h4>-->
                      <div class="clear"></div>    
                        
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
                       //$model = new InviteFriendForm();
                        
                        ?>
                        
                        <?php
                        $this->endWidget();
                    
                    ?>

                </div>

                </div>
                <div class="inner-right">
                    <div class="form-group">
                        <a href="<?php echo $this->createUrl('Fundraise/yahoo_contacts'); ?>"
                           class="btn_question">Yahoo Mail</a>

                    </div>
                    <div class="form-group">
                        <a href="<?php echo $this->createUrl('Fundraise/gmail_contacts'); ?>"
                           class="btn_question">Gmail</a>
                    </div>
                    
                    
                    <div class="form-group">
                        <a href="#<?php //echo $this->createUrl('Fundraise/invite_friends'); ?>"
                           class="btn_question">Hotmail</a>
                    </div>

                    <div class="form-group">
                        <a href="<?php echo $this->createUrl('Fundraise/invite_friends',array('type'=>'email')); ?>"
                           class="btn_question">By Email</a>
                    </div>

                    <div class="form-group">
                        <a href="<?php echo $this->createUrl('Fundraise/invite_friends',array('type'=>'contact')); ?>"
                           class="btn_question">By Contact Number</a>
                    </div>
                </div>
            </div>
    

    </div>

</div>



