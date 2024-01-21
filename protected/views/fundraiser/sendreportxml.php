<?php 
$current_user_id=$_REQUEST['idxm'];
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

    </div>
