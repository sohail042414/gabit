<?php
$question = FundraiserQuestions::model()->count(array('select' => '*', 'condition' => 'notify_status = "N" '));
$testmonial12 = Testimonial::model()->count(array('select' => '*', 'condition' => 'status = "N" '));
if(!empty($testmonial12)) {
    $testmonial = '<span class="badge bg-important">'.$testmonial12.'</span>';
}


$notification_count = UtilityHtml::get_notification_count_for_admin();

$notification_count = Notifications::model()->count(array('condition' => 'to_admin="Y" AND is_read="N" AND status="Y"'));
$notification_count_txt = '';
if((int) $notification_count > 0) {
    $notification_count_txt = '<span class="badge bg-important">'.$notification_count.'</span>';
}

$new_user_count = Users::model()->count("status_new = 'Y' AND role='fundraiser'");
$new_user_badge = '';
if((int)$new_user_count > 0){
    $new_user_badge = '<span class="badge bg-important">'.$new_user_count.'</span>';
}

$new_donors_count = Users::model()->count("status_new = 'Y' AND role='donor'");
$new_donors_badge = '';
if((int)$new_donors_count > 0){
    $new_donors_badge = '<span class="badge bg-important">'.$new_donors_count.'</span>';
}

$new_fundraiser_count = Fundraiser::model()->count("status_new = 'Y'");
$new_fundraiser_badge = '';
if((int)$new_fundraiser_count > 0){
    $new_fundraiser_badge = '<span class="badge bg-important">'.$new_fundraiser_count.'</span>';
}


$new_events_count = EventInvitation::model()->count("status_new = 'Y'");
$new_events_badge = '';
if((int)$new_events_count > 0){
    $new_events_badge = '<span class="badge bg-important">'.$new_events_count.'</span>';
}

$report_fundraiser_count = ReportFundraiser::model()->count("status = 'N'");
$report_fundraiser_badge = '';
if((int)$report_fundraiser_count > 0){
    $report_fundraiser_badge = '<span class="badge bg-important">'.$report_fundraiser_count.'</span>';
}

$new_supporter_count = Supporter::model()->count("status_new = 'Y'");
$supporter_badge = '';
if((int)$new_supporter_count > 0){
    $supporter_badge = '<span class="badge bg-important">'.$new_supporter_count.'</span>';
}

//$new_comments_count = Comment::model()->count("status_new = 'Y'");
$new_comments_badge = '';
// if((int)$new_comments_count > 0){
//     $new_comments_badge = '<span class="badge bg-important">'.$new_comments_count.'</span>';
// }

$new_donations_count = Donations::model()->count("status_new = 'Y'");
$donations_badge = '';
if((int)$new_donations_count > 0){
    $donations_badge = '<span class="badge bg-important">'.$new_donations_count.'</span>';
}

$new_fund_transfer_count = FundtransferByuser::model()->count("status_new = 'Y'");
$fund_transfer_badge = '';
if((int)$new_fund_transfer_count > 0){
    $fund_transfer_badge = '<span class="badge bg-important">'.$new_fund_transfer_count.'</span>';
}




