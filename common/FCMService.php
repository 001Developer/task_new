<?php 
/**
 * Created by SHELL on 11/12/2018.
 * Developer name ujah chigozie 
 */
 namespace UjahPeter{
	 class Firebase {
		 
		 private $FirebaseApikey;
		 private $FirebaseURL =  'https://fcm.googleapis.com/fcm/send';
		 
		 public function __construct($FirebaseApikey) {
			$this->FirebaseApikey = $FirebaseApikey;
		}

		 /*public function send($sendPushArray, $type = "single") {
			$sendPushArray =  (($type == "multiple") ?  (array) $sendPushArray : $sendPushArray);
			return $this->sendPushNotification($sendPushArray);
		}*/
		public function send($sendPushArray, $type = "single", $putTo=null) {
			if($type == "multiple" &&  empty($putTo)){
				$sendPushArray =  (array) $sendPushArray;
			}else if(!empty($putTo)){
				$sendPushArray = array_merge(array("to" => $putTo), $sendPushArray);
			}else{
				$sendPushArray =  $sendPushArray;
			}
			return $this->sendPushNotification($sendPushArray);
		}
		 
		private function sendPushNotification($sendFields) {
			$headers = array(
				'Authorization: key=' . $this->FirebaseApikey,
				'Content-Type: application/json'
			); 

			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, $this->FirebaseURL);
			curl_setopt($ch, CURLOPT_POST, true);
			curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
			curl_setopt ($ch, CURLOPT_SSL_VERIFYHOST, 0);   
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
			curl_setopt($ch, CURLOPT_POSTFIELDS,  json_encode($sendFields));
			$result = curl_exec($ch);               
			if ($result === false) {
				return 'Curl failed: ' . curl_error($ch);
			}
			curl_close($ch);
			return $result;
		}
	 
	 }
 }
