<?php
if (!empty($fundraiser)) {
    /*if ($count < 8) {
        $flag = '1';
    } else {
        $flag = '2';
    }*/
    $flag = '';
    ?>
    <!--Start content----------------------------------------------------------->

            <?php
            if (!empty($fundraiser)) {
                foreach ($fundraiser as $row) {
                    if($row['id'] == $max_id){
                        $flag  = '1';
                    }
                    $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $row['fundraiser_title']);
                    $title = str_replace("'", '', $title);
                    $title = strtolower($title);
                    ?>
                    <div class="fundraiser_list">
                        <a href="<?php echo $this->createUrl('fundraiser/index', array('id' => $row['id'], 'fundraiser_name' => $title)); ?>">
                            <div id="slider-col1">
                                <h4 class="teg-h4"><?php echo $row->ftype->fundraiser_type; ?></h4>

                                <div class="section-img"><img
                                        src='<?php echo SITE_ABS_PATH_FUNDRAISER_IMAGE . $row['fundraiser_image']; ?>'>
                                </div>

                                <h6 class="teg1-h4">Case No. <?php echo $fundraiser['id']; ?>
                                    : <?php echo $row['fundraiser_title']; ?></h6>

                                <div>
                                    <h6><?php echo substr($row['fundraiser_description'], 0, 120) . '...'; ?></h6>
                                </div>
                                <div>
                                    <h6 class="teg1-h4 teg1-color"><?php echo number_format($row['fundraiser_amount_need'], 0, ",", ",") . ' NGN'; ?></h6>
                                </div>
                            </div>
                        </a>
                    </div>
                <?php }
            }
            ?>

    ###<?php echo $flag; ?>
<?php } else {
    echo "1";
}
?>
