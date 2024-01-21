<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Manage Rewards'); ?>
            <?php
            $this->breadcrumbs = array(
                'Rewards' => array('admin'),
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
                            'label' => Yii::t('app', 'Declare Winner'), 
                            'url' => Yii::app()->createUrl('/admin/reward/declare',array('month'=>$month,'year'=>$year)),
                            'visible' => $this->auth->canUpdate($this->resource_id)
                        ),
                    ),
                ));
                ?>          
            </div>
            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
				<?php $this->widget('CoreCGridView', array(
					'id'=>'reward-points-grid',
					'dataProvider'=>$dataProvider,
					//'filter'=>$model,
					'columns'=>array(
                        array(							
							'value' => '!empty($data["user_image"]) ? "<img class=\"display_facebook_img\" src=\"".SITE_ABS_PATH_USER_IMAGE_THUMB.$data["user_image"]."\" />" : "<img class=\"display_facebook_img\" src=\"".SITE_ABS_PATH."images/no-photo.jpeg"."\" />"',
							'header' =>'Image',
                            'type' => 'raw'
						),
                        array(
							'value' => '$data["username"]',
							'header' =>'Username',
						),
                        array(
							'value' => '$data["age"]',
							'header' =>'Age',
						),
                        array(
							'value' => '$data["sex"] == "M" ? "Male" : "Female" ',
							'header' =>'Sex',
						),
                        array(
							//'name' => 'points',
							'value' => '$data["total_points"]',
							'header' =>'Cumulative Points',
						),
                        array(
                            'class' => 'CoreCButtonColumn',
                            'header' => 'Functions',
                            'template' => '{view}',
                            'buttons' => array(
                                'view' => array(
                                    'url' => 'Yii::app()->createUrl("admin/reward/view",array("id"=>$data["id"],"year"=>$data["year"],"month"=>$data["month"]))',
                                    'visible' => ($this->auth->canView($this->resource_id)) ? '1' : '0;'
                                )
                            ),
                        ),
					),
				)); ?>
            </div>        
        </div>
    </section>
</div>