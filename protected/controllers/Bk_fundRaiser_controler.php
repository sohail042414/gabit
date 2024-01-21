<?php
//set_time_limit(0);

class FundraiserController extends FrontCoreController
{


    public function actionPayment(){
        $this->layout = 'main';
        //echo "Herere"; exit;

        $this->render('payment', array(
            //'model' => $model, 
            //'fundraiser_id' => $id, 
            //'fundraiser_name' => $_REQUEST['fundraiser_name']
        ));
    }

    public function actionReturn(){
        
        echo "Herere returned back from payment"; exit;

        $this->layout = 'main';
        //echo "Herere"; exit;

        $this->render('payment', array(
            //'model' => $model, 
            //'fundraiser_id' => $id, 
            //'fundraiser_name' => $_REQUEST['fundraiser_name']
        ));
    }


    /*
     * Action for common page template for all setup fundraiser
     */
    public function actionIndex($id)
    {
        
        $fundraiser_object = $this->loadModel($id, 'SetupFundraiser');

        // $fb_config = Yii::app()->params['fb_config'];


        // $fb_share_url ="https://www.facebook.com/dialog/share?
        // app_id=".$fb_config['app_id']."
        // &display=popup
        // &href=".Yii::app()->createUrl('fundraiser/index',array('id' => $id))."
        // &redirect_uri=".Yii::app()->createUrl('fundraiser/index',array('id' => $id));

        $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser_object->fundraiser_title);
        $title = str_replace("'", '', $title);
        $title = str_replace('"', '', $title);

        $fb_share_url = Yii::app()->createAbsoluteUrl("fundraiser/$id/$title");

        $this->render('index', array(
            'fundraiser_object' => $fundraiser_object,
            'fb_share_url' => $fb_share_url
            )
        );
    }

    public function actionCaseupdates($id)
    {
         $this->layout = 'main';
        $case=CaseUpdates::model()->findAll('id = '.$id);
        $this->render('caseupdates', array('case_object' => $case,'fundraiser_object'=>$fundraiser_object));
    
      
    }
    
    /*
     * Action for add donation data of the specific fundraiser
     */
    public function actionDonations($id)
    {
            
        $this->layout = 'main_popup';
        $model = new Donations;
        if (isset($_POST['Donations'])) {        
            $_POST['Donations']['donor_phone_no']="+".$_POST['Donations']['country_code']." ".$_POST['Donations']['donor_phone_no'];            
            $model->setAttributes($_POST['Donations']);
            $model->updated_date = date('Y-m-d h:i:s',time());
            $model->donor_message = '--';
            $model->user_id = '0';            
            if ($model->save(false)) {
                if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                    Yii::app()->end();
                } else {
                    Yii::app()->session['donntion_tt'] = $_REQUEST['fundraiser_name'];
                    $this->redirect(array('responsemessage', 'id_value' => $model->id, 'phone_no'=> $model->donor_phone_no, 'fundraiser_id'=> $model->fundraiser_id, 'donation_amount'=> $model->donation_amount, 'donor_email_address'=> $model->donor_email, 'donor_name'=> $model->donor_name, 'user_id'=> $model->user_id, 'country_code'=> $model->country_code, 'donation_titl'=> $_REQUEST['fundraiser_name']));
                }
            }
        }
        $this->render('donations', array('model' => $model, 'fundraiser_id' => $id, 'fundraiser_name' => $_REQUEST['fundraiser_name']));
    }

   //}
    /*
     * Action for response message of the send donation for the fundraiser
     */
//    public function actionResponce(){
//      $this->render('responce');  
//    }

    public function actionResponsemessage()
    { 

        $phn = $_REQUEST['phone_no'] ;
        $this->layout = 'main_popup';
        if($_REQUEST['txnref']==""){
            //pass all data to view here. 
            //REquest contains all this. 
            /**
             * Array
            (
                [id_value] => 427
                [phone_no] => +234 5454
                [fundraiser_id] => 14
                [donation_amount] => 1000
                [donor_email_address] => kamal@gmail.com
                [donor_name] => Kamal
                [user_id] => 0
                [country_code] => 
                [donation_titl] => Kidney and pancreas transplant
            ) */           
             



            $this->render('response_message');
        } else {  
            $tl_mm = $_REQUEST['amount']/100;
            $data_amunt = ($_REQUEST['amount']-(5*$_REQUEST['amount']/100))/100;
            $headers = "MIME-Version: 1.0" . "\r\n";
            $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";    
        // $to = "neha@infobot-technologies.com";
            $to = $_SESSION['front_email']; 
            $subject = "Your Donation Receipt";
            $message = '<div class="content-box" style="max-width:700px; display:block; overflow:hidden; margin:0 auto; border:1px solid #000; padding:10px 10px;">
            <section class="row-section" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
            <div class="left-part" style="float:left;">
            <h3 style="font-size:16px; margin:0;">Transaction No. ' . $_REQUEST['txnref'] .  '</h3>
            </div>

            <div class="right-part" style="float:right;">
            <p style="margin:0; line-height: 22px;"><span>Print Receipt</span><br>
            Giveyourbit.com<br>
            VAT: 29766547</p>
            </div>

            </section>

            <section class="row-section rs2" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
            <div style="width:32%; float:left;">
            <ul style="display:block; overflow:hidden; list-style:none; padding-left:10px;">
            <li><strong>Billed to:</strong> Name:' .$_SESSION['front_username'].'</li>
            <li>Email:'. $_SESSION['front_email'].'</li>
            <li>Phone No.:'. $phn.'</li>
            </ul>
            </div>

            <div style="width:32%; float:left;">
            <ul style="display:block; overflow:hidden; list-style:none; padding-left:10px;">
            <li style="padding-left:37px;"><strong>Date:</strong></li>
            <li style="padding-left:37px;"><strong>Transaction Total:</strong></li>
            <li style="padding-left:37px;"><strong>Receipt #:</strong></li>
            </ul>
            </div>

            <div style="width:32%; float:left;">
            <ul style="display:block; overflow:hidden; list-style:none; padding-left:10px;">
            <li style="text-align:right;">05/06/2017</li>
            <li style="text-align:right;"><span>&#8358</span>'.$tl_mm .' NGN</li>
            <li style="text-align:right;">'.$_REQUEST['retRef'].'</li>
            </ul>
            </div>
            </section>

            <section class="row-section rs3" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
            <div class="left-part" style="float:left;">
            <ul style="display:block; overflow:hidden; list-style:none; padding:0;">
            <li style="display:inline-block; border-right:2px solid #CCC; padding:10px 10px;">Item</li>
            <li style="display:inline-block; padding:10px 10px;">Description</li>
            </ul>
            </div>

            <div class="right-part" style="float:right;">
            <ul style="display:block; overflow:hidden; list-style:none; padding:0;">
            <li style="border-left:2px solid #CCC; padding:10px 10px;">Amount</li>
            </ul>
            </div>

            </section>

            <section class="row-section rs3" style="display:block; overflow:hidden; width:100%; border-bottom:1px solid #000; padding: 5px 0 15px 0;">
            <div class="left-part" style="float:left;">
            <ul style="display:block; overflow:hidden; list-style:none; padding:0;">
            <li style="display:inline-block; padding:10px 20px;">1</li>
            <li style="display:inline-block; padding:10px 10px;">Donation to Save Joe from Cancer Fundraiser</li>
            </ul>
            </div>

            <div class="right-part" style="float:right;">
            <p style="text-align:right"><span>&#8358</span>'. $data_amunt. 'NGN<br>
            +5% VAT</p>
            </div>

            </section>

            <section class="row-section rs3" style="display:block; overflow:hidden; width:100%; padding: 5px 0 15px 0;">


            <div class="right-part" style="float:right; width:50%">
            <ul style="list-style:none; display:block; overflow:hidden; padding-left:0;">
            <li style="display:block; overflow:hidden; padding-bottom:5px; border-bottom:1px solid #000; margin-bottom:5px">
            <p style="float:left; margin:0; font-weight:bold; font-size:13px;">Transaction Total:</p>
            <p style="float:right; margin:0; font-weight:bold; font-size:13px;"><span>&#8358</span>'.$tl_mm.' NGN</p>
            </li>
            <li style="display:block; overflow:hidden; padding-bottom:5px; border-bottom:1px solid #000; margin-bottom:5px">
            <p style="float:left; margin:0; font-size:13px;">Payment:</p>
            <p style="float:right; margin:0; color:#F00; font-size:13px;">(US$'. $tl_mm.')</p>
            </li>
            <li style="display:block; overflow:hidden; padding-bottom:5px;">
            <p style="float:left; margin:0; font-weight:bold; font-size:13px;">VAT:</p>
            <p style="float:right; margin:0; font-weight:bold; font-size:13px;"><span>&#8358</span>'. (5*$_REQUEST['amount']/100)/100 .' NGN</p>
            </li>
            </ul>
            </div>

            </section>

            </div>';
            $form = "giveyourbit.com";
            mail($to, $subject, $message, $headers, $from ); 
            $this->render('response_message');    
        }
    }

     public function actionResponsemessagepayment()
        {
        //$current_donner_id = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->id:null;  
            $this->layout = 'main_popup';
        // $this->render('responsemessagepayment', array('id_value_b' => $_REQUEST['id_value_a'], 'phone_no_a'=> $_REQUEST['phone_no_a'], 'fundraiser_id_b'=> $_REQUEST['fundraiser_id_a'], 'donation_amount_b'=> $_REQUEST['donation_amount_a'], 'donor_email_address_b'=> $_REQUEST['donor_email_address_a'], 'donor_name_b'=> $_REQUEST['donor_name_a'], 'user_id_b'=> $_REQUEST['user_id_a'], 'country_code_b'=> $_REQUEST['country_code_a']));
            $this->render('responsemessagepayment');
        }

    /*
     * Action for find fundraiser based on a fundraiser type
     */
    public function actionFindfundraiser()
    {
        if (!empty($_REQUEST['fundraiser_id'])) {
            $getcount = 0;
            $featured_fundraiser = SetupFundraiser::model()->findAll(array('select' => '*', 'condition' => 'feature_flag = "Y" AND ftype_id = "' . $_REQUEST['fundraiser_id'] . '" AND status = "Y" '));
            $getcount = count($featured_fundraiser);
            $temp = '';
            if (!empty($featured_fundraiser)) {
                foreach ($featured_fundraiser as $fundraiser) {
                    $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser->fundraiser_title);
                    $title = str_replace("'", '', $title);
                    $title = strtolower($title);
                    $percentage = UtilityHtml::get_fundraiser_percent($fundraiser->fundraiser_amount_need, $fundraiser->id);
                    $ftt = FundraiserSubType::model()->find(array('select' => '*', 'condition' => 'id = "'.$fundraiser->ftype_id.'"'));
                    $temp .= '<a href=' . $this->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title)) . '>
                                <div class="slide">
                                 <h4 class="teg-h4">' . $ftt->fundraiser_subtyp  . '</h4>

                                    <div class="section-img"><img style="height:221px;"
                                            src=' . SITE_ABS_PATH_FUNDRAISER_IMAGE . $fundraiser->fundraiser_image . '></div>
                                    <h4 class="teg1-h4 teg1-color">' . number_format($fundraiser->fundraiser_amount_need, 0, ",", ",") . ' NGN' . '</h4>

                                    <div class="slider-bottom-img ">
                                        <div class="percent_line" style="width:' . $percentage . '"></div>
                                    </div>
                                    <div class="parsen">
                                        <p class="left-teg">' . UtilityHtml::get_fundraiser_percent($fundraiser->fundraiser_amount_need, $fundraiser->id) . '</p>

                                        <p class="right-teg"> ' . UtilityHtml::fundraiser_time_elapsed($fundraiser->fundraiser_timeline) . '
                                    </div>
                                    <h4 class="teg1-h4 teg4-h4">Case No. ' . $fundraiser->id . '<br>' . $fundraiser->fundraiser_title . '</h4>
                                </div>
                            </a>';
                }
            }
