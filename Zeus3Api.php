<?php


namespace ZEUS3api;

class ZEUS3api {
	
	private $host;
	private $username;
	private $password;
	private $ip_address;
	
	private $Token;
	private $TokenArray;
	
	
	const API_LOGIN  = "/cgi-bin/api/v3/system/login";
	
	const API_INTERNET_STATUS = "/cgi-bin/api/v3/system/status/internet";
	const API_DEVICE_STATUS = "/cgi-bin/api/v3/system/device/status";
	const API_DEVICE_INFO = "/cgi-bin/api/v3/system/device/info";
	
	const API_SYSTEM_STATUS = "/cgi-bin/api/v3/system/status";
	
	const API_INTERFACE_WAN_STATUS = "/cgi-bin/api/v3/interface/wan/status";
	
	
	
	const API_INTERFACE_LAN1 = "/cgi-bin/api/v3/interface/lan/1";
	
	
	const API_INTERFACE_WIRELESS = "/cgi-bin/api/v3/interface/wireless";
	
	const API_INTERFACE_WIRELESS_0_CLIENTS = "/cgi-bin/api/v3/interface/wireless/wifi0/clients/wireless";
	
	const API_SERVICE_STATISTICS = "/cgi-bin/api/v3/service/statistics";
	
	const API_SERVICE_FIREWALL = "/cgi-bin/api/v3/service/firewall";
	
	
	
	const ZEUS_ERROR = false;
	const ZEUS_OK = true;
	
	
	private function getdata($url,$args=false) 
	{ 
		$ch = curl_init(); 
	
		curl_setopt($ch, CURLOPT_URL,$url); 
 
		if($args) 
		{ 
			curl_setopt($ch, CURLOPT_POST, 1); 
			curl_setopt($ch, CURLOPT_POSTFIELDS,$args); 
		} 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type:application/json'));
 
		$result = curl_exec ($ch); 
		curl_close ($ch); 
	
		return $result; 
	} 

	private function getdataAuth($url,$ZEUS_Token,$args=false) 
	{ 
		$ch = curl_init(); 
	
		curl_setopt($ch, CURLOPT_URL,$url); 
 
		if($args) 
		{ 
			curl_setopt($ch, CURLOPT_POST, 1); 
			curl_setopt($ch, CURLOPT_POSTFIELDS,$args); 
		} 
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true); 
	
		curl_setopt($ch, CURLOPT_HTTPHEADER, array("Content-Type:application/json","Authorization: Token ".$ZEUS_Token));
 
		$result = curl_exec ($ch); 
		curl_close ($ch); 
	
		return $result; 
	}
	
private function ZEUS_Get_Token_Array($Router_IP, $Username, $Password)
{
	// API URL
	$url = 'http://'.$Router_IP.'/cgi-bin/api/v3/system/login';

	$data = array(
		'username' => $Username,
		'password' => $Password
	);

	$payload = json_encode(array("data" => $data));

 	$result = $this->getdata($url,$payload);

	$data = json_decode($result,true);

	return $data;  
} 


	public function Get_Token_Array($Router_IP, $Username, $Password)
	{
		// API URL
		$url = 'http://'.$Router_IP.'/cgi-bin/api/v3/system/login';

		$data = array(
			'username' => $Username,
			'password' => $Password
		);

		$payload = json_encode(array("data" => $data));

		$result = $this->getdata($url,$payload);

		$data = json_decode($result,true);

		return $data;  
	} 


private function ZEUS_Get_Token_String($Router_IP, $Username, $Password)
{
	$ret = $this->ZEUS_Get_Token_Array($Router_IP,$Username,$Password);
	$mtoken = @$ret['data']['Token'];
	return $mtoken;
}


	public function __construct($host = '10.0.0.1', $username = 'admin', $password = 'admin') {
		
		$this->host = $host;
		$this->username = $username;
		$this->password = $password;

/*
		$this->setConnectTimeout($connect_timeout);
		$this->setSocketTimeout($socket_timeout);
		$this->setFullLineTimeout($full_line_timeout);
		$this->setPrompt($prompt);

	
		$this->has_go_ahead = false;
		$this->cntrlcharparser = new AnsiAsciiControlParser();
		$this->pruneCtrlSeq = false;
		*/
		
	}
	
	public function __destruct() {
		// clean up resources
		//$this->disconnect();
	}
	
	public function connect() {
		
		$this->Token = $this->ZEUS_Get_Token_String($this->host,$this->username,$this->password);
		
		if (trim($this->Token) == "") {
			return self::ZEUS_ERROR;
		} else {
			return self::ZEUS_OK;
		}
		
	}
	
	public function GetToken() {		
		return $this->Token;		
	}
	
	public function getHost() {
		return $this->host;
	}

	public function getUsername() {
		return $this->username;
	}
	
	public function getPassword() {
		return $this->password;
	}

	public function getInternetStatus() {	
		$murl = "http://".$this->host.self::API_INTERNET_STATUS;
		return $this->getdataAuth($murl,$this->Token);	
	}
	
	
	public function getDeviceStatus() {	
		$murl = "http://".$this->host.self::API_DEVICE_STATUS;
		return $this->getdataAuth($murl,$this->Token);	
	}
	
	public function getDeviceInfo() {	
		$murl = "http://".$this->host.self::API_DEVICE_INFO;
		return $this->getdataAuth($murl,$this->Token);	
	}
	
	public function getInterfaceWireless() {	
		$murl = "http://".$this->host.self::API_INTERFACE_WIRELESS;
		return $this->getdataAuth($murl,$this->Token);	
	}
	
	public function getSystemStatus() {	
		$murl = "http://".$this->host.self::API_SYSTEM_STATUS;
		return $this->getdataAuth($murl,$this->Token);	
	}
	
	public function getInterfaceWireless_0_Clients() {	
		$murl = "http://".$this->host.self::API_INTERFACE_WIRELESS_0_CLIENTS;
		return $this->getdataAuth($murl,$this->Token);	
	}

	public function getServiceStatistics() {	
		$murl = "http://".$this->host.self::API_SERVICE_STATISTICS;
		return $this->getdataAuth($murl,$this->Token);	
	}
	
	public function getServiceFirewall() {	
		$murl = "http://".$this->host.self::API_SERVICE_FIREWALL;
		return $this->getdataAuth($murl,$this->Token);	
	}

	public function getInterfaceLan1() {	
		$murl = "http://".$this->host.self::API_INTERFACE_LAN1;
		return $this->getdataAuth($murl,$this->Token);	
	}	
			
	public function getInterfaceWanStatus() {	
		$murl = "http://".$this->host.self::API_INTERFACE_WAN_STATUS;
		return $this->getdataAuth($murl,$this->Token);	
	}	
			
	
}

?>