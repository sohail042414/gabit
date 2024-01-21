<!--<script type = "text/javascript" src = "https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.canvasjs.min.js"></script>-->

<?php 
$current_user_id=$_REQUEST['id'];
//echo $current_user_id;
//die();
//$user_d=$_REQUEST['dttt'];
//$user_d= $_SESSION['front_id'];
//$current_user_id = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->id:null;
//$current_user_id= "72";
 $fundraiser = null;
$fundraiser= SetupFundraiser::model()->findAll("user_id = $current_user_id");
$donation_count = 0;
        $fundraiser_sentinviation_count=0;
        $hug_count=0;
        $supporter_count=0;
        $supporter_messaging_count=0;
	$embed_site_count= 0;
	$fb_counts=0;
        foreach($fundraiser as $val){
            $donation_model_count = Donations::model()->count("fundraiser_id = ".$val->id." AND status = 'Y' ");
            $donation_count = $donation_count + $donation_model_count;
            
            $fundraiser_sentinviation_model_count= ReportInvitefriends::model()->count('fundraiser_id='.$val->id.' AND status="Y"');
            $fundraiser_sentinviation_count = $fundraiser_sentinviation_count + $fundraiser_sentinviation_model_count;
            
            $fundraiser_hug_count = FundraiserHug::model()->count(array('condition' => 'fundraiser_id='.$val->id.' AND status="Y"'));
            $hug_count=$hug_count+$fundraiser_hug_count;
            
            $fundraiser_supporter_count= Supporter::model()->count(array('condition'=> 'fundraiser_id='.$val->id.' AND status="Y"'));
            $supporter_count= $supporter_count + $fundraiser_supporter_count;
            
            
            $fundraiser_supporter_messaging_count= Supporter::model()->count(array('condition'=> 'fundraiser_id='.$val->id.''));
            $supporter_messaging_count= $supporter_messaging_count + $fundraiser_supporter_messaging_count;

	    if($embed_count== 0){
		        $embed_count= $val->no_of_embedsite;
            }
            $total_embed_site_count= $embed_count + $val->no_of_embedsite;

 	    $fundraisertitle = preg_replace("/[^A-Za-z0-9\-\']/", '_', $val->fundraiser_title);
            $this->metaTitle = $val->fundraiser_title;
            $page_url = SITE_ABS_PATH."index.php/fundraiser/".$val->id."/".$fundraisertitle;
            $fb_share = file_get_contents('http://graph.facebook.com/?id=' . $page_url . '');
            $fb_share1 = json_decode($fb_share);
 	  
            if($fb_share1->shares){
                
            }else{
		$fb_share1->shares = 0;
	    }
            $fb_counts= $fb_counts + $fb_share1->shares;
        }
