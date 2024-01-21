<style>
table tr:first-child  {background: #fff}  
tr:nth-child(even) {background: #fff}
tr:nth-child(odd) {background: #F3F4F5}
th {
    text-align: center;
    padding: 15px 0;
    border: 1px solid #ddd;
    border-bottom: 2px solid #ddd;
}
td {
   text-align: center;
    padding: 15px 0;
    border: 1px solid #ddd;
}
</style>

<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Manage') . ' ' . 'Testimonial Message' ?>

            <?php
            $this->breadcrumbs = array(
                $model->label(2) => array('admin'),
                Yii::t('app', 'Manage'),
            );


            $this->widget('CoreCBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'htmlOptions' => array('class' => 'breadcrumb')
            ));

            ?>
        </header>
        <div class="panel-body">
            <div class="box-header">
<!--            <a class="btn btn-primary module_menu1" href="<?php echo $this->createUrl("testimonialmessg/editmessage"); ?>">Edit Message</a>    -->
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-responsive">
            <div class="loader_space"></div>
               <table>
                   <tr>
                       <th>ID</th>
                       <th>User ID</th>
                       <th>User Name</th>
                       <th>Message</th>
                       <th>Make Home Page Testimonial</th>
                       
                   </tr>
                 <?php  $details_data = TestimonialMessage::model()->findAll(array('select' => '*','order'=>'id DESC')); 
                 ?>     
                 <?php foreach($details_data as $detals){ ?>
                   <?php  $details_us = Users::model()->find(array("select" => "*","condition" => "id = '".$detals['user_id']."'")); 
                 //  print_r($details_us);
                 ?>     
                   <tr>
                    <td width="10%"><?php echo $detals['id'];?></td>
                    <td width="10%"><?php echo $detals['user_id'];?></td>
                    <td width="30%"><?php echo $details_us['username'] ;?></td>
                    <td width="30%"><?php echo $detals['message'];?></td>
                    <td width="20%"><a class="" href="<?php echo $this->createUrl("testimonialmessg/editmessage?id=".$detals['id']); ?>">Click</a></td>
                   </tr>
                 <?php } ?>
               </table>    
            </div>
        </div>
    </section>
</div>