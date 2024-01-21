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
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;">Processing Fee (8% +5) :</li>
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;"><p><?php echo $transaction->processing_fee; ?> NGN</p></li>
                    </ul>
                </li>                
            </ul>
</div>

<form method='post' action='<?php echo $payment_url; ?>'>
    <input name='site_redirect_url' type="hidden" value="<?php echo $return_url; ?>" /> 
    <input name='pay_item_id' type="hidden" value='Default_Payable_MX70046' />
    <input name='txn_ref' type="hidden"  value="<?php echo $transaction->trans_ref; ?>" />
    <input name='amount' type="hidden"  value="<?php echo ($transaction->transaction_amount*100); ?>" />
    <input name='currency' type="hidden"  value='566' />
    <input name="cust_name" type="hidden" value="<?php echo $transaction->donor_name; ?>" />
    <input name='cust_id' type="hidden" value='0000000001' /> 
    <input name='pay_item_name' type="hidden" value='Fundraiser Support' />
    <!-- <input name='display_mode' value='PAGE' />  -->
    <input name='merchant_code' value='MX70046' type="hidden" />
    <input name='split_accounts' type="hidden" value= '[{"alias":"DajEd Productions Ltd","amount":"<?php echo ($transaction->giveyourbit_fee*100) + ($transaction->interswitch_fee*100); ?>","percentage":"","description":"Platform Fee","primary":"true"}, {"alias":"Merchant Account","percentage":"","amount":"<?php echo $transaction->donation_amount*100; ?>","description":"Donation Amount","primary":"false"}]' /> 

    <input name="site_name"  type="hidden" value="www.giveyourbit.com "/>
    <input class="donate-btn" style="margin-left: 80px;" type='submit' value='Make Payment' /> 
</form> 


<!-- <form method='post' action='https://sandbox.interswitchng.com/collections/w/pay'> 
  <input name='site_redirect_url' value='www.happysana.com/redirect/' /> 
  <input name='pay_item_id' value='2674246' /> 
  <input name='txn_ref' value='1559290858392' /> 
  <input name='amount' value='10000' /> 
  <input name='currency' value='566' /> 
  <input name='cust_name' value='happysana' /> 
  <input name='cust_id' value='0000000001' /> 
  <input name='pay_item_name' value='AVASyn' /> 
  <input name='display_mode' value='PAGE' /> 
  <input name='merchant_code' value='WEBDEMO' /> 
  <input name='split_accounts' value= '[{"alias":"WEB_SPLIT_1","percentage":"60","description":"tuition","isPrimary":"true"}, {"alias":"WEB_SPLIT_2","percentage":"30","description":"housing"},{"alias":"WEB_SPLIT_1","percentage":"10","description":"transport"}]' /> 
  <input type='submit' value='Submit Form' /> 
</form>  -->

</div>
