<?php 

namespace Onlinepenztarca\Opkliens;

class Validation {

	public function __construct() {}

	public function validateArray(array $data, array $requiredIndexes) {
		foreach($requiredIndexes as $index) {
			if(!isset($data[$index]) || empty($data[$index])) {
				throw new \InvalidArgumentException("$index kötelező paraméter!");
			}
		}
	}

	public function validate(array $requiredData) {
		foreach($requiredData as $data) {
			if(!isset($data) || empty($data)) {
				throw new \InvalidArgumentException("Hiányzó paraméter!");
			}
		}
	}
	
	public function validateEmail($email) {
		if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		  throw new \InvalidArgumentException("Helytelen email cím!");
		}
	}
	
	public function validateUser(array $user) {
		$this->validateEmail($user["email"]);
		$this->validateArray($user, ['email', 'data']);
		if(!isset($user['data']['firstName']) || empty($user['data']['firstName']) ) {
			throw new \InvalidArgumentException("firstName kötelező paraméter!");
		}
	}
	
	public function validateCart(array $cart) {
		foreach($cart as $item) {
			$this->validateArray($item, ['categoryId', 'brandId', 'price']);
		}
	}
	
	
	
	
}