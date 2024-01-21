<?php
//require_once 'google-api-php-client/src/Google/autoload.php';

class FundraiseController extends FrontCoreController
{

    private $upload_error = '';

    public $text_message = '';

    public function actionAccounts(){

      // $id = 287;
      // $fundraiser = Fundraiser::model()->findByPk($id);
      
      // $this->sendFundraiserEmail($fundraiser);

      // $this->createOtherAccounts($fundraiser);

      // echo $this->text_message;

      //exit;

    }

    public function actionIndex()
    {

      if(!$this->checkLogin()){
          $this->redirect(array('site/login')); 
      }

      $model = new SetupFundraiser;

      $rewardModel = new RewardPoints();

      $rewardModel->year = 	date('Y'); 
      $rewardModel->month = 	strtolower(date('F')); 
      $rewardModel->user_id= Yii::app()->frontUser->id;

      $user = Users::model()->findByPk(Yii::app()->frontUser->id);

      if(Yii::app()->createAbsoluteUrl('/') == 'http://gabit.local/index.php'){
        $social_shares_count = 10;
      }else{
        $social_shares_count = $this->getShareCount($user);
      }

      $rewardModel->social_shares_count = $social_shares_count;

  		$pointsDetails = $rewardModel->getPointsDetail();

      $actionDataProvider = $rewardModel->search();

      $this->render('index', array(
        'rewardModel' => $rewardModel,
        'model' => $model,
        'user' => $user,
        'dataProvider' => $pointsDetails,
        'actionDataProvider' => $actionDataProvider,
        //'social_shares_count' => $social_shares_count,
      ));
    }

    private function getShareCount($user){

      $active_fundraisers = Fundraiser::model()->findAll(array(
        'condition' => 'status=:status',
        'params' =>array(
          'status'=>'Y'
        ),
        'order'=> 'id DESC'
      ));

      $total_count = 0;

      foreach($active_fundraisers as $fundraiser){

        $fundraiser_url = $fundraiser->getSocialUserURL($user);

        $shares = $this->shareThisAPICall($fundraiser_url);

        $total_count = $total_count + $shares;
        
      }

      return $total_count;
      
    }

