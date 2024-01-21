<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css"
      href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen"/>
  <?php 
 // echo $_REQUEST['fundraiser_id_a'];
//echo $_REQUEST['fundraiser_id_a'];
//echo $_REQUEST['donation_amount_a'];
//echo $_REQUEST['user_id_a'];
//echo $_REQUEST['donor_name_a'];

?>
<body onload="document.myform.submit()">    
<form method="post" name="myform" action="https://sandbox.interswitchng.com/collections/w/pay">
        <!-- REQUIRED HIDDEN FIELDS -->
        <input name="product_id" type="hidden" value=<?php echo $_REQUEST['fundraiser_id_a']; ?> />
        <input name="pay_item_id" type="hidden" value=<?php echo $_REQUEST['fundraiser_id_a']; ?> />
        <input name="amount" type="hidden" value=<?php echo $_REQUEST['donation_amount_a']; ?> />
        <input name="currency" type="hidden" value="566" />
        <input name="site_redirect_url" type="hidden" value="www.merchantssite.com/redirectpage"/>
        <input name="txn_ref" type="hidden" value="4327408aaa" />
        <input name="cust_id" type="hidden" value=<?php echo $_REQUEST['user_id_a']; ?>/>
        <input name="site_name" type="hidden" value=" http://undergirl.co.uk "/>
        <input name="cust_name" type="hidden" value=<?php echo $_REQUEST['donor_name_a']; ?> />
        <input name="hash" type="hidden" value="2279AB747A7B7FB4032CED18A92A4F0BA9E7C9BC81A6E5A1A4697A7B7FB4032CE " />
        </br></br>
<!--       <input type="submit" value="PAY NOW"></input>-->
    </form>
</body>    

<?php //die; ?>
