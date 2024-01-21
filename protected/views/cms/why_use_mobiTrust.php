<style>
    .why_use_mobi_title_blk {
        background-color: #1f1a17;
        padding: 10px;
        width: 300px;
        clear: both;
    }
    .why_use_mobi_title_blk h3 {
        color:#ffffff;
    }
</style>
<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<!--Start content----------------------------------------------------------->
<div class="inner-container">
    <div class="inner-left">
    <div id="why_use_mobiTrust_content" class="inner-page">
        <h4><?php echo $page_title; ?></h4>
        <div class="Crowd_Support" id="Crowd_Support" style="margin-top:40px;">
            <?php
            $Crowd_Support = Cms::model()->find(array("select" => "page_name,page_content", "condition" => "id = '14'  AND status='Y'"));
            ?>
            
            <div id="Crowd_Support" class="why_use_mobi_title_blk">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/usear-icon.png"/>
                <h3><?php echo $Crowd_Support->page_name; ?></h3>
            </div>
            <!--<h3 id="Crowd_Support"><?php echo $Crowd_Support->page_name; ?></h3>-->

            <p><?php echo $Crowd_Support->page_content; ?></p>
        </div>
        <div class="A_Small_Fee" >
            <?php
            $Crowd_Support = Cms::model()->find(array("select" => "page_name,page_content", "condition" => "id = '15'  AND status='Y'"));
            ?>
            <div id="A_Small_Fee" class="why_use_mobi_title_blk">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon2.png"/>
                <h3><?php echo $Crowd_Support->page_name; ?></h3>
            </div>
            <!--<h3 id="A_Small_Fee"><?php echo $Crowd_Support->page_name; ?></h3>-->

            <p><?php echo $Crowd_Support->page_content; ?></p>
        </div>
        <div class="Guidance_for_Success" >
            <?php
            $Crowd_Support = Cms::model()->find(array("select" => "page_name,page_content", "condition" => "id = '16'  AND status='Y'"));
            ?>
            <div id="Guidance_for_Success" class="why_use_mobi_title_blk">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon3.png"/>
                <h3><?php echo $Crowd_Support->page_name; ?></h3>
            </div>
            <!--<h3 id="Guidance_for_Success"><?php echo $Crowd_Support->page_name; ?></h3>-->

            <p><?php echo $Crowd_Support->page_content; ?></p>
        </div>
        <div class="Mobile_Advantage">
            <?php
            $Crowd_Support = Cms::model()->find(array("select" => "page_name,page_content", "condition" => "id = '17'  AND status='Y'"));
            ?>
            <div id="Mobile_Advantage" class="why_use_mobi_title_blk">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon4.png"/>
                <h3><?php echo $Crowd_Support->page_name; ?></h3>
            </div>
            <!--<h3 id="Mobile_Advantage"><?php echo $Crowd_Support->page_name; ?></h3>-->
            
            <p><?php echo $Crowd_Support->page_content; ?></p>
        </div>
        <div class="Dedicated_Fundraising">
            <?php
            $Crowd_Support = Cms::model()->find(array("select" => "page_name,page_content", "condition" => "id = '18'  AND status='Y'"));
            ?>
            <div id="Dedicated_Fundraising" class="why_use_mobi_title_blk">
                <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/icon5.png"/>
                <h3><?php echo $Crowd_Support->page_name; ?></h3>
            </div>
            <!--<h3 id="Dedicated_Fundraising"><?php echo $Crowd_Support->page_name; ?></h3>-->

            <p><?php echo $Crowd_Support->page_content; ?></p>
        </div>
        <a href="<?php echo $this->createUrl('fundraise/index') ?>" class="button-tab">Start a Fundraiser</a>
        <a href="<?php echo $this->createUrl('fundraiser/locatefundraiser') ?>" class="button-tab">Explore Fundraisers</a>
    </div>
    </div>
     <?php echo $this->renderPartial('/layouts/cms_sidebar'); ?>
</div>
</div>
<script>
    $(document).ready(function () {
        var value = '<?php echo $_REQUEST['data'];?>';
        <?php
        if(!empty($_REQUEST['target'])) {
        ?>
        var target = "#<?php echo $_REQUEST['target']; ?>"; console.log(target);
        if($(target).length > 0) {
            $('html, body').animate({
                scrollTop: $(target).offset().top - ($('.main_head').height() + 20)
            }, 2000);
        }
        <?php
        }
        ?>
        
    });
</script>