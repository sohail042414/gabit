<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Notifications') ?>

            <?php
            $this->breadcrumbs = array(
                Yii::t('app', 'Notifications'),
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
                        //#array('label' => 'Manage Posts', 'url' => array('post/admin')),
                       array('label' => 'Send Message', 'url' => array('notifications/send_notifications_admin')),
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="loader_space"></div>
            <div class="box-body">
                <?php   
                    foreach ($notifications_arr as $key_n => $val_n) {
                ?>
                <div class="message_box">
                    <a href="<?php echo Yii::app()->createUrl('admin/notifications/notificationdetail', array('id' => $val_n['data']['id'])); ?>">
                        <?php echo (strlen($val_n['data']['subject'])>250)?substr($val_n['data']['subject'], 0, 250).'...':$val_n['data']['subject']; ?>
                        <?php echo ($val_n['count']>0)?'<span>'.$val_n['count'].' unread comment(s)</span>':''; ?>
                    </a>
                    <br>
                     <span>
                                <?php
                                    $by_date = "";
                                    if($val_n['data']['from_admin'] == 'Y') {
                                        $by_date .= "By Admin";
                                    } else {
                                        $by_date .= "By ".Users::model()->findByPk($val_n['data']['from_id']);
                                    }
                                    $by_date .= " . ";
                                    $by_date .= date('M d, Y , H:i:s', strtotime($val_n['data']['created_date']));
                                    echo $by_date;
                                ?>
                    </span>
                </div>
                <?php
                    }
                ?>              
            </div>
</div>
</section>
</div>