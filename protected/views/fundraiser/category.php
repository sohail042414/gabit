<?php
echo $this->renderPartial('/layouts/cms_banner'); ?>
<!--Start content----------------------------------------------------------->
<?php //if(!empty($_POST)) { p($_POST); }
$page_start = 0;
$page_end = 8;
$max_id = Yii::app()->db->createCommand()
    ->select('max(id) as id')
    ->from('setup_fundraiser')
    ->where('status = "Y"')//where($condition, $params)
    ->queryRow();

if(!empty($_POST['category_case_search'])) {
    $fundraisers = Yii::app()->db->createCommand()
        ->select('*')
        ->from('setup_fundraiser')
        ->where('ftype_id = "' . $_REQUEST['id'] . '" AND status=\'Y\' AND search_status=\'Y\' AND fundraiser_title LIKE "%'.$_POST['category_case_search'].'%"'/*, array(':fundraiser_title' => $_POST['category_case_search'])*/)//where($condition, $params)
        ->order('id ASC')
        ->offset($page_start)
        ->limit(36)
        ->queryAll();

    $fundraiser_record = SetupFundraiser::model()->findAll(array('select' => '*', "condition" => "ftype_id = '" . $_REQUEST['id'] . "' AND fundraiser_title LIKE '%" . $_POST['category_case_search'] . "%'"));
} else {
    $fundraisers = Yii::app()->db->createCommand()
        ->select('*')
        ->from('setup_fundraiser')
        ->where('ftype_id = "' . $_REQUEST['id'] . '" AND status=\'Y\'')//where($condition, $params)
        ->order('id ASC')
        ->offset($page_start)
        ->limit(36)
        ->queryAll();

    $fundraiser_record = SetupFundraiser::model()->findAll(array('select' => '*', "condition" => "ftype_id = '" . $_REQUEST['id'] . "' "));
}
    $total_count = count($fundraiser_record);

?>

<div class="inner-container">

    <div class="catagory_tabs">

        <ul>
            <?php foreach ($categories as $category_row) { ?>
            <?php 
                $temp_class = '';
                if ($_REQUEST['id'] == $category_row->id) {
                    $temp_class = "class='active'";
                }
            ?>
            <li <?php echo $temp_class; ?> ><a
                    href="<?php echo $category_row->makeUrl(); ?>"> <?php echo $category_row->fundraiser_type; ?></a>
            </li>
            <?php } ?>
        </ul>
    </div>


    <!--    <div class="inner-left">-->
    <div class="inner-page">
        <h4><?php  echo $category->fundraiser_type; ?></h4>
        <div class="category_cls">
            <?php
            $category_content = FundraiserType::model()->findByPk($_REQUEST['id']);
            if (!empty($category_content)) { ?>
            <div class="cat_content"><p><?php echo $category_content->type_description; ?></p></div>
            <?php } ?>

            <div class="case-search-blk" id="search_category_case">
                <?php
                    echo CHtml::beginForm();
                    echo CHtml::label('Search Cases:','category_case_search');
                    echo CHtml::textField('category_case_search', !empty($_POST['category_case_search'])?$_POST['category_case_search']:"", array());
                    echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans'));
                    echo CHtml::endForm();
                ?>
            </div>
        </div>

        <div id="catagory_list">
            <?php
            if (!empty($fundraisers)) {
                foreach ($fundraisers as $row) {
                    $fundraiser = Fundraiser::model()->findByPK($row['id']);
                    $percentage = $fundraiser->getDonationPercentage();
                    ?>
                    <div class="fundraiser_list">                        
                        <h4 class="teg-h4 tt_c"><?php echo $fundraiser->getTypeName(); ?></h4>
                            <div id="slider-col1">
                                <div class="section-img" style="position:relative;">
                                    <?php echo $fundraiser->getRewardStartImage(); ?>
                                    <a href="<?php echo $fundraiser->getURL();  ?>">
                                        <img src='<?php echo $fundraiser->getImageURL(); ?>'>
                                    </a>
                                </div>                                                                
                                <h4 class="teg1-h4 teg1-color"><?php echo $fundraiser->getGoalAmount();   ?></h4>
                                <div class="slider-bottom-img ">
                                    <div class="percent_line" style="width:<?php echo $percentage; ?>"></div>
                                </div>
                                <div class="parsen">
                                    <p class="left-teg1"><?php echo $percentage; ?> </p>
                                    <p class="right-teg1"><?php echo $fundraiser->getDaysLeft(); ?>
                                </div>
                                <a href="<?php echo $fundraiser->getURL();  ?>">
                                    <h4 class="teg1-h4 teg4-h4">Case No. <?php  echo $row   ['id'] ?> <br> <?php echo $row['fundraiser_title']  ?> </h4>
                                </a>
                            </div>
                    </div>
                <?php }
            } else {
                echo "No record";
            }
            ?>
        </div>
    </div>
    <?php if ($total_count > 8) {
        ?>
        <a id="view_btn" href="javascript:;" data-id="1">View more</a>
    <?php } ?>
</div>

<!--</div>-->

<script>
    $(document).ready(function () {
        $("#view_btn").click(function () {
            var page_no = $(this).attr('data-id');
            var totalRec = '<?php echo $max_id['id'];?>';
            var type_id = '<?php echo $_REQUEST['id'];?>';
            $.ajax({
                'type': 'POST',
                'url': '<?php echo Yii::app()->createUrl('Fundraiser/Viewmorecategory'); ?>',
                'data': 'page=' + page_no + '&max_id=' + totalRec + '&type_id=' + type_id,
                'success': function (data) {
                    var data_array = data.split('###');
                    if (data_array[1] == 1) {
                        $("#view_btn").hide();
                    }
                    $("#view_btn").attr('data-id', parseInt(page_no) + 1);
                    $('.inner-page').append(data_array[0]);
                    return false;
                }
            });
        });
    });
</script>