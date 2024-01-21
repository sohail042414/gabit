<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css">

<script>
    $(document).ready(function () {
        $('#view_btn').click(function () {
            parent.$.fancybox.close();

        });
        
    });
</script>

<style type="text/css">
    h4 {
        font-size: 18px;
        line-height: 26px;
        text-align: center;
        color: green;
        font-family: Arial, Helvetica, sans-serif;
        border: #CCC 2px dashed;
        padding: 20px;
        font-weight: 100;
        margin-left: 10px;
    }
    #dial_message_container {
    height: 137px;
    padding: 15px;
    width: auto;
    margin-top: 104px;
}
.fancybox-inner{height: 265px !important;}

</style>
<div id="dial_message_container">
<h4 id="dial_message">
    Your message has been sent.
</h4>
<a href="javascript:;" id="view_btn" class="button-tab" style="margin: 10px auto; float:none; display:table;">Ok</a>
</div>
<?php die; ?>
