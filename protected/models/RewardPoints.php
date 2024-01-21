<?php

/**
 * This is the model class for table "reward_points".
 *
 * The followings are the available columns in table 'reward_points':
 * @property integer $id
 * @property integer $fundraiser_id
 * @property integer $user_id
 * @property string $activity
 * @property integer $points
 * @property string $created_date
 */
class RewardPoints extends CActiveRecord
{
	public $social_shares_count = 0;

	public $points_list = array(
		'first_donation' => 10,
		'donation_same' => 10,
		'donation_other' => 20,
		'donation_1000' => 20,
		'donation_5000' => 50,
		'donation_10000' => 100, 
		'send_hug' => 500,
		'social_media_share' => 1000,
		'post_comment' => 500,
		'post_comment_same' =>500,
		'post_comment_other' => 1000,
		'become_supporter' => 5000,
		'view_case_update' => 500,
		'view_case_update_other' => 1000,
		'embed_on_site' => 5000,		
		'explore_fundraisers' => 1000,
		'visit_fundraiser' => 500,
		'visit_other_fundraiser' => 1000,
		'invite_by_email' => 5000,
		'invite_by_phone' => 5000,
		'invite_by_both' => 10000,
		'referral_code_entry' => 1000,
		'referral_donation' => 1000,

	);


