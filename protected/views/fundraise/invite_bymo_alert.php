<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css"
      href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen"/>
<script>
    $(document).ready(function () {
        $('#more_message').click(function () {
            $('#dial_message_container').hide();
            $('#card_payment_div').show();

        });
        $('#view_btn').click(function () {
            parent.$.fancybox.close();

        });
        $('#view_btn_ok').click(function () {
            //#parent.$.fancybox.close();
            $('#dial_message_container').show();
            $('#card_payment_div').hide();
            
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
    }
</style>

<div id="dial_message_container">
<h4 id="dial_message">
Phone invite is not available at this time. Please send invite by email for now.</h4>
<a href="javascript:;" id="view_btn" class="button-tab" style="margin: 10px auto; float:none; display:table;">ok</a>
</div>



<?php die; ?>
