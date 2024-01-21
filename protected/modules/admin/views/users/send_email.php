<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'Send Email'); ?>

            <?php
            $this->breadcrumbs = array(
                'Users' => array('admin'),
                Yii::t('app', 'Send Email '),
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
                        array('label' => Yii::t('app', 'Manage') . ' ' . 'Users', 'url' => array('admin')),
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="loader_space"></div>

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
                        <div class="row">
                            <div class="col-md-2 col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <?php echo $form->labelEx($model, 'to_all'); ?>
                                    <br>
                                    <?php echo $form->checkBox($model, 'to_all'); ?>                                    
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <?php echo $form->labelEx($model, 'to_active'); ?>
                                    <br>
                                    <?php echo $form->checkBox($model, 'to_active'); ?>                                    
                                </div>
                            </div>
                            <div class="col-md-2 col-lg-2 col-sm-12">
                                <div class="form-group">
                                    <?php echo $form->labelEx($model, 'to_inactive'); ?>
                                    <br>
                                    <?php echo $form->checkBox($model, 'to_inactive'); ?>                                    
                                </div>
                            </div>

                            <div class="col-md-6 col-lg-6 col-sm-12">
                                <div class="form-group">
                                    <?php echo $form->labelEx($model, 'user_id'); ?>
                                    <?php echo $form->dropDownList($model, 'user_id', $users_list,array('empty' => ' --Select User-- ')); ?>                                    
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 col-lg-12 col-sm-12">
                                <?php echo $form->error($model, 'user_id'); ?>
                            </div>
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'subject'); ?>
                            <?php echo $form->textField($model, 'subject',array('maxlength' => 100)); ?>
                            <?php echo $form->error($model,'subject'); ?>   
                        </div>

                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'message'); ?>
                            <?php echo $form->textArea($model, 'message',array('style' => 'resize:none;','rows' => 6, 'class' => 'apply-ckeditor')); ?>
                            <?php echo $form->error($model,'message'); ?>   
                        </div>

                    </div>


                    <div class="box-footer">
                        <?php
                        echo GxHtml::submitButton(Yii::t('app', 'Send'), array('class' => 'btn btn-primary'));
                        ?>
                    </div>

                <?php
                $this->endWidget();
                ?>
        </div>
    </section>
</div>
<script src="//cdn.ckeditor.com/4.5.4/full/ckeditor.js"></script>
<script>

    $('#<?php echo Chtml::activeId($model,'to_all') ?>').on('click',function(){        
        if($(this).is(':checked')){
            $('#<?php echo Chtml::activeId($model,'to_active') ?>').attr('checked',false);
            $('#<?php echo Chtml::activeId($model,'to_inactive') ?>').attr('checked',false);
            $('#<?php echo Chtml::activeId($model,'user_id') ?>').parent().hide();
        }else{
            checkUsersList();
        }

    });

    $('#<?php echo Chtml::activeId($model,'to_active') ?>').on('click',function(){        
        if($(this).is(':checked')){
            $('#<?php echo Chtml::activeId($model,'to_all') ?>').attr('checked',false);
            $('#<?php echo Chtml::activeId($model,'to_inactive') ?>').attr('checked',false);
            $('#<?php echo Chtml::activeId($model,'user_id') ?>').parent().hide();
        }else{
            checkUsersList();
        }
    });
    
    $('#<?php echo Chtml::activeId($model,'to_inactive') ?>').on('click',function(){                
        if($(this).is(':checked')){
            $('#<?php echo Chtml::activeId($model,'to_all') ?>').attr('checked',false);
            $('#<?php echo Chtml::activeId($model,'to_active') ?>').attr('checked',false);
            $('#<?php echo Chtml::activeId($model,'user_id') ?>').parent().hide();
        }else{
            checkUsersList();
        }
    });


    function checkUsersList(){
        if($('#<?php echo Chtml::activeId($model,'to_all') ?>').is(':checked') || $('#<?php echo Chtml::activeId($model,'to_active') ?>').is(':checked') || $('#<?php echo Chtml::activeId($model,'to_inactive') ?>').is(':checked')){
            $('#<?php echo Chtml::activeId($model,'user_id') ?>').hide();
        }else{
            $('#<?php echo Chtml::activeId($model,'user_id') ?>').parent().show();
        }
    }

    $($('#<?php echo Chtml::activeId($model,'user_id') ?>')).select2();

</script>