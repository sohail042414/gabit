<style>
.fundraiser_list .teg1-h4 {
    margin-top: -1px;
} 
.fundraiser_list .ad_cl {
    margin-bottom: 60px;
    margin-top: 14px;
    font-size: 17px;
}
.inner-page p {
    color: #464646 !important;
    font-size: 16px !important;
    font-weight: normal !important;
}
/*.fundraiser_list h4 {
    font-size: 17px; 
}*/
p.right-teg1 {
    font-weight: normal !important;
}
p.left-teg1 {
    font-weight: bold !important;
    padding-left: 8px;
    color: #666;
}
.tt_c:hover {
    color: red;
}
/*.tt_c {
    font-weight: 500;
}*/
.n_cl {
    font-size: 17px !important;  
}
</style>    

<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<!--Start content----------------------------------------------------------->
<?php
$page_start = 0;
$page_end = 8;

$max_id = Yii::app()->db->createCommand()
    ->select('max(id) as id')
    ->from('setup_fundraiser')
    ->where('status = "Y"')//where($condition, $params)
    ->queryRow();
if(!empty($_POST['sort_by_category']) || !empty($_POST['sort_by_other']) || !empty($_POST['category_case_search'])) {
    $filter_arr = array();
    $filter_arr['limit'] = $page_end;
    $filter_arr['offset'] = $page_start;
    $filter_arr['condition'] = '(1)';
    if(!empty($_POST['sort_by_category'])) {
        $filter_arr['condition'] .= ' AND ftype_id = '.$_POST['sort_by_category'];
    }
    if(!empty($_POST['category_case_search'])) {
        $filter_arr['condition'] .= ' AND fundraiser_title LIKE "%'.$_POST['category_case_search'].'%"';
    }
    if(!empty($_POST['sort_by_other'])) {
        if($_POST['sort_by_other'] == 'ftype_id') {
            $filter_arr['order'] = 'ftype_id ASC';
        } else if($_POST['sort_by_other'] == 'created_date') {
            $filter_arr['order'] = 'created_date DESC';
        } else if($_POST['sort_by_other'] == 'fundraiser_startdate') {
            $filter_arr['order'] = 'fundraiser_startdate ASC';
        } else if($_POST['sort_by_other'] == 'visited') {
            
        }
    }
    $filter_arr['order'] = 'fundr_timeline_to DESC';
    //$fundraiser = SetupFundraiser::model()->findAll($filter_arr);
    $fundraisers = Fundraiser::model()->findAll($filter_arr);
} else {
    //$fundraiser = SetupFundraiser::model()->findAll("status = 'Y' LIMIT " . $page_start . ',' . $page_end);
    $fundraisers = Fundraiser::model()->findAll("status = 'Y' order by fundr_timeline_to DESC LIMIT " . $page_start . ',' . $page_end);
}
$result_count = count($fundraisers);


?>
<div class="inner-container">
    <div class="inner-page">    
    <?php
        $category = FundraiserType::model()->findAll();
        $category_arr = array('' => 'All Categories');
        if (!empty($category)) {
            foreach ($category as $category_row) {
                $category_arr[$category_row->id] = $category_row->fundraiser_type;
            }
        }
    ?>
    
    <h4>Explore Fundraisers</h4>
    
    <div class="inner-page">
        <div id="fundraiser_data">
            <?php
           
            if (!empty($fundraisers)) {

                foreach ($fundraisers as $fundraiser) {
                    $percentage = $fundraiser->getDonationPercentage();
                   ?>
                   <?php if(($fundraiser->search_yes)=="1") { ?>
                    <div class="fundraiser_list">                        
                            <div id="slider-col1 slide explore_fundraiser">
                                <h4 class="teg-h4 tt_c">
                                    <?php echo $fundraiser->getTypeName(); ?>
                                </h4>                                    
                                <div class="section-img">
                                    <?php echo $fundraiser->getRewardStartImage(); ?>
                                    <a href="<?php echo $fundraiser->getURL(); ?>">
                                        <img style="height:221px;" src="<?php echo $fundraiser->getImageURL(); ?>">
                                    </a>
                                </div>
                                <h4 class="teg1-h4 teg1-color n_cl"><?php echo $fundraiser->getGoalAmount();   ?></h4>

                                <div class="slider-bottom-img ">
                                    <div class="percent_line" style="width:<?php echo $percentage; ?>"></div>
                                </div>
                                <div class="parsen">
                                    <p class="left-teg1"><?php echo  $percentage; ?> </p>

                                    <p class="right-teg1"><?php echo  $fundraiser->getDaysLeft(); ?>
                                </div>
                                <a href="<?php echo $fundraiser->getURL(); ?>">
                                    <h4 class="teg1-h4 teg4-h4 ad_cl">Case No. <?php echo $fundraiser->id ?> <br> <?php echo $fundraiser->fundraiser_title  ?> </h4>
                               </a>
                            </div>
                        

                    </div>

                <?php } } } else {
                   echo "<h4 ><span>Sorry, we didn't find anything that matches your search.</span></h4>";    
                   } 
                   
                  //  }
          //  }else {
            //	echo "<h4 ><span>Sorry, we didn't find anything that matches your search.</span></h4>";
           // }?>
        </div>
		<div class="clear"></div>
		<?php
        if ($result_count > 7) {?>
        <a id="view_btn" href="javascript:;" data-id="1">View More</a>
        <?php } ?>
    </div>

</div>
</div>
<script>
    $(document).ready(function () {
        $("#view_btn").click(function () {
            var page_no = $(this).attr('data-id');
            var totalRec = '<?php echo $max_id['id'];?>';
            $.ajax({
                'type': 'POST',
                'url': '<?php echo Yii::app()->createUrl('Fundraiser/Viewmore'); ?>',
                'data': 'page=' + page_no + '&max_id=' + totalRec,
                'success': function (data) {
                    var data_array = data.split('###');
                    if (data_array[1] == 1) {
                        $("#view_btn").hide();
                    }
                    $("#view_btn").attr('data-id', parseInt(page_no) + 1);
                    $('#fundraiser_data').append(data_array[0]);
                    return false;
                }
            });
        });
    });
</script>
