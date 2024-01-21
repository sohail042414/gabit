<style type="text/css">
.f-team{border-top:none; padding-left:0px !important;}
#sidebar h4.teg4-h4 {
    margin-bottom: 10px;
}
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
                            $featured_fundraisers = Fundraiser::model()->findAll(array('select' => '*', 'condition' => 'feature_flag = "Y" AND status = "Y" ORDER BY rand() LIMIT 3'));
                            if (!empty($featured_fundraisers)) {
                                foreach ($featured_fundraisers as $fundraiser) { 
                                    $percentage = $fundraiser->getDonationPercentage();
                            ?>                                
                                
                                    <div class="slide">
                                        <h4 class="teg-h4"><?php echo $fundraiser->getTypeName(); ?></h4>
                                        <div class="section-img">
                                            <?php echo $fundraiser->getRewardStartImage(); ?>
                                            <a href="<?php echo $fundraiser->getURL(); ?>">
                                                <img style="height: 221px;" src="<?php echo $fundraiser->getImageURL(); ?>">
                                            </a>
                                        </div>
                                        <h4 class="teg1-h4 teg1-color"><?php echo $fundraiser->getGoalAmount(); ?></h4>
                                        <div class="slider-bottom-img ">
                                            <div class="percent_line" style="width:<?php echo $percentage; ?>"></div>
                                        </div>
                                        <div class="parsen">
                                            <p class="left-teg1"><?php echo  $percentage; ?> </p>
                                            <p class="right-teg1"><?php echo  $fundraiser->getDaysLeft(); ?>
                                        </div>
                                        <a href="<?php echo $fundraiser->getURL(); ?>">
                                            <h4 class="teg1-h4 teg4-h4">Case No. <?php  echo $fundraiser->id ?> <br> <?php echo $fundraiser->fundraiser_title  ?> </h4>                                        
                                        </a>
                                    </div>
                            <?php } ?> 
                        <?php } ?>
                    </div>
                </div>
            </div>        
    </div>
</div>