<section class="content-header">
    <h1>
        <?php echo Yii::t('app', 'Create') . ' ' . GxHtml::encode($model->label(1)) ?>
    </h1>
    <?php
        $this->breadcrumbs = array(
            $model->label(2) => array('admin'),
            Yii::t('app', 'Create'),
        );


        $this->widget('CoreCBreadcrumbs', array(
            'links' => $this->breadcrumbs,
            'htmlOptions' => array('class' => 'breadcrumb')
        )); 

        ?> 
</section>

<section class="content">
    <div class="col-xs-12">
        <div class="box">
            <div class="box-header">
                <?php
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array('label'=>Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin')),
                    ),
                ));
                ?>
            </div>

            <?php
            $this->renderPartial('_form', array(
            'model' => $model,
            'buttons' => 'create'));
            ?>
        </div>
    </div>
</section>