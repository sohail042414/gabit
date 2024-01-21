<section class="content-header">
    <h1>
        <?php
        echo "<?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode(\$model->label(1)) ?>\n";
        ?>
    </h1>
    <?php
    echo "<?php
        \$this->breadcrumbs = array(
            \$model->label(2) => array('admin'),
            GxHtml::valueEx(\$model),
        );

        \$this->widget('CoreCBreadcrumbs', array(
            'links' => \$this->breadcrumbs,
            'htmlOptions' => array('class' => 'breadcrumb')
        )); \n
        ?> \n"
    ?>
</section>

<section class="content">
    <div class="col-xs-12">
        <?php echo "<?php echo UtilityHtml::get_flash_message(); ?>"; ?>
        <div class="box">
            <div class="box-header">
                <?php
                echo "<?php
				\$this->widget('CoreButtonCMenu', array(
					'encodeLabel' => false,
					'items' => array(
						array('label'=>Yii::t('app', 'Create') . ' ' . \$model->label(), 'url'=>array('create')),
						array('label'=>Yii::t('app', 'Update') . ' ' . \$model->label(), 'url'=>array('update', 'id' => \$model->" . $this->tableSchema->primaryKey . ")),
						array('label'=>Yii::t('app', 'Delete') . ' ' . \$model->label(), 'url'=>'#', 'linkOptions' => array('submit' => array('delete', 'id' => \$model->" . $this->tableSchema->primaryKey . "), 'confirm'=>'Are you sure you want to delete this item?')),
						array('label'=>Yii::t('app', 'Manage') . ' ' . \$model->label(2), 'url'=>array('admin'))
					),
				));
				?>\n";
                ?>
            </div>
            <div class="box-body table-responsive">
                <?php echo '<?php'; ?> $this->widget('CoreCDetailView', array(
                'data' => $model,
                'attributes' => array(
                <?php
                foreach ($this->tableSchema->columns as $column)
                    if (!empty($column->name) && $column->name != 'status') {
                        echo $this->generateDetailViewAttribute($this->modelClass, $column) . ",\n";
                    } else {
                        echo "\t\t array(
                            'name' => 'status',
                            'type' => 'raw',
                            'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                            'value' => UtilityHtml::getStatusImage(\$model->status,'view'),
                        ),";
                    }

                ?>
                ),
                )); ?>
            </div>
        </div>
    </div>
</section>