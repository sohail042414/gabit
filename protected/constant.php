<?php
define('ADMIN_PROFILE_PICTURE_WIDTH', '215');
define('ADMIN_PROFILE_PICTURE_HEIGHT', '215');
define('ADMIN_PROFILE_PICTURE_THUMB_NAME', '215x215_');

// ENCRYPTION_KEY
define("ENCRYPTION_KEY", "silicon!@^#%it%&*hub");

// relative path constant
define('SITE_REL_PATH', dirname(dirname(__FILE__)) . '/');
define('UPLOAD_DIR_PATH', SITE_REL_PATH . 'uploads/');
define('PROFILE_PICTURE_ORIGINAL', UPLOAD_DIR_PATH . 'profile_pictures/original/');
define('PROFILE_PICTURE_THUMBNAIL', UPLOAD_DIR_PATH . 'profile_pictures/thumbnails/');
define('SITE_REL_PATH_PROFILE_PICTURE_THUMB', PROFILE_PICTURE_THUMBNAIL . ADMIN_PROFILE_PICTURE_THUMB_NAME);


define('ABS_PATH', "http://" . $_SERVER['SERVER_NAME']);
define('SITE_ABS_PATH', "http://" . $_SERVER['SERVER_NAME'] . '/');
define('SITE_ABS_PATH_UPLOADS', SITE_ABS_PATH . 'uploads/');
define('SITE_ABS_PATH_PROFILE_PICTURE', SITE_ABS_PATH_UPLOADS . 'profile_pictures/');
define('SITE_ABS_PATH_PROFILE_PICTURE_THUMB', SITE_ABS_PATH_PROFILE_PICTURE . 'thumbnails/' . ADMIN_PROFILE_PICTURE_THUMB_NAME);


// Home sliderimage path 

define('HOME_SLIDER_ORIGINAL', UPLOAD_DIR_PATH . 'slider/original/');
define('HOME_SLIDER_THUMBNAIL', UPLOAD_DIR_PATH . 'slider/thumbnails/');
define('HOME_SLIDER_THUMB_NAME', '215x215_');
define('SITE_ABS_PATH_HOME_SLIDER', SITE_ABS_PATH_UPLOADS . 'slider/original/');
define('SITE_ABS_PATH_HOME_SLIDER_THUMB_SUB', SITE_ABS_PATH_UPLOADS . 'slider/');
define('SITE_ABS_PATH_HOME_SLIDER_THUMB', SITE_ABS_PATH_HOME_SLIDER_THUMB_SUB . 'thumbnails/' . HOME_SLIDER_THUMB_NAME);


// Home Testimonial path

define('TESTIMONIAL_ORIGINAL', UPLOAD_DIR_PATH . 'testimonial_picture/original/');
define('TESTIMONIAL_THUMBNAIL', UPLOAD_DIR_PATH . 'testimonial_picture/thumbnails/');
define('TESTIMONIAL_THUMB_NAME', '215x215_');
define('SITE_ABS_PATH_TESTIMONIAL', SITE_ABS_PATH_UPLOADS . 'testimonial_picture/original/');
define('SITE_ABS_PATH_TESTIMONIAL_THUMB_SUB', SITE_ABS_PATH_UPLOADS . 'testimonial_picture/');
define('SITE_ABS_PATH_TESTIMONIAL_ORIGINAL', SITE_ABS_PATH_UPLOADS . 'testimonial_picture/original/');
define('SITE_ABS_PATH_TESTIMONIAL_THUMB', SITE_ABS_PATH_TESTIMONIAL_THUMB_SUB . 'thumbnails/' . TESTIMONIAL_THUMB_NAME);

// Fundraiser image path

define('FUNDRAISER_IMAGE_ORIGINAL', UPLOAD_DIR_PATH . 'fundraiser_picture/original/');
define('FUNDRAISER_IMAGE_THUMBNAIL', UPLOAD_DIR_PATH . 'fundraiser_picture/thumbnails/');
define('FUNDRAISER_IMAGE_THUMB_NAME', '215x215_');
define('SITE_ABS_PATH_FUNDRAISER_IMAGE', SITE_ABS_PATH_UPLOADS . 'fundraiser_picture/original/');
define('SITE_ABS_PATH_FUNDRAISER_IMAGE_SUB', SITE_ABS_PATH_UPLOADS . 'fundraiser_picture/');
define('SITE_ABS_PATH_FUNDRAISER_IMAGE_THUMB', SITE_ABS_PATH_FUNDRAISER_IMAGE_SUB . 'thumbnails/' . FUNDRAISER_IMAGE_THUMB_NAME);

