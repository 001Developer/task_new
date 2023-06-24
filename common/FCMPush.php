<?php 
/**
 * Created by SHELL on 11/12/2018.
 * Developer name ujah chigozie 
 */
 class Push {
	private $objectnode = "data";
	private $to;
	private $title;
	private $message;
	private $body;
	private $image;
	private $data;
	private $is_topic = false;
	private $vibrate = 1;
	private $sound = "default";
	private $icon = "icon.png"; 
	private $priority = "high";
	private $is_background;

	function __construct() {

	}

	public function setTo($to) {
		$this->to = $to;
	}
	
	public function setNode($objectnode) {
		$this->objectnode = $objectnode;
	}
	
	public function setTitle($title) {
		$this->title = $title;
	}

	public function setMessage($message) {
		$this->message = $message;
	}
	
	public function setBody($body) {
		$this->body = $body;
	}

	public function setImage($imageUrl) {
		$this->image = $imageUrl;
	}

	public function setPayload($data) {
		$this->data = $data;
	}
	
	public function setVibrate($vibrate) {
		$this->vibrate = $vibrate;
	}
	
	public function setSound($sound) {
		$this->sound = $sound;
	}
	
	public function setIcon($icon) {
		$this->icon = $icon;
	}
	public function setPriority($priority) {
		$this->priority = $priority;
	}

	public function setIsBackground($is_background) {
		$this->is_background = $is_background;
	}
	
	public function setIsTopic($is_topic) {
		$this->is_topic = $is_topic;
	}

	public function get() {
		$request = array();  
		if(!empty($this->to)){
			if(is_array($this->to) && $this->is_topic == false){
				$request['registration_ids'] = (array) $this->to;
				if($this->objectnode != "data"){
					$request['data']['title'] = $this->title;
					$request['data']['body'] = (!empty($this->body) ? $this->body : $this->message);
					$request['data']['image-url'] = $this->image; 
				}
			}else{
				$request['to'] = $this->to ;
			}
		}
		$request['priority'] =  $this->priority;
		$request[$this->objectnode]['title'] = $this->title;
		$request[$this->objectnode]['is_background'] = $this->is_background;
		$request[$this->objectnode]['message'] = $this->message;
		$request[$this->objectnode]['body'] = (!empty($this->body) ? $this->body : $this->message);
		$request[$this->objectnode]['icon'] = $this->icon;
		$request[$this->objectnode]['image-url'] = $this->image; 
		$request[$this->objectnode]['sound'] = $this->sound;
		$request[$this->objectnode]['vibrate'] = $this->vibrate; 
		$request[$this->objectnode]['timestamp'] = date('Y-m-d G:i:s');
		return $request;
	}
}
