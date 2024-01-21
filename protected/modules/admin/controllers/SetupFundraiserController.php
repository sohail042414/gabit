<?php

class SetupFundraiserController extends AdminCoreController
{

    /**
     * Do not change Resource Id value, it can cause permissions out of order. 
     */
    public $resource_id = 4;

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
                'actions' => array('index', 'admin', 'view','download'),
                'users' => array('@'),
                'expression' => ($this->auth->canView($this->resource_id)) ? '1' : '0',
            ),
            array(
                'allow',
                'actions' => array('create'),
                'users' => array('@'),
                'expression' => ($this->auth->canAdd($this->resource_id)) ? '1' : '0',
            ),
            array(
                'allow',
                'actions' => array('update'),
                'users' => array('@'),
                'expression' => ($this->auth->canUpdate($this->resource_id)) ? '1' : '0',
            ),
            array(
                'allow',
                'actions' => array('delete'),
                'users' => array('admin'),
                'expression' => ($this->auth->canDelete($this->resource_id)) ? '1' : '0',
            ),
            array(
                'deny',  // deny all users
                'users' => array('*'),
            ),
        );
    }

    public function actionView($id)
    {
        $model = $this->loadModel($id, 'SetupFundraiser');

        if ($model->status_new == 'Y') {
            $model->status_new = 'N';
            $model->update();
        }

        $this->render('view', array(
            'model' => $model,
        ));
    }

    public function actionCreate()
    {
        $model = new SetupFundraiser;


        if (isset($_POST['SetupFundraiser'])) {
            $model->setAttributes($_POST['SetupFundraiser']);

            if ($model->save()) {
                if (Yii::app()->getRequest()->getIsAjaxRequest()) {
                    Yii::app()->end();
                } else {
                    Yii::app()->user->setFlash('success', Yii::t("success", $model->label() . " has been successfully created."));
                    $this->redirect(array('view', 'id' => $model->id));
                }
            }
        }

        $this->render('create', array('model' => $model));
    }

    public function actionUpdate($id)
    {

        Yii::app()->clientScript->registerScriptFile(
            Yii::app()->baseUrl . '/js/admin/select2/select2.js'
        );

        Yii::app()->clientScript->registerCssFile(
            Yii::app()->baseUrl . '/js/admin/select2/select2.css'
        );

        $corporates = CorporateSupporter::model()->findAll("status=1");

        //$users_list = array('' => '-- Select User --');

        $corporate_list = array();

        foreach ($corporates as $corporate) {
            $corporate_list[$corporate->id] = $corporate->name;
        }

        $model = $this->loadModel($id, 'SetupFundraiser');

        if ($model->status_new == 'Y') {
            $model->status_new = 'N';
            $model->update();
        }



        if (isset($_POST['SetupFundraiser'])) {

            $model->setAttributes($_POST['SetupFundraiser']);

            FundraiserCorporateSupporter::model()->deleteAll('fundraiser_id = :fundraiser_id', array('fundraiser_id' => $model->id));

            if (!empty($model->corporateSupporters)) {
                foreach ($model->corporateSupporters as $corporate_supporter_id) {
                    $object = new FundraiserCorporateSupporter();
                    $object->fundraiser_id = $model->id;
                    $object->corporate_supporter_id = $corporate_supporter_id;
                    $object->save();
                }
            }

            /*
            if (isset($_FILES['SetupFundraiser']['name']['uplod_fun_img']) && !empty($_FILES['SetupFundraiser']['name']['uplod_fun_img'])) {
                $model->uplod_fun_img = $_FILES['SetupFundraiser']['name']['uplod_fun_img'];
                $model->uplod_fun_img = CUploadedFile::getInstance($model, 'uplod_fun_img');
            } else {
                $model->uplod_fun_img = $_POST['SetupFundraiser']['uplod_fun_img'];
            }
            */

            if (isset($_FILES['SetupFundraiser']['name']['uplod_fun_img']) && !empty($_FILES['SetupFundraiser']['name']['uplod_fun_img'])) {
                $model->uplod_fun_img = CUploadedFile::getInstance($model, 'uplod_fun_img');
                $file_extension = $model->uplod_fun_img->getExtensionName();
                $random_filename = time() . rand(99999, 888888);
                $image_name = $random_filename . "." . $file_extension;
                $original_path = FUNDRAISER_IMAGE_ORIGINAL . $image_name;

                $model->uplod_fun_img->saveAs($original_path);
                EWideImage::load($original_path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(FUNDRAISER_IMAGE_THUMBNAIL . FUNDRAISER_IMAGE_THUMB_NAME . $image_name);

                $model->fundraiser_image = $image_name;
            }

            if ($model->save(false)) {
                Yii::app()->user->setFlash('success', Yii::t("success", $model->label() . " has been successfully updated."));
                $this->redirect(array('view', 'id' => $model->id));
            }
        }

        $fundraiser_corporate_list = [];

        $data = FundraiserCorporateSupporter::model()->findAll('fundraiser_id = :fundraiser_id', array('fundraiser_id' => $model->id));

        foreach ($data as $corp) {
            $fundraiser_corporate_list[] = array(
                'id' => $corp->corporate_supporter_id,
                'text' => 'Some ' . $corp->corporate_supporter_id,
            );
        }

        $this->render('update', array(
            'model' => $model,
            'corporate_list' => $corporate_list,
            'fundraiser_corporate_list' => $fundraiser_corporate_list,
        ));
    }

    public function actionDelete($id)
    {
        if (Yii::app()->getRequest()->getIsPostRequest()) {

            Supporter::model()->deleteAll('fundraiser_id = :fundraiser_id', array('fundraiser_id' => $id));

            $this->loadModel($id, 'SetupFundraiser')->delete();

            if (!Yii::app()->getRequest()->getIsAjaxRequest())
                $this->redirect(array('admin'));
        } else
            throw new CHttpException(400, Yii::t('app', 'Your request is invalid.'));
    }

    public function actionAdmin()
    {
        $model = new SetupFundraiser('search');
        $model->unsetAttributes();

        if (isset($_GET['SetupFundraiser']))
            $model->setAttributes($_GET['SetupFundraiser']);

        $this->render('admin', array(
            'model' => $model,
        ));
    }

    public function actionNewentry()
    {

        $model = Yii::app()->db->createCommand()
            ->select('sf.*,u.username,ft.fundraiser_type')
            ->from('setup_fundraiser as sf, users as u, fundraiser_type as ft')
            ->where("sf.ftype_id = ft.id AND sf.user_id = u.id AND sf.user_id != '1' AND sf.created_date BETWEEN '" . date('Y-m-d H:i:s', strtotime('-1 day')) . "' AND sf.created_date")
            ->queryAll();

        if (isset($_GET['SetupFundraiser']))
            $model->setAttributes($_GET['SetupFundraiser']);

        $this->render('newentry', array(
            'model' => $model,
        ));
    }

    /*
     * Action for the give ans of the question
     */
    public function actionMessage()
    {
        $model = new FundraiserQuestions();
        $this->render('message', array('model' => $model, 'data' => $_REQUEST));
    }


    public function actionDownload($fundraiser,$img){

        
            $fundraiser = Fundraiser::model()->findByPk($fundraiser);

            if(!is_object($fundraiser)){
                exit;
            }

            $file = '';

            switch($img){

                case 'f_image':
                    $file = FUNDRAISER_IMAGE_ORIGINAL.$fundraiser->uplod_fun_img;
                    break;
                case 'benif_image':
                    $file = FUNDRAISER_IMAGE_ORIGINAL.$fundraiser->uplod_pic_benif;
                    break;
                case 'benif_bg_image':
                    $file = FUNDRAISER_IMAGE_ORIGINAL.$fundraiser->uplod_benif_bg;
                    break;
                case 'lead_image':
                    $file = FUNDRAISER_IMAGE_ORIGINAL.$fundraiser->uplod_pic_lead_supptr;
                    break;
                case 'manager_image':
                    $file = FUNDRAISER_IMAGE_ORIGINAL.$fundraiser->upload_pic_fun_manager;
                    break;                    

            }

            if(!empty($file)){

                header('Content-Description: File Transfer');
                header('Content-Type: application/octet-stream');
                header('Content-Disposition: attachment; filename=' . basename($file));
                header('Content-Transfer-Encoding: binary');
                header('Expires: 0');
                header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
                header('Pragma: public');
                ob_clean();
                flush();
                readfile($file);
                exit;

            }

    }

    //    public function actionGetanswer()
    //    {
    //        $data = array();
    //        if (!empty($_POST['FundraiserAnswer'])) {
    //            $answer = new FundraiserAnswer();
    //            $answer->user_id = $_POST['FundraiserAnswer']['user_id'];
    //            $answer->questions_id = $_POST['FundraiserAnswer']['question_id'];
    //            $answer->answer_text = $_POST['FundraiserAnswer']['answer_text'];
    //            if ($answer->save(false)) {
    //                $data['id'] = $_POST['FundraiserAnswer']['question_id'];
    //            }
    //            echo json_encode($data);
    //        }
    //    }

}
