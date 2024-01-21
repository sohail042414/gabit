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
/*    width: 165px;
    height: 37px;
    float: left;
     background: #f31126; 
    background: rgba(0, 0, 0, 0) linear-gradient(to bottom, #ee1023 0%, #9c0405 100%) repeat scroll 0 0;
    background: -webkit-gradient(linear, left top, left bottom, color-stop(0%,#ee1023), color-stop(100%,#9c0405)) !important;
    background: -webkit-linear-gradient(top, #ee1023 0%,#9c0405 100%) !important;
    display: block;
    text-align: center;
    font-size: 18px;
    margin-bottom: 5px;
    color: #FFF;
    line-height: 37px;
    font-weight: 500;
    text-decoration: none;
    margin: 40% auto 0 auto;
    margin-top: -3px;
    margin-left: 10px;
    border-radius: 10px;*/
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
    $(document).ready(function () {
        $('#more_message').click(function () {
            $('#dial_message_container').hide();
            $('#card_payment_div').show();

        });

        $('#view_btn_ok').click(function () {
            //#parent.$.fancybox.close();
            $('#dial_message_container').show();
            $('#card_payment_div').hide();
            
        });
    });
</script>
<?php
$donation_value = Donations::model()->findByPk($_REQUEST['id_value']);
?>
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
<?php
$donation_messag = DonationMessage::model()->find(array('select' => 'messge'));

?>
<div id="dial_message_container">
<?php
 //print_r($_SESSION);
 $aa_ttl = $_SESSION[donntion_tt];
    ?> 
    
