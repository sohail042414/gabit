<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            Manage News and Updates
            <?php
            $this->breadcrumbs = array(
                'Corporate Supporters' => array('admin'),
                Yii::t('app', 'Manage'),
            );


            $this->widget('CoreCBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'htmlOptions' => array('class' => 'breadcrumb')
            ));

            ?>
        </header>
        <div class="panel-body">
            <div id="output"></div>
            <div class="box-header">
                <?php
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array(
                            'label' => Yii::t('app', 'Create News Update'), 
                            'url' => array('create'),
                            'visible' => $this->auth->canAdd($this->resource_id),
                        ),
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="dataTables_wrapper form-responsive">
			<?php 
				$this->widget('CoreCGridView', array(
					'id'=>'news-updates-grid',
					'dataProvider'=>$model->search(),
					'filter'=>$model,
					'columns'=>array(
						array(
                            'name' => 'image',
                            'type' => 'raw',
                            'filter' => false, //SUPPORTER_IMAGE_ORIGINAL
                            'value' => 'UtilityHtml::get_corporate_supporter_thumb($data->image,"display_facebook_img")',
                        ),  
						'title',
						'video_link',
						'status' => array(
							'header' => 'Status',
							'type' => 'raw',
							'value' => '($data->status == 1) ? "Active" : "n-Active"',
						),
						array(
							'class'=>'CButtonColumn',
						),
					),
				)); 
			?>
            </div>
        </div>
    </section>
</div>