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
            <div class="box-header" style="width:100%;">
                <div style="width:85%; float:left;">
                    <h4> Reward Points for Year <?php echo $year; ?></h4>
                </div>
                <div style="width:15%; float:right;">
                    <?php $form=$this->beginWidget('CActiveForm', array(
                        'action'=>Yii::app()->createUrl($this->route),
                        'method'=>'get',
                    )); ?>

                    <?php echo $form->label($model,'year'); ?>
                    <?php echo Chtml::dropDownList('year',$year,$yearsList,['class'=>'form-control','onchange'=>'this.form.submit()']); ?>

                    <?php $this->endWidget(); ?>
                </div>                                

                <?php
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array(
                            'label' => 'Settings', 
                            'url' => array('reward/settings'),
                            'visible' => $this->auth->canAdd($this->resource_id),
                        ),
                        array(
                            'label' => 'Winners List', 
                            'url' => array('winner/admin'),
                            'visible' => $this->auth->canAdd($this->resource_id),
                        )
                    ),
                ));
                ?>

            </div>
            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
				<?php $this->widget('CoreCGridView', array(
					'id'=>'months-grid',
					'dataProvider'=>$dataProvider,
                    'rowCssClassExpression'=>'($data["current"]==1)?"current-month":""',
					'columns'=>array(
                        array(
							'value' => '$data["id"]',
							'header' =>'Serial',
						),
                        array(
							'value' => '$data["name"]',
							'header' =>'Month',
						),
                        array(
							'value' => '$data["donation_count"]',
							'header' =>'Donors Count',
						),
                        array(
                            'class' => 'CoreCButtonColumn',
                            'header' => 'Functions',
                            'template' => '{view}',
                            'buttons' => array(
                                'view' => array(
                                    'url' => 'Yii::app()->createUrl("admin/reward/monthly",array("month"=> $data["name"],"year" => $data["year"]))',
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