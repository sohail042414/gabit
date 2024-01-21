<?php
if (!empty($testimonials_object)) {
    $flag = '';
    ?>
    <!--Start content----------------------------------------------------------->

<?php
//                            p($_SERVER);
    /*
     * code for the display testimonials in a slider
     */
//                            $testimonials_object = Testimonial::model()->findAll('status = "Y" ');
    if (!empty($testimonials_object)) {
        foreach ($testimonials_object as $testimonials_object_row) {
            if($testimonials_object_row['id'] == $max_id){
                $flag  = '1';
            }
            if (!empty($testimonials_object_row->testimonial_picture)) {
                $image_path = SITE_ABS_PATH_TESTIMONIAL . $testimonials_object_row->testimonial_picture;
            } else {
                $image_path = SITE_ABS_PATH_TESTIMONIAL . 'no_iamge.png';
            }
            ?>
            <li id="navigation_<?php echo $testimonials_object_row->id; ?>">

                <div class="testimonials-left">
                    <a name="<?php echo $testimonials_object_row->id; ?>"></a>
                    <img src="<?php echo $image_path; ?>"/>
                </div>
                <div class="testimonials-right">
                    <p>
                        “<?php echo substr($testimonials_object_row->testimonial_text, 0, 150) . '...'; ?>
                        ”</p>
                    <a>-<?php echo $testimonials_object_row->testimonial_by; ?></a>

                    <p class="neque"><?php echo $testimonials_object_row->testimonial_company; ?> </p>
                </div>
            </li>
        <?php }}
        ?>
        ###<?php echo $flag; ?>
<?php } else {
    echo "1";
}
?>
