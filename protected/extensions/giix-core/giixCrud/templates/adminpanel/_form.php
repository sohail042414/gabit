<?php echo "<?php \n"; ?>
    $form = $this->beginWidget('CoreGxActiveForm', array(
        'id' => '<?php echo $this->class2id($this->modelClass); ?>-form',
        'enableAjaxValidation' => false,
        'enableClientValidation' => true,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data'
        ),
        'clientOptions' => array(
            'validateOnSubmit' => true,
            'validateOnChange' => true,
        ),
    ));
<?php echo '?>'; ?>

    <div class="box-body">
        <?php foreach ($this->tableSchema->columns as $column): ?>
            <?php
            if (!$column->autoIncrement) {
                if($column->name != 'status') { ?>
                    <div class="form-group">
                        <?php echo "<?php echo " . $this->generateActiveLabel($this->modelClass, $column) . "; ?>\n"; ?>
                        <?php echo "<?php " . $this->generateActiveField($this->modelClass, $column) . "; ?>\n"; ?>
                        <?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
                    </div>
                <?php } else { ?>
                    <div class="form-group">
                        <?php echo "<?php echo " . $this->generateActiveLabel($this->modelClass, $column) . "; ?>\n"; ?>
                        <?php echo "<?php echo \$form->dropDownList(\$model, 'status', array('Y' => Yii::t('app', 'Active'), 'N' => Yii::t('app', 'Inactive'))); ?>\n"; ?>
                        <?php echo "<?php echo \$form->error(\$model,'{$column->name}'); ?>\n"; ?>
                    </div>
                <?php }
                ?>

            <?php } ?>
        <?php endforeach; ?>
    </div>
    <div class="box-footer">
        <?php
        echo "<?php
    echo GxHtml::submitButton(Yii::t('app', 'Save'), array('class' => 'btn btn-primary'));
    ?>\n";
        ?>
    </div>

<?php
echo "<?php
\$this->endWidget();
?>";
?>