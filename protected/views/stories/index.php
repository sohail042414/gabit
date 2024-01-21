<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">
    <div class="inner-page">
        <div class="inner-left">
            <?php if (!empty($_GET['tag'])) : ?>
                <h1>Posts Tagged with <i><?php echo CHtml::encode($_GET['tag']); ?></i></h1>
            <?php endif; ?>
            <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider' => $dataProvider,
                'itemView' => '_view',
                'template' => "{items}\n{pager}",
            )); ?>
        </div>
        <div class="inner-right">
            <div id="search_cls">
                <?php
                $model = new Post();
                $form = $this->beginWidget('CActiveForm', array(
                    'id' => 'search_blog',
                    'enableAjaxValidation' => false,
                    'action' => array('blog/search')
                ));
                echo $form->textField($model, 'search_field', array('id' => 'search', 'placeholder' => 'Search stories', 'class' => 'search_input'));
                echo CHtml::submitButton('Search', array("class" => "search-btn"));
                $this->endWidget();
                ?>
            </div>
        </div>
    </div>
</div>