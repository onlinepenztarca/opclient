<?php 

namespace Onlinepenztarca\Opkliens;

class Routes {


	private static $routes = [
		"test.com"                  =>"/partner/testcom",
		"user.balance"              =>"/user/balance",
		"user.addcoins"             =>"/user/addcoins",
		"user.create"               =>"/user/create",
		"user.history"              =>"/user/history",
        "user.button"               =>"/user/button",
		"transaction.create"		=>"/trans/create",
		"transaction.create.lite"	=>"/trans/create/lite",
		"transaction.redeem"        =>"/trans/redeem",
		"order.flush"               =>"/order/flush",
        "order.calc"                =>"/order/calc",
		"order.storno"              =>"/order/status/storno",
		"order.update"              =>"/order/status/update",
		"order.elements"            =>"/order/elements",
		"order.isredeemed"          =>"/order/isredeemed",
		"order.payblock"          	=>"/order/payblock",
	];

	const SERVER_URL = "https://www.onlinepenztarca.hu/api/v1";
	
	public static function getRoute($routeShortCut) {
		
		return self::$routes[$routeShortCut];
	}
	
	public function __construct() {}
}