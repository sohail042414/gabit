<style>
    .bx-wrapper .bx-controls-direction a {
        display: block;
    }

    #slider-col3 .bx-prev {
        display: none;
    }

    #slider-col3 .bx-next {
        display: none;
    }
   .i-left-img {
    background: #eaeaea none repeat scroll 0 0;
    float: left;
    height: 288px !important;
    margin-bottom: 10px;
    margin-top: 28px !important;
    text-align: center;
    width: 100%;
}
.i-left-img img {
    height: 287px;
    max-width: 278px;
    vertical-align: middle;
}
.user_messaging_form {
    color: #1982b3 !important;
}
.inner-page p{
    margin-top: 28px;
}
.at-share-btn-elements {
    margin: 0 auto;
    text-align: center;
}

/*div.example1tooltip {
    max-width: 900px !important;
}*/


.top-box, figure, .bottom-text{
	display:block;
	clear:both;
}

.popup-box {
	overflow: hidden;
	clear:both;
	
}

.top-box figure{
	
	width:40%;
	margin:0 auto !important;
        float: left;
        
}
/*.top-box figure img{
    width: 100%;
}*/

/*.top-box figure img{
 height: 200px !important;   
}*/

.top-box article{
	display:block;
	text-align:center
}

.right-content{
	display:block;
	width: 59%;
        float: right;
	margin:0 auto !important;
/*        border: 1px solid #464646;*/
        overflow: hidden;
/*        padding: 2px;*/
}
.art_cls{
    text-align: center;
    margin-top: 20px;
}
article p{
    line-height: 22px;
    font-size: 14px;
    
}
article h1 {
    font-size: 16px;
    
}
.clr{
    color:#464646;
}
.slider5_col.abcds h4 {
    margin: 15px 0px !important;
    color: green;
    text-align: left;
    margin: 20px 0 0 0;
    font-weight: bold;
    font-family: Arial, Helvetica, sans-serif;
    font-size: 16px;
}
.vid_dv {
    display: block;
    clear: both;
 }
/* .fundraiser_description_blk p {
    min-height: inherit !important;
    margin-bottom: 20px !important;
}
.fundraiser_bot-link-blk {
    margin-top: 5px !important;
}   */
</style>

<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport'/>
<!-- Go to www.addthis.com/dashboard to customize your tools --> 

<div class="inner-container" style="width:100%; height:300px;">
    <div class="inner-left">
        <div class="inner-page" style="margin-top:230px;">
            <form method='post' action='https://webpay-ui.k8.isw.la/collections/w/pay'>
                <input name='merchant_code' value='MX70046' />
                <input name='pay_item_id' value='Default_Payable_MX70046' />
                <input name='site_redirect_url' value='https://giveyourbit.com/index.php/fundraiser/return' /> 
                <input name='txn_ref' value='<?php echo $trans_ref; ?>' />
                <input name='amount' value='10000' />
                <input name='currency' value='566' />
                <input type='submit' value='Make Payment' /> 
            </form>    
        </div>
    </div>
</div>