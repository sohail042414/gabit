
<?php foreach($case_updates as $case){ ?>
    <?php 
        $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $case->message_update);
        $title = str_replace("'", '', $title);
        $title = strtolower($title); 
    ?>
    <div class="case-box">
        <div class="case-img">
            <img style="width:100%;" src="<?php echo SITE_ABS_PATH_IMAGE . $case->image; ?>" alt=""/>
        </div>
        <div class="case-txt">
            <strong><?php echo date('M dS', strtotime($case->update_date)); ?></strong><br/>
            <b><?php echo 'by ' . $case->user_name; ?></b><br/>
            <?php echo nl2br(substr($case->message_update,0,600)); ?>                            
            <br/>

            <div class="popup-links">
                
                <?php if(!empty($case->video)){ ?>
                <div class="link-box">
                    <a title="Watch Video on Youtube" class="video-link popup-link" href="<?php echo Yii::app()->createUrl('fundraiser/case_video',array('case_id' => $case->id)); ?>"></a>
                </div>
                <?php } ?>
                <?php if(!empty($case->document1) || !empty($case->document2) || !empty($case->document3)){ ?>
                <div class="link-box">
                    <a title="See documents" class="document-link popup-link" href="<?php echo  Yii::app()->createUrl('fundraiser/case_docs',array('case_id' => $case->id)); ?>"></a>
                </div>
                <?php } ?>
            </div>
            <!-- <a class="read-more" href="<?php echo $this->createUrl('fundraiser/caseupdates', array('id' => $case->id, 'fundraiser_name1' => $title,'target'=>'case-'.$case->id )); ?>">Read More &raquo;</a> -->
        </div>
    </div>
<?php } ?>
