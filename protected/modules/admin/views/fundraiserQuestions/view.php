<style type="text/css">
#answer_col{width:99%; float:left; padding-left:1%;}
#answer_col textarea{width:1000px; height:70px; border:#CCC 1px solid; margin-bottom:5px;}
#answer_col label{width:500px; float:left;}
#answer_col .btn_send_ans{width:auto; padding:0px 10px; border:none; background:#C30; color:#FFF; text-align:center; line-height:30px; cursor:pointer;}
</style>

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'View') . ' ' . 'Fundraiser Questions'; ?>
            <!--            --><?php //echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label(1)) ?>
            <?php
            $this->breadcrumbs = array(
                $model->label(2) => array('admin'),
                GxHtml::valueEx($model),
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
                        array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
                        array('label' => Yii::t('app', 'Update') . ' ' . $model->label(), 'url' => array('update', 'id' => $model->id)),
                        array('label' => Yii::t('app', 'Delete') . ' ' . $model->label(), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
                        array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin'))
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="box-body table-responsive view_page">
                <?php echo UtilityHtml::get_flash_message(); ?>
                <?php $this->widget('CoreCDetailView', array(
                    'data' => $model,
                    'attributes' => array(
//                        'id',
                        array(
                            'name' => 'user',
                            'type' => 'raw',
                            'value' => $model->user !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->user)), array('users/view', 'id' => GxActiveRecord::extractPkValue($model->user, true))) : null,
                        ),
                        array(
                            'name' => 'topic',
                            'type' => 'raw',
                            'value' => $model->topic !== null ? GxHtml::link(GxHtml::encode(GxHtml::valueEx($model->topic)), array('topic/view', 'id' => GxActiveRecord::extractPkValue($model->topic, true))) : null,
                        ),
                        'questions_text',
//                        'subject',
                        'notify_status',
                        'created_date',
//                        'updated_date',
                        array(
                            'name' => 'status',
                            'type' => 'raw',
                            'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                            'value' => UtilityHtml::getStatusImage($model->status, 'view'),
                        ),),
                )); ?>
            </div>
            <div class="fundraiser_question">
                <h4>Answers  :</h4>
                <div class="box-body table-responsive view_page">
                    <table id="yw1" class="table table-hover detail-view-table">
                        <tbody>

                        <?php
                        $answer = FundraiserAnswer::model()->findAll(array('select' => 'id,user_id,answer_text,status', 'condition' => 'questions_id = ' . $_REQUEST['id'] . ' AND status = "Y" ', 'order' => 'created_date DESC','limit'=>'5'));
                        if (!empty($answer)) {
                            $ans_count = '1';
                            foreach ($answer as $answer_row) {
                                ?>
                                <tr class="odd">
                                    <th><span style="font-size: 14px;">Ans</span>
                                        <?php echo $ans_count . ' : ' . $answer_row->answer_text; ?>
                                    </th>
                                </tr>
                                <?php $ans_count++;
                            }
                        }
                        ?>
                        </tbody>
                    </table>
                </div>
            </div>


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
                <?php echo $form->hiddenField($FundraiserAnswer, 'question_id', array('type' => "hidden", 'value' => $model->id)); ?>
                <div id="answer_col">
                <div class="row">
                    <?php echo $form->labelEx($FundraiserAnswer, 'answer_text'); ?>
                    <?php echo $form->textArea($FundraiserAnswer, 'answer_text', array('class' => 'answer_field_' . $model->id, 'rows' => 3, 'cols' => 119)); ?>
                    <!--                                            --><?php //echo $form->textField($FundraiserAnswer, 'answer_text', array('id' => 'answer_field_' . $que->id)); ?>
                    <?php echo $form->error($FundraiserAnswer, 'answer_text'); ?>
                </div>
                <div class="row buttons">
                    <?php echo CHtml::ajaxSubmitButton('Send', array('FundraiserQuestions/Getanswer'), array(
//                        'update' => '#que_ans_response',
                        'type' => 'POST',
                        'success'=>'function(data){
                          $("#que_ans_response").html(data);
                          setTimeout(function(){ location.reload(); }, 3000);
                        }'
                    ),
                        array('id' => $model->id, 'class' => 'btn_send_ans')
                    ); ?>
                    <div id="que_ans_response"></div>
                </div>
                </div>
                <?php $this->endWidget(); ?>
            </div>
        </div>
    </section>
</div>
