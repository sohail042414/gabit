<?php

class UtilityHtml extends CHtml
{

    public static function getStatusImage($status, $page)
    {
        if ($status == 'Y') {
            return "<div class='status_icons" . $page . "'><img src='" . Yii::app()->request->baseUrl . '/images/admin/active.ico' . "' alt=''/></div>";
        } else if ($status == 'N') {
            return "<div class='status_icons" . $page . "'><img src='" . Yii::app()->request->baseUrl . '/images/admin/inactive.ico' . "' alt=''/></div>";
        } else if ($status == 'R') {
            return 'RTO';
        }
    }
    public static function getpostStatus($status, $page)
    {
        if ($status == '2') {
            return "<div class='status_icons" . $page . "'><img src='" . Yii::app()->request->baseUrl . '/images/admin/active.ico' . "' alt=''/></div>";
        } else if ($status == '1') {
            return "<div class='status_icons" . $page . "'><img src='" . Yii::app()->request->baseUrl . '/images/admin/inactive.ico' . "' alt=''/></div>";
        } else if ($status == 'R') {
            return 'RTO';
        }
    }
    public static function getFundraiserComment($status)
    {
        if ($status == '0') {
            return "Pending";
        } else if ($status == '1') {
            return "Approved";
        } else if ($status == '2') {
            return 'Rejected';
        }
    }

    public static function get_flash_message()
    {
        $alert_message = '';

        foreach (Yii::app()->user->getFlashes() as $key => $message) {
            switch ($key) {
                case 'error' :
                    $alert_message .= '<div class="alert alert-danger alert-dismissable">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            ' . $message . '
                                        </div>';
                    break;
                case 'success' :
                    $alert_message .= '<div class="alert alert-success alert-dismissable">
                                            <button aria-hidden="true" data-dismiss="alert" class="close" type="button">×</button>
                                            ' . $message . '
                                       </div>';
                    break;
            }
        }

        return $alert_message;
    }

    public function get_image_from_path($path, $class = '', $alt = '')
    {
        return "<img src='" . $path . "' class='" . $class . "' alt='" . $alt . "' />";
    }

    public function get_home_slider_from_path($path, $class = '', $alt = '')
    {
        return "<img src='" . SITE_ABS_PATH_HOME_SLIDER_THUMB . $path . "' class='" . $class . "' alt='" . $alt . "' />";
    }
    public function get_fundraiser_image_from_path($path, $class = '', $alt = '')
    {
        return "<img src='" . SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $path . "' class='" . $class . "' alt='" . $alt . "' />";
    }
    public function get_supporter_image_from_path($path, $class = '', $alt = '')
    {
        return "<img src='" . SITE_ABS_PATH_SUPPORTER_THUMB . $path . "' class='" . $class . "' alt='" . $alt . "' />";
    }

    public function get_testimonial_picture_from_path($path, $class = '', $alt = '')
    {
        return "<img src='" . SITE_ABS_PATH_TESTIMONIAL_THUMB . $path . "' class='" . $class . "' alt='" . $alt . "' />";
    }

    public function get_pp($path, $class = '', $alt = '')
    {
        return "<img src='" . $path . "' class='" . $class . "' alt='" . $alt . "' />";
    }

    public function getDocumentLink($document_name)
    {
        return "<a class='fa fa-download' href='" . CLIENT_DOCUMENT_ABS_PATH . $document_name . "' target='__blank'></a>";
    }
    public function getview($name,$page_id)
    {
        return CHtml::link($name,array('FundraiserQuestions/View','id'=>$page_id));
    }

    public function get_mark_as_proper_link($data)
    {
        return "<a class='confirm_popup' href='" . Yii::app()->createUrl('admin/badFaces/markAsProperFace', array('id' => $data->id)) . "'>Mark as Proper Face</a>";
    }

    public function generate_password($length = 8)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }
    
    public static function get_notification_count_for_admin()
    {
        $current_user_id = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->id:null;
        $return_count = NotificationsComment::model()->count(array('condition' => 'to_admin="Y" AND is_read="N" AND status="Y"'));
        if(empty($return_count)) {
            $return_count = 0;
        }
        return $return_count;
    }

}

