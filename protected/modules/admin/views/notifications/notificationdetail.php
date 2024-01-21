<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Notification Detail') ?>

            <?php
            $this->breadcrumbs = array(
                'Notifications' => array('notifications'),
                Yii::t('app', 'Notification Detail'),
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
                        //#array('label' => 'Create Post', 'url' => array('post/create')),
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="loader_space"></div>
            <div class="box-body">
                <?php echo UtilityHtml::get_flash_message(); ?>
                
                <h4><?php echo $notification_data->subject; ?></h4><br>
                
                <div class="notification_row">
                    <div class="notification_message">
                        <span class="content_box"><?php echo nl2br($notification_data->message); ?></span>
                        <span>
                                <?php
                                    $by_date = "";
                                    if($notification_data->from_admin == 'Y') {
                                        $by_date .= "By Admin";
                                    } else {
                                        $by_date .= "By ".Users::model()->findByPk($notification_data->from_id);
                                    }
                                    $by_date .= " . ";
                                    $by_date .= date('M d, Y, H:i:s', strtotime($notification_data->created_date));
                                    echo $by_date;
                                ?>                        
                        </span>
                    </div>
                    <?php
                        foreach($notifications_comments_data as $key_ncd => $val_ncd) {
                    ?>
                        <div class="notification_comment">
                            <span class="content_box"><?php echo nl2br($val_ncd->comment); ?></span>
                            <span>
                                <?php
                                    $by_date = "";
                                    if($val_ncd->from_admin == 'Y') {
                                        $by_date .= "By Admin";
                                    } else {
                                        $by_date .= "By ".Users::model()->findByPk($val_ncd->from_id);
                                    }
                                    $by_date .= " . ";
                                    $by_date .= date('M d, Y,H:i:s', strtotime($val_ncd->created_date));
                                    echo $by_date;
                                ?>
                            </span>
                        </div>                
                    <?php
                        }
                    ?>
                    <div id="login_form" class="form notification_send_comment">
                        <?php
                        $form = $this->beginWidget('CoreGxActiveForm', array(
                            'id' => 'message-comment-form',
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

                        <div class="box-footer row buttons">
                            <?php echo $form->textArea($notifications_comment_model, 'comment', array()); ?>
                            <?php echo GxHtml::submitButton(Yii::t('app', 'Send Comment'), array('class' => 'btn_send_ans')); ?>
                        </div>

                        <?php
                            $this->endWidget();
                        ?>
                    </div>
                </div>
                             
            </div>
</div>
</section>
</div>