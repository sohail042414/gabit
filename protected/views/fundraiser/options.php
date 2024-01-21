<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css"
      href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen"/>
<style>
    #sub_pay{
        
    margin-top: 20px;
    line-height: 35px;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    float: left;
    padding: 5px 30px;
    /* margin-top: 40px !important; */
    background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0 !important;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ee1023), color-stop(100%,#9c0405)) !important;
    background: -webkit-linear-gradient(top, #ee1023 0%,#9c0405 100%) !important;
    color: #FFF;
    border: none;
    font-family: Arial, Helvetica, sans-serif;
    border-radius: 5px !important;
    margin-bottom: 40px;
    margin: 0 auto;
    margin-left: 32%;    
    }
    .new_class{
       font-size: 13px;
    line-height: 26px;
    text-align: center;
    color: green;
    font-family: Arial, Helvetica, sans-serif;
    border: #CCC 2px dashed;
    padding: 20px;
    font-weight: 100;
    overflow: hidden;
    }
    h4 {
        font-size: 18px;
        line-height: 26px;
        text-align: center;
        color: green;
        font-family: Arial, Helvetica, sans-serif;
        border: #CCC 2px dashed;
        padding: 20px;
        font-weight: 100;
    }
    .red-message{
        color:red !important;
    }    
    .blue-message{
        color:blue !important;
    }

    .note{
        font-size:15px;
        margin : 5px 0px;
    }
</style>

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
	width: 90%;
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


/*
select[name="Transactions[country_code]"]{width: 65px; height: 35px;}
input[name="Transactions[donor_phone_no]"]{width: 125px; float: right;}
*/

@media only screen and (max-width:360px) {
	.form-control {
		width: 95%;
	}
	.box-footer input {
		margin-left: 0px;
	}
}

</style>

<div id="dial_message_container">
    
<h4 id="dial_message">
    <?php echo $message_html; ?> 
    <a href="<?php echo $payment_url; ?>" class="blue-message" id="more_message">HERE</a> to donate using a payment card.
</h4>

<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'donations-form',
    'action' => $uss_form_action,
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
<div class="box-body" style="padding:10px;">
    <!-- <p class="note">For GTBank USSD payment please complete the details below</p> -->
    <div class="form-group">
        <label>Mobile No</label>
		<div class="input_cls">
        <?php echo $form->textField($transaction, 'donor_phone_no', array('maxlength' => 255)); ?>
        <?php echo $form->error($transaction, 'donor_phone_no'); ?>
        </div>
    </div>

    <div class="form-group">
        <label>Case No</label>
		<div class="input_cls">
        <?php echo $form->textField($transaction, 'fundraiser_id', array('maxlength' => 255)); ?>
        <?php echo $form->error($transaction, 'fundraiser_id'); ?>
        </div>
    </div>

    <div class="form-group">
        <?php echo $form->label($transaction, 'donation_amount'); ?>
        <div class="input_cls">
        <?php echo $form->textField($transaction, 'donation_amount'); ?>
        <?php echo $form->error($transaction, 'donation_amount'); ?>
        </div>
    </div>

	<div class="form-group">
        <?php echo $form->label($transaction, 'transaction_amount'); ?>
        <div class="input_cls">
        <?php echo $form->textField($transaction, 'transaction_amount'); ?>
        <?php echo $form->error($transaction, 'transaction_amount'); ?>
        <p style="font-size: 10px; padding-top: 43px;">Your transfer includes 8% + 5.00 processing fees</p>
		</div>		
    </div>


</div>
<p class="note">Please complete the USSD payment on your phone before tapping on red "Done" button below.</p>
<div class="box-footer">
    <?php echo GxHtml::submitButton(Yii::t('app', 'Done'), array(
        'id' => 'view_btn',
        'class' => 'class="button-tab open_success_donation"',
        'style' => 'line-height:26px; margin: 10px auto; float:none; display:table;'
        ));  ?>
</div>

<?php
$this->endWidget();
?>
