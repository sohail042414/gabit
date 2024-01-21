<div class="main_banner" xmlns="http://www.w3.org/1999/html">
    <div class="inner-container">
        <div class="inner-page">
        <div class="inner-right">
			<div id="search_cls">
            <?php
            $model = new Post();
            $form = $this->beginWidget('CActiveForm', array(
                'id'=>'search_blog',
                'enableAjaxValidation'=>false,
                'action'=>array('blog/search')
            ));		
			echo $form->textField($model,'search_field',array('id'=>'search','placeholder'=>'Search the blog', 'class'=>'search_input'));
			echo CHtml::submitButton('Search',array("class"=>"search-btn"));
			
            $this->endWidget();
            ?>
            </div>
            </div>
            
<div class="inner-left">
            <h4><?php echo '('.$dataProvider->totalItemCount.') Blogs found'; ?></h4>
            <?php $this->widget('zii.widgets.CListView', array(
                'dataProvider'=>$dataProvider,
                'itemView'=>'_searchResult',
                'template'=>"{items}\n{pager}",
            )); ?>
            </div>
        </div>
    </div>
</div>