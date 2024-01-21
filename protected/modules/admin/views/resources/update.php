<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'Update Group') ?>
            <?php
            $this->breadcrumbs = array(
                'Resources' => array('admin'),
                $model->name => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
                Yii::t('app', 'Update'),
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
                        array('label' => Yii::t('app', 'Manage Resources'), 'url' => array('admin')),
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="loader_space"></div>

            <?php
            $this->renderPartial('_form', array(
                'model' => $model
			));
            ?>
        </div>
    </section>
</div>