<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'Update') . ' ' . GxHtml::encode($model->label(1)) ?>
            <?php
            $this->breadcrumbs = array(
                $model->label(2) => array('index'),
                GxHtml::valueEx($model) => array('view', 'id' => GxActiveRecord::extractPkValue($model, true)),
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
                        array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
                        array('label' => Yii::t('app', 'View') . ' ' . $model->label(), 'url' => array('view', 'id' => GxActiveRecord::extractPkValue($model, true))),
                        array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('index')),
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="loader_space"></div>

            <?php
            $this->renderPartial('_form', array(
                'model' => $model,
                'buttons' => 'create'));
            ?>
        </div>
    </section>
</div>