    private function shareThisAPICall($fundraiser_url){

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

    public function actionCommunity(){

      $model = new CommunityFundraiser();

      $model->fundraiser_kind = 'community';
      
      if (isset($_POST['CommunityFundraiser'])) {

          $model->attributes = $_POST['CommunityFundraiser'];

          //$model->search_status = 'Y';
          $model->search_status = ($model->search_yes == 1) ? 'Y' : 'N';
          $model->status = 'Y';
          $model->status_new = 'Y';
          $model->feature_flag = 'N';
          $model->user_type = 'community';

          $model->lead_supporter_i_am = isset($_POST['OtherFundraiser']['lead_supporter_i_am']) && (int) $_POST['OtherFundraiser']['lead_supporter_i_am']==1 ? 1 :0;
          $model->lead_supporter_not_sure = isset($_POST['OtherFundraiser']['lead_supporter_not_sure']) && (int)$_POST['OtherFundraiser']['lead_supporter_not_sure'] == 1 ? 1 :0;

          $model->uploadFundraiserImage();
          $model->uploadLeadSupporterImage();
          $model->uploadFundManagerImage();


          if ($model->validate()) {
            
            $transaction = Yii::app()->db->beginTransaction();

            try {

              if($model->ftype_typ == '-1'){
                $sub_type = new FundraiserSubType();
                $sub_type->p_id = $model->ftype_id;
                $sub_type->fundraiser_subtyp = $model->ftype_typ_other;
                $sub_type->status = 'Y';
                $sub_type->save();
                $model->ftype_typ = $sub_type->id;
              }


              if($model->project_category == '-1'){
                $category = new ProjectCategory();
                $category->name = $model->project_category_other;
                $category->save();
                $model->project_category = $category->id;
              }

              if($model->project_champion == '-1'){

                $model->uploadChampionImage();
                $model->uploadChampionBgImage();

                $affiliate = new Affiliates();
                $affiliate->name = $model->project_champion_name;
                $affiliate->is_champion = 1;
                $affiliate->bg_image = $model->champion_bg_image;
                $affiliate->logo = $model->champion_logo;              
                $affiliate->save(false);
                $model->project_champion = $affiliate->id;    

            }else{
                $affiliate = Affiliates::model()->findByPk($model->project_champion);
                $model->champion_logo = $affiliate->logo;
                $model->champion_bg_image = $affiliate->bg_image;
                $model->project_champion_name = $affiliate->name;
            }

              if($model->fund_manager == '-1'){

                $affiliate = new Affiliates();
                $affiliate->name = $model->fund_mange_name;
                $affiliate->is_fundmanager = 1;
                $affiliate->email = $model->fund_mange_email;
                $affiliate->save(false);
                $model->fund_manager = $affiliate->id;    

              }else{
                  $affiliate = Affiliates::model()->findByPk($model->fund_manager);
                  $model->fund_mange_name = $affiliate->name;
                  $model->fund_mange_email = $affiliate->email;
                  $model->upload_pic_fun_manager = $affiliate->bg_image;
              }
          
              if($model->save()){
                  $transaction->commit();
                  $this->sendFundraiserEmail($model);
                  Yii::app()->user->setFlash('success', "Thanks for setting up a fundraiser on Giveyourbit."); 
                  $this->redirect(array('index', 'fundraiser_id' => $model->id)); 
              }else{
                $transaction->rollback(); 
              }

                              
            } catch (Exception $e) {
              $transaction->rollback();             
            }

          }
      }

      $ftype_list = array();

      if($model->isNewRecord && empty($model->ftype_id)){
          $model->ftype_id  = 4;
      }

      $data= FundraiserSubType::model()->findAll('p_id='.$model->ftype_id);
      $ftype_list= CHtml::listData($data,'id','fundraiser_subtyp');
      $ftype_list[-1] = "Other";

      $this->render('create', array(
        'model' => $model,
        'form_view' => 'form_community',
        'ftype_list' => $ftype_list,        
      ));

    }

    public function actionCorporate(){

      $model = new CorporateFundraiser();

      $model->fundraiser_kind = 'corporate';
      
      if (isset($_POST['CorporateFundraiser'])) {
          $model->attributes = $_POST['CorporateFundraiser'];

          $model->tell_ur_fund_story = substr($model->tell_ur_fund_story,0,1599);

          //Set fields that are not from form.                    
          $model->search_status = ($model->search_yes == 1) ? 'Y' : 'N';
          $model->status = 'Y';
          $model->status_new = 'Y';
          $model->feature_flag = 'N';
          $model->user_type = 'corporate';

          $model->lead_supporter_i_am = isset($_POST['OtherFundraiser']['lead_supporter_i_am']) && (int) $_POST['OtherFundraiser']['lead_supporter_i_am']==1 ? 1 :0;
          $model->lead_supporter_not_sure = isset($_POST['OtherFundraiser']['lead_supporter_not_sure']) && (int)$_POST['OtherFundraiser']['lead_supporter_not_sure'] == 1 ? 1 :0;
          
          $model->uploadFundraiserImage();
          $model->uploadBenificaryImage();
          $model->uploadChampionImage();
          $model->uploadChampionBgImage();
          $model->uploadFundManagerImage();
          $model->uploadLeadSupporterImage();
          $model->uploadLeadSupporterBgImage();

          if ($model->validate()) {
            
            $transaction = Yii::app()->db->beginTransaction();

            try {
    
                  if($model->project_category == '-1'){
                      $category = new ProjectCategory();
                      $category->name = $model->project_category_other;
                      $category->save();
                      $model->project_category = $category->id;
                  }

                  if($model->ftype_typ == '-1'){
                    $sub_type = new FundraiserSubType();
                    $sub_type->p_id = $model->ftype_id;
                    $sub_type->fundraiser_subtyp = $model->ftype_typ_other;
                    $sub_type->status = 'Y';
                    $sub_type->save();
                    $model->ftype_typ = $sub_type->id;
                }

                if($model->fund_manager == '-1'){

                    $affiliate = new Affiliates();
                    $affiliate->name = $model->fund_mange_name;
                    $affiliate->is_fundmanager = 1;
                    $affiliate->email = $model->fund_mange_email;
                    $affiliate->save(false);
                    $model->fund_manager = $affiliate->id;    

                  }else{

                      $affiliate = Affiliates::model()->findByPk($model->fund_manager);
                    
                      $model->fund_mange_name = $affiliate->name;
                      $model->fund_mange_email = $affiliate->email;
                      //$model->upload_pic_fun_manager = $affiliate->bg_image;
                      $model->upload_pic_fun_manager = $affiliate->logo;
                  }


                  if($model->project_champion == '-1'){

                    $model->uploadChampionImage();
                    $model->uploadChampionBgImage();

                    $affiliate = new Affiliates();
                    $affiliate->name = $model->project_champion_name;
                    $affiliate->is_champion = 1;
                    $affiliate->bg_image = $model->champion_bg_image;
                    $affiliate->logo = $model->champion_logo;              
                    $affiliate->save(false);
                    $model->project_champion = $affiliate->id;    

                }else{
                    $affiliate = Affiliates::model()->findByPk($model->project_champion);
                    $model->champion_logo = $affiliate->logo;
                    $model->champion_bg_image = $affiliate->bg_image;
                    $model->project_champion_name = $affiliate->name;
                }

                if($model->benifi_type == '1'){
                  $model->benifiry_name = $model->community_name;
                }
                                
                if($model->save()){
                  $transaction->commit();
                  $this->sendFundraiserEmail($model);
                  Yii::app()->user->setFlash('success', "Thanks for setting up a fundraiser on Giveyourbit."); 
                  $this->redirect(array('index', 'fundraiser_id' => $model->id)); 

                }else{
                  $transaction->rollback();
                }
                
              } catch (Exception $e) {
                  $transaction->rollback();             
              }

          }
      }

      $ftype_list = array();

      if($model->isNewRecord && empty($model->ftype_id)){
        $model->ftype_id  = 5;
      }

      $data= FundraiserSubType::model()->findAll('p_id='.$model->ftype_id);
      $ftype_list= CHtml::listData($data,'id','fundraiser_subtyp');
      $ftype_list[-1] = "Other";

      $this->render('create', array(
        'model' => $model,
        'form_view' => 'form_corporate',
        'ftype_list' => $ftype_list
      ));
      
    }

    public function actionNonprofit(){

      $model = new NonprofitFundraiser();

      $model->fundraiser_kind = 'nonprofit';
         
      if (isset($_POST['NonprofitFundraiser'])) {

          $model->attributes = $_POST['NonprofitFundraiser'];
          //Set fields that are not from form.
          //$model->search_status = 'Y';
          $model->search_status = ($model->search_yes == 1) ? 'Y' : 'N';
          $model->status = 'Y';
          $model->status_new = 'Y';
          $model->feature_flag = 'N';
          $model->user_type = 'non_profit';

          $model->lead_supporter_i_am = isset($_POST['OtherFundraiser']['lead_supporter_i_am']) && (int) $_POST['OtherFundraiser']['lead_supporter_i_am']==1 ? 1 :0;
          $model->lead_supporter_not_sure = isset($_POST['OtherFundraiser']['lead_supporter_not_sure']) && (int)$_POST['OtherFundraiser']['lead_supporter_not_sure'] == 1 ? 1 :0;
          
          $model->uploadFundraiserImage();
          $model->uploadBenificaryImage();
          $model->uploadBenificaryBgImage();
          $model->uploadLeadSupporterImage();
          //$model->uploadChampionImage();
          //$model->uploadChampionBgImage();
          $model->uploadFundManagerImage();

          if ($model->validate()) {

            $transaction = Yii::app()->db->beginTransaction();

            try {

                if($model->ftype_typ == '-1'){
                    $sub_type = new FundraiserSubType();
                    $sub_type->p_id = $model->ftype_id;
                    $sub_type->fundraiser_subtyp = $model->ftype_typ_other;
                    $sub_type->status = 'Y';
                    $sub_type->save();
                    $model->ftype_typ = $sub_type->id;
                }

                if($model->save()){
                    $transaction->commit();
                    $this->sendFundraiserEmail($model);
                    $this->createOtherAccounts($model);
                    Yii::app()->user->setFlash('success', "Thanks for setting up a fundraiser on Giveyourbit."); 
                    $this->redirect(array('index', 'fundraiser_id' => $model->id)); 
                }else{
                  $transaction->rollback();
                }

            } catch (Exception $e) {
              $transaction->rollback();              
            }

          }
        }


      $ftype_list = array();

      if($model->isNewRecord && empty($model->ftype_id)){
        $model->ftype_id  = 6;
      }

      $data= FundraiserSubType::model()->findAll('p_id='.$model->ftype_id);
      $ftype_list= CHtml::listData($data,'id','fundraiser_subtyp');
      $ftype_list['-1'] = "Other";

      $this->render('create', array(
        'model' => $model,
        'form_view' => 'form_nonprofit',
        'ftype_list' => $ftype_list
      ));
      
    }

    public function actionOther(){

      $model = new OtherFundraiser();

      $model->fundraiser_kind = 'other';
      
      if (isset($_POST['OtherFundraiser'])) {

          $model->attributes = $_POST['OtherFundraiser'];

          //Set fields that are not from form.
          //$model->search_status = 'Y';
          $model->search_status = ($model->search_yes == 1) ? 'Y' : 'N';
          $model->status = 'Y';
          $model->status_new = 'Y';
          $model->feature_flag = 'N';
          $model->user_type = 'other';
          $model->lead_supporter_i_am = isset($_POST['OtherFundraiser']['lead_supporter_i_am']) && (int) $_POST['OtherFundraiser']['lead_supporter_i_am']==1 ? 1 :0;
          $model->lead_supporter_not_sure = isset($_POST['OtherFundraiser']['lead_supporter_not_sure']) && (int)$_POST['OtherFundraiser']['lead_supporter_not_sure'] == 1 ? 1 :0;
          
          $model->uploadFundraiserImage();
          $model->uploadFundraiserBgImage();
          $model->uploadBenificaryImage();
          $model->uploadLeadSupporterImage();
          $model->uploadChampionImage();
          $model->uploadChampionBgImage();
          $model->uploadFundManagerImage();
          

          if ($model->validate()) {

            $transaction = Yii::app()->db->beginTransaction();

            try {

                if($model->ftype_typ == '-1'){
                  $sub_type = new FundraiserSubType();
                  $sub_type->p_id = $model->ftype_id;
                  $sub_type->fundraiser_subtyp = $model->ftype_typ_other;
                  $sub_type->status = 'Y';
                  $sub_type->save();
                  $model->ftype_typ = $sub_type->id;
                }


              if($model->save()){
                  $this->sendFundraiserEmail($model);
                  $this->createOtherAccounts($model);

                  $transaction->commit();
                  Yii::app()->user->setFlash('success', "Thanks for setting up a fundraiser on Giveyourbit."); 
                  $this->redirect(array('index', 'fundraiser_id' => $model->id)); 
               }else{
                  $transaction->rollback(); 
               }
            } catch (Exception $e) {
              $transaction->rollback();              
            }
          }
        }


      $ftype_list = array();
      
      
      if(!empty($model->ftype_id)){
        //$model->ftype_id  = 6;
        $data= FundraiserSubType::model()->findAll('p_id='.$model->ftype_id);
        $ftype_list= CHtml::listData($data,'id','fundraiser_subtyp');
        $ftype_list['-1'] = "Other";
      }
      
      $this->render('create', array(
        'model' => $model,
        'form_view' => 'form_other',
        'ftype_list' => $ftype_list
      ));
      
    }


    public function actionChampion(){
      

      $champion_id = (int)$_GET['champion_id'];

      $champion = Affiliates::model()->findByPk($champion_id);

      $response = array();

      if(is_object($champion)){
        $response = [
           'status' => true,
           'champion_logo' => SITE_ABS_PATH_FUNDRAISER_IMAGE .$champion->logo,
          'champion_bg_image' => SITE_ABS_PATH_FUNDRAISER_IMAGE.$champion->bg_image,
        ];
      }else{
        $response = [
          'status' => false,
        ];
      }

      print_r(json_encode($response));
      Yii::app()->end();
      
    }

    

    public function createOtherAccounts($fundraiser){

      $user_model = Users::model()->findByPk(Yii::app()->frontUser->id);

      if(!empty($fundraiser->fund_mange_email) && ($user_model->email != $fundraiser->fund_mange_email)){
  
          $fund_manager = Users::model()->find("email = :email",array('email' => $fundraiser->fund_mange_email));
  
          if(is_object($fund_manager)){
              $this->sendFundManagerEmail($fundraiser,$fund_manager);                        
          }else{
              $model = new Users();
      
              $model->email = $fundraiser->fund_mange_email;
              $model->username = $fundraiser->fund_mange_name;
              $model->first_name = $fundraiser->fund_mange_name;
              $model->last_name = ' ';
              $model->age = $fundraiser->fund_mange_age;
              $model->sex = $fundraiser->fund_mange_sex;
              
              $user_token = md5('giveyourbit'.rand(100,1000).time());        
              $model->user_token = $user_token;
              $model->email_verification = 'N';
              $model->user_type = '2';
              $password = 'wrwr'.time();
              $model->password = $password;
              $model->confirm_password = $password;
              $model->agree_to_terms = 1;
              $model->request_verification=' ';
              
              if($model->save(false)){
                $this->sendFundManagerAccountEmail($fundraiser,$model);
              }
          }          
      }
  

      if(!empty($fundraiser->benifi_email) && ($user_model->email != $fundraiser->benifi_email)){
  
        $beneficiary = Users::model()->find("email = :email",array('email' => $fundraiser->benifi_email));
  
        if(is_object($beneficiary)){
          $this->sendBeneficiaryEmail($fundraiser,$beneficiary);
        }else{ 

          $model = new Users();
    
          $model->email = $fundraiser->benifi_email;
          $model->username = $fundraiser->benifiry_name;
          $model->first_name = $fundraiser->benifiry_name;
          $model->last_name = ' ';
          $model->age = $fundraiser->benifi_age;
          $model->sex = $fundraiser->benifi_sex;
          
          $user_token = md5('giveyourbit'.rand(100,1000).time());        
          $model->user_token = $user_token;

          $model->email_verification = 'N';
          $model->user_type = '2';
          $password = 'wrwr'.time();
          $model->password = $password;
          $model->confirm_password = $password;
          $model->agree_to_terms = 1;
          $model->request_verification=' ';          
          if($model->save(false)){            
             $this->sendBeneficiaryAccountEmail($fundraiser,$model);
          }
        }
      }

    }

    private function sendFundraiserEmail($fundraiser){

        //$user_model = Users::model()->findByPk(Yii::app()->frontUser->id);
        $user_model = Users::model()->findByPk($fundraiser->user_id);

        $template_model = EmailTemplates::model()->findByShortCode('fundraiser_confirmation');
    
        $html_template = $template_model->template;
        $text_template = $template_model->text_email;

        $html_template = str_replace('#USSERNAME#', ucfirst($user_model->username), $html_template);
        $html_template = str_replace('#LEADSUPPORTERNAME#', ucfirst($fundraiser->lead_supptr_name), $html_template);
        $html_template = str_replace('#FUNDMANAGERNAME#', ucfirst($fundraiser->fund_mange_name), $html_template);

        if(!empty($text_template)){
          $text_template = str_replace('#USSERNAME#', ucfirst($user_model->username), $text_template);
          $text_template = str_replace('#LEADSUPPORTERNAME#', ucfirst($fundraiser->lead_supptr_name), $text_template);
          $text_template = str_replace('#FUNDMANAGERNAME#', ucfirst($fundraiser->fund_mange_name), $text_template);
        }

        $this->send_email($user_model->email, $template_model->subject, $html_template,$text_template);
    
        $this->text_message.=" <br> Sent email fundraiser_confirmation to ".$user_model->email;
    }

    private function sendBeneficiaryEmail($fundraiser,$user_model){
      
      $template_model = EmailTemplates::model()->findByShortCode('beneficiary_email');
  
      $html_template = $template_model->template;
      $text_template = $template_model->text_email;

      $html_template = str_replace('#USRFULLNAME#', ucfirst($user_model->username), $html_template);
      $html_template = str_replace('#ACTIVE_LINK#', $fundraiser->getAbsoluteURL(),$html_template);
      $html_template = str_replace('#COMPLETE_LINK#', $fundraiser->getAbsoluteURL(), $html_template);

      if(!empty($text_template)){
        $text_template = str_replace('#USRFULLNAME#', ucfirst($user_model->username), $text_template);
        $text_template = str_replace('#ACTIVE_LINK#', $fundraiser->getAbsoluteURL(),$text_template);
        $text_template = str_replace('#COMPLETE_LINK#', $fundraiser->getAbsoluteURL(), $text_template);  
      }

      $this->send_email($user_model->email, $template_model->subject, $html_template,$text_template);
      $this->text_message.=" <br> Sent email beneficiary_email to ".$user_model->email;
    }


    private function sendFundManagerEmail($fundraiser,$user_model){
      
      $template_model = EmailTemplates::model()->findByShortCode('fund_manager_email');
  
      $html_template = $template_model->template;
      $text_template = $template_model->text_email;

      $html_template = str_replace('#USRFULLNAME#', ucfirst($user_model->username), $html_template);
      $html_template = str_replace('#ACTIVE_LINK#', $fundraiser->getAbsoluteURL(),$html_template);
      $html_template = str_replace('#COMPLETE_LINK#', $fundraiser->getAbsoluteURL(), $html_template);

      if(!empty($text_template)){
        $text_template = str_replace('#USRFULLNAME#', ucfirst($user_model->username), $text_template);
        $text_template = str_replace('#ACTIVE_LINK#', $fundraiser->getAbsoluteURL(),$text_template);
        $text_template = str_replace('#COMPLETE_LINK#', $fundraiser->getAbsoluteURL(), $text_template);  
      }

      $this->send_email($user_model->email, $template_model->subject, $html_template,$text_template);
      $this->text_message.=" <br> Sent email fund_manager_email to ".$user_model->email;
    }

    private function sendBeneficiaryAccountEmail($fundraiser,$user_model){
      
      $template_model = EmailTemplates::model()->findByShortCode('beneficiary_account_email');
  
      $html_template = $template_model->template;
      $text_template = $template_model->text_email;

      //$token = base64_encode($this->encrypt($user_model->user_token, ENCRYPTION_KEY));
      $credentials_url = Yii::app()->createAbsoluteUrl('site/credentials', array('token' => $user_model->user_token));


      $html_template = str_replace('#USRFULLNAME#', ucfirst($user_model->username), $html_template);
      $html_template = str_replace('#ACTIVE_LINK#', $credentials_url,$html_template);
      $html_template = str_replace('#COMPLETE_LINK#', $credentials_url, $html_template);

      if(!empty($text_template)){
        $text_template = str_replace('#USRFULLNAME#', ucfirst($user_model->username), $text_template);
        $text_template = str_replace('#ACTIVE_LINK#', $credentials_url,$text_template);
        $text_template = str_replace('#COMPLETE_LINK#', $credentials_url, $text_template);  
      }

      $this->send_email($user_model->email, $template_model->subject, $html_template,$text_template);

      $this->text_message.=" <br> Sent email beneficiary_account_email to ".$user_model->email;
    }


    private function sendFundManagerAccountEmail($fundraiser,$user_model){

      $template_model = EmailTemplates::model()->findByShortCode('fund_manager_account_email');
  
      $html_template = $template_model->template;
      $text_template = $template_model->text_email;

      //$token = base64_encode($this->encrypt($user_model->user_token, ENCRYPTION_KEY));
      $credentials_url = Yii::app()->createAbsoluteUrl('site/credentials', array('token' => $user_model->user_token));

      $html_template = str_replace('#USRFULLNAME#', ucfirst($user_model->username), $html_template);
      $html_template = str_replace('#ACTIVE_LINK#', $credentials_url,$html_template);
      $html_template = str_replace('#COMPLETE_LINK#', $credentials_url, $html_template);

      if(!empty($text_template)){
        $text_template = str_replace('#USRFULLNAME#', ucfirst($user_model->username), $text_template);
        $text_template = str_replace('#ACTIVE_LINK#', $credentials_url,$text_template);
        $text_template = str_replace('#COMPLETE_LINK#', $credentials_url, $text_template);  
      }

      $this->send_email($user_model->email, $template_model->subject, $html_template,$text_template);
      $this->text_message.=" <br> Sent email fund_manager_account_email to ".$user_model->email;
    }


    function random_password1( $length = 8 ) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
            $password1 = substr( str_shuffle( $chars ), 0, $length );
            return $password1;
        }
    
