<style type="text/css">
.main_body {
    float: left;
    width: 100%;
}
iframe{height: 480px !important}
#embedsite_iframemain{width:50%; float: left;}
#embedsite_main{width:50%; float: right; font-family: arial; font-size: 13px; color:#098fc6;}
#embedsite_main p{color: #333; font-size: 14px;}
#embedsite_iframemain iframe{float: left;}

@media only screen and (max-width: 480px){
#embedsite_iframemain, #embedsite_main{width:100%;}
}

</style> 

<?php $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser->fundraiser_title);
    $title = str_replace("'", '', $title);
    $title = strtolower($title);
    $type = preg_replace("/[^A-Za-z0-9\-\']/", '_', trim($fundraiser->ftype->fundraiser_type));
    $type = str_replace("'", '', $type);
    $type = strtolower($type);
    $percentage = UtilityHtml::get_fundraiser_percent($fundraiser->fundraiser_amount_need, $fundraiser->id);
    $redirect_url= $this->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title)); 

?>
<div class="main_body">
 
    <div id="embedsite_iframemain">
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/embedsite_widget.js">
        </script>
        <script type="text/javascript">
           var fid=<?php echo $_REQUEST['id'];?> ;
           BuildWidget(fid);
        </script>
       
    </div>
    
    
    <div id="embedsite_main">
        <br> 
        <p><strong>Please copy the code below to your website or blog to get this widget:</strong></p>
        <br>
        <?php 
        $code =  '<div style="width:50%;text-align:center">
            <script type="text/javascript" src="http://giveyourbit.com/js/embedsite_widget.js">
            </script>
            <script type="text/javascript">
               BuildWidget('.$_REQUEST['id'].');
            </script>
            
        </div>';
        echo htmlentities($code, ENT_QUOTES); 
        ?>
        <p>Note: You cannot use widget on social media sites. You can only use widget on websites and blogs that you have personal control over the html code.<p>
    </div>

</div>