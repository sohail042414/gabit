<style type="text/css">
.clear {
	margin: 0px;
	padding: 0px;
	clear: both;
}

h4 {
	float: left;
	font-size: 22px;
	font-weight: lighter;
	width: 100%;
	margin: 0px;
	font-family: Arial, Helvetica, sans-serif;
	/* text-transform: capitalize; */
	border-bottom: #666 1px solid;
	margin-bottom: 30px;
	padding-bottom: 10px;
	line-height: 30px;
}

.supporter_right p {
	float: left;
	font-size: 13px;
	font-weight: 500;
	width: 100%;
	margin: 0px;
	font-family: Arial, Helvetica, sans-serif;
	margin-bottom: 20px;
}

.link_login {
	font-size: 13px;
	font-weight: 600;
	font-family: Arial, Helvetica, sans-serif;
	background: #f31126;
	text-align: center;
	line-height: 30px;
	padding: 0px 10px;
	float: left;
	color: #FFF;
	text-decoration: none;
	border-radius: 3px;
	margin-bottom: 20px;
}

.form-group {
	width: 100%;
	float: left;
	margin-bottom: 20px
}

label {
	width: 125px !important;
	float: left;
	font-size: 13px;
	font-weight: 500;
	width: 100%;
	margin: 0px;
	font-family: Arial, Helvetica, sans-serif;
	line-height: 30px;
}

.form-control {
	font-size: 13px;
	font-weight: 500;
	width: 190px;
	margin: 0px;
	font-family: Arial, Helvetica, sans-serif;
	height: 30px;
	border: #CCC 1px solid;
	float: left;
	padding-left: 5px;
}

.input_cls {
	width: 190px;
	float: left;
}

.box-footer input {
	font-size: 13px;
	font-weight: 600;
	font-family: Arial, Helvetica, sans-serif;
	text-align: center;
	line-height: 30px;
	padding: 0px 10px;
	float: left;
	color: #FFF;
	text-decoration: none;
	border-radius: 3px;
	margin-left: 125px;
	margin-bottom: 20px;
	border: none;
	cursor: pointer;
	-webkit-appearance: none;
	background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #ee1023), color-stop(100%, #9c0405));
	/* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #ee1023 0%, #9c0405 100%);
	/* Chrome10+,Safari5.1+ */
	color: #fff;
	-webkit-appearance: none;
	color: #fff;
}

.box-footer input:hover {
	background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) repeat scroll 0 0;
	background: -webkit-gradient(linear, left top, left bottom, color-stop(0%, #959595), color-stop(0%, #000000), color-stop(8%, #4e4e4e), color-stop(16%, #4e4e4e), color-stop(50%, #0d0d0d), color-stop(83%, #4e4e4e), color-stop(91%, #4e4e4e), color-stop(100%, #1b1b1b)) !important;
	/* Chrome,Safari4+ */
	background: -webkit-linear-gradient(top, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) !important;
	/* Chrome10+,Safari5.1+ */
}

label .required {
	color: red;
}

.errorMessage {
	color: red;
	font-family: arial;
	font-size: 12px;
	line-height: 22px;
	width: 100%;
	float: left;
}

input {
	box-sizing: border-box;
	height: 35px !important;
}

select {
	box-sizing: border-box;
}

select[name="Transactions[country_code]"] {
	width: 65px;
	height: 35px;
}

#Transactions_signup_check{
	height: 15px !important;
}

input[name="Transactions[donor_phone_no]"] {
	width: 125px;
	float: right;
}

@media only screen and (max-width:360px) {
	.form-control {
		width: 95%;
	}
	.box-footer input {
		margin-left: 0px;
	}
}

.rewar-text{
	color:#464646;
	line-height:18px;
    text-decoration: none;
    font-family:Arial, Helvetica, sans-serif;
	color:#464646;
	font-size:12px;
    display: inline;
}


.rewar-text >a {
	color:#464646;
	line-height:18px;
    font-family:Arial, Helvetica, sans-serif;
	color:#464646;
	font-size:12px;
}

