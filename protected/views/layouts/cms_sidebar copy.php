<style type="text/css">
.f-team{border-top:none; padding-left:0px !important;}


</style>

<div class="inner-right">
    <div id="sidebar" class="f-team">
        <div class="f-team-ttl">Featured Fundraisers</div>
        
        <div class="section-slider-main-div">
                <div id="slider-col2">
                        <div class="loader" style="display: none">
                            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/admin/ajax-loader1.gif"/></a>
                        </div>
                        <div class="Fundraisers" id="ajaxload">
                            <?php
                            $featured_fundraiser = SetupFundraiser::model()->findAll(array('select' => '*', 'condition' => 'feature_flag = "Y" AND ftype_id = "1" AND status = "Y" LIMIT 3'));
                            $getcount = count($featured_fundraiser);
                            $temp = '';
                            if (!empty($featured_fundraiser)) {
                                foreach ($featured_fundraiser as $fundraiser) {
                                    $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser->fundraiser_title);
                                    $title = str_replace("'", '', $title);
                                    $title = strtolower($title);
                                    $percentage = UtilityHtml::get_fundraiser_percent($fundraiser->fundraiser_amount_need, $fundraiser->id);
                                    $temp .= '<a href=' . $this->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title)) . '>
                                <div class="slide">
                                    <h4 class="teg-h4">' . $fundraiser->fundraiser_title . '</h4>

                                    <div class="section-img"><img style="height:221px;"
                                            src=' . SITE_ABS_PATH_FUNDRAISER_IMAGE . $fundraiser->uplod_fun_img . '></div>
                                    <h4 class="teg1-h4 teg1-color">' . number_format($fundraiser->fundraiser_amount_need, 0, ",", ",") . ' NGN' . '</h4>

                                    <div class="slider-bottom-img ">
                                        <div class="percent_line" style="width:'.$percentage.'"></div>
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