<div class="box-body">        
    <div class="form-group sort_dropdown">
        <label for="CommunityFundraiser_ftype_id" class="required">Select Fundraiser <span class="required">*</span></label>
        <?php  //echo Chtml::label('Select Fundraiser','fundraiser_id');  ?>                
        <?php
        echo Chtml::dropDownList('fundraiser_id',$fundraiser_id,CHtml::listData($fundraisers_list,'id','fundraiser_title'), array(
            'prompt' => '– Please Select –',
            'id' => 'fundraiser_id',
            'onchange' => CHtml::ajax(
                    array(
                        'type' => 'GET',
                        'url' => Yii::app()->createUrl('fundraiser/getform'),
                        'data' => array('fundraiser_id' => 'js:this.value'),
                        'success' => 'function(data){ showForm(data); }',
                        'async' => 'false',
                    )
            )                        
        ));
        ?> 
    </div>
    <div id="edit-form-wrap">
        <?php 
            if($tab == 'edit' && is_object($fundraiser)){
                
                if($fundraiser->user_type =='community'){                                    
                    echo $this->renderPartial('/fundraiser/_edit_community',array(
                        'model' => $edit_model,
                        'ftype_list' => $ftype_list,
                    ));
                }else if($fundraiser->user_type =='corporate'){
                    echo $this->renderPartial('/fundraiser/_edit_corporate',array(
                        'model' => $edit_model,
                        'ftype_list' => $ftype_list,
                    ));
                }else if($fundraiser->user_type =='non_profit'){
                    echo $this->renderPartial('/fundraiser/_edit_non_profit',array(
                        'model' => $edit_model,
                        'ftype_list' => $ftype_list,
                    ));
                }else if($fundraiser->user_type =='other'){
                    echo $this->renderPartial('/fundraiser/_edit_other',array(
                        'model' => $edit_model,
                        'ftype_list' => $ftype_list,
                    ));
                }
            }
        ?>
    </div>
</div>

<script>
    // function loadForm(obj){
    //     var fundraiser_id = $(obj).val();
    //     var edit_url = '<?php  ?>'
    // }

    function showForm(data){
        $('#edit-form-wrap').html(data)
    }
</script>