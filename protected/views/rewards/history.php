    <!-- content block -->
    <div class="container content-block mt-5">
        <h2 class="same-heading same-heading-pb">
            Historic Rewards
        </h2>
        <div class="accordion" id="accordionExample px-40">
        <?php foreach($winners as $key => $winner){ ?>
            <div class="accordion-item mb-24">
                <h2 class="accordion-header">
                    <button class="  accordion-button accordion-btn-fs primary-font text-black text-black text-black"
                        type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne-<?php echo $winner->id; ?>" aria-expanded="true"
                        aria-controls="collapseOne-<?php echo $winner->id; ?>">
                        <?php echo ucwords($winner->month).' '.$winner->year; ?>  Top Donor Reward: <span class="system-ui">₦</span> <?php echo $winner->prize_amount; ?>
                    </button>
                </h2>
                <div id="collapseOne-<?php echo $winner->id; ?>" class="accordion-collapse collapse <?php echo ($key == 0) ? 'show':''; ?>" data-bs-parent="#accordionExample">
                    <div class="accordion-body">
                        <div class="wrapper">
                            <div class="row accordion-row-pb">
                                <div class="col-12  mx-auto col-lg-2 border-right-white-a ">
                                    <div class="profile-pic m-auto">
                                        <?php $user_image = !empty($winner->user->user_image) ? SITE_ABS_PATH_USER_IMAGE_THUMB.$winner->user->user_image : SITE_ABS_PATH."images/no-photo.jpeg"; ?>
                                        <img src="<?php echo $user_image; ?>" alt=" pic">
                                    </div>
                                </div>
                                <div class="  col-12 col-md-6  col-lg-5  accordion-spacing border-right-white">
                                    <div class="row">
                                        <div class="col">
                                            <h3 class="accordion-left-font text-start">Donor Name</h3>
                                        </div>
                                        <div class="col">
                                            <h3 class="accordion-right-font text-start"><?php echo $winner->user->username; ?></h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <h3 class="accordion-left-font text-start">Fundraisers Supported
                                            </h3>
                                        </div>
                                        <div class="col">
                                            <h3 class="accordion-right-font text-start"><?php echo Supporter::model()->getUserMonthSupporterCount($winner->year,$winner->month,$winner->user_id); ?></h3>
                                        </div>
                                    </div>
                                    <div class="row ">
                                        <div class="col">
                                            <h3 class="accordion-left-font text-start">Total Support Actions
                                            </h3>
                                        </div>
                                        <div class="col">
                                            <h3 class="accordion-right-font text-start"><?php echo RewardPoints::model()->getMonthlyActionsCount($winner->user_id,$winner->month,$winner->year); ?></h3>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-12 col-md-6 col-lg-5 accordion-spacing ">
                                    <div class="row">
                                        <div class="col">
                                            <h3 class="accordion-left-font text-start">Location</h3>
                                        </div>
                                        <div class="col">
                                            <h3 class="accordion-right-font text-start"><?php echo $winner->location; ?></h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <h3 class="accordion-left-font text-start">Total Points</h3>
                                        </div>
                                        <div class="col">
                                            <h3 class="accordion-right-font text-start"><?php echo RewardPoints::model()->getUserMonthlyTotalPoints($winner->user_id,$winner->month,$winner->year); ?></h3>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col">
                                            <h3 class="accordion-left-font text-start">Frequency of Donations:
                                            </h3>
                                        </div>
                                        <div class="col">
                                            <h3 class="accordion-right-font text-start"><?php echo Donations::model()->getUserMonthlyDonationsCount($winner->user_id,$winner->month,$winner->year); ?></h3>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row border-top-white pt-30">
                                <div class=" col-12 col-md-6 col-lg-8 ps-1.5 pt-0 ps-md-0">
                                    <p class="primary-p-font text-start">
                                        <?php echo $winner->preparContent(); ?>
                                    </p>
                                </div>
                                <div class="col-12 col-md-6   col-lg-4 p-0 pt-4">
                                    <?php $style = !empty($winner->image1)? 'background-image: url('.SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $winner->image1.');  background-repeat: no-repeat; background-size:cover;' : ''; ?>
                                    <div class="right-bg-img position-relative" style="<?php echo $style; ?>">
                                        <!-- Modal -->
                                        <div class="modal fade" id="exampleModal-<?php echo $winner->id; ?>" tabindex="-1"
                                            aria-labelledby="exampleModalLabel" aria-hidden="true">
                                            <div class="modal-dialog modal-dialog-centered modal-dialog-width">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <div id="carouselExampleIndicators" class="carousel slide">
                                                            <div class="carousel-indicators">
                                                                <button type="button"
                                                                    data-bs-target="#carouselExampleIndicators"
                                                                    data-bs-slide-to="0" class="active"
                                                                    aria-current="true" aria-label="Slide 1"></button>
                                                                <button type="button"
                                                                    data-bs-target="#carouselExampleIndicators"
                                                                    data-bs-slide-to="1" aria-label="Slide 2"></button>
                                                                <button type="button"
                                                                    data-bs-target="#carouselExampleIndicators"
                                                                    data-bs-slide-to="2" aria-label="Slide 3"></button>
                                                                <button type="button"
                                                                    data-bs-target="#carouselExampleIndicators"
                                                                    data-bs-slide-to="3" aria-label="Slide 4"></button>
                                                            </div>
                                                            <div class="carousel-inner">

                                                                <?php if(!empty($winner->image1)){ ?>
                                                                <div class="carousel-item active">
                                                                    <div class="top-donor-block">
                                                                        <img src="<?php echo SITE_ABS_PATH_FUNDRAISER_IMAGE . $winner->image1; ?>"
                                                                            class="d-block w-100" alt="...">
                                                                    </div>
                                                                </div>
                                                                <?php } ?>
                                                                <?php if(!empty($winner->image2)){ ?>
                                                                <div class="carousel-item">
                                                                    <div class="top-donor-block">
                                                                        <img src="<?php echo SITE_ABS_PATH_FUNDRAISER_IMAGE . $winner->image2; ?>"
                                                                            class="d-block w-100" alt="...">
                                                                    </div>
                                                                </div>
                                                                <?php } ?>
                                                                <?php if(!empty($winner->image3)){ ?>
                                                                <div class="carousel-item">
                                                                    <div class="top-donor-block">
                                                                        <img src="<?php echo SITE_ABS_PATH_FUNDRAISER_IMAGE . $winner->image3; ?>"
                                                                            class="d-block w-100" alt="...">
                                                                    </div>
                                                                </div>
                                                                <?php } ?>
                                                                <?php if(!empty($winner->image4)){ ?>
                                                                <div class="carousel-item">
                                                                    <div class="top-donor-block">
                                                                        <img src="<?php echo SITE_ABS_PATH_FUNDRAISER_IMAGE . $winner->image4; ?>"
                                                                            class="d-block w-100" alt="...">
                                                                    </div>
                                                                </div>
                                                                <?php } ?>
                                                            </div>
                                                            <button class="carousel-control-prev" type="button"
                                                                data-bs-target="#carouselExampleIndicators"
                                                                data-bs-slide="prev">
                                                                <span class="carousel-control-prev-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">Previous</span>
                                                            </button>
                                                            <button class="carousel-control-next" type="button"
                                                                data-bs-target="#carouselExampleIndicators"
                                                                data-bs-slide="next">
                                                                <span class="carousel-control-next-icon"
                                                                    aria-hidden="true"></span>
                                                                <span class="visually-hidden">Next</span>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <a class="text-black" href="" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal-<?php echo $winner->id; ?>">
                                            <div
                                                class="notification-container position-absolute d-flex align-items-center justify-content-between ">
                                                <div class="row">
                                                    <div class="d-flex align-items-center">
                                                        <div class="flex-a d-flex pl-6">
                                                            <?php if(!empty($winner->image1)){ ?>
                                                            <div class="notification-img-container">
                                                                <img src="<?php echo SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $winner->image1; ?>" alt="">
                                                            </div>
                                                            <?php } ?>
                                                            <?php if(!empty($winner->image2)){ ?>
                                                            <div class="notification-img-container">
                                                                <img src="<?php echo SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $winner->image2; ?>" alt="">
                                                            </div>
                                                            <?php } ?>
                                                            <?php if(!empty($winner->image3)){ ?>
                                                            <div class="notification-img-container overlap-margin">
                                                                <img src="<?php echo SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $winner->image3; ?>" alt="">
                                                            </div>
                                                            <?php } ?>
                                                            <?php if(!empty($winner->image4)){ ?>
                                                            <div class="notification-img-container overlap-margin">
                                                                <img src="<?php echo SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB . $winner->image4; ?>" alt="">
                                                            </div>
                                                            <?php } ?>
                                                        </div>
                                                        <h4 class="fs-12 m-0 primary-font pl-6">More</h4>
                                                    </div>
                                                </div>
                                            </div>
                                        </a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        <?php } ?>
        </div>

        <div class="white-block historic-reward-block"></div>
    </div>