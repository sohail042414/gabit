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

<div class="box-body">


	<div class="form-group">
		<?php echo $form->labelEx($model,'user_id'); ?>
		<?php echo $form->textField($model,'user_id'); ?>
		<?php echo $form->error($model,'user_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'event_name'); ?>
		<?php echo $form->textField($model,'event_name',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'event_name'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'event_cordinator'); ?>
		<?php echo $form->textField($model,'event_cordinator',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'event_cordinator'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'event_type'); ?>
		<?php echo $form->textField($model,'event_type',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'event_type'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'total_members'); ?>
		<?php echo $form->textField($model,'total_members',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'total_members'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'event_desc'); ?>
		<?php echo $form->textField($model,'event_desc',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'event_desc'); ?>
	</div>

	<div class="form-group"  >
                           
            <?php echo $form->labelEx($model, 'outside_activity'); ?>
            <?php //echo $form->radioButtonlist($model,'outside_activity',array('value' => 'Yes', 'uncheckValue'=>'No')); ?>
            <?php echo  $form->radioButtonList($model,'outside_activity',array('value'=>'Yes','uncheckValue'=>'No'),array('separator'=>'', 'labelOptions'=>array('style'=>'display:inline'))); ?>
            <?php echo $form->error($model, 'outside_activity'); ?>
        </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'cost_per_person'); ?>
		<?php echo $form->textField($model,'cost_per_person'); ?>
		<?php echo $form->error($model,'cost_per_person'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'requirement_1'); ?>
		<?php echo $form->textField($model,'requirement_1',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'requirement_1'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'requirement_2'); ?>
		<?php echo $form->textField($model,'requirement_2',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'requirement_2'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'requirement_3'); ?>
		<?php echo $form->textField($model,'requirement_3',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'requirement_3'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'event_startdate'); ?>
		<?php echo $form->textField($model,'event_startdate'); ?>
		<?php echo $form->error($model,'event_startdate'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'event_enddate'); ?>
		<?php echo $form->textField($model,'event_enddate'); ?>
		<?php echo $form->error($model,'event_enddate'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'location'); ?>
		<?php echo $form->textField($model,'location',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'location'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'city'); ?>
		<?php echo $form->textField($model,'city',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'city'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'state'); ?>
		<?php echo $form->textField($model,'state',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'state'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'country'); ?>
		<?php echo $form->textField($model,'country',array('size'=>60,'maxlength'=>250)); ?>
		<?php echo $form->error($model,'country'); ?>
	</div>

	<div class="form-group"  >
                                <?php echo $form->labelEx($model, 'attached_itinerary'); ?>
                                <?php echo $form->fileField($model, 'attached_itinerary', array('maxlength' => 250, 'class' => 'upload_file')); ?>
                                <?php echo $form->error($model, 'attached_itinerary'); ?>
        </div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'created_date'); ?>
		<?php echo $form->textField($model,'created_date'); ?>
		<?php echo $form->error($model,'created_date'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>1,'maxlength'=>1)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div>
</div>
	<div class="box-footer">
        <?php
            echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary'));
        ?>
    </div>
<?php
$this->endWidget();
?>