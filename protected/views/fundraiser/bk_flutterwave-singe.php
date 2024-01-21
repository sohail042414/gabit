<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css"
      href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen"/>
<style>
    #sub_pay{
        
    margin-top: 20px;
    line-height: 35px;
    text-align: center;
    font-size: 14px;
    font-weight: bold;
    float: left;
    padding: 5px 30px;
    /* margin-top: 40px !important; */
    background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0 !important;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ee1023), color-stop(100%,#9c0405)) !important;
    background: -webkit-linear-gradient(top, #ee1023 0%,#9c0405 100%) !important;
    color: #FFF;
    border: none;
    font-family: Arial, Helvetica, sans-serif;
    border-radius: 5px !important;
    margin-bottom: 40px;
    margin: 0 auto;
    margin-left: 32%;    
    }
    .new_class{
       font-size: 13px;
    line-height: 26px;
    text-align: center;
    color: green;
    font-family: Arial, Helvetica, sans-serif;
    border: #CCC 2px dashed;
    padding: 20px;
    font-weight: 100;
    overflow: hidden;
    }
</style>

<div id="card_payment_div">
<div class="new_class">    
        <ul style=" width:90%; list-style: none; ">
            <?php if($transaction->donor_name != ""){ ?>
                    <li style="display: block; overflow: hidden;">
                    <div style="padding-bottom:20px; padding-top:20px; width: 50%; float: left;" >Your Name :</div>
                    <div style="padding-bottom:20px; padding-top:20px; width: 50%; float: left;"><p style="display: inline-block; vertical-align: middle;"><?php echo $transaction->donor_name; ?></p></div>
                    </li> 
            <?php } ?>        
                <li style="display: block; overflow: hidden;">
                    <div style="padding-bottom:20px; width: 50%; float: left;" >Your Email Address :</div>
                    <div style="padding-bottom:20px; width: 50%; float: left;"><p style="display: inline-block; vertical-align: middle;"><?php echo $transaction->donor_email; ?></p></div>
                </li> 
                <li style="display:block; overflow:hidden  ">
                    <ul style=" list-style: none; padding-left: 0; ">
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;">Your donation :</li>
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;"><p><?php echo $transaction->donation_amount; ?> NGN</p></li>
                    </ul>
                    <ul style=" list-style: none; padding-left: 0; ">
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;">Processing Fee (8% +5.00) :</li>
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;"><p><?php echo $transaction->processing_fee; ?> NGN</p></li>
                    </ul>
                    <ul style=" list-style: none; padding-left: 0; ">
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;">Transaction Amount :</li>
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;"><p><?php echo $transaction->transaction_amount; ?> NGN</p></li>
                    </ul>
                </li>                
            </ul>
</div>


<form method="POST" action="<?php echo $flutterwave_settings['payment_url']; ?>">
  <!-- <div>
    Your order is ₦3,400
  </div> -->
  <input type="hidden" name="public_key" value="<?php echo $flutterwave_settings['public_key'] ?>" />
  <input type="hidden" name="customer[email]" value="<?php echo $transaction->donor_email; ?>" />
  <input type="hidden" name="customer[name]" value="<?php echo $transaction->donor_name; ?>" />
  <input type="hidden" name="tx_ref" value="<?php echo $transaction->trans_ref; ?>" />
  <input type="hidden" name="amount" value="<?php echo $transaction->transaction_amount; ?>" />
  <input type="hidden" name="currency" value="<?php echo $flutterwave_settings['currency'] ?>" />
  <input type="hidden" name="meta[token]" value="54" />
  <input type="hidden" name="redirect_url" value="<?php echo $flutterwave_return_url; ?>" />
  <button type="submit" id="start-payment-button" class="donate-btn" style="margin-left: 80px;" >Pay Now</button>
</form>

</div>