#view_btn{
        margin-top: 20px;
	line-height:25px;
	text-align:center;
	font-size:14px;
	font-weight:bold;
	float:left;
	padding:5px 25px;
	/*margin-top:40px !important;*/
	background:rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0 !important;
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ee1023), color-stop(100%,#9c0405)) !important; /* Chrome,Safari4+ */
background: -webkit-linear-gradient(top, #ee1023 0%,#9c0405 100%) !important; /* Chrome10+,Safari5.1+ */
	color:#FFF;
	border:none;
	font-family:Arial, Helvetica, sans-serif;
	border-radius:5px !important;
        margin-bottom: 40px;
}
#view_btn:hover{background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #959595 0%, #000000 0%, #4e4e4e 8%, #4e4e4e 16%, #0d0d0d 50%, #4e4e4e 83%, #4e4e4e 91%, #1b1b1b 100%) repeat scroll 0 0 !important; 
background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#959595), color-stop(0%,#000000), color-stop(8%,#4e4e4e), color-stop(16%,#4e4e4e), color-stop(50%,#0d0d0d), color-stop(83%,#4e4e4e), color-stop(91%,#4e4e4e), color-stop(100%,#1b1b1b)) !important; /* Chrome,Safari4+ */
    background: -webkit-linear-gradient(top, #959595 0%,#000000 0%,#4e4e4e 8%,#4e4e4e 16%,#0d0d0d 50%,#4e4e4e 83%,#4e4e4e 91%,#1b1b1b 100%) !important; /* Chrome10+,Safari5.1+ */ 
color:#FFF !important;}

</style>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<?php if($fundraiser->hasEnded()){ ?>
	<h4 style="">This fundraiser has ended!</h4>	
	<a href="javascript:;" id="view_btn" class="button-tab open_success_donation" style="margin: 10px auto; float:none; display:table;">Close</a>    
<?php }else { ?>
<h4 style="">Make a Donation to <?php echo $fundraiser_name;?></h4>
<?php

$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'donations-form',
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
?>
<div class="box-body" style="padding:30px;">
    
    <?php echo UtilityHtml::get_flash_message(); ?>
    <?php echo $form->hiddenField($model, 'fundraiser_id', array('type' => "hidden", 'value' => $fundraiser->id)); ?>
    <div class="form-group"> 
        <?php echo $form->labelEx($model,'Anonymous'); ?>
        <div class="input_cls">   
        <?php echo $form->checkBox($model,'checked_bx', array('checkvalue'=>'1','uncheckValue'=>'0'),array('checked'=>'checked')); ?>
        </div>
    </div>
    <div class="form-group">
        <?php echo $form->labelEx($model, 'donor_name'); ?>
        <div class="input_cls">
		<?php echo $form->textField($model, 'donor_name', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'donor_name'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'donor_email'); ?>
		<div class="input_cls">
        <?php echo $form->textField($model, 'donor_email', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'donor_email'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="label_cls"><?php echo $form->labelEx($model, 'age'); ?></div>
        <div class="input_cls">
            <?php echo $form->textField($model, 'age'); ?>
            <?php echo $form->error($model, 'age'); ?>
        </div>
    </div>
    <div class="form-group">
        <div class="label_cls"><?php echo $form->labelEx($model, 'sex'); ?></div>
        <div class="input_cls">
            <?php echo $form->dropDownList($model, 'sex', array('' => Yii::t('app', 'Select Sex'), 'M' => Yii::t('app', 'Male'), 'F' => Yii::t('app', 'Female'))); ?>
            <?php echo $form->error($model, 'sex'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'donor_phone_no'); ?>
		<div class="input_cls">
        <?php echo $form->dropDownList($model, 'country_code',UtilityHtml::countryList()); ?>
        <?php echo $form->textField($model, 'donor_phone_no', array('maxlength' => 255)); ?>
        <?php echo $form->error($model, 'donor_phone_no'); ?>
        </div>
    </div>

	<div class="form-group">
        <?php echo $form->labelEx($model, 'donation_amount'); ?>
        <div class="input_cls">
        <?php echo $form->textField($model, 'transaction_amount'); ?>
        <?php echo $form->error($model, 'transaction_amount'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->labelEx($model, 'referral_code'); ?>
        <div class="input_cls">
        <?php echo $form->textField($model, 'referral_code'); ?>
        <?php echo $form->error($model, 'referral_code'); ?>
        </div>
    </div>

    <div class="form-group"> 
        <?php //echo $form->labelEx($model,'signup_check'); ?>
		<label for="Transactions_signup_check">&nbsp;</label>
        <div class="input_cls" style="width:250px;">   
            <?php echo $form->checkBox($model,'signup_check', array('checkvalue'=>'1','uncheckValue'=>'0'),array('checked'=>'checked')); ?>             
            <p class="rewar-text">Sign me up for the <a target="_blank" href="<?php echo Yii::app()->createUrl('rewards/index'); ?>">donor reward program</a></p>
        </div>
    </div>

</div>
<div class="clear"></div>
<div class="box-footer">
<?php echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn btn-primary'));  ?>
</div>
<?php $this->endWidget(); ?>

<script>
  $(document).ready(function () { 
    $('#<?php echo Chtml::activeId($model,'checked_bx') ?>').click(function(){
        if($(this).is(':checked')){        
            $('#<?php echo Chtml::activeId($model,'donor_name') ?>').attr("disabled", "disabled");
            //$('#<?php echo Chtml::activeId($model,'donor_email') ?>').attr("disabled", "disabled");
        } else {
            $('#<?php echo Chtml::activeId($model,'donor_name') ?>').removeAttr("disabled");
            //$('#<?php echo Chtml::activeId($model,'donor_email') ?>').removeAttr("disabled");
        }
    });
});
</script>
<?php } ?>
<script>
    $(document).ready(function () {
       $('#view_btn').click(function () {
           //parent.$.fancybox.close();
           parent.location.reload();
       });
    });
</script>