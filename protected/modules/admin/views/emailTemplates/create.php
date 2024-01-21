<?php
/* @var $this EmailTemplatesController */
/* @var $model EmailTemplates */
?>
<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'Create Email Template') ?>
            <?php
			$this->breadcrumbs=array(
				'Email Templates'=>array('index'),
				$model->id=>array('view','id'=>$model->id),
				'Create',
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
                        //array('label' => Yii::t('app', 'View') . ' ' . $model->label(), 'url' => array('view', 'id' => GxActiveRecord::extractPkValue($model, true))),
                        array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
                    ),
                ));
                ?>
            </div>

            <div class="clear"></div>
            <div class="loader_space"></div>
            
			<?php $this->renderPartial('_form', array('model'=>$model)); ?>
        </div>
    </section>
</div>


