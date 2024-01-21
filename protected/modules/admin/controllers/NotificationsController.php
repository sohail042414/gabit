<?php

class NotificationsController extends AdminCoreController {

    /**
     * Do not change Resource Id value, it can cause permissions out of order. 
     */
    public $resource_id = 22;

    /**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
			array(
				'allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('index','admin','view','notificationdetail','notifications','autocomplete'),
				'users'=>array('@'),
				'expression' => ($this->auth->canView($this->resource_id)) ? '1' : '0',
			),
			array(
				'allow',
				'actions'=>array('create','send_notifications_admin','autocomplete'),
				'users'=>array('@'),
				'expression' => ($this->auth->canAdd($this->resource_id)) ? '1' : '0',
			),
			array(
				'allow',
				'actions'=>array('update','send_notifications_admin','autocomplete'),
				'users'=>array('@'),
				'expression' => ($this->auth->canUpdate($this->resource_id)) ? '1' : '0',
			),
			array(
				'allow', 
				'actions'=>array('delete'),
				'users'=>array('admin'),
				'expression' => ($this->auth->canDelete($this->resource_id)) ? '1' : '0',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	public function actionView($id) {

        $model = $this->loadModel($id, 'Notifications');

        if($model->to_admin == 'Y'){
            $model->is_read = 'Y';
            $model->update();
        }

		$this->render('view', array(
			'model' => $model,
		));
	}

	public function actionCreate() {
		$model = new Notifications;


		if (isset($_POST['Notifications'])) {
			$model->setAttributes($_POST['Notifications']);

			if ($model->save()) {
				if (Yii::app()->getRequest()->getIsAjaxRequest()) {
					Yii::app()->end();
				} else {
					Yii::app()->user->setFlash('success', Yii::t("success", $model->label()." has been successfully created."));
					$this->redirect(array('view', 'id' => $model->id));
				}
			}
		}

		$this->render('create', array( 'model' => $model));
	}

	public function actionUpdate($id) {
		$model = $this->loadModel($id, 'Notifications');


		if (isset($_POST['Notifications'])) {
			$model->setAttributes($_POST['Notifications']);

			if ($model->save()) {
				Yii::app()->user->setFlash('success', Yii::t("success", $model->label()." has been successfully updated."));
				$this->redirect(array('view', 'id' => $model->id));
			}
		}

		$this->render('update', array(
				'model' => $model,
				));
	}

	public function actionDelete($id) {
		if (Yii::app()->getRequest()->getIsPostRequest()) {
			$this->loadModel($id, 'Notifications')->delete();

			if (!Yii::app()->getRequest()->getIsAjaxRequest())
				$this->redirect(array('admin'));
		} else
			throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
	}
        
        public function actionNotifications() {
            $model = new Notifications('search');
            
            $model->unsetAttributes();

            if (isset($_GET['Notifications']))
                $model->setAttributes($_GET['Notifications']);

            $this->render('admin', array(
                'model' => $model,
            ));
        }
        
        /*
        public function actionNotifications() {
            $notifications_arr = array();
            $notifications = null;
            
            $notifications = Notifications::model()->findAll(array('condition' => '(from_admin="Y" OR to_admin="Y") AND status="Y"', 'order'=>'id DESC'));
            //p($notifications, 0);
            if(!empty($notifications)) {
                foreach($notifications as $key_n => $val_n) {
                    $unread_notifications_count = NotificationsComment::model()->count(array('condition' => 'notification_id='.$val_n->id.' AND to_admin="Y" AND is_read="N" AND status="Y"'));
                    $notifications_arr[$key_n]['data'] = $val_n->attributes;
                  //  $notifications_arr[$key_n]['count'] = $unread_notifications_count;
                     if($current_user_id == $val_n->to_id && $val_n->is_read == 'N') {
                        $unread_notifications_count = $unread_notifications_count + 1;
                    }
                    $notifications_arr[$key_n]['count'] = $unread_notifications_count;
                }
            }
            //p($notifications_arr);die;
            $this->render('notifications', array(
                    'notifications_arr' => $notifications_arr,
            ));
	    }
        
        */