//            if ($getcount == '1') {
//                $temp .= '<div class="slide mobile_view">
//                                    <h4 class="teg-h4"></h4>
//
//                                    <div class="section-img"></div>
//                                    <h4 class="teg1-h4 teg1-color"></h4>
//
//                                    <div class="slider-bottom-img ">
//                                    </div>
//                                    <h4 class="teg1-h4 teg4-h4"></h4>
//                                </div>
//                                <div class="slide mobile_view">
//                                    <h4 class="teg-h4"></h4>
//
//                                    <div class="section-img"></div>
//                                    <h4 class="teg1-h4 teg1-color"></h4>
//
//                                    <div class="slider-bottom-img ">
//                                    </div>
//                                    <h4 class="teg1-h4 teg4-h4"></h4>
//                                </div>
//                                <div class="slide mobile_view">
//                                    <h4 class="teg-h4"></h4>
//
//                                    <div class="section-img"></div>
//                                    <h4 class="teg1-h4 teg1-color"></h4>
//
//                                    <div class="slider-bottom-img ">
//                                    </div>
//                                    <h4 class="teg1-h4 teg4-h4"></h4>
//                                </div>';
//            }
//            if ($getcount == '2') {
//                $temp .= '<div class="slide mobile_view">
//                                    <h4 class="teg-h4"></h4>
//
//                                    <div class="section-img"></div>
//                                    <h4 class="teg1-h4 teg1-color"></h4>
//
//                                    <div class="slider-bottom-img ">
//                                    </div>
//                                    <h4 class="teg1-h4 teg4-h4"></h4>
//                                </div>
//                                <div class="slide mobile_view">
//                                    <h4 class="teg-h4"></h4>
//
//                                    <div class="section-img"></div>
//                                    <h4 class="teg1-h4 teg1-color"></h4>
//
//                                    <div class="slider-bottom-img ">
//                                    </div>
//                                    <h4 class="teg1-h4 teg4-h4"></h4>
//                                </div>';
//            }
//            if ($getcount == '3') {
//                $temp .= '<div class="slide mobile_view">
//                                    <h4 class="teg-h4"></h4>
//
//                                    <div class="section-img"></div>
//                                    <h4 class="teg1-h4 teg1-color"></h4>
//
//                                    <div class="slider-bottom-img ">
//                                    </div>
//                                    <h4 class="teg1-h4 teg4-h4"></h4>
//                                </div>';
//            }
            $temp .= '###' . $getcount;
            echo $temp;

        }
    }

    /*
     * Action for the comment of the specific fundraiser
     */
    public function actionFundraiserComment($id)
    {
        $this->layout = 'main_popup';
        $model = new FundraiserComment();
        if (isset($_POST['FundraiserComment'])) {
            $model->setAttributes($_POST['FundraiserComment']);
            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                    Yii::app()->end();
                } else {
                    $this->redirect(array('CommentMessage'));
                }
            }
        }
        $this->render('fundraiser_comment', array('model' => $model, 'fundraiser_id' => $id, 'fundraiser_name' => $_REQUEST['fundraiser_name']));
    }

    /*
     * Action for response message of the comment of fundraiser
     */
    public function actionCommentMessage()
    {
        $this->layout = 'main_popup';
        $this->render('comment_message');
    }

    /*
     * Action for latest comment of the fundraiser
     */
    public function actionFundraiserViewComment()
    {
        if (!empty($_POST['fundraiser_id'])) {
            $latest_comment = FundraiserComment::model()->findAll(array('select' => 'fundraiser_reference_id, name, email, comment, created_date', 'condition' => 'fundraiser_reference_id = ' . $_POST['fundraiser_id'] . ' AND status = "Y" ', 'order' => 'id DESC' /*, 'limit' => '5'*/));
            $this->renderPartial('comment_Fundraiser', array('latest_comment' => $latest_comment));
            
            
            /* if (!empty($latest_comment)) {
                $string = '';
                $string .= '<div class="comment_parent"><div class="comment_container">';
                foreach ($latest_comment as $comment) {
                    $string .= '<div>
                                <span>' . $comment->comment . '</span><br>
                                <Span>By : ' . $comment->name . '</Span>
                    <br><span>' . date('M, Y', strtotime($comment->created_date)) . '</span><hr>
                    </div><div>';
                }
                $string .= '</div>';
                echo $string;
            } else {
                echo '<div class="comment_parent">There are no available comments</div>';
            }
            /*
            $latest_comment = Supporter::model()->findAll(array('select' => 'user_id,fundraiser_id,created_date,supporter_image,supporter_message', 'condition' => 'fundraiser_id = ' . $_POST['fundraiser_id'] . ' AND status = "Y" ', 'order' => 'id DESC', 'limit' => '5'));
            if (!empty($latest_comment)) {
                $string = '';
                $string .= '<div class="comment_container">';
                foreach ($latest_comment as $comment) {
                    $supporter_image = '';
                    if (empty($comment->supporter_image)) {
                        $supporter_image = Yii::app()->request->baseUrl . "/images/Noimage.jpg";
                    } else {
                        $supporter_image = SITE_ABS_PATH_SUPPORTER_THUMB . $comment->supporter_image;
                    }
                    $string .= '<div class="img_supporter" style="float: left;margin: 0 8px 0 0; width: 50px;"><img src="' . $supporter_image . '" /></div>';
                    $string .= '<div>
                                <span>' . $comment->supporter_message . '</span><br>
                                <Span>By : ' . $comment->user->username . '</Span>
                    <br><span>' . date('M, Y', strtotime($comment->created_date)) . '</span><hr>
                    </div>';
                }
                $string .= '</div>';
                echo $string;
            } else {
                echo "There are no available comments";
            }
            */
        }
    }

    /*
     * Action for count hug of the fundraiser
     */
    public function actionHugcounter()
    {
        if (!empty($_POST['fundraiser_id'])) {
            $Client_ip = $_SERVER['REMOTE_ADDR'];
            $check_exits = FundraiserHug::model()->find(array('select' => 'id', 'condition' => 'ip_address = "' . $Client_ip . '"  AND fundraiser_id = ' . $_POST['fundraiser_id'] . ' '));
            $hug = array();
            $hug_count = 0;
            if (!empty($check_exits)) {
                $hug['hug_count'] = FundraiserHug::model()->count(array('select' => 'id', 'condition' => 'fundraiser_id = ' . $_POST['fundraiser_id'] . ' '));
                $hug['already_hug'] = 1;
            } else {
                $check_exits = new FundraiserHug();
                $check_exits->fundraiser_id = $_POST['fundraiser_id'];
                $check_exits->ip_address = $_SERVER['REMOTE_ADDR'];
                if ($check_exits->save(false)) {
                    $total_hug = FundraiserHug::model()->count(array('select' => 'id', 'condition' => 'fundraiser_id = ' . $_POST['fundraiser_id'] . ' '));
                    if (!empty($total_hug)) {
                        $hug['hug_count'] = $total_hug;
                    } else {
                        $hug['hug_count'] = 0;
                    }
                    $hug['already_hug'] = 0;
                }
            }
            echo json_encode($hug);
        }
    }


    public function actionBecome_supporter()
    {   
        $this->layout = 'main_popup';
        $model = new LoginForm();
        $signup = new Users();
        if (!empty(Yii::app()->frontUser->id) && !empty(Yii::app()->frontUser->username)) {
            $setup_fundriser = SetupFundraiser::model()->findByPk($_REQUEST['id']);
            //p($setup_fundriser->user);
            $this->redirect(array('supporter_message', 'id' => Yii::app()->frontUser->id, 'name' => $setup_fundriser->user->username, 'fundraiser' => $_REQUEST['id']));
        }
        if (!empty($_POST['LoginForm'])) {
            $exist_user = Users::model()->find("email = :email AND password = :password", array(':email' => $_POST['LoginForm']['username'], ':password' => md5($_POST['LoginForm']['password'])));
            
            if (!empty($exist_user)) {

                Yii::app()->frontUser->setState('id', $exist_user->id);
                Yii::app()->frontUser->setState('username', $exist_user->username);
                Yii::app()->frontUser->setState('email', $exist_user->email);
                Yii::app()->frontUser->setState('first_name', $exist_user->first_name);
                Yii::app()->frontUser->setState('last_name', $exist_user->last_name);
                Yii::app()->frontUser->setState('roleID', $exist_user->user_type);
                $this->redirect(array('supporter_message', 'id' => $exist_user->id, 'name' => $exist_user->username, 'fundraiser' => $_REQUEST['id']));
            } else {
                Yii::app()->user->setFlash('error', Yii::t("error", "Sorry, the email and password you entered do not match. Please try again."));
                $this->redirect(array('become_supporter', 'model' => $model, 'id' => $_REQUEST['id'], 'fundraiser_name' => $_REQUEST['fundraiser_title'], 'fundraiser_image' => $_REQUEST['fundraiser_image'], 'flag' => '1'));
            }
        }
        if (!empty($_POST['Users'])) {
            if (isset($_POST['ajax']) && $_POST['ajax'] === 'users-form') {
                echo CActiveForm::validate($signup);
                Yii::app()->end();
            }
            $signup->attributes = $_POST['Users'];
            $digits = 5;
            $random_digit = rand(pow(10, $digits - 1), pow(10, $digits) - 1);
            $signup->user_token = $random_digit;
            $signup->email_verification = 'N';
            $signup->user_type = '2';
            $signup->password = md5(trim($_POST['Users']['password']));
            if ($signup->save(false)) {

                $email_model = EmailTemplates::model()->find("short_code = 'ACTIVATE_ACCOUNT'");
                $email_template = $email_model->template;
                $email_template = str_replace('#USRFULLNAME#', ucfirst($signup->username), $email_template);
                $encrypted = $this->encrypt($signup->id, ENCRYPTION_KEY);
                $fundraiser_id = $this->encrypt($_POST['Users']['fundraiser_id'], ENCRYPTION_KEY);
                $link = 'http://' . $_SERVER['HTTP_HOST'] . Yii::app()->createUrl('Fundraiser/Authenticate', array('pk' => base64_encode($encrypted), 'user_code' => $random_digit, 'fundraiser_code' => base64_encode($fundraiser_id)));
                $email_template = str_replace('#ACTLINK#', $link, $email_template);
                $email_template = str_replace('#LINKONLY#', $link, $email_template);
                $email_template = str_replace('#CUR_YEAR#', date('Y'), $email_template);
                $this->send_email($signup->email, $email_model->subject, $email_template);
                Yii::app()->user->setFlash('success', Yii::t("success", "Please check your email (including your spambox) to complete your registration."));
                $this->redirect(Yii::app()->createUrl('fundraiser/become_supporter', array('model' => $model, 'signup' => $signup, 'data' => $_REQUEST, 'refer' => 1)));
//                echo FrontCoreController::close_fancybox(Yii::app()->createUrl('fundraise/index'));
                $this->redirect(array('supporter_message', 'id' => $signup->id, 'name' => $signup->username, 'fundraiser' => $_REQUEST['id']));
            }

        }

        $this->render('become_supporter', array('model' => $model, 'signup' => $signup, 'data' => $_REQUEST));
    }
    
    
    public function actionAddReview()
    {
        
        $this->layout = 'main_popup';
        //$model = new LoginForm();
        $model = new UserReview();
        // echo Yii::app()->frontUser->id;die;
        
        
        //p($_POST);
        if (!empty($_POST['UserReview'])) {
                /*
                $model->setAttributes($_POST['user_id']);
                $model->setAttributes($_POST['email']);
                $model->setAttributes($_POST['message']);
                */
                $signup->attributes = $_POST['Users'];
                
                //p($model->save(false));
                if ($model->save(false)) {
                    if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                        Yii::app()->end();
                    } else {
                        Yii::app()->adminUser->setFlash('success', Yii::t("success", $model->label() . " has been successfully created."));
                        $this->redirect(array('supporter_review', 'id' => $id));
                    }
                }
                
                $this->redirect(array('supporter_review', 'id' => $exist_user->id, 'name' => $exist_user->username, 'fundraiser' => $_REQUEST['id']));
            } else {
                Yii::app()->user->setFlash('error', Yii::t("error", "Sorry, the email and password you entered do not match. Please try again."));
                $this->redirect(array('become_review', 'model' => $model, 'id' => $_REQUEST['id'], 'fundraiser_name' => $_REQUEST['fundraiser_title'], 'fundraiser_image' => $_REQUEST['fundraiser_image'], 'flag' => '1'));
            }
        //}
            
        if (!empty(Yii::app()->frontUser->id)) {
            $model_users = Users::model()->find('id="' . Yii::app()->frontUser->id . '"');
            $this->render('supporter_review', array('model' => $model,'model_users'=>$model_users));
        }else{
             $this->render('supporter_review', array('model' => $model));
        }
    }

    /*
     * function for the user authentication
     */
    public function actionAuthenticate($pk, $user_code = "", $fundraiser_code = "")
    {

        $decrypted = $this->decrypt(base64_decode($pk), ENCRYPTION_KEY);
        $fundraiser_id = $this->decrypt(base64_decode($fundraiser_code), ENCRYPTION_KEY);
        if ($user_code != "") {
            $user_model = Users::model()->findByPk($decrypted);
            $user_verified_data = Users::model()->find(array("select" => "id", "condition" => "id = '" . $user_model->id . "' AND user_token = '" . $user_code . "' AND email_verification='N' "));
            if (!empty($user_verified_data)) {
                $user_verified_data->email_verification = 'Y';
                $user_verified_data->save(false);
                $fundraiser_data = SetupFundraiser::model()->findByPk($fundraiser_id);
                $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser_data->fundraiser_title);
                $title = str_replace("'", '', $title);
                $title = strtolower($title);
                Yii::app()->user->setFlash('success', Yii::t("success", "Thank You! Your account has been verified successfully."));
                $this->redirect(Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser_data->id, 'fundraiser_name' => $title, 'fundraiser_code' => $fundraiser_code)));
            } else {
                Yii::app()->user->setFlash('error', Yii::t("error", "Oops, Verification link has been expired."));
                $this->redirect(Yii::app()->createUrl('site/login'));
            }
        } else {
            Yii::app()->frontUser->setFlash('success', Yii::t("success", "Oops, Verification link has been expired."));
            $this->redirect(Yii::app()->createUrl('site/login'));
        }

    }

    public function actionSupporter_message()
    {
        if (!empty($_REQUEST['fundraiser'])) {
            $fundraiser = SetupFundraiser::model()->findByPk($_REQUEST['fundraiser']);
            $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser->fundraiser_title);
            $title = str_replace("'", '', $title);
            $title = strtolower($title);
            $page_link = 'http://' . $_SERVER['HTTP_HOST'] .Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title));
        }

        $this->layout = 'main_popup';
        $model = new Supporter();
        if (!empty($_POST['Supporter'])) {
            $model->setAttributes($_POST['Supporter']);
            $model->supporter_message = $_POST['Supporter']['supporter_message'];
            if (isset($_FILES['Supporter']['name']['supporter_image']) && !empty($_FILES['Supporter']['name']['supporter_image'])) {
                $model->supporter_image = $_FILES['Supporter']['name']['supporter_image'];
                $model->supporter_image = CUploadedFile::getInstance($model, 'supporter_image');
            } else {
                $model->supporter_image = $_POST['Supporter']['supporter_image'];
            }
            if ($model->validate()) {
                if (isset($_FILES['Supporter']['name']['supporter_image']) && !empty($_FILES['Supporter']['name']['supporter_image'])) {
                    $file_extension = $model->supporter_image->getExtensionName();
                    $random_filename = time() . rand(99999, 888888);
                    $image_name = $random_filename . "." . $file_extension;
                    $original_path = SUPPORTER_IMAGE_ORIGINAL . $image_name;

                    $model->supporter_image->saveAs($original_path);
                    EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(SUPPORTER_IMAGE_THUMBNAIL . SUPPORTER_IMAGE_THUMB_NAME . $image_name);

                    $model->supporter_image = $image_name;
                }
                if ($_POST['Supporter']['supporter_email']) {
                    $emails = explode(',', $_POST['Supporter']['supporter_email']);
                    if(!empty($emails)){
                       // $emails_frontname = explode('@',$emails);
                        // $emails_frontname = explode('@',$_POST['Supporter']['supporter_email']);
                        $emails = $_POST['Supporter']['supporter_email'];
                        $exp    = explode('@',$emails);
                        $char   = array('.','_','-');
                        $supporter_name    = str_replace($char, '', $exp[0]);
                        
                    }
                    $fundraiser_detail=  SetupFundraiser::model()->find('id='.$_REQUEST['fundraiser']);
                    $lead_supporter_detail= Users::model()->find('id='.$fundraiser_detail->user_id);
                    
                    if(is_array($emails)){
                        foreach ($emails as $email) {
                                //Supporter MESSage 30 JUN 16
                                /*
                                $email_model = EmailTemplates::model()->find("short_code = 'Supporter'");
                                $email_template = $email_model->template;
                                $email_template = str_replace('#EMAIL#', trim($email), $email_template);
                                $email_template = str_replace('#MSG#', $_POST['Supporter']['supporter_message'], $email_template);
                                $email_template = str_replace('#LINK#', $page_link, $email_template);
                                $this->send_email(trim($email), $email_model->subject, $email_template);*/
                        }
                    }else{
                        if(!empty($emails)){
                            
                            $new_supporter= Users::model()->find('id='.Yii::app()->frontUser->id);
                            
                            $email_model = EmailTemplates::model()->find("short_code = 'Supporter'");
                            $email_model->subject = str_replace('#FUNDRAISER_TITLE#',  $fundraiser_detail->fundraiser_title, $email_model->subject);
                            $email_template = $email_model->template;
                            $email_template = str_replace('#SUPPORTER_NAME#', $new_supporter->username, $email_template);
                            $email_template = str_replace('#FUNDRAISER_TITLE#', $fundraiser_detail->fundraiser_title, $email_template);
                            $this->send_email($emails, $email_model->subject, $email_template);
                           
                            
                            $email_model1 = EmailTemplates::model()->find("short_code = 'LEAD_SUPPORTER_ALERT'");
                            $email_model1->subject = str_replace('#FUNDRAISER_TITLE#',  $fundraiser_detail->fundraiser_title, $email_model1->subject);
                            $email_template1 = $email_model1->template;
                            $email_template1 = str_replace('#SUPPORTER_NAME#', $new_supporter->username, $email_template1);
                            $email_template1 = str_replace('#FUNDRAISER_TITLE#', $fundraiser_detail->fundraiser_title, $email_template1);
                            $email_template1 = str_replace('#LINK#', $page_link, $email_template1);
                            $this->send_email($lead_supporter_detail->email, $email_model1->subject, $email_template1);
                            
			    if($fundraiser_detail->user_id != $new_supporter->id ){
		                    $notification = new Notifications();
		                    $notification->subject = "New Supporter for ".$fundraiser_detail->fundraiser_title." Fundraiser.";
		                    $notification->name = $lead_supporter_detail->username;
		                    $notification->email = Null;
		                    $notification->message ="I would like to be a supporter of ". $fundraiser_detail->fundraiser_title." fundraiser! I would also like to help to promote it to achieve its goal. "."<br><br>Check out my details on the fundraiser page. <br><a href=".$page_link.">Click Here</a>";
		                    $notification->from_id = Yii::app()->frontUser->id;
		                    $notification->from_admin = N;
		                    $notification->is_read = N;
		                    $notification->to_admin = N;
		                    $notification->to_id = $fundraiser_detail->user_id;
		                    $notification->to_type = 'L';
		                    $notification->from_type = 'S';
		                    $notification->status = Y;
		                    $notification->save(false);
		                    
		                    $notification_supporter = new Notifications();
		                    $notification_supporter->subject = "Thank you for supporting ".$fundraiser_detail->fundraiser_title." Fundraiser.";
		                    $notification_supporter->name = "Admin";
		                    $notification_supporter->email = Null;
		                    $notification_supporter->message ="Hello ".$new_supporter->username.",<br><br>"
		                                            . "Your support goal is to help promote this fundraiser to all your contacts (email, phone, social media and even physical contacts) and encourage them to do same, so that the goal of this fundraiser can be achieved.<br>"
		                                            . "Your support will give the beneficiary of this fundraiser a chance to hold out hope in the face of a challenging situation. Thank you very much for your kindness and humanity.<br><br>"
		                                            . "Regards <br>"
		                                            . "The ".$fundraiser_detail->fundraiser_title." Fundraising Team";
		                    $notification_supporter->from_id = $fundraiser_detail->user_id;
		                    $notification_supporter->from_admin = N;
		                    $notification_supporter->is_read = N;
		                    $notification_supporter->to_admin = N;
		                    $notification_supporter->to_id = Yii::app()->frontUser->id;
		                    $notification_supporter->to_type = 'S';
		                    $notification_supporter->from_type = 'L';
		                    $notification_supporter->status = Y;
		                    $notification_supporter->save(false);
			    }
                        }
                    }
                }

                if ($model->save(false)) {
                    Yii::app()->user->setFlash('success', Yii::t("success", "Your request has been sent."));
                    echo FrontCoreController::close_fancybox(Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title,'sendflag' => '1')));
                    //$this->redirect(array('supporter_message', 'flag' => '1'));
                }
            }//p($model->getErrors());
        }
        $this->render('supporter_message', array('model' => $model, 'data' => $_REQUEST));
    }
    
    
    public function actionSupporter_review(){
        if (!empty($_REQUEST['fundraiser'])) {
            $fundraiser = SetupFundraiser::model()->findByPk($_REQUEST['fundraiser']);
            $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser->fundraiser_title);
            $title = str_replace("'", '', $title);
            $title = strtolower($title);
            $page_link = 'http://' . $_SERVER['HTTP_HOST'] .Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title));
        }

        $this->layout = 'main_popup';
        $model = new Supporter();
        if (!empty($_POST['Supporter'])) {
                $model->setAttributes($_POST['Supporter']);
                $model->supporter_message = $_POST['Supporter']['supporter_message'];
                if (isset($_FILES['Supporter']['name']['supporter_image']) && !empty($_FILES['Supporter']['name']['supporter_image'])) {
                    $model->supporter_image = $_FILES['Supporter']['name']['supporter_image'];
                    $model->supporter_image = CUploadedFile::getInstance($model, 'supporter_image');
                } else {
                    $model->supporter_image = $_POST['Supporter']['supporter_image'];
                }
                if ($model->validate(array('supporter_image'))) {
                    if (isset($_FILES['Supporter']['name']['supporter_image']) && !empty($_FILES['Supporter']['name']['supporter_image'])) {
                        $file_extension = $model->supporter_image->getExtensionName();
                        $random_filename = time() . rand(99999, 888888);
                        $image_name = $random_filename . "." . $file_extension;
                        $original_path = SUPPORTER_IMAGE_ORIGINAL . $image_name;

                        $model->supporter_image->saveAs($original_path);
                        EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(SUPPORTER_IMAGE_THUMBNAIL . SUPPORTER_IMAGE_THUMB_NAME . $image_name);

                        $model->supporter_image = $image_name;
                    }
                    if ($_POST['Supporter']['supporter_email']) {
                        $emails = explode(',', $_POST['Supporter']['supporter_email']);
                        foreach ($emails as $email) {
                            $email_model = EmailTemplates::model()->find("short_code = 'Supporter'");
                            $email_template = $email_model->template;
                            $email_template = str_replace('#EMAIL#', trim($email), $email_template);
                            $email_template = str_replace('#MSG#', $_POST['Supporter']['supporter_message'], $email_template);
                            $email_template = str_replace('#LINK#', $page_link, $email_template);
                            $this->send_email(trim($email), $email_model->subject, $email_template);
                        }
                    }

                    if ($model->save(false)) {
                        Yii::app()->user->setFlash('success', Yii::t("success", "Your request has been sent."));
                        echo FrontCoreController::close_fancybox(Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title,'sendflag' => '1')));
                    //  $this->redirect(array('supporter_message', 'flag' => '1'));
                    }
            }
        }
        $this->render('supporter_review', array('model' => $model, 'data' => $_REQUEST));
    }

    public function actionLocatefundraiser()
    {
        $fundraiser = SetupFundraiser::model()->findAll();
        $this->render('locatefundraiser', array('fundraiser' => $fundraiser));
    }

    public function actionViewmore()
    {
        $page_start = $_REQUEST['page'] * 8;
        $max_id = $_REQUEST['max_id'];
        $page_end = 8;

        $fundraiser = SetupFundraiser::model()->findAll("status = 'Y' LIMIT " . $page_start . ',' . $page_end);
        /*$count = '1';
        if($fundraiser){
            $count = count($fundraiser);
        }*/
        $this->renderPartial('/layouts/viewmore', array('fundraiser' => $fundraiser, 'max_id' => $max_id));
    }

    public function actionCategory()
    {
        $this->render('category', array('id' => $_REQUEST['id'], 'category_name' => $_REQUEST['category_name']));
    }

    public function actionViewmorecategory()
    {
        $page_start = $_REQUEST['page'] * 8;
        $max_id = $_REQUEST['max_id'];
        $page_end = 8;
        $fundraiser = Yii::app()->db->createCommand()
            ->select('*')
            ->from('setup_fundraiser')
            ->where('ftype_id = "' . $_REQUEST['type_id'] . '"')//where($condition, $params)
            ->order('id ASC')
            ->offset($page_start)
            ->limit($page_end)
            ->queryAll();
        $this->renderPartial('/layouts/viewmoreCategory', array('fundraiser' => $fundraiser, 'max_id' => $max_id));
    }

    public function actionViewmoretestimonial()
    {
        $page_start = $_REQUEST['page'] * 8;
        $max_id = $_REQUEST['max_id'];
        $page_end = 8;
        $testimonials_object = Testimonial::model()->findAll("status = 'Y' LIMIT " . $page_start . ',' . $page_end);
        $this->renderPartial('/layouts/viewmoreTestimonial', array('testimonials_object' => $testimonials_object, 'max_id' => $max_id));
    }
    
    public function actionManagefundraiser(){
        //$this->layout = 'main';
        $postData = Yii::app()->request->getPost('clienData');
        $model=  new SetupFundraiser();
        $send_message= new Notifications();
        $case_update= new CaseUpdates();
        
        $current_user_id = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->id:null;
        $fundraiser = null;
       
        $fundraiser= SetupFundraiser::model()->findAll("user_id = $current_user_id ");
        //p($fundraiser);die;
        $donation_count = 0;
        $fundraiser_sentinviation_count=0;
        $hug_count=0;
        $supporter_count=0;
        $supporter_messaging_count=0;
	$embed_site_count= 0;
	$fb_counts=0;
        foreach($fundraiser as $val){
            $donation_model_count = Donations::model()->count("fundraiser_id = ".$val->id." AND status = 'Y' ");
            $donation_count = $donation_count + $donation_model_count;
            
            $fundraiser_sentinviation_model_count= ReportInvitefriends::model()->count('fundraiser_id='.$val->id.' AND status="Y"');
            $fundraiser_sentinviation_count = $fundraiser_sentinviation_count + $fundraiser_sentinviation_model_count;
            
            $fundraiser_hug_count = FundraiserHug::model()->count(array('condition' => 'fundraiser_id='.$val->id.' AND status="Y"'));
            $hug_count=$hug_count+$fundraiser_hug_count;
            
            $fundraiser_supporter_count= Supporter::model()->count(array('condition'=> 'fundraiser_id='.$val->id.' AND status="Y"'));
            $supporter_count= $supporter_count + $fundraiser_supporter_count;
            
            
            $fundraiser_supporter_messaging_count= Supporter::model()->count(array('condition'=> 'fundraiser_id='.$val->id.''));
            $supporter_messaging_count= $supporter_messaging_count + $fundraiser_supporter_messaging_count;

	    if($embed_count== 0){
		        $embed_count= $val->no_of_embedsite;
            }
            $total_embed_site_count= $embed_count + $val->no_of_embedsite;

 	    $fundraisertitle = preg_replace("/[^A-Za-z0-9\-\']/", '_', $val->fundraiser_title);
            $this->metaTitle = $val->fundraiser_title;
            $page_url = SITE_ABS_PATH."index.php/fundraiser/".$val->id."/".$fundraisertitle;
            $fb_share = file_get_contents('http://graph.facebook.com/?id=' . $page_url . '');
            $fb_share1 = json_decode($fb_share);
 	  
            if($fb_share1->shares){
                
            }else{
		$fb_share1->shares = 0;
	    }
            $fb_counts= $fb_counts + $fb_share1->shares;
        }
        if(!empty($_POST['SetupFundraiser']) || !empty($postData)){
            
            //UPDATE FUNDRAISER INFORMATION
            if(isset($_POST['SetupFundraiser']) && $_POST['SetupFundraiser']['user_id']=='1234567897845'){
                $model->setAttributes($_POST['SetupFundraiser']);
                
                $edit_fundraiser= SetupFundraiser::model()->find(' id= '.$_POST['SetupFundraiser']['id']);
                $edit_fundraiser->ftype_id=$_POST['SetupFundraiser']['ftype_id'];
                $edit_fundraiser->ftype_typ=$_POST['SetupFundraiser']['ftype_typ'];
                $edit_fundraiser->fundraiser_title=$_POST['SetupFundraiser']['fundraiser_title'];
                $edit_fundraiser->search_status=$_POST['SetupFundraiser']['search_status'];
                $edit_fundraiser->tell_ur_fund_story=$_POST['SetupFundraiser']['tell_ur_fund_story'];
                $edit_fundraiser->benifiry_name=$_POST['SetupFundraiser']['benifiry_name'];
                $edit_fundraiser->benifi_age=$_POST['SetupFundraiser']['benifi_age'];
                $edit_fundraiser->benifi_sex=$_POST['SetupFundraiser']['benifi_sex'];
                $edit_fundraiser->benifi_email=$_POST['SetupFundraiser']['benifi_email'];
                $edit_fundraiser->fundriser_goal_amount=$_POST['SetupFundraiser']['fundriser_goal_amount'];
                $edit_fundraiser->fundraiser_amount_need=$_POST['SetupFundraiser']['fundraiser_amount_need'];
                $edit_fundraiser->fundr_timeline_to=$_POST['SetupFundraiser']['fundr_timeline_to'];
                $edit_fundraiser->use_of_funds=$_POST['SetupFundraiser']['use_of_funds'];
                $edit_fundraiser->funds_achieve=$_POST['SetupFundraiser']['funds_achieve'];
                
                if($edit_fundraiser->save(false)){
                    Yii::app()->user->setFlash('success', "Fundraiser has been successfully updated.");
                    $pathinfo = SITE_ABS_PATH.Yii::app()->request->getPathInfo();
                    $this->redirect($pathinfo,array('model'=>$model,
                                'send_message'=>$send_message, 
                                'donation_count'=>$donation_count,'fundraiser'=>$fundraiser,
                                'hug_count'=>$hug_count,'supporter_count'=>$supporter_count,
                                'supporter_messaging_count'=>$supporter_messaging_count,
                                'fundraiser_sentinviation_count'=>$fundraiser_sentinviation_count,
				'total_embed_site_count'=>$total_embed_site_count,
				'fb_counts'=>$fb_counts,
                            ));
                }
            }
            
            // UPDATE FOR FUNDRAISER BY AJAX
            if($postData=='999999999999999'){
                 $this->renderPartial('_ajaxContentfundraiser', array('model'=>$model));
                 
            }
            
            // UPDATE FOR FUNDRAISER BY AJAX
            if (!empty($postData)){
             
                $fundraiser_data= SetupFundraiser::model()->findByPK($postData);
                //  if(!empty(Yii::app()->session['my_fundraiser_data'])){
                //          unset(Yii::app()->session['my_fundraiser_data']);
                //  }
                //  Yii::app()->session['my_fundraiser_data'] = $fundraiser_data->attributes;
                //  $this->renderPartial('_ajaxContentfundraiser', array('model'=>$model));

            }
            
            //IMAGE UPLOAD FOR FUNDRAISER
             if (isset($_POST['SetupFundraiser']) && $_POST['SetupFundraiser']['user_id'] != '1234567897845') {
              
                $edit_image_fundraiser= SetupFundraiser::model()->find('id='.$_POST['SetupFundraiser']['fundraiser_id']);
                
                unlink(UPLOD_FUN_IMG_ORIGINAL.$edit_image_fundraiser->uplod_fun_img);
                $edit_image_fundraiser->uplod_fun_img = $_FILES['SetupFundraiser']['name']['uplod_fun_img'];
                $edit_image_fundraiser->uplod_fun_img = CUploadedFile::getInstance($model, 'uplod_fun_img');

                    if (isset($_FILES['SetupFundraiser']['name']['uplod_fun_img']) && !empty($_FILES['SetupFundraiser']['name']['uplod_fun_img'])) {
                        $file_extension = $edit_image_fundraiser->uplod_fun_img->getExtensionName();
                        $random_filename = time() . rand(99999, 888888);
                        $image_name = $random_filename . "." . $file_extension;
                        $original_path = UPLOD_FUN_IMG_ORIGINAL . $image_name;
                        $edit_image_fundraiser->uplod_fun_img->saveAs($original_path);
                        EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(UPLOD_FUN_IMG_THUMBNAIL . UPLOD_FUN_IMG_THUMB_NAME . $image_name);
                        $edit_image_fundraiser->uplod_fun_img = $image_name;
                        $edit_image_fundraiser->save(false);
                        $success='Y';
                        Yii::app()->user->setFlash('success', "Fundraiser Image has been successfully updated.");
                        $this->render('managefundraiser',array('model'=>$model, 
                                'send_message'=>$send_message, 'donation_count'=>$donation_count,
                                'fundraiser'=>$fundraiser,'hug_count'=>$hug_count,'supporter_count'=>$supporter_count,
                                'supporter_messaging_count'=>$supporter_messaging_count,'img_upload_success'=>$success,
                                'fundraiser_sentinviation_count'=>$fundraiser_sentinviation_count,
				'total_embed_site_count'=>$total_embed_site_count,
				'fb_counts'=>$fb_counts,
                            ));

                    }
            }
           
        }elseif ($_POST['Notifications']){
            $send_message->name = Yii::app()->frontUser->username;
            $send_message->from_id = Yii::app()->frontUser->id;
            $send_message->to_id = $_POST['receiver_name'];
            $send_message->fundraiser_id = $_POST['Notifications']['fundraiser_id'];
            $send_message->receiver_type = $_POST['Notifications']['receiver_type'];
            $send_message->receiver_name = $_POST['receiver_name'];
            $send_message->subject = $_POST['Notifications']['subject'];
            $send_message->message = $_POST['Notifications']['message'];
            $send_message->is_read = "Y";
            
            if ($send_message->save(false)) {
                if($_POST['Notifications']['receiver_type']=="1"){
                    $suppr1=SetupFundraiser::model()->find('id='.$_POST['receiver_name']);
                    $to=$suppr1->benifi_email;
                    //$to= "neha@infobot-technologies.com";
                }
                elseif($_POST['Notifications']['receiver_type']=="2"){
                    $suppr2=SetupFundraiser::model()->find('id='.$_POST['receiver_name']);
                    $to=$suppr2->fund_mange_email; 
                   //$to= "neha@infobot-technologies.com";
                }
                else {
                  $suppr3= Users::model()->find('id='.$_POST['receiver_name']); 
                  $to=$suppr3->email;  
                 // $to= "sushma@infobot-technologies.com";
                }
                //$to= $_POST['UserMessaging']['user_mail'];
                //$to= "neha@infobot-technologies.com";
                $from= $_POST['Notifications']['font_user_email'];
                $headers = "From:" . $from . "\n";
                $headers = "MIME-Version: 1.0" . "\r\n";
                $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                $subject= $_POST['Notifications']['subject'];
                $message= $_POST['Notifications']['message'];
                mail($to, $subject, $message, $headers, $from );
           
            }
            Yii::app()->user->setFlash('success', "Message has been sent.");
            return $this->refresh();  
            
            $this->render('managefundraiser',array('model'=>$model,'send_message'=>$send_message, 'donation_count'=>$donation_count,
                            'fundraiser'=>$fundraiser,'hug_count'=>$hug_count,
                            'supporter_count'=>$supporter_count,'supporter_messaging_count'=>$supporter_messaging_count,
                            'fundraiser_sentinviation_count'=>$fundraiser_sentinviation_count,
   	   		    'total_embed_site_count'=>$total_embed_site_count,
			    'fb_counts'=>$fb_counts,
                            ));
        }elseif ($_POST['CaseUpdates']) {
         $case_update->user_id = Yii::app()->frontUser->id;   
         $case_update->message_update = $_POST['CaseUpdates']['message_update'];
         $case_update->user_name = $_POST['CaseUpdates']['user_name'];
         $case_update->user_email = $_POST['CaseUpdates']['user_email'];
         $case_update->fundraiser = $_POST['CaseUpdates']['fundraiser'];
         $case_update->video = $_POST['CaseUpdates']['video'];
         $case_update->image = $_FILES['CaseUpdates']['name']['image'];
         $case_update->image = CUploadedFile::getInstance($case_update, 'image');
        // $case_update->image="w";
         if (isset($_FILES['CaseUpdates']['name']['image']) && !empty($_FILES['CaseUpdates']['name']['image'])) {
                        $file_extension = $case_update->image->getExtensionName();
                        $random_filename = time() . rand(99999, 888888);
                        $image_name = $random_filename . "." . $file_extension;
                        $original_path = IMAGE_ORIGINAL . $image_name;
                        $case_update->image->saveAs($original_path);
                        EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(IMAGE_THUMBNAIL . IMAGE_THUMB_NAME . $image_name);
                        $case_update->image = $image_name;
         $case_update->save(false);
          $success='Y';
          Yii::app()->user->setFlash('success', "New case update has been successfully entered.");
          $this->render('managefundraiser',array('model'=>$model, 
                                'send_message'=>$send_message, 'donation_count'=>$donation_count,
                                'fundraiser'=>$fundraiser,'hug_count'=>$hug_count,'supporter_count'=>$supporter_count,
                                'supporter_messaging_count'=>$supporter_messaging_count,'img_upload_success'=>$success,
                                'fundraiser_sentinviation_count'=>$fundraiser_sentinviation_count,
				'total_embed_site_count'=>$total_embed_site_count,
				'fb_counts'=>$fb_counts,
                            ));
         }
        }else{
            $this->render('managefundraiser',array('model'=>$model,'send_message'=>$send_message, 'donation_count'=>$donation_count,
                            'fundraiser'=>$fundraiser,'hug_count'=>$hug_count,
                            'supporter_count'=>$supporter_count,'supporter_messaging_count'=>$supporter_messaging_count,
                            'fundraiser_sentinviation_count'=>$fundraiser_sentinviation_count,
			    'total_embed_site_count'=>$total_embed_site_count,
			    'fb_counts'=>$fb_counts,
                            ));
        }
         
        
    }
    
    public function actionEvent_invitation(){
        
        $model = new EventInvitation();
        if (isset($_POST['EventInvitation'])) {
                
                    $model->setAttributes($_POST['EventInvitation']);
                    if($_POST['EventInvitation']['country']=='1'){
                        $_POST['EventInvitation']['country']='Nigeria';
                    }
                    
                    if($_POST['EventInvitation']['state']=='1'){
                        $_POST['EventInvitation']['state']='Kano';
                    }elseif($_POST['EventInvitation']['state']=='2'){
                        $_POST['EventInvitation']['state']='Lagos';
                    }elseif($_POST['EventInvitation']['state']=='3'){
                        $_POST['EventInvitation']['state']='Kaduna';
                    }
                    /*
                    if($_POST['EventInvitation']['event_type']=='1'){
                        $_POST['EventInvitation']['event_type']='Child';
                    }elseif($_POST['EventInvitation']['event_type']=='2'){
                        $_POST['EventInvitation']['event_type']='Social';
                    }elseif($_POST['EventInvitation']['event_type']=='3'){
                        $_POST['EventInvitation']['event_type']='Awareness';
                    }*/
                    
                    $model->created_date= time();  
                    //$model->user_id= $_POST['EventInvitation']['user_id'];
		    if(!empty($_POST['EventInvitation']['user_id'])){
                        $model->user_id= $_POST['EventInvitation']['user_id'];  
                    }else{
                        $model->user_id= '1';   
                    }
			
                    $model->event_name= $_POST['EventInvitation']['event_name'];
                    $model->event_cordinator= $_POST['EventInvitation']['event_cordinator'];
                    $model->email= $_POST['EventInvitation']['email'];
                    $model->event_type= $_POST['EventInvitation']['event_type'];
                    $model->event_desc= $_POST['EventInvitation']['event_desc'];
                    $model->event_startdate= $_POST['EventInvitation']['event_startdate'];
                    $model->event_enddate= $_POST['EventInvitation']['event_enddate'];
                    $model->location= $_POST['EventInvitation']['location'];
                    $model->city= $_POST['EventInvitation']['city'];
                    $model->state= $_POST['EventInvitation']['state'];
                    $model->country= $_POST['EventInvitation']['country'];
                    $model->attached_itinerary= $_FILES['EventInvitation']['name']['attached_itinerary'];
                    $model->attached_itinerary = CUploadedFile::getInstance($model, 'attached_itinerary');

                    if($model->validate()){
                        if ($model->validate(array('attached_itinerary'))) {
                            if (isset($_FILES['EventInvitation']['name']['attached_itinerary']) && !empty($_FILES['EventInvitation']['name']['attached_itinerary'])) {
                                $file_extension = $model->attached_itinerary->getExtensionName();
                                $random_filename = time() . rand(99999, 888888);
                                $file_name = $random_filename . "." . $file_extension;
                                $original_path = EVENT_INITERARY_ORIGINAL . $file_name;
                                $model->attached_itinerary->saveAs($original_path);
                                //EWideImage::load($original_path)->saveToFile(EVENT_INITERARY_THUMBNAIL . EVENT_INITERARY_THUMB_NAME . $file_name);
                                $model->attached_itinerary = $file_name;
                            }
                            if($model->save()){

                                      Yii::app()->user->setFlash('success', Yii::t("success", "Your event invitation has been sent."));
                                      //$this->render('event_invitation');
                                      $this->redirect('event_invitation');
                            }
                        } 
                    }// p($model->getErrors());  
        }
        $this->render('event_invitation',array('model'=>$model));
    }
  
    public function actionPagedata(){
     
        $postData = Yii::app()->request->getPost('clienData');
        
        $page_no = (!empty($postData)) ? $postData : '1';
        $offset = ($page_no - 1) * COMMENT_RECORDS_PER_PAGE;
               
        $fundraiser = FundraiserComment::model()->findAll(array(
                        'select' => 'fundraiser_reference_id, name, email, comment, created_date',
                        'condition' => "fundraiser_reference_id = '".$_REQUEST['fundraiser_id']."' AND status = 'Y'",
                        'order' => 'id DESC',
                        'limit' => COMMENT_RECORDS_PER_PAGE,
                        'offset' => $offset
                    ));
        
        $this->renderPartial('_ajaxContent', array('fundraiser'=>$fundraiser));
    }
    public function actionReport_fundraiser(){
        
        $this->layout = 'main_popup';
        $model = new ReportFundraiser();
        
        if (!empty($_REQUEST)) {
            $fundraiser = SetupFundraiser::model()->findByPk($_REQUEST['id']);
            $title = preg_replace("/[^A-Za-z0-9\-\']/", '_', $fundraiser->fundraiser_title);
            $title = str_replace("'", '', $title);
            $title = strtolower($title);
            $page_link = 'http://' . $_SERVER['HTTP_HOST'] .Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser->id, 'fundraiser_name' => $title));
        }
        
        if(isset($_POST['ReportFundraiser'])){
            $fundraiser_detail= SetupFundraiser::model()->find('id='.$_REQUEST['id']);
            
            $model->fundraiser_title=$fundraiser_detail->fundraiser_title;
            $model->fundraiser_id= $_REQUEST['id'];
            $model->user_name= $_POST['ReportFundraiser']['user_name'];
            $model->email=$_POST['ReportFundraiser']['email'];
            $model->description=$_POST['ReportFundraiser']['description'];
            
            if($model->save(false)){
                
                //Yii::app()->user->setFlash('success', Yii::t("success", "Your report has been successfully sent."));
                // $pathinfo = SITE_ABS_PATH.Yii::app()->request->getPathInfo()."?f_id=".$_REQUEST['f_id'];
                //  $this->redirect($pathinfo);
                //Yii::app()->user->setFlash('success', Yii::t("success", "Your request has been sent."));
               echo FrontCoreController::close_fancybox(Yii::app()->createUrl('fundraiser/index', array('id' => $fundraiser_detail->id, 'fundraiser_name' => $title,'report_id' => '1')));
            }else{
                
                Yii::app()->user->setFlash('error', Yii::t("error", "Something went wrong"));
                $this->redirect('report_fundraiser');
            }
        }
        $this->render('report_fundraiser',array('model'=>$model));
    }
    
    public function actionReport_response(){
                $model = new ReportFundraiser();
                $this->render('report_response',array('model'=>$model));
    }
    public function actionEmbed_fundraiser(){
        $this->layout = 'main_popup';
        $fundraiser= SetupFundraiser::model()->find('id='.$_REQUEST['id']);
        if(empty($fundraiser->no_of_embedsite)){
            $fundraiser->no_of_embedsite='1';
        }else{
            $fundraiser->no_of_embedsite= $fundraiser->no_of_embedsite + 1;
        }
        $fundraiser->save(false);
        $this->render('embed_fundraiser',array('fundraiser'=>$fundraiser,'id'=>$_REQUEST['id']));
    }
    public function actionEmbedded_frame(){
        $this->layout = 'main_popup';
        $fundraiser= SetupFundraiser::model()->find('id='.$_REQUEST['id']);
        $this->renderPartial('embeded_frame',array('fundraiser'=>$fundraiser,'id'=>$_REQUEST['id']));
    }
    public function actionSendmsg_supportcenter(){
        $this->layout = 'main_popup';
        $send_notification_form =  new Notifications;
        
        if(isset($_POST['Notifications'])){
            $send_notification_form->subject = $_POST['Notifications']['subject'];
            $send_notification_form->name = $_POST['Notifications']['name'];
            $send_notification_form->email = $_POST['Notifications']['email'];
            $send_notification_form->message = $_POST['Notifications']['message'];
            $send_notification_form->from_admin = 'N';
            $send_notification_form->to_admin = 'Y';
            $send_notification_form->is_read = 'N';
	    $send_notification_form->to_type = 'A';
            $send_notification_form->from_type = 'S';
            $send_notification_form->fundraiser_id = $_POST['Notifications']['fundraiser_id'];
            $send_notification_form->receiver_type = $_POST['Notifications']['receiver_type'];
            $send_notification_form->receiver_name = $_POST['Notifications']['receiver_name'];
            if($send_notification_form->save(false)){
                $this->render('sendmsg_supportcenter_respnc');
                Yii::app()->user->setFlash('success', Yii::t("success", "Your message has been sent."));
            }
        } else {
        $this->render('sendmsg_supportcenter',array('send_notification_form'=>$send_notification_form));
        }
    }
     public function actionSendmsg_supportcenter_respnc(){
        $this->layout = 'main_popup';
       // echo "aaaa";
       // die();
        $this->render('sendmsg_supportcenter_respnc');    
     }
    public function actionDonation_complete()
    {  
        $this->layout = 'main_popup';
        $this->render('donation_complete');
    }
    
    public function actionUser_messaging()
    {
        
        $this->layout = 'main_popup';
        $model = new UserMessaging();
        
            if(isset($_POST['UserMessaging'])){
            //$model->id = $_POST['UserMessaging']['id'];
            $model->user_mail = $_POST['UserMessaging']['user_mail'];
            $model->user_id = $_POST['UserMessaging']['user_id'];
            $model->name = $_POST['UserMessaging']['name'];
            $model->email = $_POST['UserMessaging']['email'];
            $model->message = $_POST['UserMessaging']['message'];
            $sendr_name= $_POST['UserMessaging']['name'];
            $sendr_email= $_POST['UserMessaging']['email'];
            
            //if($send_mssg_form->save(true)){
            if($model->save(true)){
                
                 if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                    Yii::app()->end();
                } else {
                 $headers = "MIME-Version: 1.0" . "\r\n";
                 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
                 $to= $_POST['UserMessaging']['user_mail'];
                 //$to= "test08178@gmail.com";
                 $from= $_POST['UserMessaging']['email'];
                 //$user1= "Sender Email Address-". $from;
                 //$subject= "Some one leave you message";
                 $subject= $sendr_name." leave you message from ".$from;
                 $message= $_POST['UserMessaging']['message'];
                 mail($to, $subject, $message, $headers, $from  );
//                    Yii::app()->user->setFlash('success', Yii::t("success", $model->label() . " has been successfully created."));
//                    echo FrontCoreController::close_fancybox(Yii::app()->createUrl('fundraiser/donations',array('fundraiser_id' => $id, 'fundraiser_name' => $_REQUEST['fundraiser_name'])));
                    $this->redirect(array('responsemessage1'));
                }
                //Yii::app()->user->setFlash('success', Yii::t("success", "Your message has been sent."));
//                 $headers = "MIME-Version: 1.0" . "\r\n";
//                 $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
//                 //$to= $_POST['UserMessaging']['user_mail'];
//                 $to= "test08178@gmail.com";
//                 $from= $_POST['UserMessaging']['email'];
//                 $subject= "Some one left you message";
//                 $message= $_POST['UserMessaging']['message'];
//                 mail($to, $subject, $message, $headers, $from );
            }
            //return $this->refresh();
        }
        //$this->render('sendmsg_supportcenter',array('send_notification_form'=>$send_notification_form));
        $this->render('user_messaging', array('model' => $model, 'fundraiser_id' => $id, 'fundraiser_name' => $_REQUEST['fundraiser_name']));
    }
    
     public function actionResponsemessage1()
    {
        $this->layout = 'main_popup';
        $this->render('response_message1');
    }
    
    public function actionDynamiccitiess()
   {  
        $post_d=$_POST['Typeid'];
        $post_typ=$_POST['Typename'];
        //$data=  SetupFundraiser::model()->findAll('id='.$post_d);
       // $data=  SetupFundraiser::model()->findAll();
      if($post_typ=='1'){
        //$data=  SetupFundraiser::model()->findAll('id='.$post_d);  
        //$data=CHtml::listData($data,'id','benifiry_name');
         $data = Yii::app()->db->createCommand()
          ->select('u.id, u.username')
          ->from('users u')
          ->join('setup_fundraiser p', 'u.username=p.benifiry_name')
          ->where('p.id=:id', array(':id'=>$post_d))
          ->queryAll();
        
        $data=CHtml::listData($data,'id','username');
     } else if($post_typ=='2') {
          //$data=  SetupFundraiser::model()->findAll('id='.$post_d);
          //$data=CHtml::listData($data,'id','fund_mange_name');
         $data = Yii::app()->db->createCommand()
          ->select('u.id, u.username')
          ->from('users u')
          ->join('setup_fundraiser p', 'u.username=p.fund_mange_name')
          ->where('p.id=:id', array(':id'=>$post_d))
          ->queryAll();
        
        $data=CHtml::listData($data,'id','username');
      } else {
          $data = Yii::app()->db->createCommand()
         ->select('u.id, u.username')
         ->from('users u')
         ->join('supporter p', 'u.id=p.user_id')
         ->where('p.fundraiser_id=:id', array(':id'=>$post_d))
         ->queryAll();
         
       $data=CHtml::listData($data,'id','username');
      
      }
        foreach($data as $value=>$name)
    {
        echo CHtml::tag('option',
                   array('value'=>$value),CHtml::encode($name),true);
    }
   }
  
 public function actionSendreport(){
   $this->layout = 'popup';
   $this->render('sendreport');
 } 
 public function actionSendreportxml(){
   $this->layout = 'popup';
   $this->render('sendreportxml');
 } 
 public function actionCreatepdf(){
     //$user_d= $_REQUEST['id'];
     $userd = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->id:null;
     $user_name = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->name:null;
     $subject= " Report Pdf Document";
     $to="test08178@gmail.com";
     $from="demo12@undergirl.co.uk";
     //$mail_a="test08178@gmail.com";
    // $headers = "MIME-Version: 1.0" . "\r\n";
       //    $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
        //   $subject= " Report Pdf Document";
        //   $to="test08178@gmail.com";
        //  $from=!empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->name:null;
        //   mail($to, $subject, $pdf, $headers, $from  );
     /******************* FOR PDF *******************/
     // create curl resource 
     
        $ch = curl_init(); 

        // set url 
        curl_setopt($ch, CURLOPT_URL, "http://giveyourbit.com/index.php?r=fundraiser/sendreport&id=".$userd); 

        //return the transfer as a string 
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $output = curl_exec($ch); 
        //echo $output;
       
        // close curl resource to free up system resources 
        curl_close($ch); 
       sleep(10);   
     if($output){
     //echo $user_d;
     $body= file_get_contents("http://giveyourbit.com/index.php?r=fundraiser/sendreport&id=".$userd); 
     //echo "http://undergirl.co.uk/index.php?r=fundraiser/sendreport&id=$userd";
        $path=realpath('./')."/pdf/{$user_name}.pdf";
        $pdf = Yii::createComponent('application.extensions.tcpdf.tcpdf',
                'P', 'cm', 'A4', true, 'UTF-8');
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor("Test");
            $pdf->SetTitle("Report");
            $pdf->SetSubject("Report");
            $pdf->SetKeywords("Test");
            $pdf->setPrintHeader(false);
            $pdf->setPrintFooter(false);
            //$pdf->AliasNbPages();
            $pdf->AddPage();
            $pdf->SetFont("times", "", 10);
            $pdf->writeHTML($output, true, false, false, false, '');
           $pdf->Output($path, "F");
           $file = realpath('./')."/pdf/{$user_name}.pdf"; 

           header("Content-Description: File Transfer"); 
           header("Content-Type: application/octet-stream"); 
           header("Content-Disposition: attachment; filename='" . basename($file) . "'"); 

            readfile ($file);
            exit(); 
          // $headers = "MIME-Version: 1.0" . "\r\n";
          // $headers .= "Content-type:text/html;charset=UTF-8" . "\r\n";
         // mail($to, $subject, $pdf, $headers, $from  );
     /*************   For XML  ****************/
          
           
           //$file_path = yii::app()->basePath."\..\pdf\\{$user_name}.pdf";  
           //$file_path=realpath('./')."\pdf\{$user_name}.pdf";
           //echo $file_path;
          //$swiftAttachment = Swift_Attachment::fromPath($file_path);              
      ////    $message->attach($swiftAttachment);
         // Yii::app()->mail->send("test08178@gmail.com",$message);
      ////    $this->send_email($mail_a, $subject, $message);
     ////     Yii::app()->user->setFlash('success', Yii::t("success", "Pdf file is send , Please check your email (including your spambox)"));
          //$this->redirect(Yii::app()->createUrl('fundraiser/become_supporter', array('model' => $model, 'signup' => $signup, 'data' => $_REQUEST, 'refer' => 1)));
         // $this->render('managefundraiser');
           
          }
 }
 public function actionCreatexml(){
     $userd = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->id:null;
     $user_name = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->name:null;
      $ch1 = curl_init(); 

        // set url 
        curl_setopt($ch1, CURLOPT_URL, "http://giveyourbit.com/index.php?r=fundraiser/sendreportxml&idxm=".$userd); 

        //return the transfer as a string 
        curl_setopt($ch1, CURLOPT_RETURNTRANSFER, 1); 

        // $output contains the output string 
        $outputxml = curl_exec($ch1); 
        //echo $output;
       
        // close curl resource to free up system resources 
        curl_close($ch1); 
         
        
           $pth1= realpath('./')."/xml/template.xls";
           $pth2= realpath('./')."/xml/{$user_name}.xls";
           copy($pth1,$pth2);
           file_put_contents($pth2, $outputxml);
           $file = realpath('./')."/xml/{$user_name}.xls"; 

           header("Content-Description: File Transfer"); 
           header("Content-Type: application/octet-stream"); 
           header("Content-Disposition: attachment; filename='" . basename($file) . "'"); 

            readfile ($file);
            exit();
 } 
 

         
    }
