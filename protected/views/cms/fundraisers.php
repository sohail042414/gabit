<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<!--Start content----------------------------------------------------------->

<div class="inner-container">
    <div class="inner-left">
        <h4>Help Dave Beat Cancer </h4>

        <div class="i-left-img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abut-slider-mini.png" alt=""/></div>

        <!--        code for page content -->
        <?php echo $page_content; ?>

        <a href="<?php echo $this->createUrl('fundraise/index') ?>" class="button-tab">Start a Fundraiser</a>
        <a href="<?php echo $this->createUrl('fundraiser/locatefundraiser') ?>" class="button-tab">Explore Fundraisers</a>
        <div class="clear"></div>


        <a href="#" class="bot-link">Embed this fundraiser on a website or blog</a>
        <a href="#" class="bot-link">View similar cases</a>
        <a href="#" class="bot-link">Report this fundraiser</a>
    </div>


    <div class="inner-right">
        <div class="inner-right-col">
            <div class="i-right-ttl">#500,000 NGN</div>
            <div class="percent-col"><span>90%</span> 10 Days</div>
            <p><strong>270</strong> <b>donations</b><br/>
                All the Lorem Ipsum gentors on the Internet tend chunks anecssary Internet. </p>

            <div class="btn-col">
                <a href="#" class="donate-btn">Donate Now</a>
                <a href="#" class="social-btn"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/about-fb.png" alt=""/></a>
                <a href="#" class="social-btn"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/about-send.png" alt=""/></a>
            </div>
        </div>


        <div class="f-team">
            <div class="f-team-ttl">Fundraising Team</div>
            <div class="f-team-row">
                <div class="f-img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/about-img-fare.png" alt=""/></div>
                <p>This fundraiser<br/><i>-Neque porro-</i><br/>Fund Mqr</p>
            </div>

            <div class="f-team-row">
                <div class="f-img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/bottom-img1.png" alt=""/></div>
                <p>This fundraiser<br/><i>-Neque porro-</i><br/>Fund Mqr</p>
            </div>

            <a href="#" class="support-btn">Become a Supporter</a>
        </div>

    </div>


</div>


<div id="supporter-row">
    <div class="inner-container">
        <h4>Supporters</h4>

        <div class="clear"></div>
        <div id="slider-col4">
            <div class="slider2">
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom-1.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom2.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom3.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom4.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom5.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom6.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom7.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom8.png"/></div>

                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom-1.png"/></div>
                <div class="slide margin-r"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom2.png"/></div>
                <!--<div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom3.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom4.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom5.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom6.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom7.png"/></div>
                <div class="slide"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/abuot-slider-bottom8.png"/></div>-->
            </div>
        </div>
<!--        <script>-->
<!--            $(document).ready(function () {-->
<!--                $('.slider2').bxSlider({-->
<!--                    slideWidth: 70,-->
<!--                    minSlides: 3,-->
<!--                    maxSlides: 13,-->
<!--                    slideMargin: 10,-->
<!--                });-->
<!--            });-->
<!---->
<!--        </script>-->
        <script>
            $(document).ready(function () {
                $('.slider2').bxSlider({
                    slideWidth: 70,
                    minSlides: 3,
                    maxSlides: 12,
                    slideMargin: 19.5,
                });
            });
        </script>

    </div>
</div>


<div class="inner-container">
    <h4>Case Updates</h4>

    <div class="case-update-col">


        <div id="slider-col3">

            <div class="slider3">
                <div class="slide">
                    <div class="case-col">
                        <div class="case-box">
                            <div class="case-img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/case1.jpg" alt="" /></div>
                            <div class="case-txt">
                                <strong>Jan 23rd</strong><br />
                                <b>by Neque porro</b><br />
                                All the Lorem Ipsum generators the Internet tend to predefined chunks as making the first true generator Internet.<br />
                                <a href="#" class="read-more">Read More &raquo;</a>
                            </div>
                        </div>

                        <div class="case-box">
                            <div class="case-img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/case2.jpg" alt="" /></div>
                            <div class="case-txt">
                                <strong>Jan 23rd</strong><br />
                                <b>by Neque porro</b><br />
                                All the Lorem Ipsum generators the Internet tend to predefined chunks as making the first true generator Internet.<br />
                                <a href="#" class="read-more">Read More &raquo;</a>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="slide">
                    <div class="case-col">
                        <div class="case-box">
                            <div class="case-img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/case3.jpg" alt="" /></div>
                            <div class="case-txt">
                                <strong>Jan 23rd</strong><br />
                                <b>by Neque porro</b><br />
                                All the Lorem Ipsum generators the Internet tend to predefined chunks as making the first true generator Internet.<br />
                                <a href="#" class="read-more">Read More &raquo;</a>
                            </div>
                        </div>

                        <div class="case-box">
                            <div class="case-img"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/case4.jpg" alt="" /></div>
                            <div class="case-txt">
                                <strong>Jan 23rd</strong><br />
                                <b>by Neque porro</b><br />
                                All the Lorem Ipsum generators the Internet tend to predefined chunks as making the first true generator Internet.<br />
                                <a href="#" class="read-more">Read More &raquo;</a>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>

    </div>
</div>

<div id="comment-row">
    <div class="inner-container">
        <div class="comment-left">
            <div class="comment-icon"><img src="<?php echo Yii::app()->request->baseUrl; ?>/images/commnt-icon.jpg" alt=""/></div>
            <span>Click here to enter comment or prayer</span>

            <div class="select-style">
                <select name="">
                    <option>1234</option>
                    <option>1234</option>
                    <option>1234</option>
                    <option>1234</option>
                </select>
            </div>

        </div>

        <div class="comment-right">
            <a href="#">View Comments</a> <i>/</i> <a href="#">Prayer</a>
        </div>
    </div>
</div>

<div class="clear"></div>
<div class="inner-container">
    <a href="#" class="donate-btn1">Donate Now</a>
</div>
</div>