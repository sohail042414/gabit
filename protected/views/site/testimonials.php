<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<!--Start content----------------------------------------------------------->
<?php
$page_start = 0;
$page_end = 8;

$max_id = Yii::app()->db->createCommand()
    ->select('max(id) as id')
    ->from('Testimonial')
    ->where('status = "Y"')//where($condition, $params)
    ->queryRow();
$testimonials_object = Testimonial::model()->findAll("status = 'Y' LIMIT " . $page_start . ',' . $page_end);
$result_count = count($testimonials_object);
?>
<div class="inner-container">
    <div class="inner-left">
        <div class="inner-page">
            <h4>Testimonials</h4>
            <div id="slider-col6">
                <div id="testimonials_row">
                    <div class="section-slider-main-div testimonials-min-div">
                        <ul class="testimonials-slider">
                            <?php
//                            p($_SERVER);
                            /*
                             * code for the display testimonials in a slider
                             */
//                            $testimonials_object = Testimonial::model()->findAll('status = "Y" ');
                            if (!empty($testimonials_object)) {
                                foreach ($testimonials_object as $testimonials_object_row) {
                                    if (!empty($testimonials_object_row->testimonial_picture)) {
                                        $image_path = SITE_ABS_PATH_TESTIMONIAL . $testimonials_object_row->testimonial_picture;
                                    } else {
                                        $image_path = SITE_ABS_PATH_TESTIMONIAL . 'no_iamge.png';
                                    }
                                    ?>
                                    <li id="navigation_<?php echo $testimonials_object_row->id; ?>">

                                        <div class="testimonials-left">
                                                <a name="<?php echo $testimonials_object_row->id; ?>"></a>
                                            <img src="<?php echo $image_path; ?>"/>
                                        </div>
                                        <div class="testimonials-right">
                                            <p>
                                                “<?php echo nl2br($testimonials_object_row->testimonial_text); ?>
                                                ”</p>
                                            <a>-<?php echo $testimonials_object_row->testimonial_by; ?></a>

                                            <p class="neque"><?php echo $testimonials_object_row->testimonial_company; ?> </p>
                                        </div>
                                    </li>
                                <?php }
                                ?>
                            <?php } else { ?>
                                <li>
                                    <div class="testimonials-left"><img
                                            src="<?php echo Yii::app()->request->baseUrl; ?>/images/t-slder1.png"/>
                                    </div>
                                    <div class="testimonials-right">
                                        <p>“Lorem Ipsum has been the industry's standard dummy text ever since the
                                            1500s,
                                            when
                                            an
                                            unknown printer took a a type specimen book.”</p>
                                        <h5>-Neque porro</h5>
                                        <h5 class="neque">Neque porro quisquam </h5>
                                    </div>
                                </li>
                            <?php }
                            ?>
                        </ul>
                    </div>
                    <?php
                    if ($result_count > 7) {?>
                        <a id="view_btn" href="javascript:;" data-id="1">View more</a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
    <?php echo $this->renderPartial('/layouts/cms_sidebar'); ?>
</div>

<script>
    $(document).ready(function () {
        var value = '<?php echo $_REQUEST['id'];?>';
        var id = 'navigation_'+value;
        goToByScroll(id);
    });
    $("#view_btn").click(function () {
        var page_no = $(this).attr('data-id');
        var totalRec = '<?php echo $max_id['id'];?>';
        $.ajax({
            'type': 'POST',
            'url': '<?php echo Yii::app()->createUrl('Fundraiser/Viewmoretestimonial'); ?>',
            'data': 'page=' + page_no + '&max_id=' + totalRec,
            'success': function (data) {
                var data_array = data.split('###');
                if (data_array[1] == 1) {
                    $("#view_btn").hide();
                }
                $("#view_btn").attr('data-id', parseInt(page_no) + 1);
                $('.testimonials-slider').append(data_array[0]);
                return false;
            }
        });
    });
</script>