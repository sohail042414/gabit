<?php

class UtilityHtml extends CHtml
{

    public static function showNigeriaTime($timestamp){
        // Create the datetime and set the timestamp
        $dateTime = new DateTime($timestamp, new DateTimeZone('America/New_York'));
        //echo "<br>Default : ".$dateTime->format('M d,Y , H:i:s');
        // Convert it
        $dateTime->setTimeZone(new DateTimeZone('Africa/Lagos'));
        //echo "<br> Africa/Lagos : ".$dateTime->format('M d,Y , H:i:s');
        return $dateTime->format('M d,Y , H:i:s');
    }


    public static function getStatusImage($status, $page)
    {
        if ($status == 'Y') {
            return "<div class='status_icons" . $page . "'><img src='" . Yii::app()->request->baseUrl . '/images/admin/active.ico' . "' alt=''/></div>";
        } else if ($status == 'N') {
            return "<div class='status_icons" . $page . "'><img src='" . Yii::app()->request->baseUrl . '/images/admin/inactive.ico' . "' alt=''/></div>";
        } else if ($status == 'R') {
            return 'RTO';
        }
    }


    public static function get_reward_flash_messages(){

        $messages = Yii::app()->frontUser->getFlashes();

        $alert_message = '';

        if(count($messages) > 0){
            $alert_message .= '<div class="container-fluid p-2 mt-5 text-center position-relative">';

            foreach($messages as $key => $message) {
                switch ($key) {
                    case 'error' :
                        $alert_message .= '<div class="alert alert-danger alert-dismissable">
                                                ' . $message . '
                                            </div>';
                        break;
                    case 'success' :
                        $alert_message .= '<div class="alert alert-success alert-dismissable">
                                                ' . $message . '
                                           </div>';
                        break;
                }
            }
            
            $alert_message .= '</div>';
        }

        return $alert_message;
    }

    public static function get_flash_message()
    {
        $alert_message = '';

        foreach (Yii::app()->user->getFlashes() as $key => $message) {
            switch ($key) {
                case 'error' :
                    $alert_message .= '<div class="alert alert-danger alert-dismissable">
                                            ' . $message . '
                                        </div>';
                    break;
                case 'success' :
                    $alert_message .= '<div class="alert alert-success alert-dismissable">
                                            ' . $message . '
                                       </div>';
                    break;
            }
        }

        return $alert_message;
    }

    public function get_image_from_path($path, $class = '', $alt = '')
    {
        return "<img src='" . $path . "' class='" . $class . "' alt='" . $alt . "' />";
    }

    public function get_home_slider_from_path($path, $class = '', $alt = '')
    {
        return "<img src='" . SITE_ABS_PATH_HOME_SLIDER_THUMB . $path . "' class='" . $class . "' alt='" . $alt . "' />";
    }

    public function get_corporate_supporter_thumb($path, $class = '', $alt = '')
    {
        return "<img src='" . SITE_ABS_PATH_SUPPORTER_THUMB . $path . "' class='" . $class . "' alt='" . $alt . "' />";
    }

    public function get_testimonial_picture_from_path($path, $class = '', $alt = '')
    {
        return "<img src='" . SITE_ABS_PATH_TESTIMONIAL_THUMB . $path . "' class='" . $class . "' alt='" . $alt . "' />";
    }

    public function get_pp($path, $class = '', $alt = '')
    {
        return "<img src='" . $path . "' class='" . $class . "' alt='" . $alt . "' />";
    }

    public function getDocumentLink($document_name)
    {
        return "<a class='fa fa-download' href='" . CLIENT_DOCUMENT_ABS_PATH . $document_name . "' target='__blank'></a>";
    }

    public function get_mark_as_proper_link($data)
    {
        return "<a class='confirm_popup' href='" . Yii::app()->createUrl('admin/badFaces/markAsProperFace', array('id' => $data->id)) . "'>Mark as Proper Face</a>";
    }

    public function generate_password($length = 8)
    {
        $chars = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%^&*()_-=+;:,.?";
        $password = substr(str_shuffle($chars), 0, $length);
        return $password;
    }

