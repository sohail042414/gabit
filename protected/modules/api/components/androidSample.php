<?php

sendAndroidNotification("APA91bElJ3gFQTJpBnxs0EgJsPzDck6BKJhQn6yGyXisTxt7kvKrF62pCOXzU9UncOMqZQ00XntsGMdO72XFBcSG04IMQHdtBARW4LOthNxBJvIke8V7goz2T4gil5HzO7VmNJo_qfZ8", "testing Message");

function sendAndroidNotification($deviceId, $message)
{
    $deviceIds = array();
    $deviceIds[] = $deviceId;
    $google_api_key = "AIzaSyCoGc5NLkrn7wPDWvzyAMBQ1G7HyNKfmGY";
    $headers = array("Content-Type:" . "application/json", "Authorization:" . "key=" . $google_api_key);
    $data = array(
        'data' => array('message' => $message, 'view_count' => 10, "comment_count" => 12, "like_count" => 5),
        'registration_ids' => $deviceIds,
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
//
//    echo '<pre>';
//    print_r($responseArr);
//    die;

    if ($responseArr->success == 1) {
        echo "Success";
        curl_close($ch);
        return true;
    } else if ($responseArr->failure == 1) {
        echo "error";
        curl_close($ch);
        return false;
    }
}

?>