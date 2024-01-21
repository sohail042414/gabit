<style type="text/css">
    .form .form-actions {
        background: none;
    }
</style>


<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'Change password') . ' ' ?>
            <?php
            $this->breadcrumbs = array(
                Yii::t('app', 'Change password'),
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

            <?php $form = $this->beginWidget('CoreGxActiveForm', array(
                'id' => 'admin-change-password-form',
                'enableClientValidation' => true,
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                ),
                'htmlOptions' => array('class' => '',),
            ));
            ?>

            <div class="box-body">

                <?php
                $model->current_password = '';
                ?>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'current_password'); ?>
                    <?php echo $form->passwordField($model, 'current_password'); ?>
                    <?php echo $form->error($model, 'current_password'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'new_password'); ?>
                    <?php echo $form->passwordField($model, 'new_password'); ?>
                    <?php echo $form->error($model, 'new_password'); ?>
                </div>

                <div class="form-group">
                    <?php echo $form->labelEx($model, 'repeat_password'); ?>
                    <?php echo $form->passwordField($model, 'repeat_password'); ?>
                    <?php echo $form->error($model, 'repeat_password'); ?>
                </div>
            </div>

            <div class="box-footer">

                <div class="form-group">
<!--                    <button class="btn default" type="button" onclick="history.back();">Back</button>-->
                    <?php
                    echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary'));
                    ?>
                </div>

            </div>

        </div>
        <?php
        $this->endWidget();
        ?>
</div>
</section>
</div>
