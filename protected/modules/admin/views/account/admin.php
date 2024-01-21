<style>
table tr:first-child  {background: #fff}  
tr:nth-child(even) {background: #fff}
tr:nth-child(odd) {background: #F3F4F5}
th {
    text-align: center;
    padding: 15px 0;
    border: 1px solid #ddd;
    border-bottom: 2px solid #ddd;
}
td {
   text-align: center;
    padding: 15px 0;
    border: 1px solid #ddd;
}
</style>

<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Manage Fund Transfer Requests'); ?>

            <?php
            $this->breadcrumbs = array(
                'Fund Transfer Requests' => array('admin'),
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
                <?php if($this->auth->canUpdate($this->resource_id)){ ?>
                    <a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("account/editmessage"); ?>">Edit Message</a>   
                <?php } ?> 
            </div>

            <div class="dataTables_wrapper form-inline">
                <?php 
                $this->widget('CoreCGridView', array(
                    'id' => 'donations-grid',
                    'dataProvider' => $model->search(),
                    'filter' => $model,
                    'columns' => array(
                        'id',
                        array(
                            'header' => 'Fundraiser',
                            'name' => 'fundraiser_id',
                            'value' => '$data->fundraiser->fundraiser_title'
                        ),
                        array(
                            'header' => 'User',
                            'name' => 'user_id',
                            'value' => '$data->user->username'
                        ),
                        'bank_name',
                        'account_number',
                        'account_name',
                        'status',
                        'amount_transferred',
                        'admin_message',
                        'thankyou_message_for_supporters' => array(
                            'header' => 'Message for Donors',
                            'name' => 'thankyou_message_for_supporters',
                            'value' => '$data->thankyou_message_for_supporters'
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
                                    'visible' => ($this->auth->canDelete($this->resource_id)) ? '1' : '0;'
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