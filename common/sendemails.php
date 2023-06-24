<?php
class sendemails{
    var $to         = "";
    var $subject    = "";
    var $message    = "";
    var $fromName   = "";
    var $fromEmail  = "";
    var $replyEmail = "";
    var $header     = "";
    var $type       = "text/html";
    var $characterSet = "iso-8859-1";
    
    function send(){
		$this->header = $this->createHeader();
        if (@mail($this->to,$this->subject,$this->message,$this->header)){
            return true;
        } else {
            return false;
        }
    }
    
    function createHeader(){
		$from   = "From: " . $this->fromName . " <".$this->fromEmail .">\r\n";
        $reply 	= "Reply-To: " . $this->replyEmail . "\r\n";    
        $params = "MIME-Version: 1.0\r\n";
        $params .= "Content-type: $this->type; charset=$this->characterSet\r\n";
        
        $this->header = $from.$reply.$params;
        return $this->header;
    }
}
?>