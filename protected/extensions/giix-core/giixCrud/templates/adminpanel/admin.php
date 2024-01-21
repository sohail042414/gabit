<section class="content-header">
    <h1>
        <?php
        echo "<?php echo Yii::t('app', 'Manage') . ' ' . GxHtml::encode(\$model->label(2)) ?>\n";
        ?>
    </h1>
    <?php
    echo "<?php
        \$this->breadcrumbs = array(
            \$model->label(2) => array('admin'),
            Yii::t('app', 'Manage'),
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
                        array('label' => Yii::t('app', 'Create') . ' ' . \$model->label(), 'url' => array('create')),
                    ),
                ));
                ?>\n";
                ?>
            </div>

            <div class="box-body table-responsive">
                <?php echo '<?php'; ?> $this->widget('CoreCGridView', array(
                'id' => '<?php echo $this->class2id($this->modelClass); ?>-grid',
                'dataProvider' => $model->search(),
                'filter' => $model,
                'columns' => array(
                <?php
                $count = 0;
                foreach ($this->tableSchema->columns as $column) {
                    if(!empty($column->name) && $column->name != 'status') {
                        if (++$count == 7)
                            echo "\t\t/*\n";
                        echo "\t\t" . $this->generateGridViewColumn($this->modelClass, $column) . ",\n";

                    } else {
                        if (++$count == 7)
                            echo "\t\t/*\n";
                        echo "\t\t array(
                            'name' => 'status',
                            'type' => 'raw',
                            'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                            'value' => 'UtilityHtml::getStatusImage(\$data->status,\"grid\")',
                        ),";
                    }

                }
                if ($count >= 7)
                    echo "\t\t*/\n";
                ?>
                array(
                'header' => 'Actions',
                'class' => 'CoreCButtonColumn',
                ),
                ),
                )); ?>
            </div>

        </div>
    </div>
</section>