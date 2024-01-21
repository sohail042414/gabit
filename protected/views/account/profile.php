<meta content='width=device-width; initial-scale=1.0; maximum-scale=1.0; user-scalable=0;' name='viewport' />
<!--<meta name="viewport" content="width=device-width" />-->
<?php echo $this->renderPartial('/layouts/cms_banner'); ?>
<div class="inner-container">
    <div class="lead_support">
        <h4>My Profile</h4>
        <div class="lead_tab">
            <?php echo $this->renderPartial('/layouts/dashboard_menu'); ?>
        </div>
    </div>
    <div class="dashboard_content">
        <div class="inner-left" id="report_manage_fundraiser">
            <div class="inner-page">
                <div id="user_profile">

                <table class="demo" style="margin-top:20px;">
                     <tbody>
                    <tr>
                        <td>Image</td>
                        <?php $user_image = !empty($user->user_image) ? SITE_ABS_PATH_USER_IMAGE_THUMB.$user->user_image : SITE_ABS_PATH."images/no-photo.jpeg"; ?>
                        <td><img class="preview_image" src="<?php echo $user_image; ?>" alt="" /></td>
                    </tr>
                     <tr>
                        <td>Name</td>
                        <td><?php echo $user->username; ?></td>
                     </tr>
                     <tr>
                        <td>Email</td>
                        <td><?php echo $user->email; ?></td>
                     </tr>
                     <tr>
                        <td>User Type</td>
                        <td><?php echo $user->role; ?></td>
                     </tr>
                     <tr>
                        <td>Age</td>
                        <td><?php echo $user->age; ?></td>
                     </tr>
                     <tr>
                        <td>Sex</td>
                        <td><?php echo ($user->sex == 'M') ? 'Male': 'Female'; ?></td>
                     </tr>

                     </tbody>
                  </table>  
 

                </div>
            </div>
        </div>
        <div class="inner-right">
         <div class="inner-right-col">
            <a href="<?php echo $this->createUrl('account/update_profile'); ?>" class="btn_question">Update Profile</a>    
            <a class="btn_question" onclick="startLoader();">Start Loader</a>        
            <a class="btn_question" onclick="stopLoader();">Stop Loader</a>   
            
            <a class="btn_question" onclick="startLoader2();">Start Loader 2</a>        
            <a class="btn_question" onclick="stopLoader2();">Stop Loader 2</a>  
         </div>
      </div>
    </div>