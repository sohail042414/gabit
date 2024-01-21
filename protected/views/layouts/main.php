<!DOCTYPE html>
<html>

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    <meta name="language" content="en">
    <link href="https://fonts.cdnfonts.com/css/lucida-handwriting-std" rel="stylesheet">
    <script type='text/javascript' src='https://platform-api.sharethis.com/js/sharethis.js#property=648b204f9c28110012954d80&product=inline-share-buttons' async='async'></script>

    <?php

    if (Yii::app()->controller->id == 'fundraiser' && Yii::app()->controller->action->id == 'index') {
        $fundraiser_data = Fundraiser::model()->findByPk($_GET['id']);
    ?>

        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@giveyourbit">
        <meta name="twitter:title" content="<?php echo $fundraiser_data->fundraiser_title ?>">
        <meta name="twitter:description" content="Our lives are better when we make other people's lives better; please visit this fundraiser and offer your support to someone in need.<?php //echo $fundraiser_data->tell_ur_fund_story; 
                                                                                                                                                                                        ?>">
        <meta name="twitter:image" content="<?php echo (SITE_ABS_PATH_FUNDRAISER_IMAGE . $fundraiser_data->uplod_fun_img); ?>">

        <meta property="og:url" content="<?php echo $fundraiser_data->getShareThisUrl(); ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="Giveyourbit.com" />
        <meta property="og:title" content="<?php echo $fundraiser_data->fundraiser_title ?>" />
        <meta property="og:description" content=" Our lives are better when we make other people's lives better; please visit this fundraiser and offer your support to someone in need.<?php //echo $fundraiser_data->tell_ur_fund_story; 
                                                                                                                                                                                        ?>" />
        <meta property="og:image" content="<?php echo (SITE_ABS_PATH_FUNDRAISER_IMAGE . $fundraiser_data->uplod_fun_img); ?>" />
        <meta property="og:image:alt" content="<?php echo $fundraiser_data->fundraiser_title ?>" />

        <meta property="fb:app_id" content="1516737235423924">

    <?php }  ?>

    <?php
    if (Yii::app()->controller->id == 'blog' && Yii::app()->controller->action->id == 'view') {
        $story = Post::model()->findByPk($_GET['id']);
    ?>
        <meta name="twitter:card" content="summary_large_image">
        <meta name="twitter:site" content="@giveyourbit">
        <meta name="twitter:title" content="<?php echo $story->title; ?>">
        <meta name="twitter:description" content="Our lives are better when we make other people's lives better; please visit this fundraiser and offer your support to someone in need.<?php //echo $fundraiser_data->tell_ur_fund_story; 
                                                                                                                                                                                        ?>">
        <meta name="twitter:image" content="<? php // echo(SITE_ABS_PATH_FUNDRAISER_IMAGE . $story->uplod_fun_img\); 
                                            ?>">

        <meta property="og:url" content="<?php echo $story->getShareThisUrl(); ?>" />
        <meta property="og:type" content="website" />
        <meta property="og:site_name" content="Giveyourbit.com" />
        <meta property="og:title" content="<?php echo $story->title; ?>" />
        <meta property="og:description" content=" Our lives are better when we make other people's lives better; please visit this fundraiser and offer your support to someone in need.<?php //echo $fundraiser_data->tell_ur_fund_story; 
                                                                                                                                                                                        ?>" />
        <meta property="og:image" content="<?php //echo(SITE_ABS_PATH_FUNDRAISER_IMAGE . $fundraiser_data->uplod_fun_img); 
                                            ?>" />
        <meta property="og:image:alt" content="<?php echo $story->title ?>" />
        <meta property="fb:app_id" content="1516737235423924">

    <?php }  ?>


    <!-- Code for the meta title -->
    <?php if (!empty($this->metaTitle)) { ?>
        <title><?php echo CHtml::encode($this->metaTitle); ?></title>
    <?php } else { ?>
        <title>Giveyourbit</title>
    <?php } ?>

    <!-- Code for the meta Description -->
    <?php if (!empty($this->metaDescription)) { ?>
        <meta name="description" content="<?php echo CHtml::encode($this->metaDescription); ?>" />
    <?php } else { ?>
        <meta name="description" content="" />
    <?php } ?>

    <!-- Code for the meta Keyword -->
    <?php if (!empty($this->metaKeyword)) { ?>
        <meta name="keywords" content="<?php echo CHtml::encode($this->metaKeyword); ?>" />
    <?php } else { ?>
        <meta name="keywords" content="" />
    <?php } ?>

    <!--<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0"/>-->
    <meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
    <!--<meta name="viewport" content="width=device-width" />-->

    <!--[if IE]>
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/ie-style.css" rel="stylesheet" type="text/css">
    <![endif]-->

    <link rel="icon" type="image/png" href="/favicon.png">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/style.css" rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/loader.css" rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/fundraiser.css" rel="stylesheet" type="text/css">
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/responsive.css" rel="stylesheet" type="text/css">
    <!-- <link href="<?php //echo Yii::app()->request->baseUrl; 
                        ?>/css/responsive-orginal.css" rel="stylesheet" type="text/css"> -->
    <link href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.bxslider.css" rel="stylesheet" type="text/css">

    <!-- Roboto Font stylesheet -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,300,100,500,700' rel='stylesheet' type='text/css'>
    <!-- FontAwesome stylesheet -->
    <link href="http://netdna.bootstrapcdn.com/font-awesome/4.1.0/css/font-awesome.min.css" rel="stylesheet">
    <!-- LayerSlider stylesheet -->
    <?php
    if (Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'index') { ?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
    <?php } else if (Yii::app()->controller->id == 'site' && Yii::app()->controller->action->id == 'locate_fundraiser') { ?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
    <?php } else if (Yii::app()->controller->id == 'cms') { ?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
    <?php } else if (Yii::app()->controller->id == 'fundraiser' && Yii::app()->controller->action->id == 'managefundraiser') { ?>
        <!--                <script src="<?php //echo Yii::app()->request->baseUrl; 
                                            ?>/js/jquery.min.js"></script>-->
    <?php } else if (Yii::app()->controller->id == 'fundraiser' && Yii::app()->controller->action->id == 'category') { ?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
    <?php } else if (Yii::app()->controller->id == 'fundraiser' && Yii::app()->controller->action->id == 'locatefundraiser') { ?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
    <?php } else if (Yii::app()->controller->id == 'cms' || Yii::app()->controller->id == 'fundraiser' && Yii::app()->controller->action->id == 'event_invitation') { ?>
        <!--        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>-->
    <?php } else if (Yii::app()->controller->id == 'site' &&  Yii::app()->controller->action->id == 'testimonials') { ?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
    <?php } else if (Yii::app()->controller->id == 'site' &&  Yii::app()->controller->action->id == 'Forgotpassword') { ?>
        <!--        <script src="--><?php //echo Yii::app()->request->baseUrl; 
                                    ?><!--/js/jquery.min.js"></script>-->
    <?php } else if (Yii::app()->controller->id == 'site' &&  (Yii::app()->controller->action->id == 'notifications' || Yii::app()->controller->action->id == 'notificationdetail')) { ?>
        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>
    <?php } else if (Yii::app()->controller->id == 'fundraiser' && Yii::app()->controller->action->id == 'event_invitation') { ?>
        <!--        <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.min.js"></script>-->
    <?php } ?>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/loader.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.bxslider.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.bxslider.min.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.simplyscroll.js"></script>
    <!--    <script src="--><?php //echo Yii::app()->request->baseUrl; 
                            ?><!--/js/responsivemobilemenu.js"></script>-->

    <!--Images Scrolling-->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/jquery.simplyscroll.css" type="text/css">
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/scrolltopcontrol.js"></script>
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/jquery.tooltip.js"></script>
    <script type="text/javascript">
        $(document).ready(function() {
            $("#scroller").simplyScroll();
        });
    </script>
    <!--Navigation-->
    <link rel="stylesheet" href="<?php echo Yii::app()->request->baseUrl; ?>/css/responsive-nav.css">
    <script src="<?php echo Yii::app()->request->baseUrl; ?>/js/responsive-nav.js"></script>
    <!--Navigation-->

    <script type="text/javascript">
        function goToByScroll(id) {
            // Scroll
            $('html,body').animate({
                scrollTop: $("#" + id).offset().top - 230
            }, 'slow');
        }
    </script>

    <script>
        $(document).ready(function() {
            $('.slider3').bxSlider({
                slideWidth: 520,
                minSlides: 1,
                maxSlides: 50,
                slideMargin: 5,
                infiniteLoop: false,
                hideControlOnEnd: true,
                helpers: {
                    buttons: false
                }
            });
            //            script for the send subscribe to MobiTrust by email //subsciberemail "Subscribe email address can't blank!"
            $('#btn_subscribe').click(function() {
                var val = $('#newsletter_email').val();
                if (val == '') {
                    $("#newsletter_email").addClass('btn_newsletter');
                    $('#error_email').html("Enter email address to subscribe!");
                    return false;
                } else {
                    if (checkemail(val)) {
                        $.ajax({
                            type: "POST",
                            url: "<? echo Yii::app()->createUrl('site/newsletter'); ?>",
                            data: {
                                email: val
                            },
                            success: function(data) {
                                $("#newsletter_email").removeClass('btn_newsletter');
                                $(".newsletter_container").hide();
                                $('#error_email').html(data);
                            },
                            error: function(xhr) {
                                // alert("failure"+xhr.readyState+this.url)
                            }
                        });
                    }
                }

            });
            //            function for check email validation
            function checkemail(email) {
                var str = email;
                var filter = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,6}(?:\.[a-z]{2})?)$/i
                if (filter.test(str))
                    return true;
                else {
                    $("#newsletter_email").addClass('btn_newsletter');
                    $('#error_email').html("Please input a valid email address!");
                    return false;
                }
            }
        });
    </script>

    <!--  script and css for the fancybox   -->
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.mousewheel-3.0.4.pack.js"></script>
    <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.pack.js"></script>
    <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/js/fancybox/jquery.fancybox-1.3.4.css" media="screen" />
    <script type="text/javascript">
        $(document).ready(function() {

            $("#link_signup").fancybox({
                maxWidth: 430,
                maxHeight: 540,
                'width': '100%',
                'height': '100%',
                'autoScale': false,
                'type': 'iframe',
                'scrolling': false,
                'autoCenter': true,
                autoSize: false,
                helpers: {
                    overlay: {
                        locked: false,
                        closeClick: false
                    }
                }
            });

            $(".user_messaging_form").fancybox({
                maxWidth: 350,
                maxHeight: 390,
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

            $("#link_view_review").fancybox({
                maxWidth: 350,
                maxHeight: 410,
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

            $(".fundraiser_comment_form").fancybox({
                maxWidth: 560,
                maxHeight: 410,
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
    <script>
        $(document).on('click', '.has-loader', function() {
            startLoader();
        });
    </script>
    <title><?php echo CHtml::encode($this->pageTitle); ?></title>

    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-KTQ8JSN2ZD"></script>
    <script>
        window.dataLayer = window.dataLayer || [];

        function gtag() {
            dataLayer.push(arguments);
        }
        gtag('js', new Date());

        gtag('config', 'G-KTQ8JSN2ZD');
    </script>
</head>

<body>
    <div id="loader" style="display: none;"></div>
    <div id="loader-container" style="display: none;">
        <div class="parent"></div>
        <div class="child"></div>
    </div>
    <div id="fb-root"></div>
    <script async defer crossorigin="anonymous" src="https://connect.facebook.net/en_US/sdk.js#xfbml=1&version=v14.0&appId=1516737235423924&autoLogAppEvents=1" nonce="UebOx3Zl"></script>
    <div style="display:none;" id="back-to-top"><a href="#top"></a></div>
    <?php
    if (Yii::app()->controller->id == 'fundraise' || !empty(Yii::app()->frontUser->id)) {
        if (!empty($_SESSION['front_username']) || !empty($_SESSION['front_name'])) {
            echo $this->renderPartial('/layouts/deshboard_header');
        } else {
            echo $this->renderPartial('/layouts/header');
        }
    } else {
        echo $this->renderPartial('/layouts/header');
    }
    ?>
    <div class="main_banner-ba-div"></div>
    <?php echo $content; ?>
    <?php echo $this->renderPartial('/layouts/footer'); ?>
</body>

</html>