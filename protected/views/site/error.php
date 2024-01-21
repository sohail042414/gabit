<?php
/* @var $this SiteController */
/* @var $error array */

$this->pageTitle=Yii::app()->name . ' - Error';
$this->breadcrumbs=array(
	'Error',
);
?>

<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
<!--<meta name="viewport" content="width=device-width" />-->
<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">
   <div class="lead_support">
      <h4>Ooops, There is some error</h4>
   </div>
   <div class="dashboard_content">
      <div class="inner-left" style="width:100%;">
         <div class="inner-page">
            <div id="user_profile">
				<p><strong>
					The resource/page you are looking for does not exist, we are sorry for inconvience, You may <a href="mailto:support@giveyourbit.com">Send email </a> to <a>support@giveyourbit.com</a>, we will respond as soon as possible.
				</strong></p>
            </div>
         </div>
      </div>
   </div>
</div>