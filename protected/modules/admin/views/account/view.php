<style type="text/css">
#answer_col{width:99%; float:left; padding-left:1%;}
#answer_col textarea{width:1000px; height:70px; border:#CCC 1px solid; margin-bottom:5px;}
#answer_col label{width:500px; float:left;}
#answer_col .btn_send_ans{width:auto; padding:0px 10px; border:none; background:#C30; color:#FFF; text-align:center; line-height:30px; cursor:pointer;}
</style>

<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'View') . ' ' . 'Fund Manager Account Details'; ?>
            <!--            --><?php //echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label(1)) ?>
            <?php
            $this->breadcrumbs = array(
                $model->label(2) => array('admin'),
                GxHtml::valueEx($model),
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
                        //array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
                        //array('label' => Yii::t('app', 'Update') . ' ' . $model->label(), 'url' => array('update', 'id' => $model->id)),
                        //array('label' => Yii::t('app', 'Delete') . ' ' . $model->label(), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
                        array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin'))
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="box-body table-responsive view_page">
            <?php echo UtilityHtml::get_flash_message(); ?>
            <?php $this->widget('CoreCDetailView', array(
                'data' => $model,
                'attributes' => array(
                    'id',
                    array(
                        'label' => 'Fundraiser',
                        'value' => $model->fundraiser->fundraiser_title,
                    ),
                    array(
                        'label' => 'User',
                        'value' => $model->user->username,
                    ),
                    'bank_name',
                    'account_number',
                    'account_name',
                    'amount_transferred',
                    'admin_message',
                    'thankyou_message_for_supporters' => array(
                        'label' => 'Message for Donors',                        
                        'value' => $model->thankyou_message_for_supporters,
                    ),
                    'status'
                ),
            )); ?>
    </div>
</div>
