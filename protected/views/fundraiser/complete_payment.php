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
   <h4>Transaction is successfully done </h4>
   <!--    strt------------------------------------------>
   <div class="content-box" style="max-width:700px; display:block; overflow:hidden; margin:0 auto; border:1px solid #000; padding:10px 10px;">
      <section class="row-section" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
         <div class="left-part" style="float:left;">
            <h3 style="font-size:16px; margin:0;">Transaction ID: <?php echo $_REQUEST['txnref']; ?> </h3>
         </div>
         <div class="right-part" style="float:right;">
            <p style="margin:0; line-height: 22px;"><span>Print Receipt</span><br>
               Giveyourbit.com<br>
               VAT: 29766547
            </p>
         </div>
      </section>
      <section class="row-section rs2" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
         <div style="width:32%; float:left;">
            <ul style="display:block; overflow:hidden; list-style:none; padding-left:10px;">
               <li><strong>Billed to:</strong><br> Name: <?php echo $donation->donor_name; ?></li>
               <li>Email: <?php echo $donation->donor_email; ?></li>
               <li>Phone No.: <?php echo $donation->donor_phone_no; ?></li>
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
               <li style="text-align:right;"><?php echo date("Y/m/d",time()); ?></li>
               <li style="text-align:right;"><span>&#8358</span> <?php echo $donation->transaction_amount; ?> NGN</li>
               <li style="text-align:right;"><?php echo $donation->trans_ref; ?></li>
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
               <li style="display:inline-block; padding:10px 10px;">Donation to <?php echo $fundraiser->fundraiser_title; ?></li>
            </ul>
         </div>
         <div class="right-part" style="float:right;">
            <p style="text-align:right">
               <span>&#8358</span>
               <?php echo $donation->donation_amount; ?> NGN<br>
               +8.5% +5 Processing Fee
            </p>
         </div>
      </section>
      <section class="row-section rs3" style="display:block; overflow:hidden; width:100%; padding: 5px 0 15px 0;">
         <div class="right-part" style="float:right; width:50%">
            <ul style="list-style:none; display:block; overflow:hidden; padding-left:0;">
               <li style="display:block; overflow:hidden; padding-bottom:5px; border-bottom:1px solid #000; margin-bottom:5px">
                  <p style="float:left; margin:0; font-weight:bold; font-size:13px;">Transaction Total:</p>
                  <p style="float:right; margin:0; font-weight:bold; font-size:13px;"><span>&#8358</span><?php echo $donation->transaction_amount; ?> NGN</p>
               </li>
               <li style="display:block; overflow:hidden; padding-bottom:5px;">
                  <p style="float:left; margin:0; font-weight:bold; font-size:13px;">Donation Amount:</p>
                  <p style="float:right; margin:0; font-weight:bold; font-size:13px;"><span>&#8358</span><?php echo $donation->donation_amount; ?>  NGN</p>
               </li>
               <li style="display:block; overflow:hidden; padding-bottom:5px;">
                  <p style="float:left; margin:0; font-weight:bold; font-size:13px;">Processing Fee (8.5% +5):</p>
                  <p style="float:right; margin:0; font-weight:bold; font-size:13px;"><span>&#8358</span><?php echo $donation->processing_fee; ?>  NGN</p>
               </li>
            </ul>
         </div>
      </section>
   </div>
</div>