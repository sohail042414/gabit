<style>
    .test-payment-row{
        color: red;     
    }
</style>
<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode($model->label(2)) ?>
            <?php
            $this->breadcrumbs = array(
                $model->label(2) => array('admin'),
                Yii::t('app', 'Manage'),
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
                        array(
                            'label' => Yii::t('app', 'Send Email') , 
                            'url' => array('send_email'),
                            'visible' => $this->auth->canUpdate($this->resource_id),
                        ),
                    ),
                ));
                ?>
                <a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("donations/export"); ?>">Export</a>
                <?php if($this->auth->canUpdate($this->resource_id)){ /* ?>                    
                    <a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("donations/editmessage"); ?>">Edit Message</a>
                <?php */ } ?>                
                <a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("donations/payment_summary"); ?>">Payment Summary</a>
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
                <?php
                $this->widget('CoreCGridView', array(
                    'id' => 'donations-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'rowCssClassExpression' => '($data->payment_mode =="test") ? "test-payment-row" : ""',
                    'columns' => array(
                        //'id',
                        array(
                            'header' => 'Case No',
                            'name' => 'fundraiser_id',
                            'value' => '$data->fundraiser_id'
                        ),
                        array(
                            'name' => 'fundraiser_id',
                            'value' => 'GxHtml::valueEx($data->fundraiser)',
                            'filter' => GxHtml::listDataEx(SetupFundraiser::model()->findAllAttributes(null, true)),
                        ),
                        'donation_amount' => array(
                            'header' => 'Amount',
                            'value' => '$data->donation_amount',
                            'name' => 'donation_amount',
                            'footer' => '<b>Total : '.$model->getTotal().'<br> Average : '.$model->getAverage().'</b>',
                        ),
                        'donor_name',
                        'donor_email',
                        'donor_phone_no',
                        'created_date' => array(
                            'header' => 'Donation Date',
                            'value' => 'date("d-m-Y",strtotime($data->created_date))'
                        ),
                        'payment_type' => array(
                            'header' => 'Type',
                            'name' => 'payment_type',
                            'value' => '$data->payment_type',
                            'filter' => CHtml::dropDownList('Donations[payment_type]',$model->payment_type,$model->getPaymentTypes(),array('style' => 'width:80px;')),
                        ),
                        //'processed_by',
                        'payment_mode' => array(
                            'name' =>'payment_mode',
                            'header' => 'Mode',
                            'value' => '$data->payment_mode',
                            'filter' => CHtml::dropDownList('Donations[payment_mode]',$model->payment_mode,$model->getPaymentModes(),array('style' => 'width:70px;')),
                        ),
                        array(
                            'header' => 'TRDP',
                            //'name' => 'reward_program',
                            'type' => 'raw',
                            'value' => '$data->reward_program == 1 ? "<span style=\"color:green;\">Yes</span>" : "No"',
                            'filter' => CHtml::dropDownList('Donations[reward_program]',$model->reward_program,['all' => 'All','1' => 'Yes','0'=>'No'],array('style' => 'width:70px;')),
                        ),
                        array(
                            'header' => 'New',
                            'name' => 'status_new',
                            'type' => 'raw',
                            'value' => '$data->status_new == "Y" ? "<span style=\"color:red;\">Yes</span>" : "No"',
                            'filter' => '',
                        ),
                        array(
                            'class' => 'CoreCButtonColumn',
                            'header' => 'Functions',
                            'template' => '{view}{update}{delete}',
                            'buttons' => array(
                                'view' => array(
                                    'visible' => ($this->auth->canView($this->resource_id)) ? '1' : '0;'
                                ),
                                'update' => array(
                                    'visible' => ($this->auth->canUpdate($this->resource_id)) ? '1' : '0;'
                                ),
                                'delete' => array(
                                    //'visible' => ($this->auth->canDelete($this->resource_id)) ? '1' : '0;'
                                    'visible' =>  '$data->checkAllowDelete() ? 1 : 0'
                                ),
                            ),
                        ),

                    ),
                ));
                ?>
            </div>        
        </div>
    </section>
</div>