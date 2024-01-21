<?php 
/* @var $this SupporterController */
/* @var $model Supporter */
/* @var $form CActiveForm */
?>
<?php if($supporter_added){ ?>
<script type='text/javascript'>
    parent.showSupporterAddedMessage();
    parent.$.fancybox.close();   
</script>    
<?php }else { ?>
<style type="text/css">
#join_form{width:400px; margin:0px auto;}
#join_form h4 {float: left; font-size: 20px; font-weight: lighter; width: 100%; margin:0px; font-family:Arial, Helvetica, sans-serif; text-transform:capitalize; border-bottom:#666 1px solid; margin-bottom:10px; line-height:50px;}
.form-group{width:100%; float:left; margin-bottom:15px;}
label{width:140px; float:left; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal;}
textarea{width:220px; height:70px; float:left; border:#CCC 1px solid; font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; padding:8px; -webkit-appearance:none;}
input.form-control{width:230px; height:30px; float:left; border:#CCC 1px solid; font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; padding-left:5px; -webkit-appearance:none;}
#join_form .btn-primary{font-size: 13px; font-weight: 600; font-family:Arial, Helvetica, sans-serif; background:#f31126; text-align:center; line-height:30px; padding:0px 10px; float:left; color:#FFF; text-decoration:none; border-radius:3px; margin-bottom:20px; border:none; -webkit-appearance:none; margin-left:140px;}
.errorMessage{float:left; color:red; font-size:12px; font-family:Arial, Helvetica, sans-serif; line-height:20px; margin-left:140px;}
#up-img-row{width:190px; float:left; margin-top:20px;}
#up-img-row img{max-width:100%;}


.alert.alert-success.alert-dismissable {
    color: green;
    font-family: arial;
    font-size: 25px;
    padding-bottom: 10px;
    text-align: center;
    width: 100%;
}

#join_form p{  float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 13px;
    font-weight: normal;
    width: 140px;
}


@media screen and (-webkit-min-device-pixel-ratio:0) { 
textarea{width:227px;}
}

@media only screen and (max-width: 480px){
#join_form{width:100%;}
#join_form label{width:100%; float:left;}
#join_form .errorMessage{margin-left:0px; float:left;}
textarea{width:200px;}
input.form-control{width:200px;}
#join_form .btn-primary{margin-left:0px;}
}
/*#join_form{text-align:center;}*/
#join_form span{font-family:Arial, Helvetica, sans-serif; font-size:16px; width:100%; float:left;}
#join_form input[type=button]{background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0; padding:5px 10px; border:none; border-radius:5px; color:#FFF; float:none; margin:15px 0px;}

</style>

<div id="join_form">

    <h4>Contact <?php echo $fundraiser_owner->username; ?> to join the team</h4>
    <div class="form">
        <?php
        $form = $this->beginWidget('CoreGxActiveForm', array(
            'id' => 'supporter-form',
            'enableAjaxValidation' => true,
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
           
            <div class="form-group">
                <?php echo $form->hiddenField($model, 'user_id', array('type' => "hidden", 'value' => $_REQUEST['id'])); ?>
            </div>

            <div class="form-group">
                <?php echo $form->hiddenField($model, 'fundraiser_id', array('type' => "hidden", 'value' => $_REQUEST['fundraiser'])); ?>
            </div>

            <div class="form-group">
                <p>Please upload a picture</p>
                <?php echo $form->fileField($model, 'supporter_image', array('accept' => 'jpg|jpeg|gif|png', 'class' => 'button up-btn')); ?>
                <div id="up-img-row">
                    <div class="img-box">
                        <img id="upload_pic" class="i1" src="" style="display: none;"/>
                    </div>
                </div>
                <?php echo $form->error($model, 'supporter_image', array('clientValidation' => 'js:customValidateFile(messages)'), false, true); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'supporter_email'); ?>
<!--                --><?php //echo $form->textField($model, 'supporter_email'); ?>
                <?php echo $form->textField($model, 'supporter_email'); ?>
                <?php echo $form->error($model, 'supporter_email'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'supporter_message'); ?>
                <?php echo $form->textArea($model, 'supporter_message', array('value' => 'I would like to be a supporter of this fundraiser! I would also like to help to promote it to achieve its goal.')); ?>
                <?php echo $form->error($model, 'supporter_message'); ?>
            </div>

        </div>

        <div class="box-footer">
            <?php echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn btn-primary','id'=>'submit_supporter')); ?>
        </div>

        <?php $this->endWidget(); ?>
    </div>
    <!-- form -->
     </div>

<script type="text/javascript">
    $(document).ready(function () {
        var preview = $("#upload_pic");

        $("#Supporter_supporter_image").change(function (event) {
            var input = $(event.currentTarget);
            var file = input[0].files[0];
            var fileType = file["type"];
            var ValidImageTypes = ["image/gif", "image/jpeg", "image/png"];
            if ($.inArray(fileType, ValidImageTypes) < 0) {
                alert('This is not an image file!');
                return false;
            }
            var reader = new FileReader();
            reader.onload = function (e) {
                image_base64 = e.target.result;
                preview.show();
                preview.attr("src", image_base64);

            };
            reader.readAsDataURL(file);
        });

        $('#submit_supporter').click(function(){

            var email = $('#Supporter_supporter_email').val();
            var image = $('#Supporter_supporter_image').val();
            var flag = '';
            if(!email){
                $('#Supporter_supporter_email_em_').html('Supporter Email cannot be blank.');
                $('#Supporter_supporter_email_em_').show();
                flag = 1;
            }

            if(!image){
                $('#Supporter_supporter_image_em_').html('image required.');
                $('#Supporter_supporter_image_em_').show();
                flag = 1;
            }

            if(flag == 1){               
                return false;
            }else{
                $('#submit_supporter').css('background-color','black');
                startLoader();
                return true;
            }

        });

        // $('#supporter-form').on('afterValidate', function(event, messages, errorAttributes) {            
        //     if ($.isEmptyObject(messages)) {
        //         startLoader();
        //     }
        // });
    });
</script>
<?php } ?>