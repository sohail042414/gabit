<?php

class UsersController extends ApiCoreController {

//    public function actionLogin()
//    {
//        echo 'hi';
//        die;
//        $response = array();
//        if (!empty($user_id)) {
//            $model_fb = FbLogin::model()->findByPk($user_id);
//            $model_fb->last_active_date = date('Y-m-d', time());
//            $model_fb->save(false);
//
//            $response['success'] = '1';
//            $response['message'] = 'user updated successfully.';
//        } else {
//            $response['success'] = '0';
//            $response['message'] = 'Invalid parameter passed.';
//        }
//
//        echo json_encode($response);
//        exit;
//    }

    public function actionLogin() {
        $response = array();
        $data = (file_get_contents("php://input"));
        //{"data":{"user_type":"1","username":"admin","password":"admin"}}
        parse_str($data);
        $request_object = json_decode($data);
        $request_array = $this->objectToArray($request_object);

        //p($request_array['data']->device_token);
        //p($request_object);

        $device_token = $request_array['data']->device_token;
        $device_type = $request_array['data']->device_type;

        if (!empty($request_array['data']->username) && !empty($request_array['data']->password)) {

            $model_login = Users::model()->findByAttributes(array('username' => $request_array['data']->username, 'password' => md5($request_array['data']->password), 'user_type' => $request_array['data']->user_type));

            /* echo "Ketan<pre>";
              print_r($model_login['id']);
              print_r($model_login->attributes);
              echo "</pre>";
              die(); */

            $user_id = $model_login['id'];

            if (!empty($model_login)) {
                if ($model_login->status == 'Y') {

                    $user_device_info = UserDeviceInfo::model()->findAll("user_id = '" . $user_id . "' AND device_token = '" . $device_token . "' AND device_type = '" . $device_type . "' ");

                    if (empty($user_device_info)) {
                        //$user_device_info = new UserDevicesInformations();
                        $user_device_info = new UserDeviceInfo();
                        $user_device_info->user_id = $user_id;
                        $user_device_info->device_token = $device_token;
                        $user_device_info->device_type = $device_type;
                        $user_device_info->save(false);
                    }

                    $response['success'] = "1";
                    $response['message'] = 'login successfully';
                    $response['data'] = $model_login->attributes;
                } else {
                    $response['success'] = '0';
                    $response['message'] = 'Your account id not active, please contact admin';
                }
            } else {
                $response['success'] = '0';
                $response['message'] = 'Invalid username or password, please try again later.';
            }
        } else {
            $response['success'] = '0';
            $response['message'] = 'Invalid parameter passed.';
        }

        echo json_encode($response);
        exit();
    }

    public function actionaddEvent() {
        $response = array();
        $data = (file_get_contents("php://input"));
        parse_str($data);
        $request_object = json_decode($data);
        $request_array = $this->objectToArray($request_object);

        if (!empty($request_array['data']->user_id) && !empty($request_array['data']->event_name)) {
            $get_name = Users::model()->findByPk($request_array['data']->user_id);
            if (!empty($get_name)) {
                $meeting_data = new Meeting();
                $meeting_data->user_id = $request_array['data']->user_id;
                $meeting_data->event_name = $request_array['data']->event_name;
                $meeting_data->date_time = date('Y-m-d h:i:s', time());
                $meeting_data->description = $request_array['data']->event_description;
                $meeting_data->latitude = $request_array['data']->event_lat;
                $meeting_data->longitude = $request_array['data']->event_long;
                $meeting_data->to = $request_array['data']->event_to;
                $meeting_data->from = $request_array['data']->event_from;
                $meeting_data->distance = $request_array['data']->event_distance;
                $meeting_data->receipt_no = $request_array['data']->event_receipt_no;
                $meeting_data->purpose = $request_array['data']->event_purpose;

                // Code for Notification
                $user_first_name = $get_name['first_name'];
                $user_last_name = $get_name['last_name'];
                $message = $user_first_name . " " . $user_last_name . " has added new event";

                $user_device_info = UserDeviceInfo::model()->findAll("user_id = '1'");
                if (!empty($user_device_info)) {
                    foreach ($user_device_info as $userdevice_info) {
                        if ($userdevice_info['device_type'] == 'iPhone') {
                            $this->sendNotification($userdevice_info['device_token'], $message);
                        } else if ($userdevice_info['device_type'] == 'Android') {
                            $this->sendAndroidNotification($userdevice_info['device_token'], $message);
                        }
                    }
                }

                $data_area = (file_get_contents("http://maps.googleapis.com/maps/api/geocode/json?latlng=" . $meeting_data->latitude . "," . $meeting_data->longitude . "&sensor=true"));
                parse_str($data_area);
                $data_area = json_decode($data_area);

                if (!empty($data_area->results['0']->formatted_address)) {
                    $meeting_data->location = $data_area->results['0']->formatted_address;
                } else {
                    $meeting_data->location = "";
                }

                $meeting_data->save(false);

                $response['success'] = '1';
                $response['message'] = 'Data inserted successfully';
            } else {
                $response['success'] = '0';
                $response['message'] = 'User does not exist.';
            }
        } else {
            $response['success'] = '0';
            $response['message'] = 'Invalid parameter passed.';
        }
        echo json_encode($response);
        exit();
    }

    public function actionuserEvents() {
        if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {
            $event_list = Meeting::model()->findAll("user_id='" . $_REQUEST['user_id'] . "'");

            $event_data_array = array();
            if (!empty($event_list)) {
                foreach ($event_list as $event) {
                    $data_attributes = $event->attributes;
                    $data_attributes['time'] = date('h:i:s a', strtotime($event->date_time));
                    $data_attributes['day'] = date('m-d-Y', strtotime($event->date_time));
                    unset($data_attributes['date_time']);
                    $event_data_array[] = $data_attributes;
                }
                $response['success'] = '1';
                $response['message'] = 'List of users event';
                $response['data'] = $event_data_array;
            } else {
                $response['message'] = 'No any event of the user.';
                $response['success'] = '0';
            }

            echo json_encode($response);
            exit();
        }
    }

    public function actionuserList() {
        $User_list = Users::model()->findAll("user_type= '2'");
        if (!empty($User_list)) {
            $user_record = array();
            foreach ($User_list as $User) {
                $user_record[] = $User->attributes;
            }

            $response['success'] = '1';
            $response['message'] = 'List of users';
            $response['data'] = $user_record;
        } else {
            $response['message'] = 'User not exits.';
            $response['success'] = '0';
        }

        echo json_encode($response);
        exit();
    }

    public function actionuserDetail() {
        if (isset($_REQUEST['user_id']) && !empty($_REQUEST['user_id'])) {
            $user_list = Users::model()->find("id='" . $_REQUEST['user_id'] . "'");

            if (!empty($user_list->attributes)) {

                $response['success'] = '1';
                $response['message'] = 'User detail';
                $response['data'] = $user_list->attributes;
            } else {
                $response['success'] = '0';
                $response['message'] = 'No any event of the user';
            }
        } else {
            $response['message'] = 'Invalid parameter passed.';
            $response['success'] = '0';
        }

        echo json_encode($response);
        exit();
    }

    public function actionLogout($user_id, $device_token) {
        if (!empty($user_id) && !empty($device_token)) {
            UserDeviceInfo::model()->deleteAll("user_id = '$user_id' AND device_token = '$device_token'");

            $response['success'] = '1';
            $response['message'] = 'Data logout successfully';
        } else {
            $response['message'] = 'Invalid parameter passed.';
            $response['success'] = '0';
        }
        echo json_encode($response);
        exit();
    }

}
