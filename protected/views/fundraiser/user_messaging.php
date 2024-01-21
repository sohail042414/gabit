<style type="text/css">

.comment_prayer{width: 100%; float: left}

.clear{margin:0px; padding:0px; clear:both;}

h4 {float: left; font-size: 22px; font-weight: lighter; width: 100%; margin:0px; font-family:Arial, Helvetica, sans-serif; text-transform:capitalize; border-bottom:#666 1px solid; margin-bottom:30px; padding-bottom:20px; line-height:30px;}

.supporter_right p {float: left; font-size: 13px; font-weight: 500; width: 100%; margin:0px; font-family:Arial, Helvetica, sans-serif; margin-bottom:20px;}

.link_login{font-size: 13px; font-weight: 600; font-family:Arial, Helvetica, sans-serif; background:#f31126; text-align:center; line-height:30px; padding:0px 10px; float:left; color:#FFF; text-decoration:none; border-radius:3px; margin-bottom:20px;}



.form-group{width:100%; float:left; margin-bottom:20px}

label{width:105px !important; float:left; font-size: 13px; font-weight: 500; width: 100%; margin:0px; font-family:Arial, Helvetica, sans-serif; line-height:30px;}  

.form-control{font-size: 13px; font-weight: 500; width: 190px; margin:0px; font-family:Arial, Helvetica, sans-serif; height:30px; border:#CCC 1px solid; float:left; padding-left:5px;}

.input_cls{width:190px; float:left;}

.form-group textarea{width:190px; float:left; height: 120px; float: left;}

.box-footer input{font-size: 13px; font-weight: 600; font-family:Arial, Helvetica, sans-serif; text-align:center; line-height:30px; padding:0px 10px; float:left; color:#FFF; text-decoration:none; border-radius:3px; margin-left:125px; margin-bottom:20px; border:none; cursor:pointer; -webkit-appearance:none;



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

.errorMessage {color: red; font-family: arial;  font-size: 12px; line-height: 22px; width:100%; float:left;}





@media only screen and (max-width:480px){

.supporter_left, .supporter_right{width:100%;}

.comment_prayer{width:100%;}

label{width:125px;}

.form-group input{width:200px;}

.form-group textarea{width:190px; padding: 2%;}

.box-footer{margin-left: 0px;}

}





</style>

<?php

$msgname= $_REQUEST['msg_name'];

$msgid= $_REQUEST['msg_id'];

$msgmail= $_REQUEST['msg_mail'];

?>

<h4>Contact <?php echo $msgname;?> </h4>

<?php

$form = $this->beginWidget('CoreGxActiveForm', array(

    'id' => 'user-messaging-form',

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

<div class="box-body">

    <?php echo UtilityHtml::get_flash_message(); ?>



    <!--            <div class="form-group">-->

    <!--                --><?php //echo $form->labelEx($model, 'fundraiser_id'); ?>

    <!--                --><?php //echo $form->dropDownList($model, 'fundraiser_id', GxHtml::listDataEx(SetupFundraiser::model()->findAllAttributes(null, true))); ?>

    <!--                --><?php //echo $form->error($model, 'fundraiser_id'); ?>

    <!--            </div>-->



    <?php echo $form->hiddenField($model, 'user_id', array('type' => "hidden", 'value' => $msgid)); ?>

    <?php echo $form->hiddenField($model, 'user_mail', array('type' => "hidden", 'value' => $msgmail)); ?>



    <div class="form-group">

        <?php echo $form->labelEx($model, 'name'); ?>

        <?php echo $form->textField($model, 'name', array('maxlength' => 255)); ?>

        <?php echo $form->error($model, 'name'); ?>

    </div>

    <div class="form-group">

        <?php echo $form->labelEx($model, 'email'); ?>

        <?php echo $form->textField($model, 'email', array('maxlength' => 255)); ?>

        <?php echo $form->error($model, 'email'); ?>

    </div>

    <div class="form-group">

        <?php echo $form->labelEx($model, 'message'); ?>

        <div class="input_cls">

        <?php echo $form->textArea($model, 'message', array('maxlength' => 600, 'rows' => 6, 'cols' => 60)); ?>

        <?php echo $form->error($model, 'message'); ?>

    </div>        

    </div>





    <!--            <div class="form-group">-->

    <!--                --><?php //echo $form->labelEx($model, 'donor_message'); ?>

    <!--                --><?php //echo $form->textArea($model, 'donor_message'); ?>

    <!--                --><?php //echo $form->error($model, 'donor_message'); ?>

    <!--            </div>-->



</div>

<div class="clear"></div>

<div class="box-footer">

    <?php

    echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn btn-primary'));

    ?>

</div>

<?php

$this->endWidget();

?>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>

<script>

    $(document).ready(function () {

        //alert("aaaaaaa");

        $("span").addClass("requ");

        $("label").addClass("requ11");

    });

</script> 

<script>

//   $(document).ready(function () {

//      //alert("aaaa"); 

//       $(".btn-primary").click(function(){

//          // alert("sssss");

//       var name= $("#UserMessaging_name").val();

//       var email= $("#UserMessaging_email").val();

//       var messg= $("#UserMessaging_message").val();

//       

//       if(name==""){

//        $("#aaa").html();   

//       }

//       

//       

//           })

//           });    

</script>    

