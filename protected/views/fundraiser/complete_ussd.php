<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
<link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
<script type="text/javascript"
        src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
<link rel="stylesheet" type="text/css"
      href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen"/>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jspdf.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/html2canvas.min.js"></script>      

<script>
    $(document).ready(function () {
       $('#view_btn').click(function () {
           //parent.$.fancybox.close();
           parent.location.reload();
       });
    });
</script>

<script>

   $(document).ready(function () {
      $('#save-button').click(function () {
         $('#view_btn').hide();
         html2canvas(document.body).then(function (canvas) {
            var img = canvas.toDataURL("image/png");
            var doc = new jsPDF();
            doc.addImage(img, 'JPEG', 23, 23);
            doc.save('donation-receipt.pdf');        
         });
         $('#view_btn').show();
      });

   });

</script>

<style type="text/css">
    .success-message {
        font-size: 18px;
        line-height: 26px;
        text-align: center;
        color: green;
        font-family: Arial, Helvetica, sans-serif;
        border: #CCC 2px dashed;
        padding: 10px;
        font-weight: 100;
        width: 460px;
    }
    .content-box{
      width:460px; 
      display:block; 
      overflow:hidden; 
      margin:0 auto; 
      border:1px solid #000; 
      padding:10px 10px;
    }
    
    .row-section{ 
      display:block; 
      overflow:hidden; 
      width:100%; 
      border-bottom:1px solid #000; 
      padding: 5px 0px;
    }
    .bill-to-list{
      display:block; 
      overflow:hidden; 
      list-style:none; 
      padding-left: 20px;
    }
    .bill-to-list li{
      padding:3px 1px;
    }
    .left-part{
      width:70%;
    }
    .right-part{
      width:30%;
    }

   td, th {
      border: 1px solid black;
   }

   td, th {
      height: 40px;
      padding:5px;
   }

   table {
      border-collapse: collapse;
      width: 100%;
   }

   table.bill-to td, th {
      height: 20px;
      padding:2px 4px;
   }

   #save-button{
      width:81px;
      height:20px;
      display: block;
      padding:3px;
      background-color: #CCC;
   }

</style>

<div id="dial_message_container" style="width:460px;">
   <!-- <h4>Transaction is successfully done <br> ID :<?php //echo $transaction->trans_ref; ?></h4> -->
   <h4 class="success-message" style="
         font-size: 18px;
        line-height: 26px;
        text-align: center;
        <?php echo ($status =='success')? 'color: green;' : 'color: red;'; ?>
        font-family: Arial, Helvetica, sans-serif;
        border: #CCC 2px dashed;
        padding: 10px;
        font-weight: 100;
        width: 460px;"><?php echo $message; ?> </h4>
   <!--    strt------------------------------------------>
   <div class="content-box" style="width:460px; 
      display:block; 
      overflow:hidden; 
      margin:0 auto; 
      border:1px solid #000; 
      padding:10px 10px;">
      <?php if($status == 'success'){ ?>
      <section class="row-section" style="display:block; 
      overflow:hidden; 
      width:100%; 
      border-bottom:1px solid #000; 
      padding: 5px 0px;">
         <div>
            <h3 style="font-size:16px; margin:0;"><strong>Transaction ID :</strong>  <?php echo $transaction->trans_ref; ?> </h3>
         </div>
         <div>
            <p style="margin:0; line-height: 22px;">Giveyourbit.com <span id="save-button" style="float: right;">Save A Copy</span> </p>
         </div>
      </section>
      <section class="row-section" style="border:none;
         display:block; 
         overflow:hidden; 
         width:100%; 
         border-bottom:1px solid #000; 
         padding: 5px 0px;">
         <div style="width:100%;text-align:center">
            <h3 style="text-align: center;">Billed to</h3>
         </div>
         <table class="bill-to">
            <tbody>
               <tr>
                  <td>Name</td>
                  <td><?php echo $transaction->donor_name; ?></td>                  
               </tr>
               <tr>
                  <td>Email</td>
                  <td><?php echo $transaction->donor_email; ?></td>                  
               </tr>
               <tr>
                  <td>Phone No</td>
                  <td><?php echo $transaction->donor_phone_no; ?></td>                  
               </tr>
               <tr>
                  <td>Date</td>
                  <td><?php echo date("Y/m/d",strtotime($transaction->created_date)); ?></td>                  
               </tr>
               <tr>
                  <td>Trasaction Amount</td>
                  <td><span>&#8358</span><?php echo $transaction->transaction_amount; ?> NGN</td>                  
               </tr>
            </tbody>
         </table>
      </section>
      <section class="row-section" style="border:none;      display:block; 
      overflow:hidden; 
      width:100%; 
      border-bottom:1px solid #000; 
      padding: 5px 0px;">
         <table>
            <thead>
               <tr>
                  <th>Item</th>
                  <th>Description</th>
                  <th>Amount</th>
               </tr>
            </thead>
            <tbody>
               <tr>
                  <td>1</td>
                  <td>Donation to <?php echo $fundraiser->fundraiser_title; ?></td>
                  <td style="min-width: 110px;"><span>&#8358</span>
                     <?php //echo $transaction->donation_amount.'NGN'; ?>
                     <?php echo $transaction->transaction_amount.'NGN'; ?>
                  </td>
               </tr>
            </tbody>
         </table>
      </section>
      <section class="row-section" style="display:block; 
      overflow:hidden; 
      width:100%; 
      border-bottom:1px solid #000; 
      padding: 5px 0px;">
         <div class="right-part" style="float:right; width:65%">
            <ul style="list-style:none; display:block; overflow:hidden; padding-left:0;">
               <li style="display:block; overflow:hidden; padding-bottom:5px; border-bottom:1px solid #000; margin-bottom:5px">
                  <p style="float:left; margin:0; font-weight:bold; font-size:13px;">Transaction Total:</p>
                  <p style="float:right; margin:0; font-weight:bold; font-size:13px;"><span>&#8358</span><?php echo $transaction->transaction_amount; ?> NGN</p>
               </li>
               <?php /* ?>
               <li style="display:block; overflow:hidden; padding-bottom:5px;">
                  <p style="float:left; margin:0; font-weight:bold; font-size:13px;">Processing Fee (8% +5.00):</p>
                  <p style="float:right; margin:0; font-weight:bold; font-size:13px;"><span>&#8358</span><?php echo $transaction->processing_fee; ?>  NGN</p>
               </li>               
               <li style="display:block; overflow:hidden; padding-bottom:5px;">
                  <p style="float:left; margin:0; font-weight:bold; font-size:13px;">Donation Amount:</p>
                  <p style="float:right; margin:0; font-weight:bold; font-size:13px;"><span>&#8358</span><?php echo $transaction->donation_amount; ?>  NGN</p>
               </li>
               <?php */ ?>
            </ul>
         </div>
      </section>
      <?php } ?>
      <a href="javascript:;" id="view_btn" class="button-tab open_success_donation" style="margin: 10px auto; float:none; display:table;">Close</a>    
   </div>
</div>