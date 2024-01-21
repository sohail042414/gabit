<?php
//require_once 'google-api-php-client/src/Google/autoload.php';

class TestimonialsController extends FrontCoreController
{


  public function actionIndex()
  {

    $this->actionCreate();

  }


  public function actionCreate()
  {

      if(!$this->checkLogin()){
        $this->redirect(array('site/index')); 
      }

      $user_id = Yii::app()->frontUser->id;
      
      $user = Users::model()->findByPk($user_id);

      $model = new Testimonial();

      if (isset($_POST['Testimonial'])) {

          $testimonial_picture = $this->uploadFile();

          if(!$testimonial_picture){
            $model->addError('testimonial_picture', $this->upload_error);
          }else{

            $testimonial_by = $user->first_name." ".$user->last_name;
            if(empty($user->first_name) && empty($user->last_name)){
              $testimonial_by = $user->username;
            }

            $model->user_id = $user->id;
            $model->user_type = $user->role;
            
            $model->testimonial_text = $_POST['Testimonial']['testimonial_text'];
            $model->testimonial_by = $testimonial_by;
            $model->testimonial_company = $testimonial_by;
            $model->testimonial_picture = $testimonial_picture;
            $model->status = 'N';
            $model->updated_date = date('Y-m-d h:i:s',time());
            $model->save();

            if ($model->save(true)) {
                
                $admin_user = Users::model()->find('user_type=1 AND id=1');
                $subject = "Testimonial Entered ";
                $message = $model->testimonial_text;
                $message .="<br> User email : ".$user->email;
                $message .="<br> Username : ".$user->username;
                $headers = "From: Giveyourbit \n";
                $headers .= "MIME-Version: 1.0\n";
                $headers .= "Content-Type: text/html; charset=ISO-8859-1\n";
                mail($admin_user->email,$subject,$message,$headers);

                Yii::app()->user->setFlash('success', "Testimonial has been submitted.");    
                $this->redirect('create');     
            }else{     
                echo '<pre>';
                print_r($model->errors);
                exit;            
                Yii::app()->user->setFlash('error', "There was some error, please try again later!.");    
            }

          }

      }
                  
      $this->render('create', array('model' => $model));
  }
  

  public function uploadFile() {

    try {

        $uploadFile = CUploadedFile::getInstance('Testimonial', 'testimonial_picture');
        
        if (!is_object($uploadFile)) {
            $this->upload_error = 'No File selected!';
            return FALSE;
        }

        $ext = pathinfo($uploadFile->name, PATHINFO_EXTENSION);

        if (!in_array($ext, array('png', 'jpg', 'jpeg'))) {
          $this->upload_error = 'Allowed types are png, jpg, jpeg.';
          return FALSE;
        }
    
        $random_filename = time().rand(99999, 888888);
        $image_name = $random_filename.".".$ext;

        //echo $image_name; exit;
        //$path = getcwd().'/uploads/fundraiser_picture/original/'.$image_name;
        // echo "<br>";
        $path = TESTIMONIAL_ORIGINAL.$image_name;

        if (!$uploadFile->saveAs($path, TRUE)) {
            $this->upload_error = $uploadFile->error;
            return FALSE;
        }

        EWideImage::load($path)->resize(ADMIN_PROFILE_PICTURE_WIDTH, ADMIN_PROFILE_PICTURE_HEIGHT, 'fill')->saveToFile(TESTIMONIAL_THUMBNAIL . TESTIMONIAL_THUMB_NAME . $image_name);

        return $image_name;
       
    } catch (Exception $ex) {
      return false;
    }

    return false;      
}









}
