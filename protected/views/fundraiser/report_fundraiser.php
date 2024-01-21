<style type="text/css">
    body{font-family: arial;}
.clear{margin:0px; padding:0px; clear:both;}
h4 {float: left; font-size: 22px; font-weight: lighter; width: 100%; margin:0px; font-family:Arial, Helvetica, sans-serif; text-transform:capitalize; border-bottom:#666 1px solid; margin-bottom:30px; padding-bottom:20px; line-height:30px;}
.supporter_right p {float: left; font-size: 13px; font-weight: 500; width: 100%; margin:0px; font-family:Arial, Helvetica, sans-serif; margin-bottom:20px;}
.link_login{font-size: 13px; font-weight: 600; font-family:Arial, Helvetica, sans-serif; background:#f31126; text-align:center; line-height:30px; padding:0px 10px; float:left; color:#FFF; text-decoration:none; border-radius:3px; margin-bottom:20px;}

.report_fundraiser{width: 400px; margin: 0px auto;}
.form-group{width:100%; float:left; margin-bottom:20px}
label{width:160px !important; float:left; font-size: 13px; font-weight: 500; width: 100%; margin:0px; font-family:Arial, Helvetica, sans-serif; line-height:30px;}  
.form-control{font-size: 13px; font-weight: 500; width: 240px; margin:0px; font-family:Arial, Helvetica, sans-serif; height:30px; border:#CCC 1px solid; float:left; padding:5px; box-sizing: border-box;}
textarea.form-control{font-size: 13px; font-weight: 500; width: 240px; margin:0px; font-family:Arial, Helvetica, sans-serif; height:90px; border:#CCC 1px solid; float:left; padding:5px; box-sizing: border-box;}
/*.input_cls{width:190px; float:left;}*/

.box-footer input{font-size: 13px; font-weight: 600; font-family:Arial, Helvetica, sans-serif; text-align:center; line-height:30px; padding:0px 10px; float:left; color:#FFF; text-decoration:none; border-radius:3px; margin-left:160px; margin-bottom:20px; border:none; cursor:pointer; -webkit-appearance:none;

	background:rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0 ;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ee1023), color-stop(100%,#9c0405)); /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #ee1023 0%,#9c0405 100%); /* Chrome10+,Safari5.1+ */
    color: #fff;
-webkit-appearance:none;
	
	
    color: #fff;
	
}

.box-footer input:hover{
background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) repeat scroll 0 0;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#959595), color-stop(0%,#000000), color-stop(8%,#4e4e4e), color-stop(16%,#4e4e4e), color-stop(50%,#0d0d0d), color-stop(83%,#4e4e4e), color-stop(91%,#4e4e4e), color-stop(100%,#1b1b1b)) !important; /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #959595 0%,#000000 0%,#4e4e4e 8%,#4e4e4e 16%,#0d0d0d 50%,#4e4e4e 83%,#4e4e4e 91%,#1b1b1b 100%) !important; /* Chrome10+,Safari5.1+ */
	
}

label .required{color:red;}
.errorMessage {box-sizing:border-box;  color: red; font-family: arial;  font-size: 12px; line-height: 22px; width:100%; float:left; padding-left: 160px;}

p {
    color: #464646;
    float: left;
    font-size: 16px;
    font-weight: normal;
    line-height: 26px;
    margin: 15px 0;
    text-align: left;
    width: 100%;
}

input{box-sizing:border-box; height: 35px !important;}
select{box-sizing:border-box;}
select{width: 65px; height: 35px;}
input{width: 125px; float: right;}
textarea {
    border: 1px solid #ccc;
    float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 13px;
    font-weight: normal;
    height: 70px;
    padding: 8px;
    width: 220px;
}

label {
    float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 13px;
    font-weight: normal;
    width: 160px;
}


@media only screen and (max-width:360px){
.form-control{width:95%;}
.box-footer input{margin-left:0px;}
}

</style>
<div class="report_fundraiser">
<h4>Report Fundraiser</h4>
 <?php echo UtilityHtml::get_flash_message(); ?>
    <!--<h4>Start a Fundraiser</h4>-->
        <div class="clear"></div>    
                            
        <?php
                        $form = $this->beginWidget('CoreGxActiveForm', array(
                            'id' => 'report_fundraiser-form',
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
                        
<div class="event_box" >
            <p>If this page is offensive and unsuitable, you can flag it with the precise information of your concern and we will act on the information as quickly as
possible. We are grateful for your help to keep Giveyourbit safe.</p>
            <?php //echo $form->textField($model, 'requirements'); id="invitaion_div1"?>
                        
            <div class="form-group"  >
                <?php echo $form->labelEx($model, 'user_name'); ?>
                <?php echo $form->textField($model, 'user_name'); ?>
                <?php echo $form->error($model, 'user_name'); ?>
            </div>
                            
            <div class="form-group"  >
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email'); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>
                            
            <div class="form-group"  >
                <?php echo $form->labelEx($model, 'description'); ?>
                <?php echo $form->textArea($model, 'description'); ?>
                <?php echo $form->error($model, 'description'); ?>
            </div>

        <div class="box-footer">
            <?php
            echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans'));
            ?>
        </div>
        <p>You may not hear back from us due to the volume of mails we receive daily. However, be rest assured that we will act on your information accordingly.</p>
        </div>    
<?php
    $this->endWidget();
?>
</div>
                       
    



