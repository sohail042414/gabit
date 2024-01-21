<style type="text/css">

    .ans_response1 {
        color: green;
        float: left;
        font-size: 15px;
        font-weight: 600;
        margin: 0px 0 20px 0px;
    }
    .input_cls textarea{width:228px; height:90px; border:#CCC 1px solid;}


</style>
<!-- Start Banner -->
<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<!-- End Banner -->
<div class="inner-container">
    <div class="inner-page">
        <div class="inner-left">
            <h4>Post a Question</h4>

            <div class="Question_container">
                <div id="ans_response" class="ans_response1"></div>
                <?php $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'fundraiser-questions-User-form',
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
                $model = new FundraiserQuestions();
                ?>
                <?php echo $form->hiddenField($model, 'user_id', array('type' => "hidden", 'value' => Yii::app()->frontUser->id)); ?>

                <div class="form-group">
                    <div class="label_cls"><?php echo $form->labelEx($model, 'topic_id'); ?></div>
                    <div
                        class="input_cls"><?php echo $form->dropDownList($model, 'topic_id', GxHtml::listDataEx(Topic::model()->findAll(array("select"=>"*","condition"=>"status = 'Y' "))), array('empty' => 'Please select')); ?></div>
                    <div class="clear"></div>
                    <?php echo $form->error($model, 'topic_id'); ?>
                </div>

                <div class="row">
                    <div class="label_cls"><?php echo $form->labelEx($model, 'questions_text'); ?></div>
                    <div
                        class="input_cls"><?php echo $form->textArea($model, 'questions_text', array('rows' => 3, 'cols' => 30)); ?></div>
                    <div class="clear"></div>
                    <?php echo $form->error($model, 'questions_text'); ?>
                </div>
                <div class="clear"></div>
                <div class="row buttons">
                    <?php echo CHtml::ajaxSubmitButton('Submit', 'Getquestion', array(
//                        'update' => '#ans_response',
                        'type' => 'POST',
                        'success'=>'function(data){
                          $(".ans_response1").html(data);
                          $("#FundraiserQuestions_topic_id").val(" ");
                          $("#FundraiserQuestions_questions_text").val(" ");
                          $("#FundraiserQuestions_questions_text_em_").html("");
                          $("#FundraiserQuestions_questions_text_em_").hide();
                        }'
                    ),
                        array('class' => 'btn_send_ans')
                    );
                    ?>

                </div>
                <?php $this->endWidget(); ?>
            </div>

        </div>
        <div class="inner-right">
            <div class="inner-right-col">
                <a href="<?php echo $this->createUrl('fundraise/index'); ?>"
                   class="btn_question">Start a Fundraiser</a>

            </div>
            <div class="inner-right-col">
                <a href="<?php echo $this->createUrl('Fundraise/Updateprofile', array('id' => Yii::app()->frontUser->id)); ?>"
                   class="btn_question">Update Profile</a>
            </div>
        </div>
    </div>

</div>
</div>
<script>
    $(document).ready(function () {
        $('.btn_send_ans').click(function () {
            var id = $(this).attr('id');
            var topic = $('#FundraiserQuestions_topic_id').val();
            var text = $('#FundraiserQuestions_questions_text').val();
            var flag = '0';
            if (topic == '') {
                $('#FundraiserQuestions_topic_id_em_').show();
                $('#FundraiserQuestions_topic_id_em_').html('Topic cannot be blank.');
                flag = 1;
            }
            if (text == '') {
                $('#FundraiserQuestions_questions_text_em_').show();
                $('#FundraiserQuestions_questions_text_em_').html('Questions cannot be blank.');
                flag = 1;
            }
            if(flag == '1'){
                return false;
            }else{
                return true;
            }
        });
        /*if(jQuery("#ans_response").length > 0) {
         setTimeout(function() {
         jQuery("#ans_response").fadeOut(4000, function() {
         jQuery("#ans_response").remove();
         });
         }, 5000);
         }*/
    });
</script>
