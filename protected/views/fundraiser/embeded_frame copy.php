<style type="text/css">
a{text-decoration: none;}
iframe{height: auto !important}
.clear{margin: 0px; padding: 0px; clear: both;}
h4.case_ttl{color:#098fc6 !important;}
h4.case_ttl1{color:#333 !important;}
h4.teg1-h4{float: left; color:#f31126; font-weight: bold; font-family: arial; font-size: 18px; width: 100%; text-align: left; margin: 0px;}
h4.teg1-h4:hover{color:#098fc6;}
.slider-bottom-img { width: 100%; float: left; border-bottom: #666 1px solid;}
p{text-align: left; text-decoration: none; color:#333; font-family: arial;}
.parsen{width:100%; background: #e9e9e9; float: left; padding: 0px; margin-top: 20px; margin-bottom: 20px;}
.parsen p{margin: 5px 0px; font-size: 14px; font-family: arial;}
.parsen p.left-teg{width: 50%; float: left; padding-left: 10px; box-sizing: border-box; font-weight: bold;}
.parsen p.right-teg{width: 50%; float: left; padding-right: 10px; text-align: right; box-sizing: border-box;}
.slider-bottom-img {float: left; width: 100%;}
.slider-bottom-img .percent_line {background: #1ab8db none repeat scroll 0 0;  border-radius: 5px;  bottom: -3px;    height: 5px;
    position: relative;}
.section-img{margin: 20px 0px; float: left; width: 100%; overflow: hidden;}
.image_box{width: 223px; float: left;}
.image_box img{width:100%; float: left;}
.left_part_div{width: 223px; text-align: center;}
    
</style>

<div class="left_part_div">
     <?php $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser->fundraiser_title);
    $title = str_replace("'", '', $title);
    $title = strtolower($title);
    $type = preg_replace("/[^A-Za-z0-9\-\']/", '_', trim($fundraiser->ftype->fundraiser_type));
    $type = str_replace("'", '', $type);
    $type = strtolower($type);
    $percentage = UtilityHtml::get_fundraiser_percent($fundraiser->fundraiser_amount_need, $fundraiser->id);
    ?>
                            <div class="slide">
                                <h4 class="teg1-h4 case_ttl" style="font-weight: lighter;"><?php echo substr($fundraiser->fundraiser_title, 0, 160) . '...'; ?></h4>
                                <a class="image_box" href="<?php echo $this->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title)); ?>" target="_blank">
                                    <div class="clear"></div>
                                    <div class="section-img"><img style="height:221px;"
                                                                  src='<?php echo SITE_ABS_PATH_FUNDRAISER_IMAGE . $fundraiser->uplod_fun_img; ?>'>
                                    </div>
                                    

<!--                                    <p><?php echo substr($fundraiser->fundraiser_description, 0, 120) . '...'; ?></p>-->
                                    <h4 class="teg1-h4 teg1-color"><?php echo '' . number_format($fundraiser->fundraiser_amount_need, 0, ",", ",") . ' NGN'; ?></h4>

                                    <div class="slider-bottom-img ">
                                        <div class="percent_line" style="width:<?php echo $percentage; ?>"></div>
                                    </div>
                                    <div class="parsen">
                                        <p class="left-teg"><?php echo UtilityHtml::get_fundraiser_percent($fundraiser->fundraiser_amount_need, $fundraiser->id); ?></p>

                                        <p class="right-teg"><?php echo UtilityHtml::fundraiser_time_elapsed($fundraiser->fundraiser_timeline); ?></p>
                                    </div>
                                    <h4 class="teg1-h4 case_ttl1">Case No. <?php echo $fundraiser->id; ?>
                                        : <?php echo substr($fundraiser->fundraiser_title, 0, 160) . '...'; ?></h4>
                                </a>
                            </div>
</div>

       

