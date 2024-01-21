<style type="text/css">
#join_form{width:400px; margin:0px auto;}
#join_form h4 {float: left; font-size: 20px; font-weight: lighter; width: 100%; margin:0px; font-family:Arial, Helvetica, sans-serif; text-transform:capitalize; border-bottom:#666 1px solid; margin-bottom:10px; line-height:50px;}
.form-group{width:100%; float:left; margin-bottom:15px;}
label{width:140px; float:left; font-family:Arial, Helvetica, sans-serif; font-size:13px; font-weight:normal;}
textarea{width:220px; height:70px; float:left; border:#CCC 1px solid; font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; padding:8px; -webkit-appearance:none;}
input.form-control{width:230px; height:30px; float:left; border:#CCC 1px solid; font-size:13px; font-family:Arial, Helvetica, sans-serif; font-weight:normal; padding-left:5px; -webkit-appearance:none;}
#join_form .btn-primary{font-size: 13px; font-weight: 600; font-family:Arial, Helvetica, sans-serif; background:#f31126; text-align:center; line-height:30px; padding:0px 10px; float:left; color:#FFF; text-decoration:none; border-radius:3px; margin-bottom:20px; border:none; -webkit-appearance:none; margin-left:140px;}
.errorMessage{float:left; color:red; font-size:12px; font-family:Arial, Helvetica, sans-serif; line-height:20px; margin-left:140px;}
#up-img-row{width:190px; float:left; margin-top:20px;}
#up-img-row img{max-width:100%;}


.alert.alert-success.alert-dismissable {
    color: green;
    font-family: arial;
    font-size: 25px;
    padding-bottom: 10px;
    text-align: center;
    width: 100%;
}

#join_form p{  float: left;
    font-family: Arial,Helvetica,sans-serif;
    font-size: 13px;
    font-weight: normal;
    width: 140px;
}


@media screen and (-webkit-min-device-pixel-ratio:0) { 
textarea{width:227px;}
}

@media only screen and (max-width: 480px){
#join_form{width:100%;}
#join_form label{width:100%; float:left;}
#join_form .errorMessage{margin-left:0px; float:left;}
textarea{width:200px;}
input.form-control{width:200px;}
#join_form .btn-primary{margin-left:0px;}
}
/*#join_form{text-align:center;}*/
#join_form span{font-family:Arial, Helvetica, sans-serif; font-size:16px; width:100%; float:left;}
#join_form input[type=button]{background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0; padding:5px 10px; border:none; border-radius:5px; color:#FFF; float:none; margin:15px 0px;}



.link_login, .link_signup, .view_btn {
        font-size: 13px;
        font-weight: 600;
        font-family: Arial, Helvetica, sans-serif;
        text-align: center;
        line-height: 30px;
        padding: 0px 10px;
        float: left;
        color: #FFF;
        text-decoration: none;
        border-radius: 3px;
        margin-bottom: 20px;
        margin-right: 5px;
        background: #f31126;
        -webkit-appearance: none;
    }
</style>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css"
      href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen"/>

<div class="supporter_left">
    <!-- <img class="fund_image" src="<?php //echo $fundraiser->getImageURL(); ?>"> -->
</div>
<div class="supporter_right">    
    <div class="alert alert-success alert-dismissable">Your Request has been sent.</div>
    <a id="close_popup" class="link_signup" style="float: right;">Close</a> 
</div>

<script>
    $(document).ready(function () {
        $('#close_popup').click(function () {
            parent.$.fancybox.close();
        });
    });
</script>
