<div class="main_banner">
    <div class="center_banner">
        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abaut-slider.png" alt=""/>
    </div>
</div>
<div class="inner-container">
    <div class="inner-left">
        <?php
        /*echo "<pre>";
        print_r($model);
        echo "</pre>";*/
        //die();
        $curr_user_id = Yii::app()->frontUser->id;
        $form = $this->beginWidget('CoreGxActiveForm', array(
            'id' => 'front-users-form',
            'action' => Yii::app()->createUrl("users/update/$curr_user_id"), 
            'enableAjaxValidation' => false,
            'enableClientValidation' => false,
            'htmlOptions' => array(
                'enctype' => 'multipart/form-data'
            ),
            'clientOptions' => array(
                'validateOnSubmit' => true,
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
                <?php echo $form->labelEx($model, 'profile_image'); ?>
                <?php echo $form->fileField($model, 'profile_image', array('style' => '')); ?>
                <?php if (isset($model['profile_image']) && !empty($model['profile_image'])) { ?>
                    <span>
                        <input type="hidden" name="Users[profile_image]" value="<?php echo $model['profile_image']; ?>" />
                        <img src="<?php echo Yii::app()->request->baseUrl.'/uploads/profile_pictures/'.$model['profile_image']; ?>" title="<?php echo Yii::app()->frontUser->username; ?>" alt="<?php echo Yii::app()->frontUser->username; ?>" style="width:25px; height:25px; margin-top:6px; margin-left:15px;">
                    </span>
                <?php } else { ?>
                    <span>
                        <input type="hidden" name="Users[profile_image]" value="<?php echo $model['profile_image']; ?>" />
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/team2.png" title="<?php echo Yii::app()->frontUser->username; ?>" alt="<?php echo Yii::app()->frontUser->username; ?>" style="width:25px; height:25px; margin-top:6px; margin-left:15px;" />
                    </span>
                <?php } ?>
                <?php echo $form->error($model, 'profile_image'); ?>
            </div><!-- row -->

            <div class="form-group">
                <?php echo $form->labelEx($model, 'email'); ?>
                <?php echo $form->textField($model, 'email', array('maxlength' => 250)); ?>
                <?php echo $form->error($model, 'email'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'age'); ?>
                <?php echo $form->textField($model, 'age', array('maxlength' => 250)); ?>
                <?php echo $form->error($model, 'age'); ?>
            </div>

            <div class="form-group">
                <?php echo $form->labelEx($model, 'sex'); ?>
                <?php echo $form->dropDownList($model, 'sex', array('M' => Yii::t('app', 'Male'), 'F' => Yii::t('app', 'Female'))); ?>
                    <?php echo $form->error($model, 'sex'); ?>
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