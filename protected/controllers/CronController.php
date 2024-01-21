<?php

use PHPMailer\PHPMailer\PHPMailer;

class CronController extends Controller
{
 
    public function actionIndex(){

    }

    public function actionTest(){
        
        $cron = new CronLog();
        $cron->corn_name = 'test'; 
        $cron->save();

    }

    public function actionSocial(){
        
        $cron = new CronLog();
        $cron->corn_name = 'social'; 
        $cron->save();

        //Get all Active Donors.

        $month = strtolower(date('F'));

        $last_month =  strtolower(date('F', strtotime($month . " last month")));

        $year = date('Y');


        $donors = Users::model()->findAll(array(
            "condition" => "role IN ('donor','fundraiser') AND status IN ('Y')",
            'order' => 'id ASC',        
        ));

        $fundraisers = Fundraiser::model()->findAll(array(
            //'condition' => "status IN ('Y','N')",
            'condition' => 'status=:status',
            'params' =>array(
              'status'=>'Y'
            ),
            'order'=> 'id DESC'
        ));

        $socialModel = new UserSocialShare();

        $fundraisersData = [];

        foreach($fundraisers as $fundraiser){            
            $shares_count = $socialModel->shareThisAPICall($fundraiser->getAbsoluteURL());
            //$fundraiser->social_shares_count = $shares_count; 
            //$fundraiser->update(FALSE);
            $fundraisersData[$fundraiser->id] = $shares_count;
        }

        foreach($donors as $user){

            if(empty($user->referral_code)){
                $user->checkReferralCode();
            }

            $count_data = $socialModel->getShareCount($user,$fundraisers);

            foreach($count_data['data'] as $f_id => $f_count){
                $fundraisersData[$f_id] = $fundraisersData[$f_id] + $f_count;
            }

            $record = $socialModel->find('user_id = :user_id AND month=:month AND year=:year',array(
                'user_id' => $user->id,
                'month' => $month,
                'year' => $year
            ));

            $last_month_record = $socialModel->find('user_id = :user_id AND month=:month AND year=:year',array(
                'user_id' => $user->id,
                'month' => $last_month,
                'year' => $year
            ));

            if(!is_object($record)){
                $record = new UserSocialShare();
                $record->user_id = $user->id;
                $record->month = $month;
                $record->year = $year;
            }

            $record->total_shares = $count_data['tatal_count'];

            if(is_object($last_month_record)){
                $record->monthly_count = (int)$count_data['tatal_count'] - (int)$last_month_record->total_shares;
            }

            if(!$record->save(FALSE)){
                echo 'Herer<br>'.__FILE__;
                echo '<br>'.__LINE__;
                echo '<pre>';
                print_r($record->errors);
                exit; 
            };

            // echo "<br><br> User : ". $user->email;
            // echo "<br> Shares count : ". $record->total_shares;

            $year = date('Y',time());

        }

        foreach($fundraisers as $fundraiser){     
            $fundraiser->social_shares_count = $fundraisersData[$fundraiser->id];
            $fundraiser->update(false);
        }

        echo "<br>Done creating social shaares";
        exit;

    }

    public function actionWinner(){

        echo "Not declaring winner"; exit;

        $month = strtolower(date('F'));
        $year = date('Y');

        $model=new RewardPoints('search');
		$model->unsetAttributes(); 
		
		$dataProvider = $model->getMonthly($month,$year);

		$data = $dataProvider->getData();

		if(count($data) > 0 && isset($data[0])){

			$user = $data[0];

			$existing = RewardWinner::model()->find('month=:month AND year=:year',array(
				'month' => $month,
				'year' => $year,
			));

            $reward_prize = Setting::model()->getBySettingKey('reward_prize');

			if(is_object($existing)){
                $existing->user_id = $user['id'];
                $existing->total_points = $user['total_points'];
                $existing->reward_prize = $reward_prize;
                $existing->update(FALSE);

			}else{

				$winner = new RewardWinner();

				$winner->user_id = $user['id'];
				$winner->year = $year;
				$winner->month = $month;
				$winner->total_points = $user['total_points'];
				$winner->prize_amount = $reward_prize;
				$winner->save(false);
            }
		}
    }
        

}