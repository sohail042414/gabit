<style>
    .ssss {
        margin-top: 0;
    }

    .emblum-wrap {
        position: absolute;
        bottom: 15px;
        right: 25px;
        width: 320px;
        height: 120px;
        background-color: gray;
    }

    .emblum-logo {
        box-sizing: border-box;
        padding: 8px;
        width: 31%;
        float: left;
    }

    .emblum-logo-full {
        box-sizing: border-box;
        padding: 0px;
        width: 100%;
        height: 100%;
        background-image: url('<?php echo $emblum_bg_path; ?>');
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }

    .emblum-text {
        box-sizing: border-box;
        width: 68%;
        float: left;
        padding: 8px;
    }

    .emblum-text>p {
        font-size: 11px !important;
        /* font-weight: 400 !important; */
    }

    .featured-slide {
        min-height: 445px !important;
    }

    .crismas-wrap {
        position: absolute;
        top: 7px;
        right: 40px;
        width: 200px;
        height: 210px;
    }

    .crismas-banner {
        background-image: url('/images/crismas-flowers.png');
        box-sizing: border-box;
        padding: 0px;
        width: 100%;
        height: 100%;
        background-size: cover;
        background-repeat: no-repeat;
        background-position: center center;
    }

    .notice-bar {
        padding: 5px 0;
        box-sizing: border-box;
        height: 50px;
        color: white;
        position: fixed;
        left: 0;
        bottom: 0;
    }

    .notice-bar>p {
        -moz-animation: marquee 25s linear infinite;
        -webkit-animation: marquee 25s linear infinite;
        animation: marquee 25s linear infinite;
    }

    @-moz-keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    @-webkit-keyframes marquee {
        0% {
            transform: translateX(100%);
        }

        100% {
            transform: translateX(-100%);
        }
    }

    @keyframes marquee {
        0% {
            -moz-transform: translateX(100%);
            -webkit-transform: translateX(100%);
            transform: translateX(100%)
        }

        100% {
            -moz-transform: translateX(-100%);
            -webkit-transform: translateX(-100%);
            transform: translateX(-100%);
        }
    }

    .corporate-wrap{
        width: 100%;
        position:relative;
        height: 60px;
        border: 1px solid red;
        float:left;
        height: 86px;
    }
