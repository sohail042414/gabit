<style>
    .current-month{
	    color: red;
        font-weight: bold;
    }
</style>
<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Manage Rewards'); ?>
            <?php
				$this->breadcrumbs=array(
					'Reward Winners'=>array('index')
				);

            $this->widget('CoreCBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'htmlOptions' => array('class' => 'breadcrumb')
            ));

            ?>
        </header>
        <div class="panel-body">
            <div class="box-header" style="width:100%;">
                <div style="width:85%; float:left;">
                    <h4> Winners List</h4>
                </div>
                            
                <?php
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array(
                            'label' => 'Manage Rewards', 
                            'url' => array('reward/admin'),
                            'visible' => $this->auth->canAdd($this->resource_id),
                        ),
                    ),
                ));
                ?>

            </div>
            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
				<?php $this->widget('CoreCGridView', array(
					'id'=>'months-grid',
					'dataProvider'=>$model->search(),
					'columns'=>array(
                        'image' => array(							
							'value' => '!empty($data->user->user_image) ? "<img class=\"display_facebook_img\" src=\"".SITE_ABS_PATH_USER_IMAGE_THUMB.$data->user->user_image."\" />" : "<img class=\"display_facebook_img\" src=\"".SITE_ABS_PATH."images/no-photo.jpeg"."\" />"',
							'header' =>'Image',
                            'type' => 'raw'
						),
						'user_id' => array(
                            'header' => 'User Name',
                            'type' => 'raw',
                            'value' => '$data->user->username'
                        ),
						'year',
						'month',
						'total_points',
                        'prize_amount',
						'win_date' => array(
                            'header' => 'Win Date',
                            'value' => '$data->formatedWinDate()'
                        ),
                        'location',
                        array(
                            'class' => 'CoreCButtonColumn',
                            'header' => 'Functions',
                            'template' => '{update}{view}{delete}',
                            'buttons' => array(
                                'update' => array(
                                    'visible' => ($this->auth->canUpdate($this->resource_id)) ? '1' : '0;'
                                ),
                                'view' => array(
                                    'visible' => ($this->auth->canView($this->resource_id)) ? '1' : '0;'
                                ),
                                'delete' => array(
                                    'visible' => ($this->auth->canDelete($this->resource_id)) ? '1' : '0;'                                    
                                ),
                            ),
                        ),
					),
				)); ?>
            </div>        
        </div>
    </section>
</div>