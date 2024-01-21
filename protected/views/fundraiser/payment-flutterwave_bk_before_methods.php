
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<script src="https://checkout.flutterwave.com/v3.js"></script>
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

<script>

$(document).ready(function(){
  $('#payment-form').submit();
});

    //    payment_options: "card, mobilemoneyghana, ussd",
function makePayment() {
  FlutterwaveCheckout({
    public_key: "<?php echo $flutterwave_settings['public_key'] ?>",
    tx_ref: "<?php echo $transaction->trans_ref; ?>",
    amount: <?php echo $transaction->transaction_amount; ?>,
    currency: "<?php echo $flutterwave_settings['currency'] ?>",
    redirect_url: "<?php echo $flutterwave_return_url; ?>",
    meta: {
      case_no : '<?php echo $fundraiser->id; ?>',
      title: "<?php echo $fundraiser->fundraiser_title; ?>",
      donation_amount : '<?php echo $transaction->donation_amount; ?>',
      processing_fee : '<?php echo $transaction->processing_fee; ?>',
      date_time : '<?php echo date('Y-m-d h:i:s',time()); ?>',
      payment_method : 'js object',
    },
    customer: {
      email: "<?php echo $transaction->donor_email; ?>",
      name: "<?php echo $transaction->donor_name; ?>",
    },
    customizations: {
      title: "Giveyourbit",
      description: "Donation for fundraiser",      
    },
    subaccounts:{
        id:'RS_821FBA91809C7A752A13C88D81218465',
        split_type:'flat',
        split_value:'<?php echo $transaction->donation_amount; ?>'
    }
  });
}
</script>

<div id="card_payment_div" style="display: none;">
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

<form id="payment-form" method="POST" action="<?php echo $flutterwave_settings['payment_url']; ?>">
  <input type="hidden" name="public_key" value="<?php echo $flutterwave_settings['public_key'] ?>" />
  <input type="hidden" name="customer[email]" value="<?php echo $transaction->donor_email; ?>" />
  <input type="hidden" name="customer[name]" value="<?php echo $transaction->donor_name; ?>" />
  <input type="hidden" name="tx_ref" value="<?php echo $transaction->trans_ref; ?>" />
  <input type="hidden" name="amount" value="<?php echo $transaction->transaction_amount; ?>" />
  <input type="hidden" name="currency" value="<?php echo $flutterwave_settings['currency'] ?>" />
  <input type="hidden" name="meta[case_no]" value="<?php echo $fundraiser->id; ?>" />
  <input type="hidden" name="meta[time]" value="<?php echo date('Y-m-d h:i:s',time()); ?>" />
  <input type="hidden" name="meta[tx_ref]" value="<?php echo $transaction->trans_ref; ?>" />
  <input type="hidden" name="meta[donation_amount]" value="<?php echo $transaction->donation_amount; ?>" />
  <input type="hidden" name="meta[processing_fee]" value="<?php echo $transaction->processing_fee; ?>" />
  <?php /* ?>
  <input type="hidden" name="subaccounts[][id]" value="RS_821FBA91809C7A752A13C88D81218465" />
  <input type="hidden" name="subaccounts[][split_type]" value="flat" />  
  <input type="hidden" name="subaccounts[][split_value]" value="<?php echo $transaction->donation_amount; ?>" />
  <?php */ ?>

  <input type="hidden" name="subaccounts[][id]" value="<?php echo $flutterwave_settings['sub_account_id']; ?>" />
  <input type="hidden" name="subaccounts[][transaction_charge_type]" value="flat_subaccount" />  
  <input type="hidden" name="subaccounts[][transaction_charge]" value="<?php echo $transaction->donation_amount; ?>" />


  <input type="hidden" name="redirect_url" value="<?php echo $flutterwave_return_url; ?>" />
  <button type="submit" id="start-payment-button" class="donate-btn" style="margin-left: 80px;" >Pay Now</button>
</form>
<?php /* ?>
<button type="button" onclick="makePayment()" class="donate-btn" style="margin-left: 80px;" >Pay Now</button>
<?php */ ?>
</div>

