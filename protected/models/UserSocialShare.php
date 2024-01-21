<?php

/**
 * This is the model class for table "cron_log".
 *
 * The followings are the available columns in table 'cron_log':
 * @property integer $id
 * @property integer $total_shares
 * @property integer $monthly_count
 * @property string $month
 * @property string $year
 * @property string $created_at
 */
class UserSocialShare extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'user_social_share';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('user_id,total_shares', 'required'),
			array('user_id,total_shares,monthly_count', 'numerical', 'integerOnly' => true),
			array('year', 'length', 'max' => 4),
			array('month', 'length', 'max' => 15),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
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
			'month' => 'Month',
			'year' => 'Year',
			'monthly_count' => 'This Month Count',
			'total_shares' => 'Total Shares',
			'created_at' => 'Created Date/Time',
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
		$criteria->addCondition('user_id = '.$this->user_id);
		$criteria->compare('month',$this->month);
		$criteria->compare('year',$this->year);
		// $criteria->compare('total_shares',$this->total_shares);
		// $criteria->compare('monthly_count',$this->monthly_count);
		// $criteria->compare('created_at',$this->created_at);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'sort' => array(
                'defaultOrder' => 'id DESC',
            ),
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Affiliates the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	/**
	 * Apply Formating to Date before Saving
	 */
    public function beforeSave() {
		if($this->isNewRecord){
			$this->year = 	date('Y'); 
			$this->month = 	strtolower(date('F')); 			
		}
		//actually updated at. 
		$this->created_at = date('Y-m-d h:i:s',time());

        return parent::beforeSave();
    }


	public function getShareCount($user,$fundraiser_list){

		//echo "<br>User :".$user->username;
  
		$total_count = 0;
		
		$data = [];

		foreach($fundraiser_list as $fundraiser){

		  $fundraiser_url = $fundraiser->getSocialUserURL($user);
  
		  $shares = $this->shareThisAPICall($fundraiser_url);
			
		  $data[$fundraiser->id] = $shares;

		  $total_count = $total_count + $shares;

		}

		return [
			'data' => $data,
			'tatal_count' => $total_count
		];

		
	  }
  
	  public function shareThisAPICall($fundraiser_url){
  
		//$fundraiser_url = 'https://giveyourbit.com/index.php/fundraiser/298/Support_For_Leonards_Open_Heart_Surgery/GYB_825';
  
		$count_share_url = "https://count-server.sharethis.com/v2.0/get_counts?url=$fundraiser_url";
  
		// Initialize cURL session
		$ch = curl_init();
  
		// Set cURL options
		curl_setopt($ch, CURLOPT_URL, $count_share_url); // Replace with the URL you want to send the GET request to
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
  
		// Execute cURL session and get the response
		$response = curl_exec($ch);
  
		// Check for cURL errors
		if (curl_errno($ch)) {
			echo 'Curl error: ' . curl_error($ch);
			exit;
			return 0;
		}
  
		// Close cURL session
		curl_close($ch);
  
		$response = json_decode($response);
  
		return $response->total;
  
	  }
  

}
