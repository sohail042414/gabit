<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'Edit News and Updates'); ?>    </h1>
            <?php
            $this->breadcrumbs = array(
                'Manage News and Updates' => array('admin'),
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
                        array('label' => Yii::t('app', 'Create News and Updates'), 'url' => array('create')),
                        array('label' => Yii::t('app', 'View News and Updates'), 'url' => array('view', 'id' => GxActiveRecord::extractPkValue($model, true))),
                        array('label' => Yii::t('app', 'Manage News and Updates'), 'url' => array('admin')),
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