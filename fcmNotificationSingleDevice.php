
<?php
// API access key from Google FCM App Console
define( 'API_ACCESS_KEY', 'AIza....EDNs' );

// generated via the cordova phonegap-plugin-push using "senderID" (found in FCM App Console)
// this was generated from my phone and outputted via a console.log() in the function that calls the plugin
// my phone, using my FCM senderID, to generate the following registrationId 
$singleID = 'drUeYxw2GY8:APA91b...CeWPuzgk1XlcrlPd_xbUy' ; 
$registrationIDs = array(
     'drUeYxw2GY8:APA91bFgpLKRZ9..........mOHB9BSJeWPuzgk1XlcrlPd_xbUy', 
     'drUeYxw2GY8:APA91bFgpL_QTHC.................uzgk1XlcrlPd_xbUy'
     
) ;

// prep the bundle
// to see all the options for FCM to/notification payload: 
// https://firebase.google.com/docs/cloud-messaging/http-server-ref#notification-payload-support 

// 'vibrate' available in GCM, but not in FCM
$fcmMsg = array(
	'body' => 'here is a message. message',
	'title' => 'This is title #1',
	'sound' => "default",
        'color' => "#203E78" 
);
// I haven't figured 'color' out yet.  
// On one phone 'color' was the background color behind the actual app icon.  (ie Samsung Galaxy S5)
// On another phone, it was the color of the app icon. (ie: LG K20 Plush)

// 'to' => $singleID ;  // expecting a single ID
// 'registration_ids' => $registrationIDs ;  // expects an array of ids
// 'priority' => 'high' ; // options are normal and high, if not set, defaults to high.
$fcmFields = array(
	'to' => $singleID,
        'priority' => 'high',
	'notification' => $fcmMsg
);

$headers = array(
	'Authorization: key=' . API_ACCESS_KEY,
	'Content-Type: application/json'
);
 
$ch = curl_init();
curl_setopt( $ch,CURLOPT_URL, 'https://fcm.googleapis.com/fcm/send' );
curl_setopt( $ch,CURLOPT_POST, true );
curl_setopt( $ch,CURLOPT_HTTPHEADER, $headers );
curl_setopt( $ch,CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch,CURLOPT_SSL_VERIFYPEER, false );
curl_setopt( $ch,CURLOPT_POSTFIELDS, json_encode( $fcmFields ) );
$result = curl_exec($ch );
curl_close( $ch );
echo $result . "\n\n";
?>