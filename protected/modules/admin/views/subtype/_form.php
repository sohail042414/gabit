
<?php $form=$this->beginWidget('CoreGxActiveForm', array(
	'id'=>'fundraiser-sub-type-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

<div class="box-body">

	<div class="form-group">
		<?php echo $form->labelEx($model,'p_id'); ?>
		<?php //echo $form->textField($model,'p_id'); ?>
		<?php echo $form->dropDownList($model, 'p_id', CHtml::listData(FundraiserType::model()->findAll(),'id','fundraiser_type') ,
            array(
                    'prompt' => '– Please Select –',
                )
            );
        ?>
		<?php echo $form->error($model,'p_id'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'fundraiser_subtyp'); ?>
		<?php echo $form->textField($model,'fundraiser_subtyp',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'fundraiser_subtyp'); ?>
	</div>

	<div class="form-group">
		<?php echo $form->label($model,'type_description'); ?>
		<?php echo $form->textArea($model,'type_description',array('rows'=>6, 'cols'=>50)); ?>
		<?php echo $form->error($model,'type_description'); ?>
	</div>

	<!-- <div class="form-group">
		<?php echo $form->labelEx($model,'status'); ?>
		<?php echo $form->textField($model,'status',array('size'=>60,'maxlength'=>200)); ?>
		<?php echo $form->error($model,'status'); ?>
	</div> -->



</div>

<div class="box-footer">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
</div>

<?php $this->endWidget(); ?>

