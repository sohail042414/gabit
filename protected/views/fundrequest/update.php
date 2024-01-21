<style type="text/css">
    .box-body {
        margin-top: 10px !important;
    }

    #ans_response1 {
        color: green;
        float: left;
        font-size: 15px;
        font-weight: 600;
        margin: 0 0 20px;
    }

    #fundraise_form input.upload_file {
        border: none !important;
    }

    @media only screen and (max-width: 480px) {
        #fundraise_form input.upload_file {
            margin-top: 10px !important;
        }
    }

    .lead_tab {
        margin: 15px 0 0;
    }

    #fundraise_form .box-body {
        margin-top: 9px;
    }

    .lead_tab ul li {
        flex-grow: 0 !important;
        margin-right: 33px;
    }

    .lead_tab ul li:last-child {
        margin-right: 0;
    }

    #dvChecked {
        margin-top: 20px;
    }

    #fundraise_form input[type=text] {
        height: 35px !important;
    }
</style>

<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
<!--<meta name="viewport" content="width=device-width" />-->

<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">

    <div class="lead_support">
        <h4>Update Fund Transfer Request</h4>
        <div class="lead_tab">
            <?php echo $this->renderPartial('/layouts/dashboard_menu'); ?>
        </div>
    </div>

    <div class="dashboard_content">
        <div class="inner-left" style="width:100%; float:left; margin-top:20px;">
            <div class="inner-page">
                <div id="fundraise_form">
                    <?php echo UtilityHtml::get_flash_message(); ?>
                    <?php
                    $form = $this->beginWidget('CoreGxActiveForm', array(
                        'id' => 'fund-transfer-form',
                        'enableAjaxValidation' => false,
                        'enableClientValidation' => true,
                        'htmlOptions' => array(
                            'enctype' => 'multipart/form-data'
                        ),
                        'clientOptions' => array(
                            'validateOnSubmit' => true,
                            'validateOnChange' => true,
                        ),
                    ));
                    ?>

                    <div class="box-body">
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'fundraiser_id'); ?>
                            <?php echo $form->dropDownList($model, 'fundraiser_id', GxHtml::listDataEx(SetupFundraiser::model()->findAllByAttributes(array('user_id' => Yii::app()->frontUser->id))), array('prompt' => '--Please Select --','disabled'=>true)); ?>
                            <?php echo $form->error($model, 'fundraiser_id'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'bank_name'); ?>
                            <?php echo $form->textField($model, 'bank_name'); ?>
                            <?php echo $form->error($model, 'bank_name'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'account_number'); ?>
                            <?php echo $form->textField($model, 'account_number'); ?>
                            <?php echo $form->error($model, 'account_number'); ?>
                        </div>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'account_name'); ?>
                            <?php echo $form->textField($model, 'account_name'); ?>
                            <?php echo $form->error($model, 'account_name'); ?>
                        </div>
                        <?php
                        $messg = SupportersDonorsThankuMessage::model()->find(array("select" => "*"));
                        ?>
                        <div class="form-group">
                            <?php echo $form->labelEx($model, 'thankyou_message_for_supporters'); ?>
                            <?php echo $form->textArea($model, 'thankyou_message_for_supporters', array('maxlength' => 500, 'value' => empty($model->thankyou_message_for_supporters) ? $messg->default_message : $model->thankyou_message_for_supporters)); ?>
                            <?php echo $form->error($model, 'thankyou_message_for_supporters'); ?>
                        </div>

                        <div class="box-footer">
                            <?php
                            echo GxHtml::submitButton(Yii::t('app', 'Submit'), array('class' => 'btn_send_ans'));
                            ?>
                        </div>
                    </div>
                    <?php $this->endWidget(); ?>
                </div>
            </div>
        </div>
    </div>

</div>


<script>
    $(document).ready(function() {


        var a = '<?php if (!empty($_POST['FundtransferByuser']['is_checked'])) {
                        echo $_POST['FundtransferByuser']['is_checked'];
                    } else {
                        echo "1";
                    } ?>';
        // alert(a);
        if (a == "1") {
            //$('input:radio[name=AdminPreviewReadyForm[select_type]]').val(['1']);

            $("#dvFundaccount").hide();
        } else {
            <?php $model->is_checked = '2'; ?>

            $("#dvFundaccount").show();
        }

        $("input:checkbox[type=checkbox]").change(function() {

            if (this.value == '1' && this.checked) {
                $("#dvFundaccount").show();

            } else {
                $("#dvFundaccount").hide();

            }
        });
        $("#FundtransferByuser_fundraiser_id").on('change', function() {
            var fundraiser_id = $(this).val();
            $.ajax({
                url: '<?php echo Yii::app()->createUrl('fundraise/check_fund_transfer'); ?>',
                type: 'post',
                data: {
                    fundraiser_id: fundraiser_id
                },
                success: function(result) {

                    if (result != '') {
                        window.location = <?php SITE_ABS_PATH ?> "fund_transfer?fund_id=" + fundraiser_id;
                    }

                }
            });

        });
    });
</script>


<?php
if (!empty($_REQUEST['fund_id'])) {
    $loadurl = $this->createUrl('fundraise/check_fundtimeline', array('fundraiser_id' => $_REQUEST['fund_id'])); ?>
    <script>
        $(document).ready(function() {

            $.fancybox.open([{
                href: "<?php echo $loadurl; ?>"
                //                    title : '1st title'
            }], {
                maxWidth: 350,
                maxHeight: 165,
                fitToView: false,
                width: '100%',
                height: '100%',
                autoSize: false,
                closeClick: false,
                openEffect: 'none',
                closeEffect: 'none',
                'type': 'iframe',
                helpers: {
                    overlay: {
                        locked: false,
                        closeClick: false
                    }
                }
            });

        });
    </script>
<?php } ?>