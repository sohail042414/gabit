<div class="main_banner">
    <div class="center_banner">
        <div class="content">
            <?php
            /* @var $this UsersController */
            /* @var $model Users */
            /* @var $form CActiveForm */
            ?>

            <div class="form">

                <?php
                $form = $this->beginWidget('CoreGxActiveForm', array(
                    'id' => 'users-form',
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
                        <?php echo $form->labelEx($model, 'first_name'); ?>
                        <?php echo $form->textField($model, 'first_name', array('maxlength' => 150)); ?>
                        <?php echo $form->error($model, 'first_name'); ?>
                    </div>

                    <div class="form-group">
                        <?php echo $form->labelEx($model, 'last_name'); ?>
                        <?php echo $form->textField($model, 'last_name', array('maxlength' => 150)); ?>
                        <?php echo $form->error($model, 'last_name'); ?>
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
                        <?php echo $form->labelEx($model, 'password'); ?>
                        <?php echo $form->passwordField($model, 'password', array('maxlength' => 32)); ?>
                        <?php echo $form->error($model, 'password'); ?>
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
            </div>
        </div>
        <!-- form -->
    </div>
</div>