	public function addPoints($fundraiser_id, $activity, $amount=0, $donor_user_id=0){


		//User should be logged in or if payment call back provides user_id. 
        if(($this->checkLogin()) || ($donor_user_id > 0 && in_array($activity, array('donation','referral_code_entry','referral_donation'))) ){

			if($donor_user_id > 0){
				$user_id = $donor_user_id;
			} else if($this->checkLogin()){
				$user_id = Yii::app()->frontUser->id;
			}else{
				return false;
			}

			$year = date('Y');
			$month = date('F');
	
			$start_date = date("$year-m-01", strtotime($month." 1"));
			$end_date = date("$year-m-t", strtotime($month." 1"));
	
			$donation_count = Donations::model()->count('user_id = :user_id AND created_date BETWEEN :start_date AND :end_date',array(
				'start_date' => $start_date,
				'end_date' => $end_date,
				'user_id' => $donor_user_id,
			));

			//Other activities are allowed only user has made a donaiton in current month. 
			//Only donation will count in all cases. 
			if(($donation_count >=1) || ($activity == 'donation')){

				$points = 0;
				$activity_title = '';
	
				$existing = $this->find('user_id = :user_id AND activity = :activity',array(
					'user_id' => $user_id,
					'activity' => $activity
				));
	
				switch($activity){
	
					case 'referral_code_entry':
						$points = $this->points_list['referral_code_entry'];						
						$activity_title = 'Referral Code Entry';
						break;
					case 'referral_donation':						
						$points = $this->points_list['referral_donation'];
						$activity_title = 'Referral Donation';
						break;
						
					case 'donation':						
						if($amount >=10000){
							$points = $this->points_list['donation_10000'];
						}else if($amount >= 5000 && $amount < 10000){
							$points = $this->points_list['donation_5000'];
						}else if($amount >=1000 && $amount < 5000){
							$points = $points = $this->points_list['donation_1000'];
						}else {

							if(is_object($existing) && $existing->fundraiser_id != $fundraiser_id){
								$points = $this->points_list['donation_other'];
							}else{
								$points = $this->points_list['first_donation'];
							}
						}
						//$activity_title = 'Donation '.$amount;
						$activity_title = 'Donation ';
						break;
					
					//not working on front end. 
					case 'send_hug':
						$points = $this->points_list['send_hug'];
						$activity_title = 'Sent a hug';
						break;
					//cannot catch sharing on social media. 
					case 'social_media_share':
						$points = $this->points_list['social_media_share'];	
						$activity_title = 'Social Media Share';									
						break;
					
					//comment on front end not working. 
					case 'comment':
						if(is_object($existing) && ($existing->fundraiser_id !=$fundraiser_id)){
							$points = $this->points_list['post_comment_other'];	
						}else{
							$points = $this->points_list['post_comment'];	
						}	
	
						$activity_title = 'Posted a comment';
						break;
	
					case 'supporter':	
						$points = $this->points_list['become_supporter'];	
						$activity_title = 'Become supporter';
						break;
	
					//adding points not implemented. 
					case 'view_case_update':	
	
						if(is_object($existing) && ($existing->fundraiser_id !=$fundraiser_id)){
							$points = $this->points_list['view_case_update_other'];	
						}else{
							$points = $this->points_list['view_case_update'];	
						}	
						$activity_title = 'Viewed Case Updates';
						break;
	
					case 'embed_on_site':	
						$points = $this->points_list['embed_on_site'];	
						$activity_title = 'Embeded Fundraiser on site';
						break;					
	
					case 'explore_fundraisers':	
						$points = $this->points_list['explore_fundraisers'];	
						$activity_title = 'Explored Fundraisers';
						break;
	
					case 'visit_fundraiser':
																
						if(is_object($existing) && ($fundraiser_id != $existing->fundraiser_id)){						
							$points = $this->points_list['visit_other_fundraiser'];
						}else{
							$points = $this->points_list['visit_fundraiser'];
						}
	
						$activity_title = 'Visited Fundraiser';
						
					break;
	
					case 'invite_by_email':
						$points = $this->points_list['invite_by_email'];
						$activity_title = 'Invited friend by email';
					break;
	
					case 'invite_by_phone':
						$points = $this->points_list['invite_by_phone'];
						$activity_title = 'Invited friend by phone';
					break;
	
	
				}
	
	
				$rewardPoint = new RewardPoints();
				$rewardPoint->fundraiser_id = $fundraiser_id;
				$rewardPoint->activity = $activity;
				$rewardPoint->activity_title = $activity_title;
				$rewardPoint->user_id = $user_id;
				$rewardPoint->points = $points;
				$rewardPoint->save();	
			}

        }
		
	}


	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'reward_points';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('fundraiser_id, user_id, activity, points', 'required'),
			array('fundraiser_id, user_id, points', 'numerical', 'integerOnly'=>true),
			array('activity', 'length', 'max'=>30),
			array('points_date,created_at,activity_title,social_shares_count', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('id, fundraiser_id, user_id, activity, points, points_date,social_shares_count', 'safe', 'on'=>'search'),
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
			'user' => array(self::BELONGS_TO, 'Users', 'user_id'),
			'fundraiser' => array(self::BELONGS_TO, 'Fundraiser', 'fundraiser_id'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'id' => 'ID',
			'fundraiser_id' => 'Fundraiser',
			'user_id' => 'User',
			'activity' => 'Activity',
			'points' => 'Points',
			'year' => 'Year',
			'month' => 'Month',
			'points_date' => 'Date',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiv,eDataProvider instance which will filter
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
		$criteria->compare('fundraiser_id',$this->fundraiser_id);
		$criteria->compare('user_id',$this->user_id);
		$criteria->compare('activity',$this->activity,true);
		$criteria->compare('month',$this->month);
		$criteria->compare('year',$this->year);
		$criteria->compare('points_date',$this->points_date,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
			'pagination' => array(
				'pageSize' => 50,				
			),
			'sort' => array(
				'defaultOrder' => array('id' => 'DESC'), // Default sorting by 'columnName' in ascending order
			),
		));
	}

