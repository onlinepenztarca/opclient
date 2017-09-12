<?php 

namespace Onlinepenztarca\Opkliens;
use Onlinepenztarca\Opkliens\Routes;
use Onlinepenztarca\Opkliens\OpClient;
use Onlinepenztarca\Opkliens\Validation;
class OpActions {

  private $opClient;
  
  public function __construct(OpClient $opClient) {
	  $this->opClient = $opClient;
	  $this->validation = new Validation();
  }

    public function testCom()
    {
        return $this->opClient->get(Routes::getRoute("test.com"));
    }

	/*
	 * https://www.onlinepenztarca.hu/dev/support#action1
	 * */
	public function getBalanceByUserEmail($userEmail) {
		$this->validation->validateEmail($userEmail);
		$data = [
			"userEmail" => $userEmail
		];
		return $this->opClient->get(Routes::getRoute("user.balance"), $data);
	}

	/*
 	* https://www.onlinepenztarca.hu/dev/support#action2
 	* */
	
	public function useOpCoinsForOrder($userEmail, $valueOfOpCoins, $order) {
		$this->validation->validateEmail($userEmail);
		$this->validation->validate([$valueOfOpCoins]);
		$this->validation->validateArray($order, ["id","amount"]);
		$data = [
			"userEmail"			=> $userEmail,
			"valueOfOpCoins"	=> $valueOfOpCoins,
			"order"				=> $order
		];
       return $this->opClient->post(Routes::getRoute("transaction.redeem"), $data);
	}

	/*
	 * https://www.onlinepenztarca.hu/dev/support#action4
	 * */
	public function cartAutomatic($user, $order, $cart, $valueOfOpCoins = null) {
		$this->validation->validateUser($user);
		$this->validation->validateArray($order, ['id', 'amount', 'time']);
		$this->validation->validateCart($cart);
		$data = [
			"user"				=> $user,
			"order"				=> $order,
			"cart"				=> $cart,
			"valueOfOpCoins"	=> $valueOfOpCoins,
		];
        return $this->opClient->post(Routes::getRoute("transaction.create"), $data);
	}
	/*
 	* https://www.onlinepenztarca.hu/dev/support#action5
 	* */
	public function addCustomerServiceCampaignToUserByEmail($user, $valueOfOpCoins, $colleagueEmail) {
		$this->validation->validateUser($user);
		$this->validation->validateEmail($colleagueEmail);
		$this->validation->validate([$valueOfOpCoins]);
		$data = [
			"user" 				=> $user,
			"valueOfOpCoins" 	=> $valueOfOpCoins,
			"colleagueEmail" 	=> $colleagueEmail
		];
        return $this->opClient->post(Routes::getRoute("user.addcoins"), $data);
	}

	/*
 	* https://www.onlinepenztarca.hu/dev/support#action7
 	* */
	public function getUserHistory($userEmail) {
		$this->validation->validate([$userEmail]);
		$data = [
			"userEmail" => $userEmail
		];
        return $this->opClient->get(Routes::getRoute("user.history"), $data);
	}

	/*
	 * https://www.onlinepenztarca.hu/dev/support#action8
	 * */
	public function orderStatusUpdate($orderId, $status, $colleagueEmail) {
		$this->validation->validate([$orderId, $status]);
		$this->validation->validateEmail($colleagueEmail);
		$data = [
			"orderId" 			=> $orderId,
			"colleagueEmail" 	=> $colleagueEmail,
			"status" 			=> $status
		];
        return $this->opClient->put(Routes::getRoute("order.update"), $data);
	}

	/*
	 * https://www.onlinepenztarca.hu/dev/support#action9
	 * */
	public function orderStorno($orderId, $colleagueEmail) {
		$this->validation->validate([$orderId]);
		$this->validation->validateEmail($colleagueEmail);
		$data = [
			"orderId" 			=> $orderId,
			"colleagueEmail" 	=> $colleagueEmail
		];
        return $this->opClient->put(Routes::getRoute("order.storno"), $data);
	}
	
	/*
	 * https://www.onlinepenztarca.hu/dev/support#action10
	 * */
	public function orderElements($orderId) {
		$this->validation->validate([$orderId]);
		$data = [
			"orderId" => $orderId
		 ];
        return $this->opClient->get(Routes::getRoute("order.elements"), $data);
	}

	/*
	 * https://www.onlinepenztarca.hu/dev/support#action11
	 * */
	public function calculateFunction($userEmail, $valueOfOpCoins, $orderAmount) {
		$this->validation->validate([$valueOfOpCoins, $orderAmount]);
		$this->validation->validateEmail($userEmail);
		$data = [
			"userEmail" 		=> $userEmail,
			"valueOfOpCoins" 	=> $valueOfOpCoins,
			"orderAmount" 		=> $orderAmount
		];
        return $this->opClient->get(Routes::getRoute("order.calc"), $data);
	}

	/*
	 * https://www.onlinepenztarca.hu/dev/support#action12
	 * */
	public function isOpCoinUsedForOrder($orderId) {
		$this->validation->validate([$orderId]);
		$data = [
			"orderId" => $orderId
		];
        return $this->opClient->get(Routes::getRoute("order.isredeemed"), $data);
	}

	/*
	 * https://www.onlinepenztarca.hu/dev/support#action13
	 * */
	public function cleanOrder($orderId, $colleagueEmail) {
		$this->validation->validate([$orderId]);
		$this->validation->validateEmail($colleagueEmail);
		$data = [
			"orderId" 	        => $orderId,
			"colleagueEmail"    => $colleagueEmail
		];
		
        return $this->opClient->put(Routes::getRoute("order.flush"), $data);
	}

	/*
	 * https://www.onlinepenztarca.hu/dev/support#action15
	 * */
	public function createContact($user) {
		$this->validation->validateUser($user);
		$data = [
			"user" => $user
		];
        return $this->opClient->post(Routes::getRoute("user.create"), $data);
	}
	
	public function getButton($userEmail) {
		$this->validation->validate([$userEmail]);
		$data = [
			"userEmail" => $userEmail
		];
        return $this->opClient->get(Routes::getRoute("user.button"), $data);
	}
	
	public function uploadData($data) {

		return $this->opClient->post(Routes::getRoute("data.upload"), $data);
	}
}