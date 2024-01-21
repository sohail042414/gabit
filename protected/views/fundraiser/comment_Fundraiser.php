<div id="getResult"></div>

<script>
    
    $(document).ready(function(){
        
        var hasBeenClicked;
        
        $('#aaaaaaaaaaaa').click(function(){
            hasBeenClicked = 1;
        });
            
            
            if (hasBeenClicked == 1) {
                
                var adata = 'aaa';
             //   var fundraiser= '<?php //echo $_REQUEST['fundraiser_id'] ;?>';
                $.ajax({
                    url: '<?php echo Yii::app()->createUrl('fundraiser/pagedata',array('fundraiser_id'=>$_REQUEST['fundraiser_id'])); ?>',
                    type: 'post',
                    data: {clienData: adata},
                    success: function (result) {
                        $('#getResult').html(result);
                    }
                });
                
            } else {
            
                $.ajax({
                    url: '<?php echo Yii::app()->createUrl('fundraiser/pagedata',array('fundraiser_id'=>$_REQUEST['fundraiser_id'])); ?>',
                    type: 'post',
                    data: {clienData: adata},
                    success: function (result) {
                        $('#getResult').html(result);
                    }
                });
                
            }
            
            
        });
    
</script>

















