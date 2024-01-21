<style>
    .box-body {
    margin-top: 47px;
}
.abcd textarea{
    width: 100% !important;
}
.form-group {
    margin-bottom: 15px;
    width: 100%;
    float: none;
    margin-bottom: 40px !important;
}
.abcd label {
    width: 100%;
}
</style>

<div class="col-lg-12">
    <section class="panel">
       <header class="panel-heading">
            Add Testimonial
            <ol class="breadcrumb">
                <li>
                    <a href="http://giveyourbit.com/index.php/admin/dashboard/index">Dashboard</a>
                </li>
                <li>
                    <a href="http://giveyourbit.com/index.php/admin/testimonialmessg/admin">Testimonial Message</a>
                </li>
            </ol>    
           
        </header>
        <div class="panel-body">
            <div class="box-header">
                <ul id="yw0" class="module_menu">
                    <li>
<!--                        <a class="btn btn-primary module_menu" href="/MobiTrustWeb/admin/donations/create">Create Donations</a>-->
                    </li>
                </ul>
               
<!--                <a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("donations/admin"); ?>">Manage Donations</a>-->
         
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
                        $model = new Testimonial();
                        
                        ?>
                        <div class="box-body">
                            <?php
                            //$model = new SupportersDonorsThankuMessage();
                            //$messg = TestimonialMessage::model()->find(array("select" => "*"));
                        // echo $_POST['id']; 
                            //print_r($messg);
                            ?>
                            
                             <div class="form-group abcd">
                                <?php echo $form->labelEx($model, 'User Id'); ?>
                                <?php echo $form->textField($model, 'testimonial_by', array('maxlength' => 200, 'value' =>$fund->user_id )); ?>
                                <?php echo $form->error($model, 'testimonial_by'); ?>
                            </div>
                             <div class="form-group abcd">
                                <?php echo $form->labelEx($model, 'User Message'); ?>
                                <?php echo $form->textArea($model, 'testimonial_text', array('maxlength' => 500,'rows' => 6, 'cols' => 50,'value' =>$fund->message)); ?>
                                <?php echo $form->error($model, 'testimonial_text'); ?>
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