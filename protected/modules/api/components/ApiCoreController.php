<?php

/**
 * Controller is the customized base controller class.
 * All controller classes for this application should extend from this base class.
 */
class ApiCoreController extends GxController {

    public $layout = 'main';

    public function __construct($id, $module = null) {
        parent::__construct($id, $module);
    }

    public function send_email($to, $subject, $message) {
        Yii::import('application.extensions.phpmailer.JPhpMailer');
        $mail = new JPhpMailer;
        $mail->IsSMTP();
        $mail->Host = '208.91.198.238';
        $mail->SMTPAuth = true;
        $mail->Port = 587;
        $mail->Username = 'developer@siliconithub.com';
        $mail->Password = 'dev$$321';
        $mail->SetFrom('info@siliconithub.com', 'HyperSquere');
        $mail->Subject = $subject;
        $mail->MsgHTML($message);
        $mail->AddAddress($to);
        if ($mail->Send()) {
            return true;
        } else {
            echo 'error';
            die;

            return false;
        }
    }

    public function get_excel_sheet_format() {
        return array(
            '0' => 'Booking Date',
            '1' => 'Order Id',
            '2' => 'Awb No.',
            '3' => 'Name',
            '4' => 'Address1',
            '5' => 'Address2',
            '6' => 'City',
            '7' => 'Pin',
            '8' => 'State',
            '9' => 'Country',
            '10' => 'Tel',
            '11' => 'Landline',
            '12' => 'Weight',
            '13' => 'Value',
            '14' => 'Courier Name',
            '15' => 'Product Category',
            '16' => 'Item Count',
            '17' => 'Payment',
            '18' => 'Pod Required',
        );
    }

    function unixstamp($excelDateTime) {
        $d = floor($excelDateTime); // seconds since 1900
        $t = $excelDateTime - $d;
        return ($d > 0) ? ($d - 25569) * 86400 + $t * 86400 : $t * 86400;
    }

    public function objectToArray(&$object) {
        $array = array();
        if (!empty($object)) {
            foreach ($object as $member => $data) {
                $array[$member] = $data;
            }
        }
        return $array;
    }

    function sendNotification($deviceToken, $message) {
        $passphrase = 'pushchat';
        $ctx = stream_context_create();
        stream_context_set_option($ctx, 'ssl', 'local_cert', 'apns-dev.pem');
        stream_context_set_option($ctx, 'ssl', 'passphrase', $passphrase);
        // $fp = stream_socket_client('ssl://gateway.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);
        //developer testing url
        $fp = stream_socket_client('ssl://gateway.sandbox.push.apple.com:2195', $err, $errstr, 60, STREAM_CLIENT_CONNECT | STREAM_CLIENT_PERSISTENT, $ctx);

        if (!$fp) {
            exit("Failed to connect: $err $errstr" . PHP_EOL);
        }

        $body['aps'] = array(
            'alert' => $message,
            'sound' => 'default',
            'badge' => 0
        );

        $payload = json_encode($body);
        $msg = chr(0) . pack('n', 32) . pack('H*', $deviceToken) . pack('n', strlen($payload)) . $payload;

        // Send it to the server
        $result = fwrite($fp, $msg, strlen($msg));
        if (!$result) {
            fclose($fp);
            return false;
        } else {
            fclose($fp);
            return true;
        }
    }

    function sendAndroidNotification($deviceId, $message) {
        $deviceIds = array();
        $deviceIds[] = $deviceId;

        $google_api_key = "AIzaSyBO7XraiyUok4vBvmqdu9qTb3Y_bH5_2go";
        $headers = array("Content-Type:" . "application/json", "Authorization:" . "key=" . $google_api_key);

        $data = array(
            'data' => array('message' => $message),
            'registration_ids' => $deviceIds
        );

        $ch = curl_init();
        curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
        curl_setopt($ch, CURLOPT_URL, "https://android.googleapis.com/gcm/send");
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        $response = curl_exec($ch);
        $responseArr = json_decode($response);
        curl_close($ch);

        if (!empty($responseArr)) {
            return true;
        } else {
            return false;
        }
    }

}
