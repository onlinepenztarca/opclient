<?php 

namespace Onlinepenztarca\Opkliens;
use GuzzleHttp\Client;

class OpClient {
	
	public $guzzleClient;

	private $clientId;
	private $clientSecret;

	public function __construct($clientId, $clientSecret, ClientInterface $clientInterface = null) {
		if ($clientSecret == null) {
			throw new \InvalidArgumentException("Nincs megadva API kulcs");
		}
		$this->guzzleClient = $clientInterface == null ? new Client(['defaults' => [ 'exceptions' => false ]]) : $clientInterface;
		$this->clientSecret = $clientSecret;
		$this->clientId = $clientId;
	}
	
	public function post($route, $data = []) {
		
		$url = $this->createUrl($route);

        $headers = $this->createHeaders();

        $res = $this->guzzleClient->post($url, [
            'headers' => $headers, 
            'json' => ["body"=> $data],
        ]);
        echo json_encode($data);
        return json_decode($res->getBody()->getContents());
	}
	
	public function get($route,$data = null) {
		
        $url = $this->createUrl($route);
        $headers = $this->createHeaders();
		
        $res = $this->guzzleClient->get($url, [
            'headers' => $headers, 
            'query'   =>$data
        ]);
		
        
        return json_decode($res->getBody()->getContents());
	}

    public function put($route, $data = []) {
		
        $url = $this->createUrl($route);
        $headers = $this->createHeaders();

        $res = $this->guzzleClient->put($url, [
            'headers' => $headers,
            'json' => ["body"=> $data],
        ]);
         echo json_encode($data);
         echo $res->getBody()->getContents();

	}
	
	public function getBody($route,$data = null) {

		$url = $this->createUrl($route);
		$headers = $this->createHeaders();
		$res = $this->guzzleClient->get($url, [
		    'headers' => $headers,
		    'query'   =>$data
		]);
		return $res->getBody();
    	}
	
	public function createUrl($route) {
		return sprintf("%s%s", Routes::SERVER_URL, $route);
	}


	public function createHeaders()
	{
		return ['opapisecret' => $this->clientSecret, "opapikey" => $this->clientId, 'Accept' => 'application/json'];
	}

}