    function random_password2( $length = 8 ) {
            $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*";
            $password2 = substr( str_shuffle( $chars ), 0, $length );
            return $password2;
    }
    
    
    public function actionnewuser($lead_supptr_name,$lead_supptr_email,$lead_supptr_sex,$lead_supptr_age,$uplod_pic_lead_supptr,$lead_supptr_pss){
//     echo $lead_supptr_name."aaaaaaaaaa";
//        die;
        //$sendpassword1 = $this->random_password1(8);
        $model = new Users();
        $model->username=$lead_supptr_name;
        $model->email=$lead_supptr_email;
        $model->sex=$lead_supptr_sex;
        $model->age=$lead_supptr_age;
        $model->user_image=$uplod_pic_lead_supptr;
        $model->user_type='2';
        $digits = 5;
        $random_digit = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
        $model->user_token = $random_digit;
        $model->email_verification = 'Y';
        $model->password=md5($lead_supptr_pss);
        $model->status_new = 'Y';
                      
        if ($model->save(false)) {
            if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                        Yii::app()->end();
                    } else {
                    }
                }
         // return $sendpassword1;  
            //return random_password1(8);
               
    }
    

    public function actionnewuser1($fund_mange_name,$fund_mange_email,$fund_mange_sex,$fund_mange_age,$upload_pic_fun_manager,$fund_mange_pss){
        //$sendpassword2 = $this->random_password2(8);                
        $model = new Users();
        $model->username=$fund_mange_name;
        $model->email=$fund_mange_email;
        $model->sex=$fund_mange_sex;
        $model->age=$fund_mange_age;
        $model->user_image=$upload_pic_fun_manager;
        $model->user_type='2';
        $digits1 = 5;
        $random_digit1 = rand(pow(10, $digits1 - 1), pow(10, $digits1) - 1);
        $model->user_token = $random_digit1;
        $model->email_verification = 'Y';
        $model->password=md5($fund_mange_pss); 
        $model->status_new = 'Y';
        if ($model->save(false)) {
            
            if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                        Yii::app()->end();
                    } else {
                        
                    }
                   
                }
                //return $sendpassword2;
                //return random_password2(8);
    }
        
    
        public function actionLogout()
    {
        Yii::app()->frontUser->logout(false);
        $this->redirect(Yii::app()->homeUrl);
    }

    public function actionGetquestion()
    {
        if (!empty($_POST['FundraiserQuestions'])) {
            $answer = new FundraiserQuestions();
            $answer->user_id = $_POST['FundraiserQuestions']['user_id'];
            $answer->topic_id = $_POST['FundraiserQuestions']['topic_id'];
            $answer->questions_text = $_POST['FundraiserQuestions']['questions_text'];
            if ($answer->save(false)) {
                echo "Thank you for sharing your question";
            }
        }
    }

    public function actionQuestion()
    {
        $model = new FundraiserQuestions();
        $this->render('question', array('model' => $model));
    }

    /*
    public function actionForgotpassword()
    {
        $this->pageTitle = ' - Forgot Password';
        $model = new Users();

        // if it is ajax validation request
        if (isset($_POST['ajax']) && $_POST['ajax'] === 'admin-forgot-password-form') {
            echo CActiveForm::validate($model);
            Yii::app()->end();
        }
        // collect user input data
        if (isset($_POST['Users'])) {
            $model->attributes = $_POST['Users'];
            $new_password = UtilityHtml::generate_password();
//            $new_password = time() . rand('998', '898');

            $user_model = Users::model()->find("email=:email", array(':email' => $model->email));
            if (!empty($user_model)) {
                $user_model->password = md5($new_password);
                $user_model->save(false);
                $email_model = EmailTemplates::model()->findByPk('6');
//                $email_model = EmailTemplates::model()->find("short_code = 'FORGOT PASSWORD'");
                $email_template = $email_model->template;
                $email_template = str_replace('#USRFULLNAME#', ucfirst($user_model->username), $email_template);
                $encrypted = $this->encrypt($user_model->id, ENCRYPTION_KEY);
                $link = 'http://' . $_SERVER['HTTP_HOST'] . Yii::app()->createUrl('Fundraise/Resetpassword', array('pk' => base64_encode($encrypted)));
                $email_template = str_replace('#ACTLINK#', $link, $email_template);
                $email_template = str_replace('#LINKONLY#', $link, $email_template);
                $email_template = str_replace('#CUR_YEAR#', date('Y'), $email_template);
                $this->send_email($model->email, $email_model->subject, $email_template);
                Yii::app()->user->setFlash('success', Yii::t("success", "Your change password details has been send on your email"));
                $this->redirect(Yii::app()->createUrl('fundraise/Forgotpassword'));

            } else {
                Yii::app()->user->setFlash('error', Yii::t("error", "User does not found please try again later.!"));
                $this->redirect(Yii::app()->createUrl('fundraise/Forgotpassword'));
            }
        }

        $this->render('forgot_password', array('model' => $model));
    }

    public function actionResetpassword()
    {
        $model = new ChangePassword();
        $decrypted = $this->decrypt(base64_decode($_REQUEST['pk']), ENCRYPTION_KEY);
        if (!empty($_POST['ChangePassword'])) {
            if ($decrypted != "") {
                $user_model = Users::model()->findByPk($decrypted);
                $new_password = $_POST['ChangePassword']['new_password'];
                $user_model = Users::model()->find("id=:id", array('id' => $decrypted));
                if (!empty($user_model)) {
                    $user_model->password = md5($new_password);
                    $user_model->save(false);
                    Yii::app()->user->setFlash('success', Yii::t("success", "Password has been changed successfully.."));
                    $this->redirect(Yii::app()->createUrl('Fundraise/Resetpassword',array('pk' => base64_encode($_REQUEST['pk']))));
                } else {
                    Yii::app()->user->setFlash('error', Yii::t("error", "User does not found please try again later.!"));
                    $this->redirect(Yii::app()->createUrl('Fundraise/Resetpassword',array('pk' => base64_encode($_REQUEST['pk']))));
                }
            } else {
                Yii::app()->frontUser->setFlash('success', Yii::t("success", "Oops, Reset password link has been expired."));
                $this->redirect(Yii::app()->createUrl('site/login'));
            }
        }
        $this->render('resetpassword', array('model' => $model));
    }

    */

    public function actionFund_transfer(){

          if(!$this->checkLogin()){
              $this->redirect(array('site/index')); 
          }
        
          $model = new FundtransferByuser();

          $user_id=Yii::app()->frontUser->id;

          if(!empty($_POST['FundtransferByuser'])){

                $model->attributes = $_POST['FundtransferByuser']; 

                $model->user_id=$user_id;
                $model->created_by = $user_id;
                $model->status='pending';
                $model->status_new = 'Y';

                if ($model->save()) {
                    /*
                    $user_model = Users::model()->find("id=:id", array('id' => $id));
                    $user_admin = Users::model()->find("user_type=:user_type", array('user_type' => '1'));
                    $admin_email=$user_admin->email;
                    $customer_email = $user_model->email;
                    $customer_username = $user_model->username;

                    $email_model = EmailTemplates::model()->findByPk('7');
                    $email_template = $email_model->template;
                    $email_template = str_replace('#USRFULLNAME#', ucfirst($customer_username), $email_template);
                    //$this->send_email($user_model->email, $email_model->subject, $email_template);
                    mail($user_model->email, $email_model->subject, $email_template);
                    $email_model_admin = EmailTemplates::model()->findByPk('9');
                    $email_template_admin = $email_model_admin->template;
                    $email_template_admin = str_replace('#USERNAME#', ucfirst($customer_username), $email_template_admin);
                    $email_template_admin = str_replace('#ACCOUNT_NUBMER#', ucfirst($model->fundraiser_account), $email_template_admin);
                   // $this->send_email($admin_email, $email_template_admin->subject, $email_template_admin);
                    mail($admin_email, $email_template_admin->subject, $email_template_admin);
                    $this->donnermail($data11);
                    $this->suppormail($data12);
                    */
                    Yii::app()->user->setFlash('success', Yii::t("success", "Fund Tranfer request successfully sent."));                                                
                }
        }

        $transfer_requests = FundtransferByuser::model()->findAll('user_id = :user_id',array('user_id' => $user_id));

        $this->render('fund_transfer', array(
          'model' => $model,
          'transfer_requests' => $transfer_requests,
        ));
    }
   

    
    public function actionInvite_friends(){

        if(!$this->checkLogin()){
            $this->redirect(array('site/index')); 
        }

        $model=  new InviteFriendForm;

        $type = isset($_REQUEST['type']) ? $_REQUEST['type'] : 'email';

        if (!empty($_POST['InviteFriendForm'])) {
            //if($model->validate()){
                if ($_REQUEST['type']=='email'){
                    
                        $email=$_POST['InviteFriendForm']['email'];
                        $greeting= isset($_POST['InviteFriendForm']['greeting']) ? $_POST['InviteFriendForm']['greeting'] : 'Hello Dear Friend';
                        //$sender_name = $_POST['InviteFriendForm']['sender_name'];
                        $email_data = explode(",", $email); 
                                              
                        $fundraiser_data= SetupFundraiser::model()->find('id='.$_POST['InviteFriendForm']['fundraiser_name']);
                        //p($fundraiser_data) ;die;
                        
                        $fundraiser_path= SITE_ABS_PATH."index.php/"."fundraiser"."/".$fundraiser_data->id."/thankyou";
                        $fundraiser_img= SITE_ABS_PATH_FUNDRAISER_IMAGE.$fundraiser_data->uplod_fun_img;
                        $fundraisre_tittle=$fundraiser_data->fundraiser_title;
                        
                        foreach ($email_data as $key){
                          //  p($key);
                          $receiver_email= $key;
                          $id=Yii::app()->frontUser->id;
                          $user_model = Users::model()->find("id=:id", array('id' => $id));
                          $username= $user_model->username;
                          //$username= !empty($sender_name) ? $sender_name : $user_model->username;

                          $link_slug = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraisre_tittle);
                          $link_slug = str_replace("'", '', $link_slug);
                          $link_slug = strtolower($link_slug);

                          $fundreiaser_url = Yii::app()->createAbsoluteUrl('fundraiser/index', array('id' => $fundraiser_data->id, 'fundraiser_name' => $link_slug));
                          $fundraiser_name_link = '<a href="'.$fundreiaser_url.'">'.$fundraisre_tittle.'</a>';

                          $email_model = EmailTemplates::model()->findByPk('8');
                          $subject = str_replace('#USERNAME#', ucfirst($username), $email_model->subject);
                          $email_template = $email_model->template;
                          $email_template = str_replace('#USERNAME#', ucfirst($username), $email_template);
                          $email_template = str_replace('#FUNDRAISER_LINK#', ucfirst($fundraiser_path), $email_template);
                          $email_template = str_replace('#FUNDRAISER_IMAGE#', ucfirst($fundraiser_img), $email_template);
                          $email_template = str_replace('#FUNDRAISR_NAME#', $fundraiser_name_link, $email_template);
                          $email_template = str_replace('#CASE_NO#',$fundraiser_data->id, $email_template);
	
                          $email_template = str_replace('#PERSONAL_GREETING#',$greeting, $email_template);
                          

                          $report_invitefriends= new ReportInvitefriends();
                          $report_invitefriends->receiver_email=$receiver_email;
                          $report_invitefriends->fundraiser_id=$fundraiser_data->id;
                          $report_invitefriends->service_provider="ByEmail";
                          $report_invitefriends->sender_id=$id;
                          $report_invitefriends->greeting=$greeting;
                          $report_invitefriends->save(false);

                          $rewardModel = new RewardPoints();
                          if($type == 'email'){
                            $rewardModel->addPoints($fundraiser_data->id,'invite_by_email',0,$user_model->id);
                          }else if($type =='phone'){
                            $rewardModel->addPoints($fundraiser_data->id,'invite_by_phone',0,$user_model->id);
                          }

                          $this->send_email($receiver_email, $subject, $email_template);
	
                          Yii::app()->user->setFlash('success', Yii::t("success", "Invitation has been successfully sent."));    
                        }
                    
                }else {   
             		  
                  $pathinfo = SITE_ABS_PATH."index.php/".Yii::app()->request->getPathInfo()."?f_id=".$_POST['InviteFriendForm']['fundraiser_name'];
                  $this->redirect($pathinfo);
                        //$contact_numbers=$_POST['InviteFriendForm']['contact_numbers'];
                        //$contact_data= explode(",", $contact_numbers); 
                        //p($contact_data);die;
                        //foreach($contact_data as $key_val){
                        //    $number=$key_val;
                        //}
                        
                        //$sender_model = Users::model()->find("id=:id", array('id' => Yii::app()->frontUser->id));
                        //$sender_name= $sender_model->username;
                       	// $message .= "Hi ".'<br><br>';
                        //$message .= "You have invitation from the $sender_name.".'<br><br>';
                        //$message .= "Thanks".'<br>';  
                        //$message .= "".$sender_name.".";
                        //p($message);die;
                        //Yii::app()->user->setFlash('success', Yii::t("success", "Invitation has been successfully sent."));    
                }
            //}//p($model->getErrors());die;        
        }


        $this->render('invite_friends', array(
              'model' => $model,
              'type' => $type,
        ));
    }
    
    
    public function actionGmail_contacts(){
       
        $_SESSION['new_fundraiser_id']=$_REQUEST['fundraiser'];
      

        $this->redirect('https://accounts.google.com/o/oauth2/auth?client_id=208714488425-2eo3gght0gu62op5mtrqardfp13nfbss.apps.googleusercontent.com&redirect_uri=http://giveyourbit.com/index.php/Fundraise/gmail_contacts_import&scope=https://www.google.com/m8/feeds/&response_type=code');

    }
    

    public function actionInvite_bymo_response(){
        
        $this->layout = 'main_popup';
        $this->render('invite_bymo_alert');
    }
    public function actionCheck_fund_transfer(){
        $fundraiser_data= SetupFundraiser::model()->find('id='.$_REQUEST['fundraiser_id']);
        $timefromdb = time(); // or your date as well
        $future = strtotime($fundraiser_data->fundraiser_timeline); //Future date.
        $timeleft = $future-$timefromdb;
        $daysleft = round((($timeleft/24)/60)/60);
        if($daysleft < 0) {
            $daysleft = 0;
        }
        if($daysleft!=0){
              $pathinfo = $this->createUrl('fundraise/fund_transfer',array('fund_id'=>$_REQUEST['fundraiser_id']));
              $this->redirect($pathinfo);
        }
    }

    public function actionCheck_fundtimeline(){
	      $fundraiser_data= SetupFundraiser::model()->find('id='.$_REQUEST['fundraiser_id']);
        $this->render('fundtransfer_alert',array('fund_id'=> $_REQUEST['fundraiser_id'],'fundraiser_data'=>$fundraiser_data));
    }

    public function actionDynamiccities()
    {

        $post_d =$_POST['ftype_id'];
        //$data= FundraiserSubType::model()->findAll('p_id='.$post_d);

        $data= FundraiserSubType::model()->findAll(array("condition" => 'p_id='.$post_d, "order" => 'id DESC'));
        //Games::model()->findAll(array("condition" => "developer_id = '".$id."'","order" => "status"));
        $data=CHtml::listData($data,'id','fundraiser_subtyp');
        foreach($data as $value=>$name)
        {
            echo CHtml::tag('option',
                      array('value'=>$value),CHtml::encode($name),true);
        }

        echo CHtml::tag('option',
                      array('value'=>-1),CHtml::encode('Other'),true);

    }  

}