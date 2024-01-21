<?php
/**
 * This library manages permissions for logged in user in admin pannel. 
 * 
 * Following are list of resources
 * It must be mapped same in table, resources. (without controller name), order is how it appears in left menu on admin side. 
 * 
 * resource_id |             name       |          controller
 * 0           | Dashboard              |       DashboardController
 * 1           | Users                  |       UsersController
 * 2           | Dropdowns              |       AffiliatesController
 * 3           | CMS                    |       CmsController
 * 4           | Fundraisers            |       SetupFundraiserController
 * 5           | Fundraiser Reports     |       ReportFundraiserController
 * 6           | Event Invitations      |       EventinvitationController
 * 7           | Blog/Posts             |       PostController
 * 8           | Banners/Popups         |       BannersController
 * 9           | Fundraiser Categories  |       FundraiserTypeController
 * 10          | Fundraiser Types       |       SubtypeController
 * 11          | Fundraiser Supporters  |       SupporterController
 * 12          | Fundraiser Comment     |       FundraiserCommentController
 * 13          | Donations              |       DonationsController
 * 14          | Fund Manager Accounts  |       AccountController
 * 15          | Partners               |       PatnerController
 * 16          | Email Templates        |       AdminCoreController
 * 17          | Home Slider Manager    |       HomeSliderController
 * 18          | Admin Topics           |       TopicController
 * 19          | Questions              |       FundraiserQuestionsController
 * 20          | Testimonials           |       TestimonialController
 * 21          | User Testimonials      |       TestimonialmessgController
 * 22          | Notifications          |       NotificationsController
 * 23          | Manage Administrators  |       AdministratorsController
 * 24          | Groups                 |       GroupsController
 * 25          | News Letter            |       NewsletterController
 * 26          | Settings               |       SettingsController
 * 27          | Resources              |       ResourcesController
 * 28          | Rewards                |       RewardController
 * 29          | Donors                 |       DonorsController
 * 30          | Corporate Supporters   |       CorporateSupportersController
 * 
  */
class Auth {

    public $permissions = array(
        'view' => array(),
        'add' => array(),
        'update' => array(),
        'delete' => array(),
    );
    
    public $user = NULL;


    public function __construct() {

        if (!Yii::app()->user->isGuest) {
            $this->user = Users::model()->findByPk(Yii::app()->user->id);
        }
        
        $this->setPermissions();
    }

    private function setPermissions() {

        if ($this->user != NULL) {

            $permissions = Permissions::model()->findAll(array('condition' => 'group_id= :group_id','params' => array('group_id' => $this->user->group_id)));

            foreach ($permissions as $model) {

                if ($model->can_view) {
                    $this->permissions['view'][] = $model->resource_id;
                }

                if ($model->can_add) {
                    $this->permissions['add'][] = $model->resource_id;
                }

                if ($model->can_update) {
                    $this->permissions['update'][] = $model->resource_id;
                }

                if ($model->can_delete) {
                    $this->permissions['delete'][] = $model->resource_id;
                }
            }
        }

    }

    /**
     * Checks if user can view a resource , also used in layouts to show menus, if list (comma seprated values) are passed, it will return true if any of resource is allowed to user for view. 
     * @param type $resource
     * @return boolean
     */
    public function canView($resource) {

        //if not logged
        if ($this->user == NULL) {
            return FALSE;
        }

        if ($this->user->role == 'super_user') {
            return TRUE;
        }

        $resources = $this->formatResource($resource);

        // Check if user can view any of the provided resource ids. return true. 

        foreach ($resources as $resource_id) {

            if (in_array($resource_id, $this->permissions['view'])) {

                return TRUE;
            }
        }

        return FALSE;
    }

    
    public function canAdd($resource) {

        if ($this->user == NULL) {
            return FALSE;
        }

        if ($this->user->role =='super_user') {
            return TRUE;
        }

        if (in_array($resource, $this->permissions['add'])) {
            return TRUE;
        }

        return FALSE;
    }

    public function canUpdate($resource) {

        if ($this->user == NULL) {
            return FALSE;
        }

        if ($this->user->role =='super_user') {
            return TRUE;
        }

        if (in_array($resource, $this->permissions['update'])) {
            return TRUE;
        }

        return FALSE;
    }

    public function canDelete($resource) {

        if ($this->user == NULL) {
            return FALSE;
        }

        if ($this->user->role == 'super_user') {
            return TRUE;
        }

        if (in_array($resource, $this->permissions['delete'])) {
            return TRUE;
        }

        return FALSE;
    }

    private function formatResource($resource) {
        return explode(',', $resource);
    }

}
