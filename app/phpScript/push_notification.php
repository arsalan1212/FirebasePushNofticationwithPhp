<?php
	require_once 'connection.php';


	function send_notification($token,$message){
		
		$url='https://fcm.googleapis.com/fcm/send';
	    $server_key='AAAAm8RXyRs:APA91bHLg ....... gyRrj0';  // put your own server key

		$header=array('Authorization:key='.$server_key,'Content-Type:application/json');

		$field=array('registration_ids'=>$token,'data'=>$message);
        $payload=json_encode($field);
	   
	   $ch = curl_init();
       curl_setopt($ch, CURLOPT_URL, $url);
       curl_setopt($ch, CURLOPT_POST, true);
       curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
       curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
       curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);  
       curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
       curl_setopt($ch, CURLOPT_POSTFIELDS, $payload);
       $result = curl_exec($ch);           
       
       if ($result === FALSE) {
           die('Curl failed: ' . curl_error($ch));
       }
       curl_close($ch);
       return $result;
	}

	$query="SELECT token FROM  token";
	$query_result=mysqli_query($connection,$query);
	$tokens=array();

	if(mysqli_num_rows($query_result)>0){

		while($row=mysqli_fetch_assoc($query_result)){
			$tokens[]=$row['token'];
		}
	}

	$message=array("title"=>"First Notifiaction","message"=>"This is simple Notification from App Server");
	$message_status=send_notification($tokens,$message);

	echo $message_status;

	mysqli_close($connection);
?>