</style>
<!-- Start Banner -->
<div class="main_banner">

    <div class="center_banner">
        <div id="banner-main" class="slider">
            <ul class="Home_slider">
                <?php if (!empty($home_slider)) {
                    foreach ($home_slider as $home_slider_row) {
                        $image_path = SITE_ABS_PATH_HOME_SLIDER . $home_slider_row->slider_image;
                ?>
                        <li><img class="home-banner" src="<?php echo $image_path; ?>" />

                            <div class="text" id="homeslider<?php echo $home_slider_row->id; ?>">
                                <span><?php echo $home_slider_row->slider_title; ?></span>

                                <p><?php echo $home_slider_row->slider_content; ?></p>
                                <a href="<?php echo $this->createUrl('fundraise/index') ?>" class="banner-btn has-loader">Start a Fundraiser</a>
                                <a href="<?php echo $this->createUrl('fundraiser/locatefundraiser') ?>" class="banner-btn has-loader">Explore Fundraisers</a>
                            </div>
                            <?php /* ?>
                            <div class="emblum-wrap">
                                <div class="emblum-logo">
                                    <img src="<?php echo $emblum_logo_path; ?>"/>
                                </div>
                                <div class="emblum-text">
                                    <p>Get rewarded for your acts of benovolance through our Top Donor Reward Program TRDP, for more details <a href="<?php echo $TRDP_link; ?>" target="_blank"> click here</a></p>
                                </div>s
                            </div>
                            <?php */ ?>
                            <?php /* ?>
                            <div class="crismas-wrap">
                                <div class="crismas-banner">
                                </div>
                            </div>
                            <?php */ ?>
                            <div class="emblum-wrap">
                                <a href="<?php echo $TRDP_link; ?>" target="_blank">
                                    <div class="emblum-logo-full">
                                    </div>
                                </a>
                            </div>
                            <?php /* ?>
                            <div class="notice-bar">
                                <p style="color:#ebad02; font-size:20px; font-family: 'Lucida Handwriting Std', cursive;  white-space: nowrap;">We wish our fundraisers and donors a merry Christmas and a happy New year.</p>
                            </div>
                            <?php */ ?>
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
                    <?php if (!empty($categories)) { ?>
                        <div class="slider1">
                            <?php foreach ($categories as $category) { ?>
                                <div class="slide">
                                    <h4 class="teg-h4">
                                        <a href="<?php echo $category['category_url']; ?>"><?php echo $category['category_title']; ?></a>
                                    </h4>
                                    <div class="section-img">
                                        <?php echo $category['reward_star_image']; ?>
                                        <a href="<?php echo $category['category_url'] ?>">
                                            <img style="height:221px;" src="<?php echo $category['image_url'];  ?>">
                                        </a>
                                    </div>
                                    <a href="<?php echo $category['category_url'] ?>">
                                        <h4 class="teg1-h4 case_ttl"><?php echo $category['case_no']; ?></h4>
                                    </a>
                                    <a href="<?php echo $category['category_url'] ?>">
                                        <p><?php echo $category['description']; ?></p>
                                    </a>
                                    <h4 class="teg1-h4 teg1-color 22"><?php echo $category['amount']; ?></h4>
                                    <div class="slider-bottom-img ">
                                        <div class="percent_line" style="width:<?php echo $category['percentage']; ?>"></div>
                                    </div>
                                    <div class="parsen">
                                        <p class="left-teg"><?php echo $category['percentage'];  ?></p>
                                        <p class="right-teg"><?php echo $category['days_left']; ?></p>
                                    </div>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>

    <!-- Start section second -->
    <div class="section-second">
        <div class="section-min-slider">
            <div class="text">
                <h3 class="teg-h3-slider">Why Use Giveyourbit?</h3>
                <h5>At Giveyourbit, we believe in kindness and our aim is to arouse it in our communities. Collective
                    support for individuals and families in financial need can put smiles on many faces. Below are five
                    reason why you should use Giveyourbit:</h5>
            </div>
            <div class="section-slider-main-div ">
                <div id="icons-row">
                    <ul class="section-second-icon">
                        <li>
                            <div class="icon-slider">
                                <a class="anchor" href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Crowd_Support')) ?>">
                                    <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/usear-icon.png" />
                                </a>
                            </div>
                            <h5>Crowd Support...</h5>
                            <a href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Crowd_Support')) ?>" class="read-link">Read More </a>
                        </li>
                        <li>
                            <div class="icon-slider"><a class="anchor" href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'A_Small_Fee')) ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon2.png" /></a></div>
                            <h5> A Small Fee... </h5>
                            <a href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'A_Small_Fee')) ?>" class="read-link">Read More </a>
                        </li>
                        <li>
                            <div class="icon-slider"><a class="anchor" href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Guidance_for_Success')) ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon3.png" /></a></div>
                            <h5> Guidance for Success... </h5>
                            <a href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Guidance_for_Success')) ?>" class="read-link">Read More </a>
                        </li>
                        <li>
                            <div class="icon-slider"><a class="anchor" href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Mobile_Advantage')) ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon4.png" /></a></div>
                            <h5>Mobile Advantage... </h5>
                            <a href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Mobile_Advantage')) ?>" class="read-link">Read More </a>
                        </li>
                        <li>
                            <div class="icon-slider"><a class="anchor" href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Dedicated_Fundraising')) ?>"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon5.png" /></a></div>
                            <h5>Dedicated Page...</h5>
                            <a href="<?php echo $this->createUrl('cms/why_use_mobiTrust', array('target' => 'Dedicated_Fundraising')) ?>" class="read-link">Read More </a>
                        </li>
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
                                <a id="active-btn_<?php echo $type->id; ?>" data-id='<?php echo $type->id; ?>' class="type_button button_act"> <?php echo $type->fundraiser_type; ?></a>
                            <?php }
                    } else { ?>
                            <li><a class="active" href="javascript: void(0)">No Type</a></li>
                        <?php } ?>
                </ul>
            </div>
        </div>
        <div class="section-frist">
            <div class="section-min-slider" style="height: auto;">
                <h3>Featured Fundraisers</h3>
                <div class="section-slider-main-div">
                    <div id="slider-col2">
                        <!-- <div class="loader" style="display: none">
                            <img src="<?php //echo Yii::app()->request->baseUrl; 
                                        ?>/images/admin/ajax-loader1.gif"/></a>
                        </div> -->
                        <div class="Fundraisers" id="ajaxload">
                            <?php $featured_fundraiser = Fundraiser::model()->findAll(array('select' => '*', 'condition' => 'feature_flag = "Y" AND status = "Y"', 'order' => 'fundr_timeline_to DESC')); ?>
                            <?php foreach ($featured_fundraiser as $fundraiser) { ?>
                                <?php
                                $percentage = $fundraiser->getDonationPercentage();
                                ?>
                                <div class="slide featured-slide">
                                    <h4 class="teg-h4"> <?php echo $fundraiser->getTypeName(); ?></h4>
                                    <div class="section-img ssss">
                                        <?php echo $fundraiser->getRewardStartImage(); ?>
                                        <a href="<?php echo $fundraiser->getURL();  ?>">
                                            <img style="height:221px;" src="<?php echo $fundraiser->getImageURL(); ?>">
                                        </a>
                                    </div>
                                    <h4 class="teg1-h4 teg1-color"><?php echo $fundraiser->getGoalAmount();  ?></h4>
                                    <div class="slider-bottom-img ">
                                        <div class="percent_line" style="width:<?php echo $percentage; ?>"></div>
                                    </div>
                                    <div class="parsen">
                                        <p class="left-teg"><?php echo $percentage; ?></p>
                                        <p class="right-teg"><?php echo $fundraiser->getDaysLeft(); ?> </p>
                                    </div>
                                    <div class="corporate-wrap" style="display: none;">
                                        <ul class="corporate-slider">
                                            <li><img src="http://placehold.it/170x200&text=FooBar1" /></li>
                                            <li><img src="http://placehold.it/170x200&text=FooBar2" /></li>
                                            <li><img src="http://placehold.it/170x200&text=FooBar3" /></li>
                                            <li><img src="http://placehold.it/170x200&text=FooBar4" /></li>
                                            <li><img src="http://placehold.it/170x200&text=FooBar5" /></li>
                                            <li><img src="http://placehold.it/170x200&text=FooBar6" /></li>
                                            <li><img src="http://placehold.it/170x200&text=FooBar7" /></li>
                                            <li><img src="http://placehold.it/170x200&text=FooBar8" /></li>
                                        </ul>
                                        <br>
                                        <div class="bx-custom-control" style="width:100%">
                                            <div style="width:20px;float:left">
                                                <a class="control-prev-slide"><<</a>
                                            </div>
                                            <div style="width:20px;float:right;">                                             
                                                <a class="control-next-slide">>></a>
                                            </div>  
                                        </div>
                                    </div>
                                    <a href="<?php echo $fundraiser->getURL();  ?>">
                                        <h4 class="teg1-h4 teg4-h4">Case No. <?php echo $fundraiser->id; ?><br> <?php echo $fundraiser->fundraiser_title;  ?></h4>
                                    </a>
                                </div>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End section fourth -->
<!-- https://web.facebook.com/profile.php?id=100083808785468 -->
<!-- https://web.facebook.com/profile.php?id=100083412519493 -->

<div id="comment-row" style="padding: 0px; background:none;">
    <div class="inner-container">
        <div style="width: 70%; height:100%; float:left;">
            <div class="fb-like" data-href="https://web.facebook.com/profile.php?id=100083808785468" data-width="" data-layout="button" data-action="like" data-size="large" data-share="true"></div>
        </div>
        <div style="width: 30%; height:100%;float:left;text-align:right;">
            <a href="https://twitter.com/share?ref_src=twsrc%5Etfw" class="twitter-share-button" data-size="large" data-text="Visit Giveyourbit and see how you can raise funds for your cause or support a cause, follow us on twitter" data-url="https://giveyourbit.com/" data-via="giveyourbit" data-lang="en" data-show-count="false">Tweet</a>
            <script async src="https://platform.twitter.com/widgets.js" charset="utf-8"></script>
        </div>
    </div>
</div>
<?php $testimonials = Testimonial::model()->findAll("status = 'Y' AND user_type='fundraiser'"); ?>
<?php if (!empty($testimonials)) { ?>
    <div class="section-fourth testi-spec">
        <div class="section-min-slider testimonials">
            <h4><a href="<?php echo $this->createUrl('site/testimonials'); ?>">Testimonials</a></h4>

            <div id="slider-col6">

                <div class="section-slider-main-div testimonials-min-div">
                    <ul class="bxslider1 testimonials-slider">
                        <?php
                        foreach ($testimonials as $testimonials_object_row) {
                            if (!empty($testimonials_object_row->testimonial_picture)) {
                                $image_path = SITE_ABS_PATH_TESTIMONIAL . $testimonials_object_row->testimonial_picture;
                            } else {
                                $image_path = SITE_ABS_PATH_TESTIMONIAL . 'no_iamge.png';
                            }
                        ?>
                            <li>
                                <div class="testimonials-left">
                                    <img src="<?php echo $image_path; ?>" />
                                </div>
                                <div class="testimonials-right">
                                    <p>
                                        “<?php echo substr($testimonials_object_row->testimonial_text, 0, 150) . '...'; ?>
                                    </p>
                                    <a href="<?php echo $this->createUrl('site/testimonials', array('id' => $testimonials_object_row->id)); ?>">-<?php echo $testimonials_object_row->testimonial_by; ?></a>

                                    <p class="neque"><?php echo $testimonials_object_row->testimonial_company; ?> </p>
                                </div>
                            </li>
                        <?php } ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
<?php } ?>
<!-- End section fourth -->
<div class="clear"></div>

<script>
    $(document).ready(function() {
        $('.slider1').bxSlider({
            slideWidth: 227,
            minSlides: 1,
            maxSlides: 50,
            slideMargin: 50,
            infiniteLoop: true,
            hideControlOnEnd: false
        });


        $('.corporate-slider').bxSlider({
            minSlides: 3,
            maxSlides: 3,
            slideWidth: 50,
            slideMargin: 5,
            nextSelector: '.control-next-slide',
            prevSelector: '.control-prev-slide',
            infiniteLoop: false,
            hideControlOnEnd: true,
        });
    });
</script>

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
        pause: 9000,
        speed: 12000
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
    //            url: "<? // echo Yii::app()->createUrl('Fundraiser/findfundraiser'); 
                        ?>//",
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

    $(document).ready(function() {

        var Fundraisers = $('.Fundraisers').bxSlider({
            slideWidth: 229,
            minSlides: 1,
            maxSlides: 50,
            slideMargin: 50,
            infiniteLoop: true,
            //controls : false,            
        });

        $('.type_button').on('click', function() {
            var id = $(this).attr("data-id");
            $('.button_act').removeClass('active');
            $('#active-btn_' + id).addClass('active');
            $(".loader").css("display", "block");
            $.ajax({
                type: "POST",
                url: "<?php echo Yii::app()->createUrl('Fundraiser/findfundraiser'); ?>",
                data: {
                    fundraiser_id: id
                },
                success: function(data) {
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
                error: function(xhr) {}
            });
        });
    });
</script>

<?php
if (!empty($_REQUEST['flag']) && $_REQUEST['flag'] == '1') { ?>
    <?php $loadurl = $this->createUrl('site/signup', array('flag' => $_REQUEST['flag']));
    ?>

    <script>
        $(document).ready(function() {

            $.fancybox.open([{
                href: "<?php echo $loadurl; ?>"
            }], {
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
                helpers: {
                    overlay: {
                        locked: false,
                        closeClick: false
                    }
                }
            });

        });
    </script>
<?php
} else {
    //show banner popup only when there is no popup message of signup or registration.    
?>

    <script>
        function isMobileBrowser() {

            var isMobile = false; //initiate as false
            // device detection
            if (/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|ipad|iris|kindle|Android|Silk|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i.test(navigator.userAgent) ||
                /1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i.test(navigator.userAgent.substr(0, 4))) {
                isMobile = true;
            }

            return isMobile;
        }



        $(document).ready(function() {

            if (isMobileBrowser()) {

                $("#mobile-notes").fancybox({
                    width: '500px',
                    height: '500px',
                    autoScale: false,
                    type: 'iframe',
                    scrolling: false,
                    autoCenter: true,
                    autoSize: false,
                    padding: '1px',
                    helpers: {
                        overlay: {
                            locked: false,
                            closeClick: false
                        }
                    }
                });

                const myTimeout = setTimeout(function() {
                    $('#mobile-notes').trigger('click');
                }, 3000);

            } else {

                $("#site-notes").fancybox({
                    width: '700px',
                    height: '500px',
                    autoScale: false,
                    type: 'iframe',
                    scrolling: false,
                    autoCenter: true,
                    autoSize: false,
                    padding: '1px',
                    helpers: {
                        overlay: {
                            locked: false,
                            closeClick: false
                        }
                    }
                });

                const myTimeout = setTimeout(function() {
                    $('#site-notes').trigger('click');
                }, 3000);

            }

        });
    </script>
<?php } ?>