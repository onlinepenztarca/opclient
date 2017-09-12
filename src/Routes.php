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
		"transaction.redeem"        =>"/trans/redeem",
		"order.flush"               =>"/order/flush",
        "order.calc"                =>"/order/calc",
		"order.storno"              =>"/order/status/storno",
		"order.update"              =>"/order/status/update",
		"order.elements"            =>"/order/elements",
		"order.isredeemed"          =>"/order/isredeemed",
	];

	const SERVER_URL = "http://45.32.154.255/api/v1";
	
	public static function getRoute($routeShortCut) {
		
		return self::$routes[$routeShortCut];
	}
	
	public function __construct() {}
}