<style>
.ssss {
	margin-top: 0;
}
</style>
<!--Sohail testing-->
<!-- Start Banner -->
<div class="main_banner">
    <div class="center_banner">
        <div id="banner-main" class="slider">
            <ul class="Home_slider">
                <?php if (!empty($home_slider)) {
                    foreach ($home_slider as $home_slider_row) {
                        $image_path = SITE_ABS_PATH_HOME_SLIDER . $home_slider_row->slider_image;
                        ?>
                        <li><img src="<?php echo $image_path; ?>"/>

                            <div class="text" id="homeslider<?php echo $home_slider_row->id; ?>">
                                <span><?php echo $home_slider_row->slider_title; ?></span>

                                <p><?php echo $home_slider_row->slider_content; ?></p>
                                <a href="<?php echo $this->createUrl('fundraise/index') ?>" class="banner-btn">Start a
                                    Fundraiser</a>
                                <a href="<?php echo $this->createUrl('fundraiser/locatefundraiser') ?>"
                                   class="banner-btn">Explore Fundraisers</a>
                            </div>
                        </li>
                    <?php }
                } ?>
            </ul>
        </div>
    </div>
</div>
<!-- End Banner -->

<!-- Start content -->
<div class="content">
    <!-- Start section frist -->
    <div class="section-frist">
        <div class="section-min-slider">
            <h3>Categories</h3>

            <div class="section-slider-main-div">
                <div id="slider-col1">
                    <?php
                    //#$category_of_fundraiser = SetupFundraiser::model()->findAll(array('select' => '*', 'condition' => 'DATE(fundraiser_timeline) > DATE(NOW()) AND status = "Y" group by ftype_id', 'order' => 'ftype_id ASC'));
                    $category_of_fundraiser = SetupFundraiser::model()->findAll(array('select' => '*', 'condition' => 'status = "Y" group by ftype_id', 'order' => 'ftype_id ASC'));
                    if (!empty($category_of_fundraiser)) { ?>
                    <div class="slider1">
                        <?php foreach ($category_of_fundraiser as $fundraiser) {
                            $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser->fundraiser_title);
                            $title = str_replace("'", '', $title);
                            $title = strtolower($title);
                            $type = preg_replace("/[^A-Za-z0-9\-\']/", '_', trim($fundraiser->ftype->fundraiser_type));
                            $type = str_replace("'", '', $type);
                            $type = strtolower($type);
                            $percentage = UtilityHtml::get_fundraiser_percent($fundraiser->fundraiser_amount_need, $fundraiser->id);
                            ?>
                            <div class="slide">
                                <h4 class="teg-h4"> 
                                    <a href=<?php echo $this->createUrl('fundraiser/category', array('id' => $fundraiser->ftype_id, 'category_name' => $type)) ?>><?php echo $fundraiser->ftype->fundraiser_type; ?></a></h4>
                                    <a href="<?php echo $this->createUrl('fundraiser/category', array('id' => $fundraiser->ftype_id, 'category_name' => $type)); ?>">
                                        <div class="section-img">
                                            <img style="height:221px;" src='<?php echo SITE_ABS_PATH_FUNDRAISER_IMAGE . $fundraiser->uplod_fun_img; ?>'>
                                        </div>                                    
                                        <h4 class="teg1-h4 case_ttl">Case No. <?php echo $fundraiser->id; ?>
                                        : <?php echo substr($fundraiser->fundraiser_title, 0, 20) . '...'; ?></h4>
                                        <?php 
                                        $type_of_fundraiser = FundraiserType::model()->find('status = "Y" AND id='.$fundraiser->ftype_id);
                                        ?>
                                        <p><?php
                                        $str_length= strlen($type_of_fundraiser->type_description);
                                        if($str_length>120){
                                            echo substr($type_of_fundraiser->type_description, 0, 120) . '...'; 
                                        
                                        }else{
                                            echo substr($type_of_fundraiser->type_description, 0, 120); 
                                        }
                                        ?></p>
                                        <h4 class="teg1-h4 teg1-color"><?php echo '' . number_format($fundraiser->fundraiser_amount_need, 0, ",", ",") . ' NGN'; ?></h4>
                                        <div class="slider-bottom-img ">
                                            <div class="percent_line" style="width:<?php echo $percentage; ?>"></div>
                                        </div>
                                        <div class="parsen">
                                            <p class="left-teg"><?php echo UtilityHtml::get_fundraiser_percent($fundraiser->fundraiser_amount_need, $fundraiser->id); ?></p>

                                            <p class="right-teg"><?php echo UtilityHtml::fundraiser_time_elapsed($fundraiser->fundraiser_timeline); ?></p>
                                        </div>
                                    </a>
                                </div>
                            <?php } ?>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End section first -->

    <!-- Start section second -->
    <div class="section-second">
        <div class="section-min-slider">
            <div class="text">
                <h3 class="teg-h3-slider">Why Use Giveyourbit?</h3>
                <h5>At Giveyourbit, we believe in benevolence and our aim is to arouse it in our communities. Collective
                    support for individuals and families in financial need can put smiles on many faces. Below are five
                    reason why you should use Giveyourbit:</h5>
            </div>
            <div class="section-slider-main-div ">
                <div id="icons-row">
                    <ul class="section-second-icon">
                        <li>
                            <div class="icon-slider">
                                <a class="anchor"
                                   href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Crowd_Support')) ?>">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/usear-icon.png"/>
                                </a>
                            </div>
                            <h5>Crowd Support...</h5>
                            <a href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Crowd_Support')) ?>"
                               class="read-link">Read More </a>
                        </li>
                        <li>
                            <div class="icon-slider"><a class="anchor"
                                                        href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'A_Small_Fee')) ?>"><img
                                        src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon2.png"/></a></div>
                            <h5> A Small Fee... </h5>
                            <a href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'A_Small_Fee')) ?>"
                               class="read-link">Read More </a></li>
                        <li>
                            <div class="icon-slider"><a class="anchor"
                                                        href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Guidance_for_Success')) ?>"><img
                                        src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon3.png"/></a></div>
                            <h5> Guidance for Success... </h5>
                            <a href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Guidance_for_Success')) ?>"
                               class="read-link">Read More </a></li>
                        <li>
                            <div class="icon-slider"><a class="anchor"
                                                        href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Mobile_Advantage')) ?>"><img
                                        src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon4.png"/></a></div>
                            <h5>Mobile Advantage... </h5>
                            <a href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Mobile_Advantage')) ?>"
                               class="read-link">Read More </a></li>
                        <li>
                            <div class="icon-slider"><a class="anchor"
                                                        href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Dedicated_Fundraising')) ?>"><img
                                        src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon5.png"/></a></div>
                            <h5>Dedicated Page...</h5>
                            <a href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Dedicated_Fundraising')) ?>"
                               class="read-link">Read More </a></li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
    <!-- End section second -->

    <!-- Start section third -->
    <?php
    /*
     * Code for the get the type of fundraiser
     */
    $fundraiser_type = FundraiserType::model()->findAll(array("select" => "id,fundraiser_type"));
    ?>
    <div class="section-third">
        <div class="section-min-slider section-third-manu-div">
            <div id="third-section-col">
                <ul class="section-third-manu">
                    <?php if (!empty($fundraiser_type)) { ?>
                        <li><a id="active-btn_all" class="active button_act type_button" data-id='all' href="javascript: void(0)">All </a></li>

                    <?php foreach ($fundraiser_type as $key => $type) {
                            if ($key == '0') {
                                echo CHtml::hiddenField('funderaiser_type', $type->id, array('id' => 'funderaiser_type'));
                            } ?>
                            <li>
                            <a id="active-btn_<?php echo $type->id; ?>" data-id='<?php echo $type->id; ?>'
                               class="type_button button_act"> <?php echo $type->fundraiser_type; ?></a>
                        <?php }
                    } else { ?>
                        <li><a class="active" href="javascript: void(0)">No Type</a></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
        <div class="section-frist">
            <div class="section-min-slider">
                <h3>Featured Fundraisers</h3>
                <div class="section-slider-main-div">
                    <div id="slider-col2">
                        <!-- <div class="loader" style="display: none">
                            <img src="<?php //echo Yii::app()->request->baseUrl; ?>/images/admin/ajax-loader1.gif"/></a>
                        </div> -->
                        <div class="Fundraisers" id="ajaxload">
                            <?php
                            $featured_fundraiser = SetupFundraiser::model()->findAll(array('select' => '*', 'condition' => 'feature_flag = "Y" AND status = "Y"'));
                            $getcount = count($featured_fundraiser);
                            $temp = '';
                            if (!empty($featured_fundraiser)) {
                                foreach ($featured_fundraiser as $fundraiser) {
                                    $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser->fundraiser_title);
                                    $title = str_replace("'", '', $title);
                                    $title = strtolower($title);
                                    $percentage = UtilityHtml::get_fundraiser_percent($fundraiser->fundraiser_amount_need, $fundraiser->id);
                                    $ft = FundraiserSubType::model()->find(array('select' => '*', 'condition' => 'id = "'.$fundraiser->ftype_id.'"'));
                                $temp .= '<a href=' . $this->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title)) . '>
                                <div class="slide">
                                    <h4 class="teg-h4">' . $ft->fundraiser_subtyp  . '</h4>

                                    <div class="section-img ssss"><img style="height:221px;"
                                            src=' . SITE_ABS_PATH_FUNDRAISER_IMAGE . $fundraiser->uplod_fun_img . '></div>
                                    <h4 class="teg1-h4 teg1-color">' . number_format($fundraiser->fundraiser_amount_need, 0, ",", ",") . ' NGN' . '</h4>
			    
                                    <div class="slider-bottom-img ">
                                        <div class="percent_line" style="width:' . $percentage . '"></div>
                                    </div>
                                    <div class="parsen">
                                        <p class="left-teg">' . UtilityHtml::get_fundraiser_percent($fundraiser->fundraiser_amount_need, $fundraiser->id) . '</p>

                                        <p class="right-teg"> ' . UtilityHtml::fundraiser_time_elapsed($fundraiser->fundraiser_timeline) . '
                                    </div>
                                    <h4 class="teg1-h4 teg4-h4">Case No. ' . $fundraiser->id . '<br>' . $fundraiser->fundraiser_title . '</h4>
                                </div>
                            </a>';
                                }
                            }
                            echo $temp;
                            ?>
                        </div>
                    </div>
                </div> 
            </div>
        </div>
    </div>
