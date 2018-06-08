
# opclient
Az opclient egy api csomag az onlinePénztárcához.

<b>Pár dolog amit érdemes behívni hogy ne legyen gond.</b>

require_once('../vendor/autoload.php');/*Ez természetesn elhagyható*/

use Onlinepenztarca\Opkliens\OpClient;

use Onlinepenztarca\Opkliens\OpActions;


Példakód:

        $cartItemsToOp[] = array(
            "price"         =>140000,
            "productId"     =>54321
        );

        $userDatasToOp = array(
            'email' => "teszt@teszt.com",
            'data' => array(
                'firstName' => "Tesztelő",
            )
        );
        $orderDatasToOp = array(
            'id' => 12345,
            'amount' => 145000,
            "time" => date("Y-m-d H:i:s")
        );
       
		if (isset($_POST["onlinepenztarca_check"]) && !empty($_POST["onlinepenztarca_check"]) && $_POST["onlinepenztarca_check"] == "on") {
            $valueOfOpCoin = 145000;
        } else {
            $valueOfOpCoin = null;
        }
		
       	$opClient =  new OpClient('APY_KEY',"APY_SECRET");
        $opActions = new OpActions($opClient);
        $returnObject = $opActions->cartAutomaticLite($userDatasToOp, $orderDatasToOp, $cartItemsToOp, $valueOfOpCoin);
        if (isset($returnObject->success) && $returnObject->success == true && isset($returnObject->applied) && $returnObject->applied < 0) {
		/*Azért <0  mert minuszba van visszaadva az érték*/
        /*további kód ha volt onlinePénztárca összeg felhasználás*/
        }
  




