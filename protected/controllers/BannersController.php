<?php
/**
 * This controller loads popups for banners that appear on home page when user is not logged in. 
 */

class BannersController extends FrontCoreController
{
    /*
     * Displays the Signup page
     */
    public function actionDesktop(){
        
        $this->layout = 'main_pop';  

        $popup_image = SITE_ABS_PATH_UPLOADS.'notes/note-1.jpg'; 
        $popup_url = Yii::app()->createUrl('site/index');

        $banner = Banners::model()->find(array(
            'condition' => '',
            'params' => array(),
            'order' => 'rand()'
        ));

        if(is_object($banner)){
            $popup_image = SITE_ABS_PATH_BANNER_IMAGE.$banner->image;
            if(!empty($banner->url)){
                $popup_url = $banner->url;
            }
        }
         
        $this->render('popup',[
            'popup_image' => $popup_image,
            'popup_url' => $popup_url,
        ]);
    }

    /*
     * Displays the Signup page
     */
    public function actionMobile(){

        $this->layout = 'main_pop';

        $popup_image = SITE_ABS_PATH_UPLOADS.'notes/mobile-note-1.jpg';
        $popup_url = Yii::app()->createUrl('site/index');

        $banner = Banners::model()->find(array(
            'condition' => '',
            'params' => array(),
            'order' => 'rand()'
        ));

        if(is_object($banner)){
            $popup_image = SITE_ABS_PATH_BANNER_IMAGE.$banner->mobile_image;
            if(!empty($banner->url)){
                $popup_url = $banner->url;
            }
        }

        $this->render('popup',[
            'popup_image' => $popup_image,
            'popup_url' => $popup_url,
        ]);
    }


    /*
     * Displays the Signup page
     */
    public function actionDesktopStatic(){

        $note_name = '';

        if(isset($_SESSION['note_name']) && !empty($_SESSION['note_name'])){
            $note_name = $_SESSION['note_name'];
        }

        if($note_name == 'note-1.jpg'){
            $note_name = 'note-2.jpg';
        }else{
            $note_name ='note-1.jpg';
        }

        $_SESSION['note_name'] = $note_name;

        $this->layout = 'main_pop';       
        $note_url = SITE_ABS_PATH_UPLOADS.'notes/'.$note_name;        
        $this->render('notes',[
            'note_url' => $note_url,
        ]);
    }
    
    /*
     * Displays the Signup page
     */
    public function actionMobileStatic(){

        $this->layout = 'main_pop';

        $note_name = '';

        if(isset($_SESSION['mobile_note_name']) && !empty($_SESSION['mobile_note_name'])){
            $note_name = $_SESSION['mobile_note_name'];
        }

        if($note_name == 'mobile-note-1.jpg'){
            $note_name = 'mobile-note-2.jpg';
        }else{
            $note_name ='mobile-note-1.jpg';
        }

        $_SESSION['mobile_note_name'] = $note_name;

        $note_url = SITE_ABS_PATH_UPLOADS.'notes/'.$note_name;                
        $this->render('notes',[
            'note_url' => $note_url,
        ]);
    }

}