<?php if($_REQUEST['txnref']=="") {   ?>
<h4 id="dial_message">
    <?php echo $donation_messag->messge;  ?> <a href="javascript:;" id="more_message">HERE</a> to donate using a payment<br/> card.
<!--    Your phone number has been synced<br/> for this donation. On your phone,<br/> please dial<br/> 777CaseNumberAnyAmount#<br/> i.e. 7774500#<br/> to donate with your phone credit. Or<br/> click <a href="javascript:;" id="more_message">HERE</a> to donate using a payment<br/> card.-->
</h4>
<a href="javascript:;" id="view_btn" class="button-tab open_success_donation" style="margin: 10px auto; float:none; display:table;">Done</a>    
<?php } else { ?>
    <h4>Transaction is successfully done and your transaction id <?php echo $_REQUEST['txnref']; ?></h4>
    
<!--    strt------------------------------------------>

<div class="content-box" style="max-width:700px; display:block; overflow:hidden; margin:0 auto; border:1px solid #000; padding:10px 10px;">
<section class="row-section" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
<div class="left-part" style="float:left;">
<h3 style="font-size:16px; margin:0;">Transaction No. <?php echo $_REQUEST['txnref']; ?> </h3>
</div>

<div class="right-part" style="float:right;">
<p style="margin:0; line-height: 22px;"><span>Print Receipt</span><br>
 Giveyourbit.com<br>
 VAT: 29766547</p>
</div>

</section>

<section class="row-section rs2" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
<div style="width:32%; float:left;">
<ul style="display:block; overflow:hidden; list-style:none; padding-left:10px;">
<li><strong>Billed to:</strong> Name: <?php echo $_SESSION['front_username']; ?></li>
<li>Email: <?php echo $_SESSION['front_email']; ?></li>
<li>Phone No.: 08099456477</li>
</ul>
</div>

<div style="width:32%; float:left;">
<ul style="display:block; overflow:hidden; list-style:none; padding-left:10px;">
<li style="padding-left:37px;"><strong>Date:</strong></li>
<li style="padding-left:37px;"><strong>Transaction Total:</strong></li>
<li style="padding-left:37px;"><strong>Receipt #:</strong></li>
</ul>
</div>

<div style="width:32%; float:left;">
<ul style="display:block; overflow:hidden; list-style:none; padding-left:10px;">
<li style="text-align:right;"><?php echo date("Y/m/d"); ?></li>
<li style="text-align:right;"><span>&#8358</span> <?php echo $_REQUEST['amount']/100; ?> NGN</li>
<li style="text-align:right;"><?php echo $_REQUEST['retRef']; ?></li>
</ul>
</div>
</section>

<section class="row-section rs3" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
<div class="left-part" style="float:left;">
<ul style="display:block; overflow:hidden; list-style:none; padding:0;">
<li style="display:inline-block; border-right:2px solid #CCC; padding:10px 10px;">Item</li>
<li style="display:inline-block; padding:10px 10px;">Description</li>
</ul>
</div>

<div class="right-part" style="float:right;">
<ul style="display:block; overflow:hidden; list-style:none; padding:0;">
<li style="border-left:2px solid #CCC; padding:10px 10px;">Amount</li>
</ul>
</div>

</section>

<section class="row-section rs3" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
<div class="left-part" style="float:left;">
<ul style="display:block; overflow:hidden; list-style:none; padding:0;">
<li style="display:inline-block; padding:10px 20px;">1</li>
<li style="display:inline-block; padding:10px 10px;">Donation to <?php echo $aa_ttl; ?></li>
</ul>
</div>
<div class="right-part" style="float:right;">
<p style="text-align:right">
    <span>&#8358</span>
    <?php echo ($_REQUEST['amount']-(1.5*$_REQUEST['amount']/100))/100; ?> NGN<br>
 +1.5% Processing Fee</p>
</div>

<div class="right-part" style="float:right;">
<p style="text-align:right">
    <span>&#8358</span>
    <?php echo ($_REQUEST['amount']-(7.5*$_REQUEST['amount']/100))/100; ?> NGN<br>
 +7.5% VAT</p>
</div>

</section>

<section class="row-section rs3" style="display:block; overflow:hidden; width:100%; padding: 5px 0 15px 0;">

<div class="right-part" style="float:right; width:50%">
<ul style="list-style:none; display:block; overflow:hidden; padding-left:0;">
<li style="display:block; overflow:hidden; padding-bottom:5px; border-bottom:1px solid #000; margin-bottom:5px">
<p style="float:left; margin:0; font-weight:bold; font-size:13px;">Transaction Total:</p>
<p style="float:right; margin:0; font-weight:bold; font-size:13px;"><span>&#8358</span><?php echo $_REQUEST['amount']/100; ?> NGN</p>
</li>
<li style="display:block; overflow:hidden; padding-bottom:5px; border-bottom:1px solid #000; margin-bottom:5px">
<p style="float:left; margin:0; font-size:13px;">Payment:</p>
<p style="float:right; margin:0; color:#F00; font-size:13px;">(US$ <?php echo $_REQUEST['amount']/100; ?>)</p>
</li>
<li style="display:block; overflow:hidden; padding-bottom:5px;">
<p style="float:left; margin:0; font-weight:bold; font-size:13px;">VAT:</p>
<p style="float:right; margin:0; font-weight:bold; font-size:13px;"><span>&#8358</span><?php echo (5*$_REQUEST['amount']/100)/100; ?>  NGN</p>
</li>
</ul>
</div>

</section>

</div>

<!--end  ------------------------------------------------- -->
<?php }
?>
    
</div>

<div id="card_payment_div" style="display: none;">
<div class="new_class">    
<!--<h4>
    Card payment availability is pending; please donate using airtime
