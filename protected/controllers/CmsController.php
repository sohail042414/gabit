<?php

class CmsController extends Controller
{

    var $metaDescription;
    var $metaKeyword;
    var $metaTitle;

    public function actionIndex()
    {
        $this->render('index');
    }

    public function actionHow_this_work()
    {

        $cms_model = Cms::model()->findbyPk('7');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;
        $this->render('how_this_work', array('page_content' => $cms_model->page_content));
    }

    public function actionAboutus()
    {

        $cms_model = Cms::model()->findbyPk('2');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('about_us', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionSupport_and_Contact_Centre()
    {

        $cms_model = Cms::model()->findbyPk('3');
        // code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;


        $this->render('support_and_contact_centre', array('page_content' => $cms_model->page_content));
    }

    public function actionCareers()
    {

        $cms_model = Cms::model()->findbyPk('4');

        //        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;


        $this->render('careers', array('page_content' => $cms_model->page_content));
    }

    public function actionFees()
    {

        $cms_model = Cms::model()->findbyPk('5');

        //        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;


        $this->render('fees', array('page_content' => $cms_model->page_content));
    }

    public function actionMedia_Reviews()
    {

        $cms_model = Cms::model()->findbyPk('6');

        //        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;


        $this->render('media_reviews', array('page_content' => $cms_model->page_content));
    }

    public function actionFundraising_suggestions()
    {

        $cms_model = Cms::model()->findbyPk('8');

        //        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('fundraising_suggestions', array('page_content' => $cms_model->page_content));
    }

    public function actionLeveraging_social_media()
    {

        $cms_model = Cms::model()->findbyPk('10');

        //        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;


        $this->render('leveraging_social_media', array('page_content' => $cms_model->page_content));
    }

    public function actionFundraisers()
    {

        $cms_model = Cms::model()->findbyPk('13');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('fundraisers', array('page_content' => $cms_model->page_content));
    }

    public function actionWhy_use_mobiTrust()
    {

        $cms_model = Cms::model()->findbyPk('26');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('why_use_mobiTrust', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionA_Small_Fee()
    {

        $cms_model = Cms::model()->findbyPk('15');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('a_small_fee', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionGuidance_for_success()
    {

        $cms_model = Cms::model()->findbyPk('16');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('guidance_for_success', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionMobile_advantage()
    {

        $cms_model = Cms::model()->findbyPk('17');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('mobile_advantage', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionDedicated_fundraising()
    {

        $cms_model = Cms::model()->findbyPk('18');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('dedicated_fundraising', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionMedical_partners()
    {

        $cms_model = Cms::model()->findbyPk('19');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('medical_partners', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionDiseases_and_deiagnoses_centre()
    {

        $cms_model = Cms::model()->findbyPk('20');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('diseases_and_deiagnoses_centre', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionPress_support()
    {

        $cms_model = Cms::model()->findbyPk('21');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('press_support', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionHow_to()
    {

        $cms_model = Cms::model()->findbyPk('22');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('how_to', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionPress_featured_fundraisers()
    {

        $cms_model = Cms::model()->findbyPk('23');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('press_featured_fundraisers', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionStep_by_step_guide_to_fundraising()
    {

        $cms_model = Cms::model()->findbyPk('24');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('step_by_step_guide_to_fundraising', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionGeneral_information()
    {

        $cms_model = Cms::model()->findbyPk('25');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('general_information', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionWhat_is_cancer()
    {

        $cms_model = Cms::model()->findbyPk('28');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('what_is_cancer', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }


    public function actionAbout_crowdfunding()
    {

        $cms_model = Cms::model()->findbyPk('29');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('about_crowdfunding', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }
    public function actionTerms_of_service()
    {

        $cms_model = Cms::model()->findbyPk('30');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('terms_of_service', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionPrivacy_policy()
    {

        $cms_model = Cms::model()->findbyPk('31');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('privacy_policy', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }


    public function actionQuestion_detail()
    {

        $cms_model = Cms::model()->findbyPk('25');

//        code for the meta
        $this->metaTitle = 'Question Detail';
//        $this->metaDescription = $cms_model->meta_desc;
//        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('question_detail', array('page_title' => 'Question Detail', 'data' => $_REQUEST));
    }


    public function actionBenefits_crowdfunding()
    {

        $cms_model = Cms::model()->findbyPk('32');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('benefits_crowdfunding', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }

    public function actionPaying_for_cancer_treatment()
    {

        $cms_model = Cms::model()->findbyPk('33');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('paying_for_cancer_treatment', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }
    
    public function actionView_our_brand_resources()
    {

        $cms_model = Cms::model()->findbyPk('34');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('view_our_brand_resources', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }
    
    public function actionLearn_about_raising_money_for_yourself_or_a_loved_one()
    {

        $cms_model = Cms::model()->findbyPk('35');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('learn_about_raising_money_for_yourself_or_a_loved_one', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }
    
    public function actionLearn_about_supporting_a_fundraising_campaign_or_two()
    {

        $cms_model = Cms::model()->findbyPk('36');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('learn_about_supporting_a_fundraising_campaign_or_two', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }
    
    public function actionLearn_about_donating_to_a_fundraising_campaign()
    {

        $cms_model = Cms::model()->findbyPk('37');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('learn_about_donating_to_a_fundraising_campaign', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }
    
    public function actionDigital_media()
    {

        $cms_model = Cms::model()->findbyPk('38');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('digital_media', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }
    
    public function actionSoftware_engineer()
    {

        $cms_model = Cms::model()->findbyPk('39');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('software_engineer', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }
    
    public function actionGraphic_designer()
    {

        $cms_model = Cms::model()->findbyPk('40');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('graphic_designer', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }
    
    public function actionCommunity_evangelist()
    {

        $cms_model = Cms::model()->findbyPk('41');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('community_evangelist', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }
    
    public function actionEmbed_this_fundraiser()
    {

        $cms_model = Cms::model()->findbyPk('42');

//        code for the meta
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('embed_this_fundraiser', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }
    
    public function actionReport_this_fundraiser()
    {

        $cms_model = Cms::model()->findbyPk('43');
        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('report_this_fundraiser', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));
    }


    public function actionTop_donor_reward_program(){

        $cms_model = Cms::model()->findbyPk('44');

        $this->metaTitle = $cms_model->meta_title;
        $this->metaDescription = $cms_model->meta_desc;
        $this->metaKeyword = $cms_model->meta_keyword;

        $this->render('top_donor_reward_program', array('page_title' => $cms_model->page_title, 'page_content' => $cms_model->page_content));

    }


}