</div>
<!-- End section fourth -->

<div class="section-fourth testi-spec">
    <div class="section-min-slider testimonials">
        <h4><a href="<?php echo $this->createUrl('site/testimonials'); ?>">Testimonials</a></h4>

        <div id="slider-col6">

            <div class="section-slider-main-div testimonials-min-div">
                <ul class="bxslider1 testimonials-slider">
                    <?php
                    /*
                     * code for the display testimonials in a slider
                     */
                    $testimonials = Testimonial::model()->findAll('status = "Y" ');
                    
                    if (!empty($testimonials)) {
                        foreach ($testimonials as $testimonials_object_row) {
                            if (!empty($testimonials_object_row->testimonial_picture)) {
                                $image_path = SITE_ABS_PATH_TESTIMONIAL . $testimonials_object_row->testimonial_picture;
                            } else {
                                $image_path = SITE_ABS_PATH_TESTIMONIAL . 'no_iamge.png';
                            }
                            ?>
                            <li>
                                <div class="testimonials-left">
                                    <img src="<?php echo $image_path; ?>"/>
                                </div>
                                <div class="testimonials-right">
                                    <p>
                                        “<?php echo substr($testimonials_object_row->testimonial_text, 0, 150) . '...'; ?>
                                        �?</p>
                                    <a href="<?php echo $this->createUrl('site/testimonials', array('id' => $testimonials_object_row->id)); ?>">-<?php echo $testimonials_object_row->testimonial_by; ?></a>

                                    <p class="neque"><?php echo $testimonials_object_row->testimonial_company; ?> </p>
                                </div>
                            </li>
                        <?php }
                        ?>
                    <?php } else { ?>
                        <li>
                            <div class="testimonials-left"><img
                                    src="<?php echo Yii::app()->request->baseUrl; ?>/images/t-slder1.png"/></div>
                            <div class="testimonials-right">
                                <p>“Lorem Ipsum has been the industry's standard dummy text ever since the 1500s,
                                    when
                                    an
                                    unknown printer took a a type specimen book.�?</p>
                                <h5>-Neque porro</h5>
                                <h5 class="neque">Neque porro quisquam </h5>
                            </div>
                        </li>
                    <?php }
                    ?>
                </ul>
            </div>
        </div>
    </div>
