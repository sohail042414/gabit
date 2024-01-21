<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'Update') . ' ' . GxHtml::encode($model->label(1)) ?>
            <?php
            $this->breadcrumbs = array(
                'Administrators' => array('admin'),
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
                        array('label' => Yii::t('app', 'Create Administrator') , 'url' => array('create')),
                        array('label' => Yii::t('app', 'View Administrator') , 'url' => array('view', 'id' => GxActiveRecord::extractPkValue($model, true))),
                        array('label' => Yii::t('app', 'Manage Administrators') , 'url' => array('admin')),
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