	public function getPointsDetail(){
		
		$current_month_donation_count = Donations::model()->getUserCurrentMonthDonationsCount($this->user_id);

		$user = Users::model()->findByPK($this->user_id);

		$data = array(
			1 => array(
				'title' => 'Referral Code Entry',
				'points' => '1000',
				'count' => $this->getMonthlyActivityCount('referral_code_entry'),
			),
			2 => array(
				'title' => 'Referral Donation',
				'points' => '1000',
				'count' => $this->getMonthlyActivityCount('referral_donation'),
			),			
			3 => array(
				'title' => 'Donation',
				'points' => '10',
				//'count' => $this->getMonthlyActivityCount('donation'),
				'count' => ($current_month_donation_count > 0) ? 1 : 0,
			),			
			4 => array(
				'title' => '1 more Donation (Same fundraiser)',
				'points' => '10',
				'count' => $this->countDonationSameFundraiser($current_month_donation_count),
				//'count' => (($this->getMonthlyActivityCountByPoints('donation',10) - 1) >0 )?:0,
			),
			5 => array(
				'title' => '1 more donation (other fundraiser)',
				'points' => '20',
				'count' => $this->countDonationOtherFundraiser($current_month_donation_count),
				//'count' => $this->getMonthlyActivityCountByPoints('donation',20),
			),
			6 => array(
				'title' => 'Donation (1000 and above)',
				'points' => '20',
				//'count' => $this->getMonthlyActivityCountByPoints('donation',20),
				'count' => $this->getDonatioinPointsByAmount(null,null,null,1000,5000),
				
			),
			7 => array(
				'title' => 'Donation (5000 and above)',
				'points' => '50',
				//'count' => $this->getMonthlyActivityCountByPoints('donation',50),
				'count' => $this->getDonatioinPointsByAmount(null,null,null,5000,10000),
			),
			8 => array(
				'title' => 'Donation (10000 and above)',
				'points' => '100',
				//'count' => $this->getMonthlyActivityCountByPoints('donation',100),
				'count' => $this->getDonatioinPointsByAmount(null,null,null,10000,100000),
			),
			9 => array(
				'title' => 'Send a hug',
				'points' => '500',
				'count' => $this->getMonthlyActivityCount('send_hug'),
			),
			10 => array(
				'title' => 'Social media share',
				//'points' => '1000',
				//'count' => $this->getMonthlyActivityCount('social_media_share'),
				'points' => (int) $this->social_shares_count * $this->points_list['social_media_share'],
				'count' => $this->social_shares_count,
			),
			/*
			11 => array(
				'title' => 'Post comment',
				'points' => '500',
				'count' => $this->getMonthlyActivityCount('comment'),
			),
			*/
			12 => array(
				'title' => 'Post comments (Same fundraiser)',
				'points' => '500',
				//'count' => (($this->getMonthlyActivityCountByPoints('comment',500) - 1) > 0)?:0,
				'count' => $user->comment_count,
			),
			13 => array(
				'title' => 'Post 1 more comment (other fundraiser)',
				'points' => '1000',
				//'count' => $this->getMonthlyActivityCountByPoints('comment',1000),
				'count' => $user->comment_count_other,
			),
			14 => array(
				'title' => 'Become a supporter',
				'points' => '5000',
				'count' => $this->getMonthlyActivityCount('supporter'),
			),
			15 => array(
				'title' => 'View case update',
				'points' => '500',
				'count' => $this->getMonthlyActivityCount('view_case_update'),
			),
			16 => array(
				'title' => 'View case updates (other fundraiser)',
				'points' => '1000',
				'count' => $this->getMonthlyActivityCountByPoints('view_case_update',1000),
			),
			17 => array(
				'title' => 'Embed fundraiser on a website or blog',
				'points' => '5000',
				'count' => $this->getMonthlyActivityCount('embed_on_site'),
			),
			18 => array(
				'title' => 'Explore fundraisers',
				'points' => '1000',
				'count' => $this->getMonthlyActivityCount('explore_fundraisers'),
			),
			19 => array(
				'title' => 'Visit 1 fundraiser',
				'points' => '500',
				'count' => $this->getMonthlyActivityCountByPoints('visit_fundraiser',500),
			),
			20 => array(
				'title' => 'Visit 1 more fundraiser',
				'points' => '1000',
				'count' =>  $this->getMonthlyActivityCountByPoints('visit_fundraiser',1000),
			),
			21 => array(
				'title' => 'Invite friends by email',
				'points' => '5000',
				'count' => $this->getMonthlyActivityCount('invite_by_email'),
			),
			/*
			22 => array(
				'title' => 'Invite friend by phone',
				'points' => '5000',
				'count' => $this->getMonthlyActivityCount('invite_by_phone'),
			),
			23 => array(
				'title' => 'Invite friends both by email and phone',
				'points' => '10000',
				'count' => ($this->getMonthlyActivityCount('invite_by_email')+$this->getMonthlyActivityCount('invite_by_phone')),
			),
			*/
			
		);

		$dataProvider=new CArrayDataProvider($data, array(
			'keyField' => 'title', 
			'sort'=>array(
				'attributes'=>array(
					 'title', 'points', 'count',
				),
			),
			'pagination'=>array(
				'pageSize'=>30,
			),
		));

		return $dataProvider;
		 
	}