// INFO
define('UPLOD_FUN_IMG_ORIGINAL', UPLOAD_DIR_PATH . 'fundraiser_picture/original/');
define('UPLOD_FUN_IMG_THUMBNAIL', UPLOAD_DIR_PATH . 'fundraiser_picture/thumbnails/');
define('UPLOD_FUN_IMG_THUMB_NAME', '215x215_');
define('SITE_ABS_PATH_UPLOD_FUN_IMG', SITE_ABS_PATH_UPLOADS . 'fundraiser_picture/original/');
define('SITE_ABS_PATH_UPLOD_FUN_IMG_SUB', SITE_ABS_PATH_UPLOADS . 'fundraiser_picture/');
define('SITE_ABS_PATH_UPLOD_FUN_IMG_THUMB', SITE_ABS_PATH_UPLOD_FUN_IMG_SUB . 'thumbnails/' . UPLOD_FUN_IMG_THUMB_NAME);

define('UPLOD_PIC_BENIF_ORIGINAL', UPLOAD_DIR_PATH . 'fundraiser_picture/original/');
define('UPLOD_PIC_BENIF_THUMBNAIL', UPLOAD_DIR_PATH . 'fundraiser_picture/thumbnails/');
define('UPLOD_PIC_BENIF_THUMB_NAME', '215x215_');
define('SITE_ABS_PATH_UPLOD_PIC_BENIF', SITE_ABS_PATH_UPLOADS . 'fundraiser_picture/original/');
define('SITE_ABS_PATH_UPLOD_PIC_BENIF_SUB', SITE_ABS_PATH_UPLOADS . 'fundraiser_picture/');
define('SITE_ABS_PATH_UPLOD_PIC_BENIF_THUMB', SITE_ABS_PATH_UPLOD_FUN_IMG_SUB . 'thumbnails/' . UPLOD_PIC_BENIF_THUMB_NAME);

define('UPLOD_PIC_LEAD_SUPPTR_ORIGINAL', UPLOAD_DIR_PATH . 'fundraiser_picture/original/');
define('UPLOD_PIC_LEAD_SUPPTR_THUMBNAIL', UPLOAD_DIR_PATH . 'fundraiser_picture/thumbnails/');
define('UPLOD_PIC_LEAD_SUPPTR_THUMB_NAME', '215x215_');
define('SITE_ABS_PATH_UPLOD_PIC_LEAD_SUPPTR', SITE_ABS_PATH_UPLOADS . 'fundraiser_picture/original/');
define('SITE_ABS_PATH_UPLOD_PIC_LEAD_SUPPTR_SUB', SITE_ABS_PATH_UPLOADS . 'fundraiser_picture/');
define('SITE_ABS_PATH_UPLOD_PIC_LEAD_SUPPTR_THUMB', SITE_ABS_PATH_UPLOD_PIC_LEAD_SUPPTR_SUB . 'thumbnails/' . UPLOD_PIC_LEAD_SUPPTR_THUMB_NAME);

define('UPLOAD_PIC_FUN_MANAGE_ORIGINAL', UPLOAD_DIR_PATH . 'fundraiser_picture/original/');
define('UPLOAD_PIC_FUN_MANAGE_THUMBNAIL', UPLOAD_DIR_PATH . 'fundraiser_picture/thumbnails/');
define('UPLOAD_PIC_FUN_MANAGE_THUMB_NAME', '215x215_');
define('SITE_ABS_PATH_UPLOAD_PIC_FUN_MANAGE', SITE_ABS_PATH_UPLOADS . 'fundraiser_picture/original/');
define('SITE_ABS_PATH_UPLOAD_PIC_FUN_MANAGE_SUB', SITE_ABS_PATH_UPLOADS . 'fundraiser_picture/');
define('SITE_ABS_PATH_UPLOAD_PIC_FUN_MANAGE_THUMB', SITE_ABS_PATH_UPLOAD_PIC_FUN_MANAGE_SUB . 'thumbnails/' . UPLOAD_PIC_FUN_MANAGE_THUMB_NAME);

define('USER_IMAGE', UPLOAD_DIR_PATH . 'fundraiser_picture/original/');
define('USER_IMAGE_THUMBNAIL', UPLOAD_DIR_PATH . 'fundraiser_picture/thumbnails/');
define('USER_IMAGE_THUMB_NAME', '215x215_');
define('SITE_ABS_PATH_USER_IMAGE', SITE_ABS_PATH_UPLOADS . 'fundraiser_picture/original/');
define('SITE_ABS_PATH_USER_IMAGE_SUB', SITE_ABS_PATH_UPLOADS . 'fundraiser_picture/');
define('SITE_ABS_PATH_USER_IMAGE_THUMB', SITE_ABS_PATH_UPLOAD_PIC_FUN_MANAGE_SUB . 'thumbnails/' . USER_IMAGE_THUMB_NAME);

