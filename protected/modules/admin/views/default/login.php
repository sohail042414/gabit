<?php
$form = $this->beginWidget('CActiveForm', array(
    'id' => 'login-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('class' => 'form-signin',),
));
?>

<h2 class="form-signin-heading">     </h2>
<div class="login-wrap">
    <div class="user-login-info">
        <?php echo UtilityHtml::get_flash_message(); ?>
        <div class="form-group">
            <?php echo $form->textField($model, 'username', array('placeholder' => 'User Name', 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'username'); ?>
        </div>
        <div class="form-group">
            <?php echo $form->passwordField($model, 'password', array('placeholder' => 'Password', 'class' => 'form-control')); ?>
            <?php echo $form->error($model, 'password'); ?>
        </div>
    </div>

    <label class="checkbox">
        <?php echo $form->checkBox($model, 'rememberMe'); ?>
        Remember me next time

        <span class="pull-right">
            <a href="<?php echo $this->createUrl('default/forgotpassword'); ?>">I forgot my password</a>
        </span>
    </label>
    <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-lg btn-login btn-block', 'value' => 'Sign me in')); ?>
</div>

<?php $this->endWidget(); ?>
