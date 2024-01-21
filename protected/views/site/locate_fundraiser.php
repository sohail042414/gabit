<style type="text/css">
    h4 span {
        color: red;
    }
    .teg1-h4 {
    display: block;
    }
  #slider-col1 {
    margin-bottom: 100px;
}
.fundraiser_list .section-img{
    margin-bottom: 20px !important;
}
#slider-col1 .parsen {
    margin-bottom: 18px !important;
}
.section-img{
     margin-bottom: 18px;
}
.www:hover{
    color:red;
}
</style>
<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<?php $page_start = 0;
$page_end = 8;
$max_id = Yii::app()->db->createCommand()
    ->select('max(id) as id')
    ->from('setup_fundraiser')
    ->where('status = "Y"')//where($condition, $params)
    ->queryRow();

$result = Yii::app()->db->createCommand()
    ->select('set.*,fund.fundraiser_type,')
    ->from('setup_fundraiser as set')
    ->join('fundraiser_type as fund', 'fund.id = set.ftype_id')
    ->where('set.fundraiser_title like :val1 OR set.fundraiser_description like :val2 ', array(':val1' => '%' . $keyword . '%', ':val2' => '%' . $keyword . '%'))
    ->andwhere('search_status = "Y" ')
    ->andwhere('set.status = "Y"' )
    ->order('id ASC')
    ->offset($page_start)
    ->limit(8)
    ->queryAll();
$result_count = count($result);
//echo $result_count; die ;echo $result_count;

    $criteria = new CDbCriteria;
    $criteria->condition = "fundraiser_title LIKE :match AND search_yes LIKE :yes AND status='Y'";
    $criteria->params = array(":match"=>"%$keyword%", ":yes"=>"1");
    $result = SetupFundraiser::model()->findAll($criteria);
    $result_count = count($result);  
?>

<!--Start content----------------------------------------------------------->
<div class="inner-container">
    <div class="inner-page">
        <!--<h4>List of Fundraiser</h4>-->
        <h4>Your Search Results:</h4>

    
    <div class="fundraiser_data" style="margin-top:0px;">
        <?php
  //$condition = SetupFundraiser::model()->find("short_code = 'ACTIVATE_ACCOUNT'");
        if (!empty($result)) {
            foreach ($result as $row) {
                $title = preg_replace("/[^A-Za-z0-9\']/", '_', $row['fundraiser_title']);
                $title = str_replace("'", '', $title);
                $title = strtolower($title);
                $fundraiser_type = FundraiserType::model()->findByPk($row['ftype_id']);
                $fundraisersub_type = FundraiserSubType::model()->findByPk($row['ftype_typ']);
                $othr= $fundraisersub_type->fundraiser_subtyp;
               // $setup= SetupFundraiser::model()->findByPk($result);
                //echo $ttt;
               // die;
                $percentage = UtilityHtml::get_fundraiser_percent($row['fundriser_goal_amount'], $row['id']);
               // print_r($row);
               // die;
                ?>
                <div class="fundraiser_list">
                    
                    <a href="<?php echo $this->createUrl('fundraiser/index', array('id' => $row['id'], 'fundraiser_name' => $title)); ?>">
                            <div id="slider-col1">
                            <h4 class="teg-h4 www"> 
                                <?php if($othr!='Others'){ ?> 
                                <?php echo $fundraisersub_type->fundraiser_subtyp; ?> <?php //echo $fundraiser_type->fundraiser_type; ?>
                                <?php } else { ?>
                                <?php echo $row['ftype_typ']; ?>
                                <?php } ?>
                            </h4> 
                            
                            <div class="section-img"><img
                                    src=' <?php echo SITE_ABS_PATH_UPLOD_FUN_IMG . $row['uplod_fun_img']; ?><?php //echo SITE_ABS_PATH_FUNDRAISER_IMAGE . $row['fundraiser_image']; ?>'>
                            </div>

                        <!--    <h6 class="teg1-h4">Case No. <?php echo $fundraiser['id']; ?>
                                : <?php echo $row['fundraiser_title']; ?></h6>

                            <div>
                                <h6><?php echo substr($row['fundraiser_description'], 0, 120) . '...'; ?></h6>
                            </div>-->
                          
                                <h6 class="teg1-h4 teg1-color"><?php echo number_format($row['fundriser_goal_amount'], 0, ",", ",") . ' NGN'; ?></h6>
                           
                            <div class="slider-bottom-img ">
                                <div class="percent_line" style="width:<?php echo $percentage; ?>"></div>
                            </div>
                            <div class="parsen search_persen">
                                <p  class="left_tag"><?php echo UtilityHtml::get_fundraiser_percent($row['fundriser_goal_amount'], $row['id']); ?></p>
                                <p  class="right_tag"><?php echo UtilityHtml::fundraiser_time_elapsed($row['fundr_timeline_to']); ?></p>
                            </div>
				<h6 class="teg1-h4">Case No. <?php echo $row['id'];//$fundraiser['id']; ?>
                                <br> <?php echo $row['fundraiser_title']; ?></h6>

                          <!--  <div>
                                <h6><?php echo substr($row['fundraiser_description'], 0, 120) . '...'; ?></h6>
                            </div>-->
                        </div>
                    </a>
                </div>


            <?php }
        } else {
            echo "<h4><span>Sorry, we didn't find anything that matches your search.</span></h4>";
        }
        ?>
    </div>
<div class="clear"></div>
    <?php
    if ($result_count > 7) {?>
<!--    if (!empty($result) || $result_count > 8) {?>-->
        <a id="view_btn" href="javascript:;" data-id="1">View More</a>
    <?php }?>
</div>
</div>
<script>
    $(document).ready(function () {
        $("#view_btn").click(function () {
            var page_no = $(this).attr('data-id');
            var totalRec = '<?php echo $max_id['id'];?>';
            var keyword = '<?php echo $keyword;?>'
            $.ajax({
                'type': 'POST',
                'url': '<?php echo Yii::app()->createUrl('site/Viewmore'); ?>',
                'data': 'page=' + page_no + '&max_id=' + totalRec+ '&keyword=' + keyword,
                'success': function (data) {
                    var data_array = data.split('###');
                    if (data_array[1] == 1) {
                        $("#view_btn").hide();
                    }
                    $("#view_btn").attr('data-id', parseInt(page_no) + 1);
                    $('.fundraiser_data').append(data_array[0]);
                    return false;
                }
            });
        });
    });
</script>