        public function actionNotificationdetail($id) {

  
            $model = $this->loadModel($id, 'Notifications');

            if($model->to_admin == 'Y'){
                $model->is_read = 'Y';
                $model->update();
            }

            $notification_model = new Notifications();
            $notifications_comment_model = new NotificationsComment();
            
            $unread_notifications = NotificationsComment::model()->findAll(array('condition' => 'notification_id='.$id.' AND to_admin="Y" AND is_read="N" AND status="Y"'));
            if(!empty($unread_notifications)) {
                foreach($unread_notifications as $key_un => $val_un) {
                    $val_un->is_read = 'Y';
                    $val_un->save();
                }
            }
            $unread_notifications_notification = Notifications::model()->findAll(array('condition' => 'id='.$id.' AND to_admin="Y"  AND is_read="N" AND status="Y" '));
            //p($unread_notifications_notification);die;
            if(!empty($unread_notifications_notification)) {
                    foreach($unread_notifications_notification as $key_un1 => $val_un1) {
                        $val_un1->is_read = 'Y';
                        $val_un1->save();
                    }
                }
            $notification_data = Notifications::model()->find(array('condition' => 'id='.$id.' AND status="Y"'));
            $notifications_comments_data = NotificationsComment::model()->findAll(array('condition' => 'notification_id='.$id.' AND status="Y"'));

            $current_user_id = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->id:null;
            //p($notifications_comment_model, 0); p($notification_data, 0); p($notifications_comments_data);
            if(!empty($_POST['NotificationsComment'])) { //#p($_POST['NotificationsComment']);
                $notifications_comment_model->notification_id = $id;
                $notifications_comment_model->comment = $_POST['NotificationsComment']['comment'];
                if($notifications_comment_model->validate()) {
                    $notifications_comment_model->from_id = null;
                    $notifications_comment_model->from_admin = 'Y';
                    $notifications_comment_model->to_id = $current_user_id;
                    $notifications_comment_model->to_admin = 'N';
                    //p($notifications_comment_model);die;
                    $notifications_comment_model->save();
                    Yii::app()->frontUser->setFlash('success', Yii::t("success", "You have successfully send notification."));
                } else {                    
                    Yii::app()->frontUser->setFlash('error', Yii::t("error", "Something went wrong!"));
                }
                $this->redirect(Yii::app()->createUrl('admin/notifications/notificationdetail', array('id' => $id)));
            }
          
            $this->render('notificationdetail', array(
                'notification_model' => $notification_model,
                'notifications_comment_model' => $notifications_comment_model,
                'notification_data' => $notification_data,
                'notifications_comments_data' => $notifications_comments_data
            ));
        }
         public function actionSend_notifications_admin(){
                         
            $send_notification_form = new SendNotificationForm();
            $notification = new Notifications();
            
            $send_all_notification = new SendallNotifications();
            $receiver_id= $_REQUEST['selectedvalue'];
            if(!empty($_POST['SendNotificationForm'])) {

                $send_notification_form->setAttributes($_POST['SendNotificationForm']);
                if($_POST['SendNotificationForm']['is_checked']=='1'){                    
                    $all_receiver = Users::model()->findAll('user_type = "2"');
                }else{
                    $receiver_data = Users::model()->find('id='.$receiver_id);                      
                }
                $id=Yii::app()->user->id;
               // echo $id;die;
                $notification->subject = $send_notification_form->subject;
                $notification->name = $receiver_data->username;
                $notification->email = Null;
                $notification->message = $send_notification_form->message;
                $notification->from_id = null;
                
                if($_POST['SendNotificationForm']['is_checked']=='1'){
                     $notification->to_id = null;
                     $notification->is_sent_to_all="Y";
                }else{
                    $notification->to_id = $receiver_data->id;
                }
                
                //$notification->to_id = $receiver_data->id;
                $notification->from_admin = 'Y';
                $notification->to_admin = 'N';
                $notification->is_read = 'N';
		        $notification->from_type = 'A';
                $notification->to_type = 'L';
                //$notification->to_id = NULL;;
                //p($notification);die;
                if($notification->save(false)) {
                    
                    if($_POST['SendNotificationForm']['is_checked']=='1'){
                        foreach($all_receiver as $val){
                            $send_all_notification = new SendallNotifications();
                            $send_all_notification->user_id= $val->id;
                            $send_all_notification->notification_id= $notification->id;
                            $send_all_notification->is_read = 'N';
                            //p($send_all_notification);die;
                            $send_all_notification->save(false);
                        } 
                    }
                    
                    Yii::app()->user->setFlash('success', Yii::t("success", "You have successfully send notification."));
                  //  $this->redirect(Yii::app()->createUrl('notifications/send_notifications_admin'));
                    $this->redirect(Yii::app()->createUrl('admin/notifications/send_notifications_admin'));
                } else {
                    // echo '<pre>';
                    // print_r($notification->errors);
                    // exit; 
                    Yii::app()->user->setFlash('error', Yii::t("error", "Something went wrong!"));
                }
            }

            $this->render('send_notification', array(
                'send_notification_form' => $send_notification_form
            ));
        }
         
        public function actionAutocomplete($term){
            $term=$_GET['term'];
//            $query = Users::model()->findAll( 'username LIKE :match',
//                    array(':match' => "%$term%"));
//            
//            
            $limit = 15;
            $criteria = new CDbCriteria;
            $criteria->condition = "username LIKE :match";
            $criteria->params = array(":match"=>"%$term%");
            $criteria->limit = $limit;
            $query = Users::model()->findAll($criteria);
            
            
            $list = array();        
            foreach($query as $q){
                $data['value']= $q['id'];
                $data['label']= $q['username'];

                $list[]= $data;
                unset($data);
            }

            echo json_encode($list);
        }
        
        public function actionTest(){
            $_GET['term']='aj';
            $match = $_GET['term'];
            $query = Users::model()->findAll( 'username LIKE :match',
                    array(':match' => "%$match%"));
            p($query);die;
      }
}


