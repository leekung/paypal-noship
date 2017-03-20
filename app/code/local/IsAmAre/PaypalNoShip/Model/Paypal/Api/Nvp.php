<?php
class IsAmAre_PaypalNoShip_Model_Paypal_Api_Nvp extends Mage_Paypal_Model_Api_Nvp
{
    /**
     * Do the API call
     * add NOSHIPPING=1
     * Do not send address to Paypal
     *
     * @param string $methodName
     * @param array $request
     * @return array
     */
    public function call($methodName, array $request)
    {
        $request['NOSHIPPING'] = 1;
        $addressKeys = [
            'SHIPTOCOUNTRYCODE',
            'SHIPTOSTATE',
            'SHIPTOCITY',
            'SHIPTOSTREET',
            'SHIPTOZIP',
            'SHIPTOPHONENUM',
            'SHIPTOSTREET2',
            'SHIPTONAME',
            'ADDROVERRIDE',
        ];
        foreach ($addressKeys as $key) {
            if (isset($request[$key])) {
                unset($request[$key]);
            }
        }

        return parent::call($methodName, $request);
    }
}
		