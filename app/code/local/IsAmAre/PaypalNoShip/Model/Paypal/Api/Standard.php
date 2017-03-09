<?php
class IsAmAre_PaypalNoShip_Model_Paypal_Api_Standard extends Mage_Paypal_Model_Api_Standard
{
    protected function _importAddress(&$request) {
        $request['no_shipping'] = 1;
        return;
    }
}
		