</div>
<!-- End section fourth -->
<div class="clear"></div>

<!-- Script code for the testimonial slider -->
<script>
    $('.testimonials-slider').bxSlider({
        infiniteLoop: false,
        hideControlOnEnd: true,
        minSlides: 1,
        maxSlides: 50,
        slideWidth: 520,
        slideMargin: 10
    });
</script>

<!-- Script code for the home banner slider -->
<script>
    $('.Home_slider').bxSlider({
        mode: 'fade',
        auto: true,
        //captions: true,
        pause: 7000,
        speed: 7000
    });
</script>
<!--  Script code for the load default type of fundraiser into featured fundraiser -->
<script>
    //    upload_fundraiser();
    //    function upload_fundraiser() {
    //        var a = $('#funderaiser_type').val();
    //        $('#active-btn_1').addClass('active');
    //        $.ajax({
    //            type: "POST",
    //            url: "<?// echo Yii::app()->createUrl('Fundraiser/findfundraiser'); ?>//",
    //            data: {fundraiser_id: a},
    //            success: function (data) {
    //                $('#ajaxload').html(data);
    //
    //            },
    //            error: function (xhr) {
    ////                    alert("failure"+xhr.readyState+this.url)
    //            }
    //        });
    //    }

    $(document).ready(function () {

        var Fundraisers = $('.Fundraisers').bxSlider({
            slideWidth: 229,
            minSlides: 1,
            maxSlides: 50,
            slideMargin: 50,
            //controls : false,            
        });

        $('.type_button').on('click', function () {
            var id = $(this).attr("data-id");
            $('.button_act').removeClass('active');
            $('#active-btn_' + id).addClass('active');
            $(".loader").css("display", "block");
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->createUrl('Fundraiser/findfundraiser'); ?>",
                data: {fundraiser_id: id},
                success: function (data) {
                    var getdata = data.split('###');
                    $(".loader").css("display", "none");
                    if (getdata[0] == '') {
                        $('.Fundraisers').html("No Record Found!");
                        Fundraisers.destroySlider();
                    } else if (getdata[1] > 4) {
                        $('#ajaxload').html(getdata[0]);
                        Fundraisers.reloadSlider();
                    } else {
                        $('#ajaxload').html(getdata[0]);
                        $('#ajaxload').addClass('slider_container');
                        if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                            Fundraisers.reloadSlider();
                            // some code..
                        } else {
                            Fundraisers.destroySlider();
                        }

                    }
                },
                error: function (xhr) {
                }
            });
        });
    });
</script>

<?php
if (!empty($_REQUEST['flag']) && $_REQUEST['flag'] == '1') { ?>
    <?php $loadurl = $this->createUrl('site/signup', array('flag' => $_REQUEST['flag']));
    ?>

    <script>
        $(document).ready(function () {

            $.fancybox.open([
                    {
                        href: "<?php echo $loadurl; ?>"
                    }]
                , {
                    maxWidth: 420,
                    maxHeight: 150,
                    fitToView: false,
                    width: '100%',
                    height: '100%',
                    autoSize: false,
                    closeClick: false,
                    openEffect: 'none',
                    closeEffect: 'none',
                    'type': 'iframe',
                    helpers: {overlay: {locked: false, closeClick: false}}
                });

        });
    </script>
<?php }
?>
