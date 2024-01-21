 <?php if(!empty($fundraiser)){ ?>
    <div class="comment_parent">
        <div class="comment_container">
       
            <?php $i=0; foreach ($fundraiser as $comment) { ?>
                <div>
                        <span><?php echo $comment->comment;?></span><br>
                        <Span><?php echo "By : ".$comment->name; ?></span>
                        <br><span><?php echo date('M, Y', strtotime($comment->created_date));?></span><hr>
                </div>

            <?php } ?>


            <p class="paginationBar">
                
                <?php
                $fundraiserCount = FundraiserComment::model()->count(array('select' => 'fundraiser_reference_id, name, email, comment, created_date', 'condition' => 'fundraiser_reference_id = ' . $_REQUEST['fundraiser_id'] . ' AND status = "Y" ', 'order' => 'id DESC' /*, 'limit' => '5'*/));

                $total_pages = ceil($fundraiserCount / COMMENT_RECORDS_PER_PAGE); 
                if($total_pages==1){
                    
                }else{
                    for ($i=1;$i<=$total_pages;$i++){ ?>
                        <button  class="pageBtn" value="<?php echo $i; ?>"><?php echo $i; ?></button>
                    <?php } ?>
                <?php }?>    
            </p>
        </div>
    </div>
<?php } else {?>
                 <div class="comment_parent">There are no available comments</div>
<?php   } ?>
                
<script>
    
    $(document).ready(function(){
        $('.paginationBar').each(function(){
            
            $('.pageBtn').click(function(){
                var pageValue = $(this).attr("value");
                
                $.ajax({
                    url: '<?php echo Yii::app()->createUrl('fundraiser/pagedata',array('fundraiser_id'=>$_REQUEST['fundraiser_id'])); ?>',
                    type: 'post',
                    data: {clienData: pageValue},
                    success: function (result) {
                        $('#getResult').html(result);
                    }
                });


            });
            
        });

            
        });
    
</script>