?>
<div id="report_manage_fundraiser1">
<table style="border: 1px solid #C0C0C0; border-collapse: collapse; padding: 5px; width: 100%;">
                                    <thead>	
                                            <tr>		
                                                <th style="border: 1px solid #C0C0C0 !important; padding: 5px; background: #F0F0F0; font-size: 14px; color: #666;">Cases</th>
                                                <th style="border: 1px solid #C0C0C0 !important; padding: 5px; background: #F0F0F0; font-size: 14px; color: #666;">No. of Donations</th>
                                                <th style="border: 1px solid #C0C0C0 !important; padding: 5px; background: #F0F0F0; font-size: 14px; color: #666;">No. of Hugs</th>
                                                <th style="border: 1px solid #C0C0C0 !important; padding: 5px; background: #F0F0F0; font-size: 14px; color: #666;">No. of Supporters</th>
                                                <th style="border: 1px solid #C0C0C0 !important; padding: 5px; background: #F0F0F0; font-size: 14px; color: #666;">No. of Sent Invites</th>
                                                <th style="border: 1px solid #C0C0C0 !important; padding: 5px; background: #F0F0F0; font-size: 14px; color: #666;">No. of FB Shares</th>
                                                <th style="border: 1px solid #C0C0C0 !important; padding: 5px; background: #F0F0F0; font-size: 14px; color: #666;">No. of Site Embeds</th>
                                            </tr>	
                                    </thead>	
                                    <tbody>	
                                        <?php 
                                        
                                        foreach($fundraiser as $key=>$val){ 
                                            $fundraiser_donation_count = Donations::model()->count("fundraiser_id = ".$val->id." AND status = 'Y' ");
                                            $fundraiser_hug_count = FundraiserHug::model()->count(array('condition' => 'fundraiser_id='.$val->id.' AND status="Y"'));
                                            $fundraiser_supporter_count= Supporter::model()->count(array('condition'=> 'fundraiser_id='.$val->id.' AND status="Y"'));
                                            $fundraiser_sentinviation_count= ReportInvitefriends::model()->count(array('condition'=> 'fundraiser_id='.$val->id.' AND status="Y"'));
                                            $fundraiser_embedsite_count= SetupFundraiser::model()->find('id='.$val->id.' AND status="Y"');
                                            $embedsite_count = $fundraiser_embedsite_count->no_of_embedsite;
                                            if(empty($embedsite_count)){
                                                $embedsite_count = 0;
                                            }
                                            $fundraisertitle = preg_replace("/[^A-Za-z0-9\-\']/", '_', $val->fundraiser_title);
                                            $this->metaTitle = $val->fundraiser_title;
                                            $page_url = SITE_ABS_PATH."index.php/fundraiser/".$val->id."/".$fundraisertitle;
                                            //$page_url = 'http://testing.siliconithub.com/MobiTrustWeb/cms/aboutus';
                                            $fb_share = file_get_contents('http://graph.facebook.com/?id=' . $page_url . '');
                                            $fb_share1 = json_decode($fb_share);
                                            if($fb_share1->shares){
                
					    }else{
						$fb_share1->shares = 0;
					    }
                                        ?>
                                        <tr>
                                        <?php 
                                            if(empty($i)){
                                                    $i=1;
                                        }?>
                                            <td style="border: 1px solid #C0C0C0; padding: 5px; font-size: 13px; color: #666; font-weight: normal;"><strong><?php echo $i.". ".$val->fundraiser_title; ?></strong></td>
                                            <td style="border: 1px solid #C0C0C0; padding: 5px; font-size: 13px; color: #666; font-weight: normal;"><?php echo $fundraiser_donation_count;?></td>
                                            <td style="border: 1px solid #C0C0C0; padding: 5px; font-size: 13px; color: #666; font-weight: normal;"><?php echo $fundraiser_hug_count;?></td>
                                            <td style="border: 1px solid #C0C0C0; padding: 5px; font-size: 13px; color: #666; font-weight: normal;"><?php echo $fundraiser_supporter_count;?></td>
                                            <td style="border: 1px solid #C0C0C0; padding: 5px; font-size: 13px; color: #666; font-weight: normal;"><?php echo $fundraiser_sentinviation_count;?></td>
                                            <td style="border: 1px solid #C0C0C0; padding: 5px; font-size: 13px; color: #666; font-weight: normal;"><?php echo $fb_share1->shares; ?></td>
                                            <td style="border: 1px solid #C0C0C0; padding: 5px; font-size: 13px; color: #666; font-weight: normal;"><?php echo $embedsite_count; ?></td>
                                        </tr>
                                        <?php $i++; } ?>
                                    </tbody>
                                </table>
    <div class="cases_row">
                                    <?php 
                                    foreach($fundraiser as $key=>$val){ 
                                    $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $val->fundraiser_title);
                                    $title = str_replace("'", '', $title);
                                    $title = strtolower($title);
                                    $type = preg_replace("/[^A-Za-z0-9\-\']/", '_', trim($val->ftype->fundraiser_type));
                                    $type = str_replace("'", '', $type);
                                    $type = strtolower($type);
                                    $percentage = UtilityHtml::get_fundraiser_percent($val->fundriser_goal_amount, $val->id); 
                                    ?>
                                    <?php if(empty($case_sr)){
                                                    $case_sr=1;
                                    }?>
                                
                                    <div style="float: left; margin-bottom: 10px;">
                                        <strong style="float: left; padding: 8px 0px; margin-right: 10px; color: #666;">Case <?php echo $case_sr." :"; $case_sr++;?></strong>
                                        <p style="float: left; padding: 5px 15px; border: #CCC 1px solid; margin: 0px; box-sizing: border-box; width: auto; margin-right: 20px;"><span style="margin-right: 20px; float: left; width: auto;"><?php echo UtilityHtml::get_fundraiser_percent($val->fundriser_goal_amount, $val->id); ?></span>

                                        <?php echo UtilityHtml::fundraiser_time_elapsed($val->fundr_timeline_to)." to end"; ?></p>
                                    </div>
                                    <?php }?>
                                    
                                    <?php
                                        //echo GxHtml::submitButton(Yii::t('app', 'Email Report'),array('fundraiser/sendreport'), array('class' => 'btn_send_ans'));
                                    ?>
                                </div>
<!--    <script type="text/javascript">

window.onload = function () {
	var chart = new CanvasJS.Chart("chartContainer",
	{
		theme: "theme2",
		legend:{
			verticalAlign: "center",
			horizontalAlign: "right",
			fontSize: 14,
			fontFamily: "Helvetica"        
		},
		data: [
		{
			type: "pie",
                        indexLabelFontFamily:"Garamond",
                        fontSize: 20,
			showInLegend: true,
                        startAngle:-20,
			toolTipContent: "{y} - #percent %",
			yValueFormatString: "#0.#,,. Million",
			legendText: "{indexLabel}",
			dataPoints: [
				{  y: <?php echo $donation_count; ?>, indexLabel: "Donations" },
				{  y: <?php echo $fb_counts; ?>, indexLabel: "Facebook Shares" },
				{  y: <?php echo $hug_count;?>, indexLabel: "Hugs" },
				{  y: <?php echo $fundraiser_sentinviation_count; ?>, indexLabel: "Sent Invites"},
				{  y: <?php echo $supporter_count;?>, indexLabel: "Supporters" },
				{  y: <?php echo $total_embed_site_count; ?>, indexLabel: "No. of Site Embeds" }
			]
		}
		]
	});
	chart.render();
};
</script>-->
                                <?php //if(!empty($fundraiser) && ($fundraiser_donation_count != 0 || $fundraiser_hug_count != 0 || $fundraiser_supporter_count != 0 || $fundraiser_sentinviation_count != 0)){?>
<!--                                <div id="chartContainer" style="width: 100%; height: 400px; float: right; margin: 40px 0px;"></div>-->
    </div>