</h4>-->
 <?php
     $name_usr = $_SESSION['front_username'] ;
     $usr_id_vl = $_SESSION['front_id'] ;
     $amunt = $_REQUEST['donation_amount'];
     $shw_amnt = $amunt - (5*$amunt/100);
     $val ="100";
     $totl_amunt =  $amunt*$val;
     $totl_mny = $totl_amunt + (5*$totl_amunt/100);
     $totl_mny_nw = $amunt - (5*$amunt/100);
     //echo $totl_mny;

     $donation_amount = $_REQUEST['donation_amount'];
     $processing_fee = (1.5*$donation_amount/100);
     $total_vat = (7.5*$donation_amount/100);
     $total_payment = $donation_amount + $processing_fee + $total_vat;

     $trxref=base64_encode("giveyourbit".time());
     $conct = $trxref."1076"."101".$totl_amunt."http://giveyourbit.com/index.php/fundraiser/responsemessage"."D3D1D05AFE42AD50818167EAC73C109168A0F108F32645C8B59E897FA930DA44F9230910DAC9E20641823799A107A02068F7BC0F4CC41D2952E249552255710F";
     $data_hs = hash('sha512', $conct);
      ?> 
        <ul style=" width:90%; list-style: none; ">
            <?php if($_REQUEST['donor_name'] != ""){ ?>
                    <li style="display: block; overflow: hidden;">
                    <div style="padding-bottom:20px; padding-top:20px; width: 50%; float: left;" >Your Name :</div>
                    <div style="padding-bottom:20px; padding-top:20px; width: 50%; float: left;"><p style="display: inline-block; vertical-align: middle;"><?php echo $_REQUEST['donor_name']; ?></p></div>
                    </li> 
            <?php } ?>        
                        <li style="display: block; overflow: hidden;">
                    <div style="padding-bottom:20px; width: 50%; float: left;" >Your Email Address :</div>
                    <div style="padding-bottom:20px; width: 50%; float: left;"><p style="display: inline-block; vertical-align: middle;"><?php echo $_REQUEST['donor_email_address']; ?></p></div>
                </li> 
                <li style="display:block; overflow:hidden  ">
                    <ul style=" list-style: none; padding-left: 0; ">
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;">Your donation :</li>
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;"><p><?php echo $donation_amount; ?> NGN</p></li>
                    </ul>
                    <ul style=" list-style: none; padding-left: 0; ">
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;">Processing Fee (1.5%) :</li>
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;"><p><?php echo $processing_fee; ?></p></li>
                    </ul>
                    <ul style=" list-style: none; padding-left: 0; ">
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;">VAT (7.5%) :</li>
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;"><p><?php echo $total_vat; ?></p></li>
                    </ul>
                    <ul style=" list-style: none; padding-left: 0; ">
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;">Your Payment :</li>
                        <li style="width: 50%; float: left; padding-bottom: 15px; display: block; overflow: hidden;"><p><?php echo $total_payment; ?>  NGN</p></li>
                    </ul>
                </li>

           
                <li style="display: block; overflow: hidden;">
                            <div style="padding-bottom:20px; padding-top:20px; font-weight:bold; width: 50%; float: left;" >Transaction Total :</div>
                            <div style="padding-bottom:20px; padding-top:20px; font-weight:bold; width: 50%; float: left;"><p style="display: inline-block; vertical-align: middle;"><?php echo $total_payment; ?> NGN</p></div>
                </li>  
                
            </ul>
</div>

<form method='post' action='https://webpay-ui.k8.isw.la/collections/w/pay'>
    <input type="hidden" name='merchant_code' value='MX70046' />
    <input name='pay_item_id' type="hidden" value='Default_Payable_MX70046' />
    <input name='site_redirect_url' type="hidden" value='http://giveyourbit.com/index.php/fundraiser/responsemessage' /> 
    <input name='txn_ref' type="hidden"  value="<?php echo $trxref; ?>" />
    <input name='amount' type="hidden"  value="<?php echo ($total_payment*100); ?>" />
    <input name="site_name"  type="hidden" value="www.giveyourbit.com "/>
    <input name="cust_name" type="hidden" value="<?php echo $name_usr; ?>" />
    <input name='currency' type="hidden"  value='566' />
    <input class="donate-btn" style="margin-left: 80px;" type='submit' value='Make Payment' /> 
</form> 



</div>



<?php
 $loadurl = $this->createUrl('fundraiser/donation_complete',array('report_id'=>$_REQUEST['report_id']));
   //   $loadurl=  SITE_ABS_PATH."fundraiser/report_fundraiser?id=". $fundraiser_object->id."&fundraiser_name=".$fundraiser_object->fundraiser_title."&fundraiser_image=".$fundraiser_object->fundraiser_image; 
?>

    <script>
        
        
        $('.open_success_donation').click(function () {
            
            window.parent.$.fancybox.open([
                    { 
                        href : "<?php echo $loadurl; ?>"
//                    title : '1st title'
                    }]
                , {
                    maxWidth: 400,
                    maxHeight: 210,
                    fitToView: false,
                    width: '100%',
                    height: '100%',
                    autoSize: false,
                    closeClick: false,
                    openEffect: 'none',
                    closeEffect: 'none',
                    'type': 'iframe',
                    helpers : { overlay : { locked : false,closeClick: true  } },
                    
                });
         

        });
    </script>
<?php //die; ?>
