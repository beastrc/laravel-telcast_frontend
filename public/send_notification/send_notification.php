<?php
    // session_start();
    include_once './GCM.php';

    
    
    $deviceToken = $_REQUEST['token'];
    $message = $_REQUEST['body'];
    $title = $_REQUEST['title'];

    // $deviceToken = "edERDKLklEgnlgiVV1rGOJ:APA91bHWfYECjL99CKCDTaz5sU7m4BWDLN4UAy1-Q02XKbxG4wdjScXgAJufuHPR-JnNpEneCfSEsHSSuZd8WeACZWWl8Rb7PlMXNMIByP0wU-zzGNhKPPtWiLi_Mt-A4HoOARKjiCul";
    // $message = "CheckedIn";
    // $title = "CheckedIn";

    $gcm = new GCM();

    $notificationMessage=array("body"=>$message,"title"=>$title,"sound"=>"mySound","tag"=>"all_customers");

    // $gcm->send_notification($deviceToken, $notificationMessage);

    $tokenList = explode(",", $deviceToken);
    foreach ($tokenList as $token) {
        $gcm->send_notification($token, $notificationMessage);

        // echo "------\n";
        echo $notificationMessage;
    }  

    
    /* End send notification */

    // echo "Test Notification";
?>