<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'View Corporate Supporter'); ?>
            </h1>
            <?php
            $this->breadcrumbs = array(
                'Corporate Supporters' => array('admin'),
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
                        array('label' => Yii::t('app', 'Create Corporate Supporter'), 'url' => array('create')),
                        array('label' => Yii::t('app', 'Update Corporate Supporter'), 'url' => array('update', 'id' => $model->id)),
                        array('label' => Yii::t('app', 'Delete Corporate Supporter'), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
                        array('label' => Yii::t('app', 'Manage Corporate Supporters'), 'url' => array('admin'))
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
                            'name' => 'image',
                            'type' => 'html',
                            'filter' => '',
                            'value'=> UtilityHtml::get_corporate_supporter_thumb($model->image,"display_facebook_img"),
                        ),
                        'name',
						'website_url',
						array(
                            'name' => 'status',
                            'type' => 'raw',
                            'value' => $model->status == 1 ? "Active" : "In Active",
                        ),
					)
                )); ?>
            </div>
        </div>
    </section>
</div>