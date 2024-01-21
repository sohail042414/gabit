<div class="row">
    <div class="col-lg-3 rewards-left-area"></div>
    <div class="col-lg-9 rewards-right-area">
        <h1>Historic Rewards</h1>

        <?php foreach($winners as $winner){ ?>
            <div class="row">
                <div class="col-lg-4 col-md-4">
                <?php $user_image = !empty($winner->user->user_image) ? SITE_ABS_PATH_USER_IMAGE_THUMB.$winner->user->user_image : SITE_ABS_PATH."images/no-photo.jpeg"; ?>
                    <img src="<?php echo $user_image; ?>">
                    <p><?php echo $winner->user->username; ?></p>
                    <p><?php echo $winner->user->email; ?></p>
                </div>
                <div class="col-lg-4 col-md-4">
                    <p>
                        Aliquam mollis, ex quis iaculis luctus, enim lectus pharetra eros, vel tempus purus turpis at ligula. Vivamus rutrum diam tristique lobortis mattis. Proin in mauris orci. Morbi pretium sed elit quis bibendum. In fringilla purus ut tellus varius lobortis. Pellentesque id libero pharetra, egestas est eget, scelerisque orci. Pellentesque mollis enim tortor, eget maximus quam mollis at. Vivamus nulla lacus.
                    </p>
                </div>
                <div class="col-lg-4 col-md-4">
                <img style="width:330px;" src="<?php echo SITE_ABS_PATH; ?>css/rewards/images/reward-card-old.png" alt="Reward-Card">
                </div>
            </div>
            <div class="row" style="border-bottom: 2xp solid black;">
                <div class="col-lg-4 col-md-4">
                    Activity 
                </div>
                <div class="col-lg-4 col-md-4">
                    Points (2000)
                </div>
                <div class="col-lg-4 col-md-4">
                    Total No of actions (43)
                </div>
            </div>
            <div class="row" style="border-bottom: 2xp solid black;">
                <div class="col-lg-4 col-md-4">
                    Donation 
                </div>
                <div class="col-lg-4 col-md-4">
                    Total No (3)
                </div>
                <div class="col-lg-4 col-md-4">
                    Total:  ( ₦ 40000)
                </div>
            </div>

            <?php } ?>



    </div>
</div>