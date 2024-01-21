<?php echo $this->renderPartial('/layouts/cms_banner');
$fundraiser_question= FundraiserQuestions::model()->findByPk($_REQUEST['id']);
?>
<!--Start content----------------------------------------------------------->
<div class="inner-container">
    <div class="inner-left">
        <div class="inner-page">
            <h4><?php echo $fundraiser_question->questions_text; ?></h4>
            <p class="q-line"><?php echo 'Last Updated: ' . $today = date("F j, Y, g:i a", strtotime($fundraiser_question->updated_date));; ?></p>

            <ul class="q-list">
                <?php
                $ans = FundraiserAnswer::model()->findAll(array('select' => 'answer_text,created_date', 'condition' => 'questions_id = ' . $data['id'] . ''));
                if (!empty($ans)) {
                    foreach ($ans as $ans_row) {
                        ?>
                        <li>
                            <?php echo $ans_row->answer_text; ?>
                        </li>
                    <?php }
                } else {
                    echo "No Record!";
                } ?>
            </ul>
	    <a href="<?php echo $this->createUrl('fundraise/index') ?>" class="button-tab">Start a Fundraiser</a>
            <a href="<?php echo $this->createUrl('fundraiser/locatefundraiser') ?>" class="button-tab">Explore Fundraisers</a>

            <?php if (Yii::app()->request->urlReferrer == SITE_ABS_PATH . "index.php/cms/support_and_contact_centre" && $_REQUEST['back'] == 1) { ?>
                <a href="<?php echo $this->createUrl('cms/support_and_contact_centre') ?>" class="button-tab">Back</a>
            <?php } ?>
        </div>
    </div>


    <?php echo $this->renderPartial('/layouts/cms_sidebar'); ?>
</div>
</div>
</div>
