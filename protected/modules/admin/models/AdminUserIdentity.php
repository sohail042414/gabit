<?php

class AdminUserIdentity extends CUserIdentity
{

    public $permissions = array(
        'view' => array(),
        'add' => array(),
        'update' => array(),
        'delete' => array(),
    );
    
    public $user = NULL;

    // public function __construct() {

    //     if (!Yii::app()->user->isGuest) {
    //         $this->user = Users::model()->findByPk(Yii::app()->user->id);
    //     }
        
    //     $this->setPermissions();
    // }

    public function authenticate()
    {

        $model = Users::model()->find("username = :username OR email = :username", array(':username' => $this->username));
        if (empty($model)) {
            $this->errorCode = self::ERROR_USERNAME_INVALID;
            return false;
        }

        if ($model->password != md5($this->password)) {
            $this->errorCode = self::ERROR_PASSWORD_INVALID;
            return false;
        } 

        Yii::app()->user->setState('id', $model->id);
        Yii::app()->user->setState('username', $model->username);
        Yii::app()->user->setState('role', $model->role);

        $this->errorCode = self::ERROR_NONE;
        
        return true;
    }


    private function setPermissions() {

        if ($this->user != NULL) {

            $groupPermissions = Permissions::model()->findAll(array('condition' => '"group_id"=' . $this->user->group_id));

            foreach ($groupPermissions as $model) {

                if ($model->View) {
                    $this->permissions['view'][] = $model->ModuleId;
                }

                if ($model->Add) {
                    $this->permissions['add'][] = $model->ModuleId;
                }

                if ($model->Update) {
                    $this->permissions['update'][] = $model->ModuleId;
                }

                if ($model->Delete) {
                    $this->permissions['delete'][] = $model->ModuleId;
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