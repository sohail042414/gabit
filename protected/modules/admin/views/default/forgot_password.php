<?php $form = $this->beginWidget('CActiveForm', array(
    'id' => 'admin-forgot-password-form',
    'enableClientValidation' => true,
    'clientOptions' => array(
        'validateOnSubmit' => true,
    ),
    'htmlOptions' => array('class' => 'form-signin',),
));
?>

<!--    <h2 class="form-signin-heading">Forgot Password</h2>-->
    <h2 class="form-signin-heading"></h2>
    <div class="login-wrap">
        <div class="user-login-info">
            <div class="form-group">
                <?php echo $form->textField($model, 'email', array('placeholder' => 'Email', 'class' => 'form-control')); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>
        </div>

        <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-lg btn-login btn-block', 'value' => 'Submit')); ?>
        <div class="registration">
            You want to redirect Login Page?
            <a href="<?php echo $this->createUrl('default/index'); ?>">Click here</a>
        </div>
    </div>
<?php $this->endWidget(); ?>