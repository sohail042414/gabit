<style type="text/css">
    .form .form-actions {
        background: none;
    }
</style>


<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'Forgot password') . ' ' ?>
            <?php
            $this->breadcrumbs = array(
                Yii::t('app', 'Forgot password'),
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
                        array('label' => Yii::t('app', 'Manage') . ' ' . 'sdsd', 'url' => array('admin')),
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <?php echo UtilityHtml::get_flash_message(); ?>
            <div class="loader_space"></div>

            <?php $form = $this->beginWidget('CActiveForm', array(
                'id' => 'admin-forgot-password-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array('class' => '',),
            ));
            ?>

            <div class="box-body">

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'email'); ?>
                    <?php echo $form->textField($model, 'email', array('placeholder' => 'Email', 'class' => 'form-control')); ?>
                    <?php echo $form->error($model, 'email'); ?>
                </div>

            </div>

            <div class="box-footer">

                <div class="form-group">
                    <button class="btn default" type="button" onclick="history.back();">Back</button>
                    <?php echo CHtml::submitButton('Login', array('class' => 'btn btn-primary', 'value' => 'Submit')); ?>
                </div>

            </div>

        </div>
        <?php
        $this->endWidget();
        ?>
</div>
</section>
</div>


