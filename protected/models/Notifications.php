<?php

Yii::import('application.models._base.BaseNotifications');

class Notifications extends BaseNotifications
{
        public $font_user_email;
        public $font_user_name;


        public static function model($className=__CLASS__) {
            return parent::model($className);
        }

        public function beforeSave()
        {
            if ($this->isNewRecord) {
                $this->created_date = new CDbExpression('NOW()');
            } else {
                $this->updated_date = new CDbExpression('NOW()');
            }

            return parent::beforeSave();
        }

        public function getReceiverTypes(){
            return array(
                'beneficiary'=>'To Beneficiary',
                'manager'=>'To Fund Manager',
                'supporter'=>'To Supporter'
            );
        }

        public function searchAdmin() {
            $criteria = new CDbCriteria;
    
            //$criteria->compare('id', $this->id);
            //$criteria->compare('from_id', $this->from_id);
            //$criteria->compare('from_admin', $this->from_admin, true);            
            //$criteria->compare('to_admin', $this->to_admin, true);
            $criteria->addCondition('from_admin="Y" OR to_admin="Y"');
            
            return new CActiveDataProvider($this, array(
                'criteria' => $criteria,
                'sort' => array(
                    'defaultOrder' => 'id DESC',
                ),
                'pagination' => [
                    'pageSize' => 20,
                ],
            ));
        }

        public function getUnReadCommentsCount(){
           $count = NotificationsComment::model()->count(array('condition' => 'notification_id='.$this->id.' AND is_read="N"'));
           return $count;
        }

        public function getCommentHtml(){
            
            $style = '';
            if($this->to_admin == 'Y' && $this->is_read == 'N'){
                $style = 'border:1px solid red;';
            }

            $html = '<div class="message_box" style="'.$style.'">';
            $html .= '<a href="'.Yii::app()->createUrl('admin/notifications/notificationdetail', array('id' => $this->id)).'">';
            $subject = (strlen($this->subject) > 250 ) ? substr($this->subject, 0, 250).'...' : $this->subject;
            $html.= $subject;
            $unread_count = $this->getUnReadCommentsCount();
            if($unread_count > 0){
                $html.='<span> '.$unread_count.' unread comment(s)</span>';
            }
            $html.='</a>';
            $html.='<br>';
            $html.='<span>';
            
            $by_date = "";
            if($this->from_admin == 'Y') {
                $by_date .= "By Admin";
            } else if(isset($this->fromUser)) {
                $by_date .= "By ".$this->fromUser->username;
            }
            $by_date .= " . ";
            $by_date .= date('M d, Y , H:i:s', strtotime($this->created_date));
            $html.= $by_date;                    
            $html.='</span>';
            $html.='</div>';

            return $html;
        }
}