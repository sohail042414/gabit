<div class="post">
	<div class="title">
		<?php echo CHtml::link(CHtml::encode($data->title), $data->url); ?>
	</div>
	<div class="author">
		posted by <?php echo $data->author->username . ' on ' . date('F j, Y',strtotime($data->create_time)); ?>
	</div>
	<div class="content">
		
		<?php if (Yii::app()->controller->id == 'blog' && Yii::app()->controller->action->id == 'view') { ?>
		<br>
		<!-- ShareThis BEGIN -->
		<div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
		<!-- code for page content -->
		<br>
		<?php } ?>

		<?php
			$this->beginWidget('CMarkdown', array('purifyOutput'=>true));
			echo $data->content;
			$this->endWidget();
		?>

		<?php if (Yii::app()->controller->id == 'blog' && Yii::app()->controller->action->id == 'view') { ?>
		<br>
		<!-- ShareThis BEGIN -->
		<div class="sharethis-inline-share-buttons"></div><!-- ShareThis END -->
		<!-- code for page content -->
		<br>
		<?php } ?>
	</div>
	<div class="nav">
<!--		<b>Tags:</b>-->
<!--		--><?php //echo implode(', ', $data->tagLinks); ?>
<!--		<br/>-->
<!--		--><?php //echo CHtml::link('Permalink', $data->url); ?><!-- |-->
		<?php echo CHtml::link("Comments ({$data->commentCount})",$data->url.'#comments'); ?> |
		Last updated on <?php echo date('F j,Y',strtotime($data->update_time)); ?>
	</div>
</div>