	private function countDonationSameFundraiser($current_count = 0){

		if($current_count == 0){
			return 0;
		}

		$first_donation = Donations::model()->getUserFirstDonationInMonth($this->user_id);

		$year = date('Y');
        $month = date('F');

        $start_date = date("$year-m-01", strtotime($month." 1"));
        $end_date = date("$year-m-t", strtotime($month." 1"));

        $count =  Donations::model()->count('user_id = :user_id AND fundraiser_id = :fundraiser_id AND created_date BETWEEN :start_date AND :end_date', 
			array(
				'start_date' => $start_date,
				'end_date' => $end_date,
				'fundraiser_id' => $first_donation->fundraiser_id,
				'user_id' => $this->user_id,
			)
		);

		if($count > 1){
			return ($count -1);
		}

		return 0;
	}

	private function countDonationOtherFundraiser($current_count = 0){

		if($current_count == 0){
			return 0;
		}

		$first_donation = Donations::model()->getUserFirstDonationInMonth($this->user_id);

		$year = date('Y');
        $month = date('F');

        $start_date = date("$year-m-01", strtotime($month." 1"));
        $end_date = date("$year-m-t", strtotime($month." 1"));

        $count =  Donations::model()->count('user_id = :user_id AND fundraiser_id != :fundraiser_id AND created_date BETWEEN :start_date AND :end_date', 
			array(
				'start_date' => $start_date,
				'end_date' => $end_date,
				'fundraiser_id' => $first_donation->fundraiser_id,
				'user_id' => $this->user_id,
			)
		);

		return $count;	
	}




	public function getYears(){

		$sql = "SELECT MIN(reward_points.year) as start_year from reward_points ";

		$min_year= Yii::app()->db->createCommand($sql)->queryScalar();

		//because we start this program in 2023
		if((int)$min_year < 2023){
			$min_year = 2023;
		}

		$current_year = date('Y');

		$list = [];

		for($i = $current_year; $i >= $min_year; $i--){
			$list[$i] = $i;
		}

		return $list;
	}

	public function getMonths($year = null){

		if($year == null){
			$year = date('Y');
		}

		$current_month = date('F');
		$current_year = date('Y');

		$data = array(
			1 => array(
				'id' => '1',
				'name' => 'January',
				'year' => $year,
			),
			2 => array(
				'id' => '2',
				'name' => 'February',
				'year' => $year
			),
			3 => array(
				'id' => '3',
				'name' => 'March',
				'year' => $year
			),
			4 => array(
				'id' => '4',
				'name' => 'April',
				'year' => $year
			),
			5 => array(
				'id' => '5',
				'name' => 'May',
				'year' => $year
			),
			6 => array(
				'id' => '6',
				'name' => 'June',
				'year' => $year
			),
			7 => array(
				'id' => '7',
				'name' => 'July',
				'year' => $year
			),
			8 => array(
				'id' => '8',
				'name' => 'August',
				'year' => $year
			),
			9 => array(
				'id' => '9',
				'name' => 'September',
				'year' => $year
			),
			10 => array(
				'id' => '10',
				'name' => 'October',
				'year' => $year
			),
			11 => array(
				'id' => '11',
				'name' => 'November',
				'year' => $year
			),
			12 => array(
				'id' => '12',
				'name' => 'December',
				'year' => $year
			),
		);

		foreach($data as $key => $month){

			$start_date = date("$year-m-01", strtotime($month['name']." 1"));
			$end_date = date("$year-m-t", strtotime($month['name']." 1"));

			// $donation_count = Donations::model()->count('created_date BETWEEN :start_date AND :end_date',array(
			// 	'start_date' => $start_date,
			// 	'end_date' => $end_date
			// ));

			/*
			$sql = "SELECT count(distinct donor_email) 
			FROM donations WHERE created_date BETWEEN '".$start_date."' AND '".$end_date."'
			GROUP BY donor_email ";
			*/
			
			$month_name = strtolower($month['name']);
			$sql = "SELECT count(DISTINCT user_id) 
			FROM reward_points 
			WHERE month= '$month_name' 
			AND year = $year
			";

			$donation_count= Yii::app()->db->createCommand($sql)->queryScalar();

			$data[$key]['donation_count'] = $donation_count;
			$data[$key]['current'] = ($month['name'] == $current_month && ($month['year'] == $current_year)) ? 1:0;
		}

		$dataProvider=new CArrayDataProvider($data, array(
			'keyField' => 'id', 
			'sort'=>array(
				'attributes'=>array(
					 'id', 'name', 'year'
				),
			),
			'pagination'=>array(
				'pageSize'=>12,
			),
		));

		return $dataProvider;

	}


