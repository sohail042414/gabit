<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'View Reward Winner') ?>

            <?php
            $this->breadcrumbs = array(
                'Reward Wommers' => array('admin'),
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
                        array('label' => Yii::t('app', 'Update Winner'), 'url' => array('update', 'id' => $model->id)),
                        array('label' => Yii::t('app', 'Manage Winners List'), 'url' => array('admin'))
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="box-body table-responsive view_page">
                <?php echo UtilityHtml::get_flash_message(); ?>

				<?php $this->widget('CoreCDetailView', array(
					'data'=>$model,
					'attributes'=>array(
						'id',
						array(
							'label' => 'User',
							'value' => $model->user->username,
						),
						'year',
						'month',
						'total_points',
                        'prize_amount',
						'win_date',
						'location',
						array(
                            'name' => 'content',
                            'type' => 'raw',
                            'value' => $model->content,
                        ),
						array(
                            'name' => 'image1',
                            'type' => 'html',
                            'filter' => '',
                            'value' => UtilityHtml::get_image_from_path(SITE_ABS_PATH_FUNDRAISER_IMAGE . $model->image1, 'view_page_profile_picture'),
                        ),
						array(
                            'name' => 'image2',
                            'type' => 'html',
                            'filter' => '',
                            'value' => UtilityHtml::get_image_from_path(SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $model->image2, 'view_page_profile_picture'),
                        ),
						array(
                            'name' => 'image3',
                            'type' => 'html',
                            'filter' => '',
                            'value' => UtilityHtml::get_image_from_path(SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $model->image3, 'view_page_profile_picture'),
                        ),
						array(
                            'name' => 'image4',
                            'type' => 'html',
                            'filter' => '',
                            'value' => UtilityHtml::get_image_from_path(SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $model->image4, 'view_page_profile_picture'),
                        ),
					),
				)); ?>
            </div>
        </div>

    </section>
</div>