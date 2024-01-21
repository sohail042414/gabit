<style>
.cases_col{
    width: 50%;
    padding-left: 10px;
    box-sizing: border-box;
}

.cases_col p{
    margin-right: 0px !important;
}

.cases_half{
    width: 100%;
    float: left !important;
}

.cases_col strong {
    width: 80px;
}

.cases_col p {
    float: right;
    width: 68%;
}


@media (max-width: 767px){
    .cases_col{
        width: 100% !important;
    }

    .cases_half{
        width: 100% !important;
        float: left !important;
    }

    
}

</style>
<div class="box-body">  
    <table class="demo">
        <thead>	
                <tr>		
                    <th>Cases</th>
                    <th>No. of Donations</th>
                    <th>No. of Hugs</th>
                    <th>No. of Supporters</th>
                    <th>No. of Sent Invites</th>
                    <!-- <th>No. of FB Shares</th>
                    <th>No. of Site Embeds</th> -->
                    <th>Total Donation</th>
                    <th>Total Received</th>
                    <th>Balance</th>
                </tr>	
        </thead>	
        <tbody>	
            <?php foreach($fundraisers_list as $key => $fundraiser){ ?>
            <tr>            
                <td><strong><?php echo ($key+1).". ".$fundraiser->fundraiser_title; ?></strong></td>
                <td><?php echo $fundraiser->getDonationCount();?></td>
                <td><?php echo $fundraiser->getHugCount();?></td>
                <td><?php echo $fundraiser->getSupporterCount();?></td>
                <td><?php echo $fundraiser->getSentInvitationCount();?></td>
                <!-- <td>N/A<?php //echo $fundraiser->getFbShareCount(); ?></td>
                <td><?php echo $fundraiser->getSiteEmbedCount(); ?></td> -->
                <td>
                    <?php $amount = $fundraiser->getDonationAmount(); ?>
                    <?php echo number_format($amount,2); ?>
                </td>
                <td>
                    <?php $received = $fundraiser->getTotalPayout(); ?>
                    <?php echo number_format($received,2); ?>
                </td>
                <td>
                    <?php $balance = $amount-$received; ?>
                    <?php echo number_format($balance,2); ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    
    <div class="cases_row">
        <div class="cases_half">
            <table class="demo">
                <thead>	
                        <tr>		
                            <th>Cases</th>
                            <th>No. Of Social Shares</th>
                            <th>No. of Facebook Comments</th>
                            <th>No. of Site Embeds</th>
                        </tr>	
                </thead>	
                <tbody>	
                    <?php foreach($fundraisers_list as $key => $fundraiser){ ?>
                    <tr>            
                        <td><strong><?php echo ($key+1).". ".$fundraiser->fundraiser_title; ?></strong></td>
                        <td>
                            <?php echo $fundraiser->social_shares_count; ?>
                            <?php //echo $fundraiser->getFbShareCount(); ?>
                        </td>
                        <td>
                            <?php echo $fundraiser->comments_count; ?>
                            <?php //echo $fundraiser->getFbShareCount(); ?>
                            <?php //echo  ($user->comment_count+$user->comment_count_other); ?>
                        </td>
                        <td><?php echo $fundraiser->getSiteEmbedCount(); ?></td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>
        <div class="cases_half" style="margin-top: 10px;">
        <?php foreach($fundraisers_list as $key=>$fundraiser){ ?>                                    
            <div class="cases_col">
                <strong>Case <?php echo ($key+1)." :"; ?></strong>
                <p><span><?php echo $fundraiser->getDonationPercentage(); ?></span>
                <?php echo $fundraiser->getDaysLeft()." to end"; ?></p>
            </div>
            <?php }?>   
        </div>
    </div>
    <div id="chartContainer" class="fundraiser_chart">

    </div>
    <div class="inner-right vvv"> 
        <div class="inner-right-col">                                     
            <ul class="sub-menu clearfix">
                <li id="main_ll"><a href="#" class="dropbtna">Email This Report</a>
                    <ul id="sub1">
                        <li><a href="#">Send</a>
                        </li>
                        <li id="sub_nw"><a href="#">Download</a>
                            <ul id="sub2">
                                <li><a href="#"><?php echo CHtml::button('PDF', array('submit' => $this->createUrl('fundraiser/createpdf'),array('id' =>$_SESSION['front_id']),array('class'=>''))); ?></a>
                                </li>
                                <li><a href="#"><?php echo CHtml::button('XML', array('submit' => $this->createUrl('fundraiser/createxml'),array('id' =>$_SESSION['front_id']),array('class'=>''))); ?></a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </li>
            </ul>                                                                    
        </div>     
    </div> 
</div>

<script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.canvasjs.min.js"></script>
    <script type="text/javascript">
    $(document).ready(function(){
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
			legendText: "{indexLabel} ",
			dataPoints: [
				{  y: <?php echo $chart_stats['donation_count']; ?>, indexLabel: "Donations" },
				{  y: <?php echo $chart_stats['fb_counts']; ?>, indexLabel: "Facebook Shares" },
				{  y: <?php echo $chart_stats['hug_count']; ?>, indexLabel: "Hugs" },
				{  y: <?php echo $chart_stats['fundraiser_sentinviation_count']; ?>, indexLabel: "Sent Invites"},
				{  y: <?php echo $chart_stats['supporter_count']; ?>, indexLabel: "Supporters" },
				{  y: <?php echo $chart_stats['total_embed_site_count']; ?>, indexLabel: "No. of Site Embeds" },
			]
		}
		]
	});

    console.log(chart);
	chart.render();
});

</script>