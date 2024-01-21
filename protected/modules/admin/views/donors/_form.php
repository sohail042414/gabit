<?php
$form = $this->beginWidget('CoreGxActiveForm', array(
    'id' => 'users-form',
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
            <?php echo $form->labelEx($model, 'username'); ?>
            <?php echo $form->textField($model, 'username', array('maxlength' => 250)); ?>
            <?php echo $form->error($model, 'username'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'username'); ?>
            <?php echo $form->textField($model, 'username', array('maxlength' => 250)); ?>
            <?php echo $form->error($model, 'username'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'email'); ?>
            <?php echo $form->textField($model, 'email', array('maxlength' => 250)); ?>
            <?php echo $form->error($model, 'email'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'age'); ?>
            <?php echo $form->textField($model, 'age'); ?>
            <?php echo $form->error($model,'age'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model,'sex'); ?>
            <?php echo $form->dropDownList($model, 'sex', array('' => Yii::t('app', 'Select Sex'), 'M' => Yii::t('app', 'Male'), 'F' => Yii::t('app', 'Female'))); ?>
            <?php echo $form->error($model,'sex'); ?>
        </div>

        <?php
        $model->password = '';
        $model->confirm_password = '';
        ?>
        <div class="form-group">
            <?php echo $form->labelEx($model, 'password'); ?>
            <?php echo $form->passwordField($model, 'password', array('maxlength' => 32)); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'confirm_password'); ?>
            <?php echo $form->passwordField($model, 'confirm_password', array('maxlength' => 32)); ?>
            <?php echo $form->error($model, 'confirm_password'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'status'); ?>
            <?php echo $form->dropDownList($model, 'status', array('Y' => Yii::t('app', 'Active'), 'N' => Yii::t('app', 'Inactive'))); ?>
            <?php echo $form->error($model, 'status'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'comment_count'); ?>
            <?php echo $form->textField($model, 'comment_count'); ?>
            <?php echo $form->error($model, 'comment_count'); ?>
        </div>

        <div class="form-group">
            <?php echo $form->labelEx($model, 'comment_count_other'); ?>
            <?php echo $form->textField($model, 'comment_count_other'); ?>
            <?php echo $form->error($model, 'comment_count_other'); ?>
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