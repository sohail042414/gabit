<?php

class RewardsController extends FrontCoreController
{

    var $metaDescription;
    var $metaKeyword;
    var $metaTitle;

    public $layout = 'reward-program';

    public function actionIndex()
    {
        
        //$reward_date = Setting::model()->getBySettingKey('reward_date');

        $year = date('Y');
        $month = date('F');

        $reward_date = date("$year-m-t", strtotime($month." 1"));

        $reward_prize = Setting::model()->getBySettingKey('reward_prize');

        $this->render('index',array(
            'reward_date' => $reward_date,
            'reward_prize' => $reward_prize,
        ));
    }

    public function actionTop_donor_reward_program(){

        $cms_model = Cms::model()->findbyPk('44');

        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('top_donor_reward_program', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));

    }

    public function actionDonors(){

        $trdp_page = Cms::model()->findbyPk('44');
        $how_it_works_page = Cms::model()->findbyPk('45');

        $this->metaTitle = $trdp_page->meta_title;
        $this->metaDescription = $trdp_page->meta_desc;
        $this->metaKeyword = $trdp_page->meta_keyword;

        $this->render('donors', array(
            'trdp_page' => $trdp_page, 
            'how_it_works_page' => $how_it_works_page
            )
        );

    }

    public function actionFundraisers(){

        if(!$this->checkLogin()){
            $_SESSION['returnUrl'] = 'rewards';
            $this->redirect(array('site/login')); 
        }

        $role = Yii::app()->frontUser->role;

        if($role !='fundraiser'){
            Yii::app()->frontUser->setFlash('error', 'This page is accessible only to Fundraisers!');

            $this->redirect(Yii::app()->createUrl('rewards'));
        }

        $cms_page = Cms::model()->findbyPk('46');

        $this->metaTitle = $cms_page->meta_title;
        $this->metaDescription = $cms_page->meta_desc;
        $this->metaKeyword = $cms_page->meta_keyword;

        $this->render('fundraisers', array(
            'cms_page' => $cms_page, 
            )
        );

    }


    public function actionHistory(){

        $winners = RewardWinner::model()->findAll(array('order' => 'id DESC'));

        $this->metaTitle = "Historic Rewards, Winners List";
        $this->metaDescription = "Historic Rewards, Winners List";
        $this->metaKeyword = "Historic Rewards, Winners List";

        $this->render('history', array(
            'winners' => $winners
            )
        );

    }


    public function actionTerms(){

        $policies = Cms::model()->findbyPk('47');
        $rules = Cms::model()->findbyPk('48');


        $this->metaTitle = $policies->meta_title;
        $this->metaDescription = $policies->meta_desc;
        $this->metaKeyword = $policies->meta_keyword;

        $this->render('terms', array(
            'policies' => $policies, 
            'rules' => $rules, 
            )
        );

    }

    public function actionTestimonials(){

        $cms_page = Cms::model()->findbyPk('48');

        $testimonials = Testimonial::model()->findAll(array(
            'condition' =>"status = 'Y' AND user_type='donor'",
            'limit' => 10,
            'order' => 'id DESC'
        ));

        $this->metaTitle = $cms_page->meta_title;
        $this->metaDescription = $cms_page->meta_desc;
        $this->metaKeyword = $cms_page->meta_keyword;

        $this->render('testimonials', array(
            'testimonials' => $testimonials,
            'cms_page' => $cms_page, 
            )
        );

    }


}
