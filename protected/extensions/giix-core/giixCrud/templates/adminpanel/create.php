<section class="content-header">
    <h1>
        <?php
        echo "<?php echo Yii::t('app', 'Create') . ' ' . GxHtml::encode(\$model->label(1)) ?>\n";
        ?>
    </h1>
    <?php
    echo "<?php
        \$this->breadcrumbs = array(
            \$model->label(2) => array('admin'),
            Yii::t('app', 'Create'),
        );\n

        \$this->widget('CoreCBreadcrumbs', array(
            'links' => \$this->breadcrumbs,
            'htmlOptions' => array('class' => 'breadcrumb')
        )); \n
        ?> \n"
    ?>
</section>

<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <?php
                echo "<?php
                \$this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array('label'=>Yii::t('app', 'Manage') . ' ' . \$model->label(2), 'url' => array('admin')),
                    ),
                ));
                ?>\n";
                ?>
            </div>

            <?php echo "<?php\n"; ?>
            $this->renderPartial('_form', array(
            'model' => $model,
            'buttons' => 'create'));
            <?php echo '?>'; ?>

        </div>
    </div>
</section>