    function time_elapsed_string($ptime)
    {
        $etime = time() - strtotime($ptime);
        if ($etime < 1) {
            return '0 seconds';
        }

        $a = array(365 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );
        $a_plural = array('year' => 'years',
            'month' => 'months',
            'day' => 'days',
            'hour' => 'hours',
            'minute' => 'minutes',
            'second' => 'seconds'
        );

        foreach ($a as $secs => $str) {
            $d = $etime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . ($r > 1 ? $a_plural[$str] : $str) . ' ago';
            }
        }
    }

    public function get_fundraiser_percent($amount = '', $id = '')
    {
        $Donations = Donations::model()->findAll(array('select' => 'donation_amount', 'condition' => 'fundraiser_id = ' . $id . '  '));
        $total_amount = 0;
        foreach ($Donations as $amount_row)
            $total_amount += $amount_row->donation_amount;
        $percentage = round(($total_amount / $amount) * 100) . '%';
        if($percentage > 100){
            $percentage = '100%';
        }
        return $percentage;
    }

    public function fundraiser_left_day()
    {
    }
    
    /*
     * Function time_elapsed_string
     * Internal Function
     */
    function fundraiser_time_elapsed($time)
    {
        $timefromdb = time(); // or your date as well
        $future = strtotime($time); //Future date.
        $timeleft = $future-$timefromdb;
        $daysleft = round((($timeleft/24)/60)/60);
        if($daysleft < 0) {
            $daysleft = 0;
        }
        return $daysleft.' Days';
    }

    function close_fancybox($redirect_url)
    {
        echo "<script type='text/javascript' src='" . Yii::app()->request->baseUrl . "/js/jquery.min.js'></script>
        <script type='text/javascript'>
                $(function() { parent.$.fancybox.close(); });
                window.parent.location.href = '" . $redirect_url . "';
                </script>";
    }
    
    public static function get_notification_count_for_user()
    {
        $current_user_id = !empty(Yii::app()->frontUser->id)?Yii::app()->frontUser->id:null;
        $return_count = NotificationsComment::model()->count(array('condition' => 'to_id='.$current_user_id.' AND is_read="N" AND status="Y"'));
    	/* 1 JULY 2016 BACKUP
	$return_message_count = Notifications::model()->count(array('condition' => 'to_id = '.$current_user_id.' AND is_read="N" AND status="Y"'));
	*/
	        $return_message_count = Notifications::model()->count(array('condition' => '(to_id = '.$current_user_id.'  )AND is_read="N" AND status="Y"'));

        $all_admin_message_count = SendallNotifications::model()->count(array('condition' => 'user_id='.$current_user_id.'  AND is_read="N" '));

        $return_count=$return_count+$return_message_count+$all_admin_message_count;
        //p($return_count);die;
        if(empty($return_count)) {
            $return_count = 0;
        }
        return $return_count;
    }

    public static function countryList(){
        $countries = array();
                
        $countries['234'] = '+234 (Nigeria)'; 
        $countries['86'] = '+86 (China)';
        $countries['33'] = '+33 (France)';
        $countries['49'] = '+49 (Germany)';
        $countries['92'] = '+92 (Pakistan)';
        $countries['44'] = '+44 (United Kingdom)';
        $countries['7-840'] = '+7 840 (Abkhazia)';
        $countries['7-940'] = '+7 940 (Abkhazia)';
        $countries['93'] = '+93 (Afghanistan)';
        $countries['355'] = '+355 (Albania)';
        $countries['213'] = '+213 (Algeria)';
        $countries['1-684'] = '+1 684 (American Samoa)';
        $countries['376'] = '+376 (Andorra)';
        $countries['244'] = '+244 (Angola)';
        $countries['1-264'] = '+1 264 (Anguilla)';
        $countries['54'] = '+54 (Argentina)';
        $countries['374'] = '+374 (Armenia)';
        $countries['297'] = '+297 (Aruba)';
        $countries['247'] = '+247 (Ascension)';
        $countries['61'] = '+61  (Australia)';
        $countries['672'] = '+672 (Australian External Territories)';
        $countries['43'] = '+43 (Austria)';
        $countries['994'] = '+994 (Azerbaijan)';
        $countries['1-268'] = '+1 268 (Antigua and Barbuda)';
        $countries['1-242'] = '+1 242 (Bahamas)';
        $countries['973'] = '+973 (Bahrain)';
        $countries['880'] = '+880 (Bangladesh)';
        $countries['1-246'] = '+1 246 (Barbados)';
        $countries['375'] = '+375 (Belarus)';
        $countries['32'] = '+32 (Belgium)';
        $countries['501'] = '+501 (Belize)';
        $countries['229'] = '+229 (Benin)';
        $countries['1-441'] = '+1 441 (Bermuda)';
        $countries['975'] = '+975 (Bhutan)';
        $countries['591'] = '+591 (Bolivia)';
        $countries['387'] = '+387 (Bosnia and Herzegovina)';
        $countries['267'] = '+267 (Botswana)';
        $countries['55'] = '+55  (Brazil)';
        $countries['246'] ='+246 (British Indian Ocean Territory)';
        $countries['284'] = '+1 284 ( British Virgin Islands)';
        $countries['673'] = '+673 (Brunei)';
        $countries['359'] = '+359 (Bulgaria)';
        $countries['226'] = '+226 (Burkina Faso)';
        $countries['257'] = '+257 (Burundi)';
        $countries['855'] = '+855 (Cambodia)';
        $countries['237'] = '+237 (Cameroon)';
        $countries['1'] = '+1  (Canada)';
        $countries['238'] = '+238 (Cape Verde)';
        $countries['345'] = '+345 (Cayman Islands)';
        $countries['236'] = '+236 (Central African Republic)';
        $countries['235'] = '+235 (Chad)';
        $countries['56'] = '+56 (Chile)';
        $countries['61'] = '+61 (Christmas Island)';
        $countries['61'] = '+61 (Cocos-Keeling Islands)';
        $countries['57'] = '+57 (Colombia)';
        $countries['269'] = '+269 (Comoros)';
        $countries['242'] = '+242 (Congo)';
        $countries['243'] = '+243 (Congo, Dem. Rep. of (Zaire))';
        $countries['682'] = '+682 (Cook Islands)';
        $countries['506'] = '+506 (Costa Rica)';
        $countries['225'] = '+225 (Ivory Coast)';
        $countries['385'] = '+385 (Croatia)';
        $countries['53'] = '+53 (Cuba)';
        $countries['599'] = '+599 (Curacao)';
        $countries['537'] = '+537 (Cyprus)';
        $countries['420'] = '+420 (Czech Republic)';
        $countries['45'] = '+45 (Denmark)';
        $countries['246'] = '+246 (Diego Garcia)';
        $countries['253'] = '+253 (Djibouti)';
        $countries['767'] = '+1 767 (Dominica)';
        $countries['1-809'] = '+1 809 (Dominican Republic)';
        $countries['1-829'] = '+1 829 (Dominican Republic)';
        $countries['1-849'] = '+1 849 (Dominican Republic)';
        $countries['670'] = '+670 (East Timor)';
        $countries['56'] = '+56 (Easter Island)';
        $countries['593'] = '+593 (Ecuador)';
        $countries['20'] = '+20 (Egypt)';
        $countries['503'] = '+503 (El Salvador)';
        $countries['240'] = '+240 (Equatorial Guinea)';
        $countries['291'] = '+291 (Eritrea)';
        $countries['372'] = '+372 (Estonia)';
        $countries['251'] = '+251 (Ethiopia)';
        $countries['500'] = '+500 (Falkland Islands)';
        $countries['298'] = '+298 (Faroe Islands)';
        $countries['679'] = '+679 (Fiji)';
        $countries['358'] = '+358 (Finland)';
        $countries['596'] = '+596 (French Antilles)';
        $countries['594'] = '+594 (French Guiana)';
        $countries['689'] = '+689 (French Polynesia)';
        $countries['241'] = '+241 (Gabon)';
        $countries['220'] = '+220 (Gambia)';
        $countries['995'] = '+995 (Georgia)';
        $countries['233'] = '+233 (Ghana)';
        $countries['350'] = '+350 (Gibraltar)';
        $countries['30'] = '+30 (Greece)';
        $countries['299'] = '+299 (Greenland)';
        $countries['1-473'] = '+1 473 (Grenada)';
        $countries['590'] = '+590 (Guadeloupe)';
        $countries['1-671'] = '+1 671 (Guam)';
        $countries['502'] = '+502 (Guatemala)';
        $countries['224'] = '+224 (Guinea)';
        $countries['245'] = '+245 (Guinea-Bissau)';
        $countries['595'] = '+595 (Guyana)';
        $countries['509'] = '+509 (Haiti)';
        $countries['504'] = '+504 (Honduras)';
        $countries['852'] = '+852 (Hong Kong SAR China)';
        $countries['36'] = '+36 (Hungary)';
        $countries['354'] = '+354 (Iceland)';
        $countries['91'] = '+91 (India)';
        $countries['62'] = '+62 (Indonesia)';
        $countries['98'] = '+98 (Iran)';
        $countries['964'] = '+964 (Iraq)'; 
        $countries['353'] = '+353 (Ireland)';
        $countries['972'] = '+972 (Israel)';
        $countries['39'] = '+39 (Italy)';
        $countries['1-876'] = '+1 876 (Jamaica)';
        $countries['81'] = '+81 (Japan)';
        $countries['962'] = '+962 (Jordan)';
        $countries['7-7'] = '+7 7 (Kazakhstan)';
        $countries['254'] = '+254 (Kenya)';
        $countries['686'] = '+686 (Kiribati)';
        $countries['850'] = '+850 (North Korea)';
        $countries['82'] = '+82 (South Korea)';
        $countries['965'] = '+965 (Kuwait)';
        $countries['996'] = '+996 (Kyrgyzstan)';
        $countries['856'] = '+856 (Laos)';
        $countries['371'] = '+371 (Latvia)';
        $countries['961'] = '+961 (Lebanon)';
        $countries['266'] = '+266 (Lesotho)';
        $countries['231'] = '+231 (Liberia)';
        $countries['218'] = '+218 (Libya)';
        $countries['423'] = '+423 (Liechtenstein)';
        $countries['370'] = '+370 (Lithuania)';
        $countries['352'] = '+352 (Luxembourg)';
        $countries['853'] = '+853 (Macau SAR China)';
        $countries['389'] = '+389 (Macedonia)';
        $countries['261'] = '+261 (Madagascar)';
        $countries['265'] = '+265 (Malawi)';
        $countries['60'] = '+60 (Malaysia)';
        $countries['960'] = '+960 (Maldives)';
        $countries['223'] = '+223 (Mali)';
        $countries['356'] = '+356 (Malta)';
        $countries['692'] = '+692 (Marshall Islands)';
        $countries['596'] = '+596 (Martinique)';
        $countries['222'] = '+222 (Mauritania)';
        $countries['230'] = '+230 (Mauritius)';
        $countries['262'] = '+262 (Mayotte)';
        $countries['52'] = '+52 (Mexico)';
        $countries['691'] = '+691 (Micronesia)';
        $countries['1-808'] = '+1 808 (Midway Island)';
        $countries['691'] = '+691 (Micronesia)';
        $countries['373'] = '+373 (Moldova)';
        $countries['377'] = '+377 (Monaco)';
        $countries['976'] = '+976 (Mongolia)';
        $countries['382'] = '+382 (Montenegro)';
        $countries['1664'] = '+1664 (Montserrat)';
        $countries['212'] = '+212 (Morocco)';
        $countries['95'] = '+95 (Myanmar)';
        $countries['674'] = '+674 (Nauru)';
        $countries['977'] = '+977 (Nepal)';
        $countries['31'] = '+31 (Netherlands)';
        $countries['599'] = '+599 (Netherlands Antilles)';
        $countries['1-869'] = '+1 869 (Nevis)';
        $countries['687'] = '+687 (New Caledonia )';
        $countries['64'] = '+64 (New Zealand)';
        $countries['505'] = '+505 (Nicaragua )';
        $countries['227'] = '+227 (Niger)';
        $countries['683'] = '+683 (Niue)';
        $countries['672'] = '+672  (Norfolk Island)';
        $countries['1-670'] = '+1 670 (Northern Mariana Islands)';
        $countries['47'] = '+47 (Norway)';
        $countries['968'] = '+968 (Oman)';
        $countries['680'] = '+680 (Palau)';
        $countries['970'] = '+970 (Palestinian Territory)';
        $countries['507'] = '+507 (Panama)';
        $countries['675'] = '+675 (Papua New Guinea)';
        $countries['595'] = '+595 (Paraguay)';
        $countries['51'] = '+51 (Peru)';
        $countries['63'] = '+63 (Philippines)';
        $countries['48'] = '+48 (Poland)';
        $countries['351'] = '+351 (Portugal)';
        $countries['1-787'] = '+1 787 (Puerto Rico)';
        $countries['1-939'] = '+1 939 (Puerto Rico)';
        $countries['974'] = '+974 (Qatar)';
        $countries['262'] = '+262 (Reunion)';
        $countries['40'] = '+40 (Romania)';
        $countries['7'] = '+7 (Russia)';
        $countries['250'] = '+250 (Rwanda)';
        $countries['685'] = '+685 (Samoa)';
        $countries['378'] = '+378 (San Marino)';
        $countries['966'] = '+966 (Saudi Arabia)';
        $countries['221'] = '+221 (Senegal)';
        $countries['381'] = '+381 (Serbia)';
        $countries['248'] = '+248 (Seychelles)';
        $countries['232'] = '+232 (Sierra Leone)';
        $countries['65'] = '+65 (Singapore)';
        $countries['421'] = '+421 (Slovakia)';
        $countries['386'] = '+386 (Slovenia)';
        $countries['677'] = '+677 (Solomon Islands)';
        $countries['27'] = '+27 (South Africa)';
        $countries['500'] = '+500 (South Georgia)';//$countries[500] = 'South Georgia and Sandwich Islands (+500)';
        $countries['34'] = '+34 (Spain)';
        $countries['94'] = '+94 (Sri Lanka)';
        $countries['249'] = '+249 (Sudan)';
        $countries['597'] = '+597 (Suriname)';
        $countries['268'] = '+268 (Swaziland)';
        $countries['46'] = '+46 (Sweden)';
        $countries['41'] = '+41 (Switzerland)';
        $countries['963'] = '+963 (Syria)';
        $countries['886'] = '+886 (Taiwan)';
        $countries['992'] = '+992 (Tajikistan)';
        $countries['255'] = '+255 (Tanzania)';
        $countries['66'] = '+66 (Thailand)';
        $countries['670'] = '+670 (Timor Leste)';
        $countries['228'] = '+228 (Togo)';
        $countries['690'] = '+690 (Tokelau)';
        $countries['676'] = '+676 (Tonga)';
        $countries['1-868'] = '+1 868 (Trinidad and Tobago)';
        $countries['216'] = '+216 (Tunisia)';
        $countries['90'] = '+90 (Turkey)';
        $countries['993'] = '+993 (Turkmenistan)';
        $countries['1-649'] = '+1 649 (Turks and Caicos Islands)';
        $countries['688'] = '+688 (Tuvalu)';
        $countries['256'] = '+256 (Uganda)';
        $countries['380'] = '+380 (Ukraine)';
        $countries['971'] = '+971 (United Arab Emirates)';
        $countries['1'] = '+1  (United States)';
        $countries['598'] = '+598 ( Uruguay)';
        $countries['1-340'] = '+1 340 (U.S. Virgin Islands)';
        $countries['998'] = '+998 (Uzbekistan)';
        $countries['678'] = '+678 (Vanuatu)';
        $countries['58'] = '+58 (Venezuela)';
        $countries['84'] = '+84 (Vietnam)';
        $countries['1-808'] = '+1 808 (Wake Island)';
        $countries['681'] = '+681 (Wallis and Futuna)';
        $countries['967'] = '+967 (Yemen)';
        $countries['260'] = '+260 (Zambia)';
        $countries['255'] = '+255 (Zanzibar)';
        $countries['263'] = '+263 (Zimbabwe)';

        return $countries;
    }

}