	public function getMonthly($month,$year=null)
    {	
		$month = strtolower($month);
		if($year == null){
			$year = date('Y');
		}

        $sql = "SELECT users.id,users.username,users.email,users.user_image,users.sex, users.age,reward_points.month,reward_points.year ,SUM(reward_points.points) as total_points
				from reward_points 
				JOIN users on reward_points.user_id = users.id AND users.role='donor'
				WHERE reward_points.month = '$month' 
				AND reward_points.year = $year				
				GROUP BY reward_points.user_id								
				HAVING SUM(reward_points.points) > 0
				ORDER BY total_points DESC";

		$rawData= Yii::app()->db->createCommand($sql)->queryAll();

		$dataProvider=new CArrayDataProvider($rawData, array(
			'keyField' => 'id', 
			'sort'=>array(
				'attributes'=>array(
					 'id', 'username', 'email','total_points',
				),
			),
			'pagination'=>array(
				'pageSize'=>1000,
			),
		));

		return $dataProvider;

    }


	public function getUserPoints($user_id,$month,$year)
    {

        $sql = "SELECT users.id,users.username,users.email,reward_points.activity,reward_points.created_at,COUNT(reward_points.activity) as total_actions,SUM(reward_points.points) as total_points
				from reward_points 
				JOIN users on reward_points.user_id = users.id
				WHERE users.id = $user_id
				AND reward_points.month = '$month' AND reward_points.year = $year
				GROUP BY reward_points.activity
				HAVING SUM(reward_points.points) > 0";

		$rawData= Yii::app()->db->createCommand($sql)->queryAll();

		$dataProvider=new CArrayDataProvider($rawData, array(
			'keyField' => 'activity', 
			'sort'=>array(
				'attributes'=>array(
					 'id', 'username', 'email','total_points',
				),
			),
			'pagination'=>array(
				'pageSize'=>1000,
			),
		));

		return $dataProvider;

    }

	public function getPointsByActivity($user_id,$activity,$month,$year)
    {

        $sql = "SELECT users.id,users.username,users.email,reward_points.activity,SUM(reward_points.points) as total_points
				from reward_points 
				JOIN users on reward_points.user_id = users.id
				WHERE users.id = $user_id
				AND reward_points.month = '$month' AND reward_points.year = $year
				GROUP BY reward_points.activity
				HAVING SUM(reward_points.points) > 0";

		$rawData= Yii::app()->db->createCommand($sql)->queryAll();

		$dataProvider=new CArrayDataProvider($rawData, array(
			'keyField' => 'activity', 
			'sort'=>array(
				'attributes'=>array(
					 'id', 'username', 'email','total_points',
				),
			),
			'pagination'=>array(
				'pageSize'=>1000,
			),
		));

		return $dataProvider;

    }


	public function getDonatioinPointsByAmount($user_id,$month,$year,$min_amount,$max_amount){

		if($user_id ==null){
			$user_id = $this->user_id;
		}

		if($month == null){
			$month = $this->month;
		}

		if($year == null){
			$year = $this->year;
		}


        $start_date = date("$year-m-01", strtotime($month." 1"));
        $end_date = date("$year-m-t", strtotime($month." 1"));

		/*
        $donation_count = Donations::model()->count('user_id = :user_id AND created_date BETWEEN :start_date AND :end_date AND transaction_amount BETWEEN '.($min_amount-1).' AND '.($max_amount+1).'',array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'user_id' => $user_id,
        ));
		*/
		
		$donation_count = Donations::model()->count('user_id = :user_id AND created_date BETWEEN :start_date AND :end_date AND transaction_amount >= '.(int)$min_amount.' AND transaction_amount <'.(int)$max_amount,array(
            'start_date' => $start_date,
            'end_date' => $end_date,
            'user_id' => $user_id,
        ));
        

        return $donation_count;

    }