?>
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <?php
            $this->widget('CoreCMenu', array(
                'encodeLabel' => false,
                'items' => array(
                    array(
                        'label' => '<i class="fa fa-dashboard"></i> <span>Dashboard</span>', 
                        'url' => array('dashboard/index'),
                        'resource_id' => '0',
                    ),
                    array(
                        'label' => '<i class="fa fa-comments"></i> <span>Donations '.$donations_badge.'</span>', 
                        'url' => array('donations/admin'),
                        'resource_id' => '13',
                    ),
                    array(
                        'label' => '<i class="fa fa-user"></i> <span> Fund Transfer Requests '.$fund_transfer_badge.'</span>', 
                        'url' => array('account/admin'),
                        'resource_id' => '14',
                    ),
                    array('label' => '<i class="fa fa-line"></i> <span>____________________</span>', 'url' => ''),
                    array(
                        'label' => '<i class="fa fa-user"></i> <span>Manage Users '.$new_user_badge.'</span>', 
                        'url' => array('users/admin'),
                        'resource_id' => '1',
                    ),
                    array(
                        'label' => '<i class="fa fa-user"></i> <span>Manage Administrators </span>', 
                        'url' => array('administrators/admin'),
                        'resource_id' => '23',
                    ),
                    array(
                        'label' => '<i class="fa fa-user"></i> <span>Manage Donors '.$new_donors_badge.'</span>', 
                        'url' => array('donors/admin'),
                        'resource_id' => '23',
                    ),
                    /*
                    array(
                        'label' => '<i class="fa fa-user"></i> <span>Manage Groups </span>', 
                        'url' => array('groups/admin'),
                        'resource_id' => '24',
                    ),
                    array(
                        'label' => '<i class="fa fa-user"></i> <span>Manage Resources </span>', 
                        'url' => array('resources/admin'),
                        'resource_id' => '25',
                    ),
                    */
                    array(
                        'label' => '<i class="fa fa-user"></i> <span>Manage Dropdowns</span>', 
                        'url' => array('affiliates/admin'),
                        'resource_id' => '2',
                    ),
                    array(
                        'label' => '<i class="fa fa-th"></i> <span>Manage Content Page</span>', 
                        'url' => array('cms/admin'),
                        'resource_id' => '3',
                    ),
                    array(
                        'label' => '<i class="fa fa-money"></i> <span>Manage Fundraiser '.$new_fundraiser_badge.'</span>', 
                        'url' => array('SetupFundraiser/admin'),
                        'resource_id' => '4',
                    ),
                    array(
                        'label' => '<i class="fa fa-money"></i> <span>Manage Rewards</span>', 
                        'url' => array('reward/admin'),
                        'resource_id' => '28',
                    ),
                    array(
                        'label' => '<i class="fa fa-comment"></i> <span>Manage Report Fundraiser '.$report_fundraiser_badge.'</span>', 
                        'url' => array('reportFundraiser/admin'),
                        'resource_id' => '5',
                    ),
                    array(
                        'label' => '<i class="fa fa-comment"></i> <span>Manage Events '.$new_events_badge.'</span>', 
                        'url' => array('eventinvitation/admin'),
                        'resource_id' => '6',
                    ),
                    array(
                        'label' => '<i class="fa fa-comment"></i> <span>Manage Success Stories</span>', 
                        'url' => array('post/admin'),
                        'resource_id' => '7',
                    ),
                    array(
                        'label' => '<i class="fa fa-comment"></i> <span>Manage Popups</span>', 
                        'url' => array('banners/admin'),
                        'resource_id' => '8',
                    ),
                    array('label' => '<i class="fa fa-line"></i> <span>____________________</span>', 'url' => ''),

                    array(
                        'label' => '<i class="fa fa-life-ring"></i> <span>Fundraiser Categories</span>', 
                        'url' => array('fundraiserType/admin'),
                        'resource_id' => '9',
                    ),
                    array(
                        'label' => '<i class="fa fa-life-ring"></i> <span>Fundraiser Types</span>', 
                        'url' => array('Subtype/admin'),
                        'resource_id' => '10',
                    ),
                    array(
                        'label' => '<i class="fa fa-life-ring"></i> <span>Fundraiser Supporters '.$supporter_badge.'</span>', 
                        'url' => array('supporter/admin'),
                        'resource_id' => '11',
                    ),
                    array(
                        'label' => '<i class="fa fa-comments"></i> <span>Fundraisers Comment '.$new_comments_badge.'</span>', 
                        'url' => array('FundraiserComment/admin'),
                        'resource_id' => '12',
                    ),
                    array('label' => '<i class="fa fa-line"></i> <span>____________________</span>', 'url' => ''),

                    array(
                        'label' => '<i class="fa fa-square"></i> <span>Corporate Supporters</span>', 
                        'url' => array('CorporateSupporters/admin'),
                        'resource_id' => '30',
                    ),
                    array(
                        'label' => '<i class="fa fa-square"></i> <span>Partners</span>', 
                        'url' => array('patner/admin'),
                        'resource_id' => '15',
                    ),
                    array(
                        'label' => '<i class="fa fa-envelope"></i> <span>Email Templates</span>', 
                        'url' => array('emailTemplates/admin'),
                        'resource_id' => '16',
                    ),
                    array(
                        'label' => '<i class="fa fa-sliders"></i> <span>Home Slider Manager</span>', 
                        'url' => array('HomeSlider/admin'),
                        'resource_id' => '17',
                    ),
                    array(
                        'label' => '<i class="fa fa-stack-exchange"></i> <span>Admin Topics</span>', 
                        'url' => array('topic/admin'),
                        'resource_id' => '18',
                    ),
                    array(
                        'label' => '<i class="fa fa-question-circle"></i><span>Questions <span class="badge bg-important">'.$question.'</span>'.'</span>', 
                        'url' => array('FundraiserQuestions/admin'),
                        'resource_id' => '19',
                    ),
                    array('label' => '<i class="fa fa-line"></i> <span>____________________</span>', 'url' => ''),
                    
                    array(
                        'label' => '<i class="fa fa-comments"></i> <span>Testimonial'.$testmonial.'</span>', 
                        'url' => array('testimonial/admin'),
                        'resource_id' => '20',
                    ),
                    array(
                        'label' => '<i class="fa fa-comments"></i> <span>User Testimonial</span>', 
                        'url' => array('testimonialmessg/admin'),
                        'resource_id' => '21',
                    ),
                    array(
                        'label' => '<i class="fa fa-bell"></i><span>Notifications '.$notification_count_txt.'</span>', 
                        'url' => array('notifications/notifications'),
                        'resource_id' => '22',
                    ),
                    array(
                        'label' => '<i class="fa fa-book"></i><span>News and Updates </span>', 
                        'url' => array('newsUpdates/admin'),
                        'resource_id' => '22',
                    ),
                    array('label' => '<i class="fa fa-line"></i> <span>____________________</span>', 'url' => ''),

                    array(
                        'label' => '<i class="fa fa-user"></i> <span>Newsletter</span>', 
                        'url' => array('newsletter/admin'),
                        'resource_id' => '26',
                    ),
                    array(
                        'label' => '<i class="fa fa-lock"></i> <span>Settings</span>', 
                        'url' => array('settings/update/id/1'),
                        'resource_id' => '27',
                    ),
                    array(
                        'label' => '<i class="fa fa-lock"></i> <span>Logout</span>', 
                        'url' => array('dashboard/logout'),
                        'resource_id' => '0',
                    ),
                ),
            ));
            ?>
        </div>
    </div>
</aside>
