<?php

/**
 * This is the model class for table "reward_winner".
 *
 * The followings are the available columns in table 'reward_winner':
 * @property integer $id
 * @property integer $user_id
 * @property integer $year
 * @property string $month
 * @property integer $total_points
 * @property integer $prize_amount;
 * @property string $win_date
 * @property string $content;
 * @property string $image1;
 * @property string $image2;
 * @property string $image3;
 * @property string $image4;
 */
class RewardWinner extends CActiveRecord
{

	public $user_name;
	public $image1_file;
	public $image2_file;
	public $image3_file;
	public $image4_file;

	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reward_winner';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id, year, month, total_points', 'required'),
			array('user_id, year, total_points,prize_amount', 'numerical', 'integerOnly'=>true),
			array('month', 'length', 'max'=>15),
			array('location', 'length', 'max'=>50),
			array('image1,image2,image3,image4', 'length', 'max'=>255),
			array('win_date,content', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, user_id, year, month, total_points, win_date', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */

	 public function relations()
	 {
		 return array(
			 'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
		 );
	 }

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'user_id' => 'User',
			'year' => 'Year',
			'month' => 'Month',
			'total_points' => 'Total Points',
			'prize_amount' => 'Prize Amouunt',
			'win_date' => 'Win Date',
			'image1_file' => 'Image 1',
			'image2_file' => 'Image 2',
			'image3_file' => 'Image 3',
			'image4_file' => 'Image 4',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('id',$this->id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('year',$this->year);
		$criteria->compare('month',$this->month,true);
		$criteria->compare('total_points',$this->total_points);
		$criteria->compare('win_date',$this->win_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => array(
				'defaultOrder' => array('win_date' => 'DESC'), // Default sorting by 'columnName' in ascending order
			),
		));
	}


	public function uploadImage1() {

        try {

            $imageObject = CUploadedFile::getInstance($this, 'image1_file');

            if (!is_object($imageObject)) {
                return FALSE;
            } 

			$file_extension = $imageObject->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$imageObject->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);
			$this->image1 = $image_name;                    
            
        } catch (Exception $ex) {

        }
    }


	public function uploadImage2() {

        try {

            $imageObject = CUploadedFile::getInstance($this, 'image2_file');

            if (!is_object($imageObject)) {
                return FALSE;
            } 

			$file_extension = $imageObject->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$imageObject->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);
			$this->image2 = $image_name;                    
            
        } catch (Exception $ex) {

        }
    }

	public function uploadImage3() {

        try {

            $imageObject = CUploadedFile::getInstance($this, 'image3_file');

            if (!is_object($imageObject)) {
                return FALSE;
            } 

			$file_extension = $imageObject->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$imageObject->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);
			$this->image3 = $image_name;                    
            
        } catch (Exception $ex) {

        }
    }

	public function uploadImage4() {

        try {

            $imageObject = CUploadedFile::getInstance($this, 'image4_file');

            if (!is_object($imageObject)) {
                return FALSE;
            } 

			$file_extension = $imageObject->getExtensionName();
			$random_filename = time() . rand(99999, 888888);
			$image_name = $random_filename . "." . $file_extension;
			$original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;
			$imageObject->saveAs($original_path);
			EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);
			$this->image4 = $image_name;                    
            
        } catch (Exception $ex) {

        }
    }

	

	public function beforeSave()
    {
		if($this->isNewRecord){
			$this->win_date = date('Y-m-d h:i:s',time());
			$this->content = '<p>{WINNER_NAME} was rewarded on the Top Donor Reward Program TDRP on {WIN_DATE} for taking actions {TOTAL_ACTIONS} times on fundraiser pages on Giveyourbit, with a cumulative {TOTAL_POINTS} points; supporting {TOTAL_SUPPORTED} fundraisers. Tap on the photo image to your right to see enlarged photos of {WINNER_NAME}. The reward of {PRIZE_AMOUNT} Naira was recieved by this donor for acts of kindness to people who are faced with challenges; trying to raise funds on the Giveyourbit website. Supporting fundraisers on Giveyourbit offers hope to these people who are victims of circumstance, and it puts a smile on their faces and the faces of members of their families. So, we at Giveyourbit with utmost gratitude certifies {WINNER_NAME} as a {STAR_DONOR}, for kindness to people on Giveyourbit.</p>';
		}

        return parent::beforeSave();
    }
	
	public function preparContent(){

		$content = $this->content;

		// Tokens to replace. 
		// {WINNER_NAME} , {WIN_DATE} , {TOTAL_ACTIONS} , {TOTAL_POINTS} , {TOTAL_SUPPORTED} , {PRIZE_AMOUNT}, {STAR_DONOR}

		$content = str_replace('{WINNER_NAME}', '<strong>'.$this->user->username.'</strong>', $content);
		$content = str_replace('{WIN_DATE}', '<strong>'.$this->formatedWinDate().'</strong>', $content);

		$total_actions = RewardPoints::model()->getMonthlyActionsCount($this->user_id,$this->month,$this->year);
		$content = str_replace('{TOTAL_ACTIONS}', '<strong>'.$total_actions.'</strong>', $content);

		$total_points = RewardPoints::model()->getUserMonthlyTotalPoints($this->user_id,$this->month,$this->year);
		$content = str_replace('{TOTAL_POINTS}', '<strong>'.$total_points.'</strong>', $content);

		$total_supported = Supporter::model()->getUserMonthSupporterCount($this->year,$this->month,$this->user_id);
		$content = str_replace('{TOTAL_SUPPORTED}', '<strong>'.$total_supported.'</strong>', $content);

		$content = str_replace('{PRIZE_AMOUNT}', '<strong>'.$this->prize_amount.'</strong>', $content);

		$content = str_replace('{STAR_DONOR}', "<strong>Star Donor</strong>", $content);

		

		return $content;

	}

	public function formatedWinDate(){
		return date('F d, Y',strtotime($this->win_date));
	}


    public function afterFind(){
        $this->user_name = $this->user->username;
    }
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RewardWinner the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
