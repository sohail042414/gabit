<header class="header fixed-top clearfix">
    <!--logo start-->
    <div class="brand">
        <a href="<?php echo Yii::app()->createUrl('admin/dashboard/index'); ?>" class="logo">
            <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/logo.png" alt="" width="180px" height="50px">
        </a>
        <div class="sidebar-toggle-box">
            <div class="fa fa-bars"></div>
        </div>
    </div>
    <!--logo end-->
    <div class="top-nav clearfix">
        <!--search & user info start-->
        <ul class="nav pull-right top-menu">
            <!-- user login dropdown start-->
            <li class="dropdown">
                <a data-toggle="dropdown" class="dropdown-toggle" href="#">
                    <?php
                    $user_model = Users::model()->findByPk(Yii::app()->user->id);
                    if (!empty($user_model->profile_picture) && file_exists(SITE_REL_PATH_PROFILE_PICTURE_THUMB . $user_model->profile_picture)) { ?>
                        <img
                            src="<?php echo SITE_ABS_PATH_PROFILE_PICTURE_THUMB . $user_model->profile_picture; ?>"
                            class="img-circle"
                            alt="User Image"/>
                    <?php
                    } else {
                        ?>
                        <img src="<?php echo Yii::app()->request->baseUrl; ?>/images/admin/avatar5.png"
                             class="img-circle"
                             alt="User Image"/>
                    <?php
                    }
                    ?>
                    <span
                        class="username"><?php echo Yii::app()->user->username;?></span>
                    <b class="caret"></b>
                </a>
                <ul class="dropdown-menu extended logout">
                    <li><a href="<?php echo $this->CreateUrl('dashboard/changepassword'); ?>"><i class="fa fa-key"></i> Change Password</a></li>
                    <li><a href="<?php echo $this->CreateUrl('dashboard/logout'); ?>"><i class="fa fa-key"></i> Log Out</a></li>
                </ul>
            </li>
        </ul>
    </div>
</header>