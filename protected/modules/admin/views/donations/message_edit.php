<style>
    .box-body {
    margin-top: 47px;
}
.abcd textarea{
    width: 100% !important;
}
</style>

<div class="col-lg-12">
    <section class="panel">
       <header class="panel-heading">
            Edit Responce Message
            <ol class="breadcrumb">
                <li>
                    <a href="http://giveyourbit.com/index.php/admin/dashboard/index">Dashboard</a>
                </li>
                <li>
                    <a href="http://giveyourbit.com/index.php/admin/account/admin">Donations</a>
                </li>
                <li>New Entry</li>
            </ol>    
           
        </header>
        <div class="panel-body">
            <div class="box-header">
                <ul id="yw0" class="module_menu">
                    <li>
<!--                        <a class="btn btn-primary module_menu" href="/MobiTrustWeb/admin/donations/create">Create Donations</a>-->
                    </li>
                </ul>
               
                <a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("donations/admin"); ?>">Manage Donations</a>
         
                <?php /*<a class="btn btn-primary module_menu1" href="<php echo $this->createUrl("donations/admin"); ?>">Go Back</a>*/ ?>
            </div>
            <div class="clear"></div>
           
            <div class="dataTables_wrapper form-inline">
                <div id="fundraise_form">
                    <?php echo UtilityHtml::get_flash_message(); ?>
                   
                        <?php
                        $form = $this->beginWidget('CoreGxActiveForm', array(
                            'id' => 'message-edit-form',
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
                        $model = new DonationMessage();
                        
                        ?>
                        <div class="box-body">
                            <?php
                            //$model = new SupportersDonorsThankuMessage();
                            $messg = DonationMessage::model()->find(array("select" => "*"));
                          
                            //print_r($messg)."aaaaaaaaaaaaaaaaa";
                            ?>
                            <?php //echo $form->hiddenField($model, 'id', array('type' => "hidden", 'value' => $messg->id)); ?>
                             <div class="form-group abcd">
                                <?php echo $form->labelEx($model, 'messge'); ?>
                                <?php echo $form->textArea($model, 'messge', array('maxlength' => 500,'rows' => 6, 'cols' => 50, 'value'=>$messg->messge)); ?>
                                <?php echo $form->error($model, 'messge'); ?>
                            </div>


                        
                        <div class="box-footer">
                            <?php
                            echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans'));
                            ?>
                        </div>
                        </div>    
                        <?php
                        $this->endWidget();
                  
                    ?>

                   

                </div>
            </div>
            
            </div>
        
    </section>
</div>