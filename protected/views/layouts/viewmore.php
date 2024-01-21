<?php
if (!empty($fundraisers)) {
    $flag = '';
?>
<!--Start content----------------------------------------------------------->
<div class="inner-container">
    <div class="inner-page">
        <?php
        foreach ($fundraisers as $fundraiser) {
            if($fundraiser->id == $max_id){
                $flag  = '1';
            }
            $percentage = $fundraiser->getDonationPercentage();
            ?>
            <div class="fundraiser_list">
                <a href="<?php echo $fundraiser->getURL(); ?>">
                    <div id="slider-col1">
                        <h4 class="teg-h4"><?php echo $fundraiser->getTypeName(); ?></h4>
                        <div class="section-img"><img src="<?php echo $fundraiser->getImageURL(); ?>"></div>
                        <h4 class="teg1-h4 teg1-color"><?php echo $fundraiser->getGoalAmount(); ?></h4>
                        <div class="slider-bottom-img ">
                            <div class="percent_line" style="width:<?php echo $percentage; ?>"></div>
                        </div>
                        <div class="parsen">
                            <p class="left-teg1"><?php echo  $percentage; ?> </p>
                            <p class="right-teg1"><?php echo  $fundraiser->getDaysLeft(); ?>
                        </div>
                        <h4 class="teg1-h4 teg4-h4">Case No. <?php  echo $fundraiser->id ?> <br> <?php echo $fundraiser->fundraiser_title  ?> </h4>
                        
                    </div>
                </a>
            </div>
        <?php } ?>
    </div>
</div>
    ###<?php echo $flag;?>
<?php }
else{
    echo "1";
}
?>
