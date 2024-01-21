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
        <h4>Invite Friends</h4>
        <div class="lead_tab">
            <?php echo $this->renderPartial('/layouts/dashboard_menu'); ?>
        </div>
    </div>
    <div class="dashboard_content">
   
            <div class="inner-page">
                
                <div id="check_email_provider" class="inner-left">
                    <?php echo UtilityHtml::get_flash_message(); ?>

                    <?php if($_REQUEST['type']== 'email'){ ?>  
                            <p>Promote this fundraiser to your contacts by adding multiple email addresses separated with commas.</p> 
                    <?php }else{ ?>
                           <p>Promote this fundraiser to your contacts by adding multiple phone numbers.</p> 
                    <?php } ?>
                        
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
                        
                        
                        <div class="box-body">
                            <?php echo $form->hiddenField($model, 'user_id', array('type' => "hidden", 'value' => Yii::app()->frontUser->id)); ?>
                            <?php if($_REQUEST['type']== 'email'){ ?>  
                            <?php
                            $id=Yii::app()->frontUser->id;
                            $fund_supp_data = Yii::app()->db->createCommand()
                                    ->select(array('sf.*'))
                                    ->from('setup_fundraiser sf')
                                   // ->from(array('supporter', 'setup_fundraiser'))
                                    ->join('supporter sp', 'sp.fundraiser_id=sf.id')
                                    ->where('sp.user_id=:user_id', array(':user_id'=> $id))
                                    ->queryAll();                             
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
                                <?php echo $form->labelEx($model, 'fundraiser_name'); ?>                                
                                <?php echo $form->dropDownList($model, 'fundraiser_name',$mrp_fund,array('prompt' => '-- Please Select Fundraiser --')); ?>
                                <?php echo $form->error($model, 'fundraiser_name'); ?>
                            </div>

                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'email'); ?>
                                <?php echo $form->textArea($model, 'email', array('placeholder'=>'Enter email addresses separated with commas')); ?>
                                <?php echo $form->error($model, 'email'); ?>
                            </div>
                            <div class="box-footer">
                                <?php
                                echo GxHtml::submitButton(Yii::t('app', 'Send Invitation'), array('class' => 'btn_send_ans'));
                                ?>
                            </div>
                            <?php } else { ?>
                            <div class="form-group">
                                <?php echo $form->labelEx($model, 'fundraiser_name'); ?>
                                <?php echo $form->dropDownList($model, 'fundraiser_name', GxHtml::listDataEx(SetupFundraiser::model()->findAllByAttributes(array('user_id' =>Yii::app()->frontUser->id ))),array('prompt' => '-- Please Select --')); ?>
                                <?php echo $form->error($model, 'fundraiser_name'); ?>
                            </div>
                            <div class="form-group"  >
                                <?php echo $form->labelEx($model, 'contact_numbers'); ?>
                                <?php echo $form->textArea($model, 'contact_numbers', array('placeholder'=>'Enter contacts separated with commas.')); ?>
                                <?php echo $form->error($model, 'contact_numbers'); ?>
                            </div>
                            <div class="box-footer">
                                <?php
                                echo GxHtml::submitButton(Yii::t('app', 'Send Invitation'), array('class' => 'btn_send_ans'));
                                ?>
                            </div>
                            <?php } ?>

                        
                            
                            <?php if($_REQUEST['type']== 'email'){ ?>  
                                        <p>We will send invitation to the email addresses you enter.</p> 
                            <?php }else{ ?>
                                        <p>We will send invitation to the phone numbers you enter.</p> 
                            <?php } ?>
                        </div>    
                        <?php
                        $this->endWidget();
                    
                    ?>

                </div>

                
                <div id="invite_links_with_si">
                        <!--                    <div id="social_icons_cls">
                        <div id="social_icons_cls">
                        <a href="#"><span>Facebook</span> <p><img src="<?php echo SITE_ABS_PATH."images/fb.png"; ?>" alt=""/></p></a>
                        <a href="#"><span>Twitter</span> <p><img src="<?php echo SITE_ABS_PATH."images/tw.png"; ?>" alt=""/></p></a>
                        <a href="#"><span>Google+</span> <p><img src="<?php echo SITE_ABS_PATH."images/gp.png"; ?>" alt=""/></p></a>
                        <a href="#"><span>Linkedin</span> <p><img src="<?php echo SITE_ABS_PATH."images/in.png"; ?>" alt=""/></p></a>
                        <a href="#"><span>More</span> <p><img src="<?php echo SITE_ABS_PATH."images/pl.png"; ?>" alt=""/></p></a>
                    </div>
                    </div>-->
                <div class="inner-right">

                    <div class="form-group">
                        <a  style="<?php echo ($type=='email') ? 'cursor:not-allowed; background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) repeat scroll 0 0 !important' : ''; ?>" href="<?php echo ($type=='email') ? "javascript::void(0);" : $this->createUrl('Fundraise/invite_friends',array('type'=>'email')); ?>"
                           class="btn_question">Invite by Email</a>
                    </div>

                    <div class="form-group">
                        <a style="<?php echo ($type=='contact') ? ' cursor:not-allowed; background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) repeat scroll 0 0 !important;' : ''; ?>" href="<?php echo ($type=='contact') ? "javascript::void(0);" : $this->createUrl('Fundraise/invite_friends',array('type'=>'contact')); ?>"
                           class="btn_question">Invite by Phone</a>
                    </div>

                </div>
                </div>
            </div>
    
    </div>

</div>


<?php
if(!empty($_REQUEST['f_id'])){ ?>
    <?php $loadurl = $this->createUrl('fundraise/invite_bymo_response', array('code'=>$_REQUEST['f_id']));
    ?>

    <script>
        $(document).ready(function () {

            $.fancybox.open([
                {
                    href : "<?php echo $loadurl; ?>"
//                    title : '1st title'
                }]
                , {
                    maxWidth: 400,
                    maxHeight: 200,
                    fitToView: false,
                    width: '100%',
                    height: '100%',
                    autoSize: false,
                    closeClick: false,
                    openEffect: 'none',
                    closeEffect: 'none',
                    'type': 'iframe',
                    helpers : { overlay : { locked : false,closeClick: false  } }
            });

        });
    </script>
<?php }
?>



