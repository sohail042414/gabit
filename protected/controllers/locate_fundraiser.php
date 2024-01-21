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
    $fundraiser = SetupFundraiser::model()->findAll($filter_arr);
} else {
    $fundraiser = SetupFundraiser::model()->findAll("status = 'Y' LIMIT " . $page_start . ',' . $page_end);
}
$result_count = count($fundraiser);
?>
<div class="inner-container">
    <div class="inner-page">
<?php /* ?>
    <div class="catagory_tabs">
        <ul>
            <?php            
            $category = FundraiserType::model()->findAll();
            $category_arr = array('' => 'All Categories');
            if (!empty($category)) {
                foreach ($category as $category_row) {
                    $category_arr[$category_row->id] = $category_row->fundraiser_type;
                    $temp_class = '';
                    if ($_REQUEST['id'] == $category_row->id) {
                        $temp_class = "class='active'";
                    }
                    $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', trim($category_row->fundraiser_type));
                    $title = str_replace("'", '', $title);
                    $title = strtolower($title);
                    ?>
                    <li <?php echo $temp_class; ?> ><a href="<?php echo $this->createUrl('fundraiser/category', array('id' => $category_row->id, 'category_name' => $title))?>"> <?php echo $category_row->fundraiser_type; ?></a>
                    </li>

                <?php }
            }
            ?>
        </ul>
    </div>
<?php */ ?>
    
    
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
    
    <div class="fundriser-search-blk">
        <?php
            echo CHtml::beginForm();
            echo "<div class='sort_dropdown'>";
            echo CHtml::label('Sort by:');
            echo CHtml::dropDownList('sort_by_category', !empty($_POST['sort_by_category'])?$_POST['sort_by_category']:"", $category_arr);
            echo "</div><div class='sort_dropdown'>";
            echo CHtml::label('Sort by:');
            echo CHtml::dropDownList('sort_by_other', !empty($_POST['sort_by_other'])?$_POST['sort_by_other']:"", array('fundraiser_startdate' => 'Date Started', 'ftype_id' => 'Type', 'visited' => 'Most Visited', 'created_date' => 'Most Recent'));
            echo "</div><div class='search_cases'>";
            echo CHtml::label('Search Cases:');
            echo CHtml::textField('category_case_search', !empty($_POST['category_case_search'])?$_POST['category_case_search']:"", array());
            echo CHtml::submitButton('', array('class' => 'fundriser_search_btn'));
            echo "</div>";            
            echo CHtml::endForm();
        ?>
    </div>
    
    <div class="inner-page">
        <div id="fundraiser_data">
            <?php
            if (!empty($fundraiser)) {
                foreach ($fundraiser as $row) {
                    $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $row->fundraiser_title);
                    $title = str_replace("'", '', $title);
                    $title = strtolower($title);
                    $percentage = UtilityHtml::get_fundraiser_percent($row->fundraiser_amount_need, $row->id);
                    if (empty($row->fundraiser_image)) {
                        $image = Yii::app()->request->baseUrl . "/images/Noimage.jpg";
                    } else {
                        $image = SITE_ABS_PATH_FUNDRAISER_IMAGE . $row->fundraiser_image;
                    } ?>

                    <div class="fundraiser_list">

                        <a href="<?php echo $this->createUrl('fundraiser/index', array('id' => $row->id, 'fundraiser_name' => $title)); ?>">
                            <div id="slider-col1 slide explore_fundraiser">
                                <!--<h4 class="teg-h4"><?php /*echo $row->ftype->fundraiser_type; */?></h4>-->

                                <!--<div class="section-img"><img src='<?php /*echo $image; */?>'></div>
                                <h6 class="teg1-h4">Case No. <?php /*echo $fundraiser->id; */?>
                                    : <?php /*echo $row->fundraiser_title; */?></h6>

                                <div>
                                    <h6><?php /*echo substr($row->fundraiser_description, 0, 120) . '...'; */?></h6></div>
                                <div>
                                    <h6 class="teg1-h4 teg1-color"><?php /*echo number_format($row->fundraiser_amount_need, 0, ",", ",") . ' NGN'; */?></h6>
                                </div>-->
                                <div class="section-img"><img style="height:221px;"
                                                              src=' <?php echo $image; ?>'></div>
                                <h4 class="teg1-h4 teg1-color"><?php  echo number_format($row->fundraiser_amount_need, 0, ",", ",") . ' NGN'; ?></h4>

                                <div class="slider-bottom-img ">
                                    <div class="percent_line" style="width:<?php echo $percentage; ?>"></div>
                                </div>
                                <div class="parsen">
                                    <p class="left-teg1"><?php echo  UtilityHtml::get_fundraiser_percent($row->fundraiser_amount_need, $row->id); ?> </p>

                                    <p class="right-teg1"><?php echo  UtilityHtml::fundraiser_time_elapsed($row->fundraiser_timeline) ?>
                                </div>
                                <h4 class="teg1-h4 teg4-h4">Case No. <?php  echo $row->id ?> <br> <?php echo $row->fundraiser_title  ?> </h4>
                            </div>
                        </a>

                    </div>

                <?php }
            }
            ?>
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