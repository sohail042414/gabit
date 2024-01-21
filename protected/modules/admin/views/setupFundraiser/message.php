<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', $data['name'] . ': Messages') ?>
            <?php
            $this->breadcrumbs = array(
                $data['name'] => array('SetupFundraiser/admin'),
                Yii::t('app', 'Create'),
            );
            $this->widget('CoreCBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'htmlOptions' => array('class' => 'breadcrumb')
            ));
            ?>
        </header>
        <div class="panel-body">
            <div class="box-header">
                <?php
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array('label' => Yii::t('app', 'Manage'), 'url' => array('admin')),
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="loader_space"></div>

            <?php
            $questions = FundraiserQuestions::model()->findAll(array('select' => 'id,user_id,fundraiser_id,questions_text,status', 'condition' => 'fundraiser_id = ' . $data['id'] . ' ', 'order' => 'created_date DESC'));
            if (!empty($questions)) {
                $ans_count = '1'; ?>
                <div class="box-body table-responsive view_page">
                    <table id="yw1" class="table table-hover detail-view-table">
                        <tbody>
                        <?php foreach ($questions as $key => $que) {
                            $obj_answer = FundraiserAnswer::model()->findAll(array('select' => 'answer_text', 'condition' => 'questions_id = ' . $que->id . ' ', 'order' => 'created_date DESC'));
                            ?>
                            <!--code for get number of fundraiser question-->
                            <tr class="odd">
                                <th><span style="font-size: 14px;">Que</span>
                                    <?php echo $ans_count . ' : ' . $que->questions_text; ?>
                                </th>
                                <td>
                                    <a class="btn btn-primary que_replay" id="replay_link"
                                       data-id="<?php echo $que->id; ?>"> Replay</a>
                                </td>
                            </tr>
                            <tr class="even" id="show_record_<?php echo $que->id; ?>">

                            </tr>
                            <?php
                            /*
                             * Code for the totoal
                             */
                            if (!empty($obj_answer)) {
                                foreach ($obj_answer as $answer) {
                                    ?>
                                    <tr class="even">
                                        <th><span style="font-size: 14px;">Ans</span>
                                            <?php echo ' : ' . $answer->answer_text; ?>
                                        </th>
                                    </tr>
                                <?php }
                            } ?>
                            <!--code for given question's answer-->
                            <tr class="even ans_field" id="ans_div_<?php echo $que->id; ?>" style="display: none;">
                                <th>
                                    <div class="box-body">
                                        <?php $form = $this->beginWidget('CActiveForm', array(
                                            'id' => 'fundraiser-answer-User-form',
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
                                        $FundraiserAnswer = new FundraiserAnswer();
                                        ?>
                                        <?php echo $form->hiddenField($FundraiserAnswer, 'user_id', array('type' => "hidden", 'value' => Yii::app()->user->id)); ?>
                                        <?php echo $form->hiddenField($FundraiserAnswer, 'question_id', array('type' => "hidden", 'value' => $que->id)); ?>
                                        <div class="row">
                                            <?php echo $form->labelEx($FundraiserAnswer, 'answer_text'); ?>
                                            <?php echo $form->textField($FundraiserAnswer, 'answer_text',array('class' => 'answer_field_' . $que->id)); ?>
<!--                                            --><?php //echo $form->textField($FundraiserAnswer, 'answer_text', array('id' => 'answer_field_' . $que->id)); ?>
                                            <?php echo $form->error($FundraiserAnswer, 'answer_text'); ?>
                                        </div>
                                        <div class="row buttons">
                                            <?php echo CHtml::ajaxSubmitButton('Send', array('SetupFundraiser/Getanswer'), array(
//                                                'update' => '#que_ans_response',
                                                'dataType' => 'json',
                                                'success' => 'js: function(data) {
//                                                    $("answer_field_"+data.id).val("");
                                                    $("#ans_div_"+data.id).hide();
                                                    }',
                                                'type' => 'POST',
                                            ),
                                                array('id' => $que->id,'class'=>'btn_send_ans')
                                            ); ?>
                                            <div id="que_ans_response"></div>
                                        </div>
                                        <?php $this->endWidget(); ?>
                                    </div>
                                </th>
                            </tr>
                            <?php $ans_count++;
                        } ?>
                        </tbody>
                    </table>
                </div>
            <?php }
            ?>
        </div>
</div>
</section>
<script>
    $(document).ready(function () {
        $('.que_replay').click(function () {
            var id = $(this).attr('data-id');
            $('ans_field').show();
            $('#ans_div_' + id).show();
        });
        $('.btn_send_ans').click(function () {
            var id = $(this).attr('id');
            var text = $('.answer_field_'+id).val();
            if (text == '') {
//                $(this).prop('disabled', true); //TO DISABLED
                return false;
            } else {
//                $(this).prop('enable', true); //TO DISABLED
                $('#show_record_'+id).html('<th><span style="font-size: 14px;">Ans : </span>'+text+'</th>');
                return true;
            }
        });
    });
</script>