// Supporter image

define('SUPPORTER_IMAGE_ORIGINAL', UPLOAD_DIR_PATH . 'supporter_image/original/');
define('SUPPORTER_IMAGE_THUMBNAIL', UPLOAD_DIR_PATH . 'supporter_image/thumbnails/');
define('SUPPORTER_IMAGE_THUMB_NAME', '215x215_');
define('SITE_ABS_PATH_SUPPORTER_IMAGE', SITE_ABS_PATH_UPLOADS . 'supporter_image/original/');
define('SITE_ABS_PATH_SUPPORTER_IMAGE_SUB', SITE_ABS_PATH_UPLOADS . 'supporter_image/');
define('SITE_ABS_PATH_SUPPORTER_THUMB', SITE_ABS_PATH_SUPPORTER_IMAGE_SUB . 'thumbnails/' . SUPPORTER_IMAGE_THUMB_NAME);

// Event upload path
define('EVENT_INITERARY_ORIGINAL', UPLOAD_DIR_PATH . 'event_itinerary/original/');
define('EVENT_INITERARY_THUMBNAIL', UPLOAD_DIR_PATH . 'event_itinerary/thumbnails/');
define('EVENT_INITERARY_THUMB_NAME', '215x215_');
define('SITE_ABS_PATH_EVENT_IMAGE', SITE_ABS_PATH_UPLOADS . 'event_itinerary/original/');
define('SITE_ABS_PATH_EVENT_IMAGE_SUB', SITE_ABS_PATH_UPLOADS . 'event_itinerary/');
define('SITE_ABS_PATH_EVENT_IMAGE_THUMB', SITE_ABS_PATH_EVENT_IMAGE_SUB . 'thumbnails/' . EVENT_INITERARY_THUMB_NAME);

// new case update
define('IMAGE_ORIGINAL', UPLOAD_DIR_PATH . 'case_updates/original/');
define('IMAGE_THUMBNAIL', UPLOAD_DIR_PATH . 'case_updates/thumbnails/');
define('IMAGE_THUMB_NAME', '215x215_');
define('SITE_ABS_PATH_IMAGE', SITE_ABS_PATH_UPLOADS . 'case_updates/original/');
define('SITE_ABS_PATH_IMAGE_SUB', SITE_ABS_PATH_UPLOADS . 'case_updates/');
define('SITE_ABS_PATH_IMAGE_THUMB', SITE_ABS_PATH_IMAGE_SUB . 'thumbnails/' . IMAGE_THUMB_NAME);

//Pagination 
define('COMMENT_RECORDS_PER_PAGE',10);

// Affiliate image path

//define('FUNDRAISER_IMAGE_ORIGINAL', UPLOAD_DIR_PATH . 'fundraiser_picture/original/');

define('AFFILIATE_IMAGE_ORIGINAL', UPLOAD_DIR_PATH . 'affiliate_picture/original/');
define('AFFILIATE_IMAGE_THUMBNAIL', UPLOAD_DIR_PATH . 'affiliate_picture/thumbnails/');
define('AFFILIATE_IMAGE_THUMB_NAME', '215x215_');
define('SITE_ABS_PATH_AFFILIATE_IMAGE', SITE_ABS_PATH_UPLOADS . 'affiliate_picture/original/');
define('SITE_ABS_PATH_AFFILIATE_SUB', SITE_ABS_PATH_UPLOADS . 'affiliate_picture/');
define('SITE_ABS_PATH_AFFILIATE_IMAGE_THUMB', SITE_ABS_PATH_AFFILIATE_SUB . 'thumbnails/' . AFFILIATE_IMAGE_THUMB_NAME);


define('BANNER_IMAGE_ORIGINAL', UPLOAD_DIR_PATH . 'banners/original/');
define('SITE_ABS_PATH_BANNER_IMAGE', SITE_ABS_PATH_UPLOADS . 'banners/original/');


if(isset($_SERVER['SERVER_NAME']) && ($_SERVER['SERVER_NAME'] == 'gabit.local')){
    define('SITE_ABS_PATH_CASE_UPDATES_DOCS', "http://" . $_SERVER['SERVER_NAME'] . '/uploads/case_updates/original/');
}else{
    define('SITE_ABS_PATH_CASE_UPDATES_DOCS', "https://" . $_SERVER['SERVER_NAME'] . '/uploads/case_updates/original/');
}

?>
