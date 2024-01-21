<div class="main_banner">
    <div class="center_banner">
        <?php
        /* @var $this SiteController */
        /* @var $model LoginForm */
        /* @var $form CActiveForm */

        $this->pageTitle = Yii::app()->name . ' - Login';
        $this->breadcrumbs = array(
            'Login',
        );
        ?>


<div class="inner-container">
    <div class="inner-left">

        <?php if (Yii::app()->user->hasFlash('fb_error')) { ?>
            <div class="row" style="color:red;padding:5px;margin:10px;">
                <?php echo Yii::app()->user->getFlash('fb_error'); ?>
            </div>
        <?php } ?>

        <?php if (Yii::app()->user->hasFlash('success_message')) { ?>
            <div class="row" style="color:green;padding:5px;margin:10px;">
                <?php echo Yii::app()->user->getFlash('success_message'); ?>
            </div>
        <?php } ?>


        <div class="inner-page">
		<div id="login_form">
                    <?php
                    $from_signup_popup = false;
                    if(!empty($_GET['type'])) {
                        if($_GET['type'] == 'from_signup_popup') {
                            $from_signup_popup = true;
                        }
                    }
                    ?>                    
                    <h4><?php echo !empty($from_signup_popup)?'Please Login to continue':'Login'; ?></h4>
            <?php
            if(!empty($_REQUEST['refer'])){ ?>
                <div class="alert alert-success alert-dismissable">
                    You have been successfully register..
                </div>
            <?php }
            ?>
        <div class="form">
            <?php $form = $this->beginWidget('CoreGxActiveForm', array(
                'id' => 'login-form',
                'enableAjaxValidation' => false,
                'enableClientValidation' => true,
                'htmlOptions' => array(
                    'enctype' => 'multipart/form-data'
                ),
                'clientOptions' => array(
                    'validateOnSubmit' => true,
                    'validateOnChange' => true,
                ),
            )); ?>
            <?php echo UtilityHtml::get_flash_message(); ?>

            <div class="row">
                <div class="label_cls"><?php echo $form->labelEx($model, 'username'); ?></div>
                
                <div class="input_cls">
				<?php echo $form->textField($model, 'username'); ?>
                <div class="clr"></div>
                <?php echo $form->error($model, 'username'); ?>
                </div>
                
            </div>

            <div class="row">
                <div class="label_cls"><?php echo $form->labelEx($model, 'password'); ?></div>
                
                <div class="input_cls">
				<?php echo $form->passwordField($model, 'password'); ?>
                <div class="clr"></div>
                <?php echo $form->error($model, 'password'); ?>
                </div>
                
            </div>

            <div class="row rememberMe">
                <?php echo $form->checkBox($model, 'rememberMe'); ?>
				<?php echo $form->label($model, 'rememberMe'); ?>
                <div class="clr"></div>
                <?php echo $form->error($model, 'rememberMe'); ?>
                
            </div>
            
            <div class="row">
                <a href="<?php echo $this->createUrl('account/forgot_password');?>" class="fp_cls">Forgot Password?</a>
            </div>

            <div class="row buttons">
                <?php echo CHtml::submitButton('Login',array('style'=>'height:41px;')); ?>
                <div class="fb-login-wrap">
                    <fb:login-button class="fb-login-button" data-width="250" data-size="large" data-button-type="continue_with" data-layout="default" data-use-continue-as="true" scope="public_profile,email" onlogin="checkLoginState();">
                    </fb:login-button>
                </div>
            </div>

            <div class="row buttons" style="padding-left:35px;">

            </div>

            <?php $this->endWidget(); ?>
        </div>
        <!-- form -->
        </div>
        </div>
    </div>
</div>
</div>
</div>
<script>

function statusChangeCallback(response) {  
    // Called with the results from FB.getLoginStatus().
    //console.log('statusChangeCallback');
    //console.log(response);                   // The current login status of the person.
    
    if (response.status === 'connected') {   // Logged into your webpage and Facebook.
                
        $.ajax({
            'type': 'POST',
            'dataType' : 'json',
            'url': '<?php echo Yii::app()->createUrl('site/fbconnected'); ?>',                
            'data': {'response':response},
            'success': function (data) {
                if(data.status){
                    location.href = '<?php echo Yii::app()->createUrl('fundraise/index'); ?>';
                }else{
                    getUserData(response);  
                }
            }
        });
    } else {                             
        //do nothing 
    }
  }


  function checkLoginState() {               // Called when a person is finished with the Login Button.
    FB.getLoginStatus(function(response) {   // See the onlogin handler
      statusChangeCallback(response);
    });
  }


  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1516737235423924',
      cookie     : true,                     // Enable cookies to allow the server to access the session.
      xfbml      : true,                     // Parse social plugins on this webpage.
      version    : 'v14.0'           // Use this Graph API version for this call.
    });


    // FB.getLoginStatus(function(response) {   // Called after the JS SDK has been initialized.
    //   statusChangeCallback(response);        // Returns the login status.
    // });

  };
 
  function getUserData(tokenData) {                      // Testing Graph API after login.  See statusChangeCallback() for when this call is made.    
        
        FB.api(
            '/me',
            'GET',
            {"fields":"id,name,email"},
            function(response) {
                                
                $.ajax({
                    'type': 'POST',
                    'dataType' : 'json',
                    'url': '<?php echo Yii::app()->createUrl('site/fbapilogin'); ?>',                
                    'data': {'response': response,'tokenData':tokenData},
                    'success': function (data) {
                        if(data.status){
                            location.href = '<?php echo Yii::app()->createUrl('fundraise/index'); ?>';
                        }else{
                            console.log('not able to login using facebook');
                        }
                    }
                });

            }
        );
    

  }
</script>