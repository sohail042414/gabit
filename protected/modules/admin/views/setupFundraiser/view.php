<div class="col-lg-12">
    <section class="panel">
        <header class="panel-heading">
            <?php echo Yii::t('app', 'View') . ' ' . GxHtml::encode($model->label(1)) ?>
            <?php
            $this->breadcrumbs = array(
                $model->label(2) => array('admin'),
                GxHtml::valueEx($model),
            );

            $this->widget('CoreCBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'htmlOptions' => array('class' => 'breadcrumb')
            ));

            ?>
        </header>

        <div class="panel-body">
            <div class="box-header">
                <?php
                $this->widget('CoreButtonCMenu', array(
                    'encodeLabel' => false,
                    'items' => array(
                        array('label' => Yii::t('app', 'Create') . ' ' . $model->label(), 'url' => array('create')),
                        array('label' => Yii::t('app', 'Update') . ' ' . $model->label(), 'url' => array('update', 'id' => $model->id)),
                        array('label' => Yii::t('app', 'Delete') . ' ' . $model->label(), 'url' => '#', 'linkOptions' => array('submit' => array('delete', 'id' => $model->id), 'confirm' => 'Are you sure you want to delete this item?')),
                        array('label' => Yii::t('app', 'Manage') . ' ' . $model->label(2), 'url' => array('admin'))
                    ),
                ));
                ?>
            </div>
            <div class="clear"></div>
            <div class="box-body table-responsive view_page">
                <div class="row">
                    <div class="col-md-12">
                        <?php echo UtilityHtml::get_flash_message(); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <?php $this->widget('CoreCDetailView', array(
                            'data' => $model,
                            'attributes' => array(
                                array(
                                    'name' => 'id',
                                    'type' => 'raw',
                                    'label' => 'ID/Case No',
                                    'value' => $model->id,
                                ),
                                'fundraiser_title',
                                array(
                                    'name' => 'ftype',
                                    'type' => 'raw',
                                    'value' => $model->ftype
                                ),
                                array(
                                    'name' => 'status',
                                    'type' => 'raw',
                                    'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                                    'value' => UtilityHtml::getStatusImage($model->status, 'view'),
                                ),
                                array(
                                    'name' => 'search_yes',
                                    'type' => 'raw',
                                    'label' => 'Search Status',
                                    'value' => UtilityHtml::getStatusImage($model->search_yes, 'view'),
                                ),
                                'fundr_timeline_from',
                                'fundr_timeline_to'
                            )
                        ));
                        ?>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <?php $this->widget('CoreCDetailView', array(
                            'data' => $model,
                            'attributes' => array(
                                'fundriser_goal_amount',
                                array(
                                    'label' => 'Total Donation',
                                    'type' => 'raw',
                                    'value' => number_format(Fundraiser::model()->getDonationAmount($model->id), 2),
                                ),
                                array(
                                    'label' => 'Total Payout',
                                    'type' => 'raw',
                                    'value' => number_format(Fundraiser::model()->getTotalPayout($model->id), 2),
                                ),
                                array(
                                    'label' => 'Balance',
                                    'type' => 'raw',
                                    'value' => number_format(Fundraiser::model()->getBalance($model->id), 2),
                                ),
                                array(
                                    'name' => 'reward_program',
                                    'type' => 'raw',
                                    'label' => 'TRDP subscribed',
                                    'value' => UtilityHtml::getStatusImage($model->reward_program, 'view'),
                                ),
                                'comments_count',
                                'social_shares_count',
                            )
                        ));
                        ?>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-3 col-lg-3">
                        <p><strong> Fundraiser Image</strong> &nbsp; <a href="<?php echo Yii::app()->createUrl('/admin/SetupFundraiser/download',array('fundraiser'=>$model->id,'img' => 'f_image')); ?>" style="text-decoration:underline;">Download</a></p>
                        <?php echo UtilityHtml::get_fundraiser_full_image_from_path($model->uplod_fun_img,"admin-full-image"); ?>
                    </div>
                    <div class="col-md-9 col-lg-8">
                        <?php $this->widget('CoreCDetailView', array(
                            'data' => $model,
                            'attributes' => array(
                                array(
                                    'name' => 'tell_ur_fund_story',
                                    'type' => 'raw',
                                    'label' => 'Full Story',
                                    'value' => $model->tell_ur_fund_story
                                ),
                                array(
                                    'name' => 'fund_can_achiv',
                                    'type' => 'raw',
                                    'label' => 'Fundraiser Can Achieve',
                                    'value' => $model->fund_can_achiv
                                ),
                            ),
                        ));
                        ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <?php $benif_image_download = !empty($model->uplod_pic_benif) ? '<a href="'.Yii::app()->createUrl("/admin/SetupFundraiser/download", array("fundraiser" =>$model->id, "img" => "benif_image")).'" style="text-decoration:underline;">Download</a> <br>':''; ?>
                        <?php $benif_bg_image_download = !empty($model->uplod_benif_bg) ?  '<a href="'.Yii::app()->createUrl("/admin/SetupFundraiser/download", array("fundraiser" =>$model->id, "img" => "benif_bg_image")).'" style="text-decoration:underline;">Download</a> <br>' : ''; ?>
                        <?php $this->widget('CoreCDetailView', array(
                            'data' => $model,
                            'attributes' => array(
                                'benifiry_name',
                                'benifi_age',
                                'benifi_sex',
                                'benifi_email',
                                array(
                                    'name' => 'uplod_pic_benif',
                                    'type' => 'raw',
                                    'label' => 'Beneficiary Image',
                                    'value' => $benif_image_download.UtilityHtml::get_image_from_path(SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $model->uplod_pic_benif, 'admin-full-image'),
                                ),
                                array(
                                    'name' => 'uplod_benif_bg',
                                    'type' => 'html',
                                    'label' => 'Beneficiary Background Image',
                                    'value' => $benif_bg_image_download.UtilityHtml::get_image_from_path(SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $model->uplod_benif_bg, 'admin-full-image'),
                                ),
                            ),
                        )); ?>
                    </div>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <?php $lead_image_download = !empty($model->uplod_pic_lead_supptr) ? '<a href="'.Yii::app()->createUrl("/admin/SetupFundraiser/download", array("fundraiser" =>$model->id, "img" => "lead_image")).'" style="text-decoration:underline;">Download</a> <br>':''; ?>
                        <?php $this->widget('CoreCDetailView', array(
                            'data' => $model,
                            'attributes' => array(
                                'lead_supptr_name',
                                'lead_supptr_email',
                                'lead_supptr_phone',
                                'lead_supptr_sex',
                                'lead_supptr_age',
                                array(
                                    'name' => 'lead_supptr_relationshp',
                                    'value' => $model->lead_supporter_relation->relationship_type,
                                ),
                                array(
                                    'name' => 'uplod_pic_lead_supptr',
                                    'type' => 'html',
                                    'label' => 'Lead Supporter Image',
                                    'value' => $lead_image_download.UtilityHtml::get_image_from_path(SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $model->uplod_pic_lead_supptr, 'admin-full-image'),
                                ),
                            ),
                        )); ?>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <?php $fund_manager_image_download = !empty($model->upload_pic_fun_manager) ? '<a href="'.Yii::app()->createUrl("/admin/SetupFundraiser/download", array("fundraiser" =>$model->id, "img" => "manager_image")).'" style="text-decoration:underline;">Download</a> <br>':''; ?>
                        <?php $this->widget('CoreCDetailView', array(
                            'data' => $model,
                            'attributes' => array(
                                'fund_mange_name',
                                'fund_mange_email',
                                'fund_manager_phone',
                                'fund_mange_sex',
                                'fund_mange_age',
                                array(
                                    'name' => 'fund_mange_relationshp',
                                    'value' => $model->fund_mange_relation->relationship_type,
                                ),
                                array(
                                    'name' => 'upload_pic_fun_manager',
                                    'type' => 'html',
                                    'label' => 'Fund Manager Image',
                                    'value' => $fund_manager_image_download.UtilityHtml::get_image_from_path(SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $model->upload_pic_fun_manager, 'admin-full-image'),
                                ),
                                
                            ),
                        )); ?>
                    </div>
                    <?php if(!empty($model->project_champion)){ ?>
                    <div class="col-md-6 col-lg-6 col-sm-12">
                        <?php $this->widget('CoreCDetailView', array(
                            'data' => $model,
                            'attributes' => array(
                                'project_champion',
                                'project_champion_name',
                                'champion_logo',
                                'champion_bg_image',
                            ),
                        )); ?>
                    </div>
                    <?php } ?>
                </div>
            </div>
            <div class="row" style="display:none;">
                <div class="col-md-6 col-lg-6 col-sm-12">
                        <?php $this->widget('CoreCDetailView', array(
                            'data' => $model,
                            'attributes' => array(
                                'id',
                                array(
                                    'name' => 'ftype',
                                    'type' => 'raw',
                                    'value' => $model->ftype
                                ),
                                'fundraiser_title',
                                array(
                                    'label' => 'Total Donation',
                                    'type' => 'raw',
                                    'value' => number_format(Fundraiser::model()->getDonationAmount($model->id), 2),
                                ),
                                array(
                                    'label' => 'Total Payout',
                                    'type' => 'raw',
                                    'value' => number_format(Fundraiser::model()->getTotalPayout($model->id), 2),
                                ),
                                array(
                                    'label' => 'Balance',
                                    'type' => 'raw',
                                    'value' => number_format(Fundraiser::model()->getBalance($model->id), 2),
                                ),
                                array(
                                    'name' => 'search_status',
                                    'type' => 'raw',
                                    'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                                    'value' => UtilityHtml::getStatusImage($model->status, 'view'),
                                ),
                                array(
                                    'name' => 'uplod_fun_img',
                                    'type' => 'html',
                                    'filter' => '',
                                    'value' => UtilityHtml::get_image_from_path(SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $model->uplod_fun_img, 'view_page_profile_picture'),
                                ),
                                'fundraiser_description',
                                'benifiry_name',
                                'benifi_age',
                                'benifi_sex',
                                'benifi_email',
                                array(
                                    'name' => 'uplod_pic_benif',
                                    'type' => 'html',
                                    'label' => 'Beneficiary Image',
                                    'filter' => '',
                                    'value' => UtilityHtml::get_image_from_path(SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $model->uplod_pic_benif, 'view_page_profile_picture'),
                                ),
                                array(
                                    'name' => 'uplod_benif_bg',
                                    'type' => 'html',
                                    'label' => 'Beneficiary Background Image',
                                    'filter' => '',
                                    'value' => UtilityHtml::get_image_from_path(SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $model->uplod_benif_bg, 'view_page_profile_picture'),
                                ),
                                'lead_supptr_name',
                                'lead_supptr_email',
                                'lead_supptr_phone',
                                'lead_supptr_sex',
                                'lead_supptr_age',
                                'lead_supptr_relationshp',
                                array(
                                    'name' => 'uplod_pic_lead_supptr',
                                    'type' => 'html',
                                    'label' => 'Lead Supporter Image',
                                    'filter' => '',
                                    'value' => UtilityHtml::get_image_from_path(SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $model->uplod_benif_bg, 'uplod_pic_lead_supptr'),
                                ),
                                'fund_mange_name',
                                'fund_mange_email',
                                'fund_mange_phone',
                                'fund_mange_sex',
                                'fund_mange_age',
                                'fund_mange_relationshp',
                                'fundraiser_goal',
                                'fundraiser_amount_need',
                                'fundraiser_timeline',
                                'use_of_funds',
                                'funds_achieve',
                                array(
                                    'name' => 'feature_flag',
                                    'type' => 'raw',
                                    'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                                    'value' => UtilityHtml::getStatusImage($model->feature_flag, 'view'),
                                ),
                                array(
                                    'name' => 'status',
                                    'type' => 'raw',
                                    'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                                    'value' => UtilityHtml::getStatusImage($model->status, 'view'),
                                ),
                                array(
                                    'name' => 'status',
                                    'type' => 'raw',
                                    'filter' => array('Y' => 'Active', 'N' => 'Inactive'),
                                    'value' => UtilityHtml::getStatusImage($model->status, 'view'),
                                ),
                                'comments_count',
                                'social_shares_count',
                            ),
                        )); ?>
                    </div>
            </div>
            <div class="clear"></div>
            <?php if (count($model->corporates) > 0) { ?>
                <div class="dataTables_wrapper form-responsive">
                    <h2>Corporate Supporters</h2>
                    <table class="display table table-bordered table-striped dataTable">
                        <thead>
                            <tr>
                                <th id="donations-grid_c0">Corporate Logo</th>
                                <th id="donations-grid_c0">Corporate Name</th>
                                <th id="donations-grid_c0">Website</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php foreach ($model->corporates as $corporate) { ?>
                                <tr>
                                    <td><?php echo UtilityHtml::get_corporate_supporter_thumb($corporate->supporter->image, "display_facebook_img"); ?></td>
                                    <td><?php echo $corporate->supporter->name; ?></td>
                                    <td><?php echo $corporate->supporter->website_url; ?></td>
                                </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            <?php } ?>
        </div>
    </section>
</div>
<style>
    .admin-full-image{
        width:100%;
        height: auto;        
    }
</style>