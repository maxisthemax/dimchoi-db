<?php

#API access key from Google API's Console
    define( 'API_ACCESS_KEY', 'AIzaSyAollvd1GougMI5zKme3ntbOZvKYosOJr4' );
    $token = !empty($_POST['token']) ? $_POST['token'] : '';
    $title = !empty($_POST['title']) ? $_POST['title'] : '';
    $body = !empty($_POST['body']) ? $_POST['body'] : '';
    $broadcast = !empty($_POST['broadcast']) ? $_POST['broadcast'] : '';
    $mode = $_POST['mode'];
#prep the bundle
if ($mode == 1)
{    
        $msg = array
        (
            'body'  => $body,
            'title' => $title,
            'icon'  => 'myicon',/*Default Icon*/
            'sound' => 'mySound'/*Default sound*/
        );

        $fields = array
        (
            'to'        => $token,
            'notification'  => $msg
        );            
}
else if ($mode == 2)
{       

        $data = array
        (
            'broadcast'  => $broadcast,
            'icon'  => 'myicon',/*Default Icon*/
            'sound' => 'mySound'/*Default sound*/
        );

        $fields = array
        (
            'to'    => $token,
            'data'  => $data
        );          
}
    
        $headers = array
        (
            'Authorization: key=' . API_ACCESS_KEY,
            'Content-Type: application/json'
        );


#Send Reponse To FireBase Server    
        $ch = curl_init();
        curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
        curl_setopt( $ch,CURLOPT_POST, true );
        curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
        curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
        curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
        curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fields ) );
        $result = curl_exec($ch );
        curl_close( $ch );
#Echo Result Of FireBase Server
echo $result;
?>