	public function beforeSave()
    {
		if($this->isNewRecord){
			$this->year = 	date('Y'); 
			$this->month = 	strtolower(date('F')); 
			$this->points_date = date('Y-m-d',time());
			$this->created_at = date('Y-m-d h:i:s',time());
		}

        return parent::beforeSave();
    }

	public function getMonthlyActionsCount($user_id,$month,$year){
		
		return $this->count('user_id=:user_id AND year=:year AND month=:month',array(
			'user_id'=>$user_id,
			'year'=>$year,
			'month' => strtolower($month),
		));
		
		/*
		$sql = "SELECT COUNT(*) FROM reward_points WHERE user_id=".$user_id." AND year=".$year." AND month='".$month."';";

		$total_points= Yii::app()->db->createCommand($sql)->queryScalar();

		if((int)$total_points > 0){
			return $total_points;
		}

		return 0;
		*/
	}

	/**
	 * Must set Model $user_id, $year, and $month before calling this method. 
	 * Or pass these variables. 
	 */

	public function getMonthlyActivityCount($activity,$user_id=null,$month=null,$year=null){

		if($user_id ==null){
			$user_id = $this->user_id;
		}

		if($month == null){
			$month = $this->month;
		}

		if($year == null){
			$year = $this->year;
		}

		return $this->count('user_id=:user_id AND year=:year AND month=:month AND activity=:activity',array(
			'user_id'=>$user_id,
			'year'=>$year,
			'month' => $month,
			'activity' => $activity
		));

	}


		/**
	 * Must set Model $user_id, $year, and $month before calling this method. 
	 * Or pass these variables. 
	 */

	 public function getMonthlyActivityCountByPoints($activity,$points,$user_id=null,$month=null,$year=null){

		if($user_id ==null){
			$user_id = $this->user_id;
		}

		if($month == null){
			$month = $this->month;
		}

		if($year == null){
			$year = $this->year;
		}

		return $this->count('user_id=:user_id AND year=:year AND points=:points AND month=:month AND activity=:activity',array(
			'user_id'=>$user_id,
			'year'=>$year,
			'points' => $points,
			'month' => $month,
			'activity' => $activity
		));

	}

	public function getActivityTotalPoints($user_id,$month,$year,$activity){

        $sql = "SELECT SUM(reward_points.points) as total_points
				from reward_points 
				WHERE reward_points.user_id = $user_id
				AND reward_points.month = '$month' 
				AND reward_points.year = '$year'
				AND reward_points.activity = '$activity'
				GROUP BY reward_points.activity
				";

		$total_points= Yii::app()->db->createCommand($sql)->queryScalar();

		if((int)$total_points > 0){
			return $total_points;
		}
		
		return 0;
	}

	public function getUserMonthlyTotalPoints($user_id,$month,$year){

        $sql = "SELECT SUM(reward_points.points) as total_points
				from reward_points 
				WHERE reward_points.user_id = $user_id
				AND reward_points.month = '$month' 
				AND reward_points.year = '$year'
				GROUP BY reward_points.user_id
				";

		$total_points= Yii::app()->db->createCommand($sql)->queryScalar();

		$comment_points = $this->getCommentPoints($user_id);

		$total_points = $total_points + $comment_points;

		if((int)$total_points > 0){
			return $total_points;
		}
		
		return 0;
	}

	public function getCommentPoints($user_id){

		$user = Users::model()->findByPK($user_id);

		$total_points = 0;

		if($user->comment_count > 0){
			$total_points = $total_points + ($user->comment_count*500);
		}

		if($user->comment_count_other > 0){
			$total_points = $total_points + ($user->comment_count_other*1000);
		}

		return $total_points;
	}
	


	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return RewardPoints the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}


	public function checkLogin()
    {
        if (!empty(Yii::app()->frontUser->id) && !empty(Yii::app()->frontUser->role) && in_array(Yii::app()->frontUser->role, array('fundraiser','supporter','donor'))) {
            return true;
        } else {
            return false;
        }
    }
}
