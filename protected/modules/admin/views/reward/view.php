<div class="col-sm-12">
    <section class="panel">

        <header class="panel-heading">
            <?php echo Yii::t('app', 'Reward Points Details for User '.$user->username); ?>
            <?php
            $this->breadcrumbs = array(
                'Rewards' => array('admin'),
                Yii::t('app', 'Manage'),
            );

            $this->widget('CoreCBreadcrumbs', array(
                'links' => $this->breadcrumbs,
                'htmlOptions' => array('class' => 'breadcrumb')
            ));

            ?>
        </header>
        <div class="panel-body">
            <div class="box-header">            
            </div>

            <div class="clear"></div>
            <div class="dataTables_wrapper form-inline">
                <div class="row">
                    <div class="col-md-4">
                        <img class="preview_image" src="<?php echo !empty($user->user_image) ? SITE_ABS_PATH_USER_IMAGE_THUMB.$user->user_image : SITE_ABS_PATH."images/no-photo.jpeg"; ?>" alt="" />
                    </div>
                    <div class="col-md-8">
                        <?php             
                        $this->widget('CoreCDetailView', array(
                            'data' => $user,
                            'attributes' => array(
                                'username',
                                'phone',
                                'email',
                            ),
                        )); 
                        ?>
                        <table class="display table table-bordered table-striped dataTable">
                            <thead>
                                <tr>
                                <th>Total no. of Actions</th>
                                <th>No. of Donations</th>
                                <th>Total Donation</th>
                                <th>No. of Fundraisers Supported</th>                                
                                <th>Cumulative Points</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo $model->getMonthlyActionsCount($user->id,$month,$year); ?></td>
                                <td>                                    
                                    <?php //echo Donations::model()->getUserCurrentMonthDonationsCount($user->id); ?>
                                    <?php echo Donations::model()->getUserCurrentMonthDonationsCount($user->id); ?>
                                </td>
                                <td>
                                    <?php //echo $model->getActivityTotalPoints($user->id,$month,$year,'donation'); ?>
                                    <?php echo Donations::model()->getUserCurrentMonthTotalDonation($user->id); ?>
                                </td>
                                <td><?php echo $model->getMonthlyActivityCount('supporter',$user->id,$month,$year); ?></td>                                
                                <td><?php echo $model->getUserMonthlyTotalPoints($user->id,$month,$year); ?></td>
                            </tr>
                            </tbody>
                        </table>  

                        <table class="display table table-bordered table-striped dataTable" style="margin-top:20px;">
                            <thead>
                                <tr>
                                <th>Donor Referral Code</th>
                                <th>No. of Code Entries</th>
                                <th>Comments Points Total</th>
                                <th>Referral Cumulative Points</th>
                                </tr>
                            </thead>
                            <tbody>
                            <tr>
                                <td><?php echo $user->referral_code; ?></td>
                                <td><?php echo (int)$user->getReferralCount(); ?></td>
                                <td><?php echo $model->getCommentPoints($user->id); ?></td>
                                <td><?php echo (int)$user->getReferralCount()*1000; ?></td>
                            </tr>
                            </tbody>
                        </table>  

                    </div>                          
                </div> 
                <div class="row">
                    <div class="col-md-6">
                        <h3>Activity Chart</h3>
                        <?php 
                            $this->widget('CoreCGridView', array(
                                'id'=>'reward-points-grid',
                                'dataProvider'=>$pointsDetails,
                                'columns'=>array(
                                    array(
                                        'value' => '$data["title"]',
                                        'header' =>'Activity',
                                    ),
                                    array(
                                        'value' => '$data["points"]',
                                        'header' =>'Points',
                                    ),
                                    array(
                                        'value' => '$data["count"]',
                                        'header' =>'Total Number of actions',
                                    )
                                ),
                            )); 
                        ?> 
                    </div>
                    <div class="col-md-6">
                        <h3>Action History</h3>
                        <?php                 
                            $this->widget('CoreCGridView', array(
                                'id'=>'reward-points-grid',
                                'dataProvider'=>$actionDataProvider,
                                'columns'=>array(
                                    //'user_id',
                                    //'month',
                                    //'year',
                                    array(
                                        'value' => '$data->activity_title',
                                        'header' =>'Action',
                                    ),
                                    'points',
                                    array(
                                        'value' => '$data->created_at',
                                        'header' =>'Date/Time',
                                    ),
                                ),
                            ));                 
                        ?>
                    </div>
                </div>
            </div>        
        </div>
    </section>
</div>