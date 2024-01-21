<section class="content-header">
    <h1>
        <?php echo "<?php echo Yii::t('app', 'Update') . ' ' . GxHtml::encode(\$model->label(1)) ?>"; ?>
    </h1>
    <?php
    echo "<?php
    \$this->breadcrumbs = array(
        \$model->label(2) => array('admin'),
        GxHtml::valueEx(\$model) => array('view', 'id' => GxActiveRecord::extractPkValue(\$model, true)),
        Yii::t('app', 'Update'),
    );

    \$this->widget('CoreCBreadcrumbs', array(
        'links' => \$this->breadcrumbs,
        'htmlOptions' => array('class' => 'breadcrumb')
    ));
    ?>\n";
    ?>
</section>

<section class="content">
    <div class="row">
        <div class="col-md-12">
            <div class="box">
                <div class="box-header">
                    <?php
                    echo "<?php
                    \$this->widget('CoreButtonCMenu', array(
                        'encodeLabel' => false,
                        'items' => array(
                            array('label' => Yii::t('app', 'Create') . ' ' . \$model->label(), 'url' => array('create')),
                            array('label' => Yii::t('app', 'View') . ' ' . \$model->label(), 'url' => array('view', 'id' => GxActiveRecord::extractPkValue(\$model, true))),
                            array('label' => Yii::t('app', 'Manage') . ' ' . \$model->label(2), 'url' => array('admin')),
                        ),
                    ));
                    ?>\n";
                    ?>
                </div>

                <?php
                echo "<?php
                \$this->renderPartial('_form', array(
                    'model' => \$model,
                    'buttons' => 'create'));
                ?>\n";
                ?>
            </div>
        </div>
    </div>
</section>