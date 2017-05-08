<?php
class IsAmAre_PaypalNoShip_Model_Paypal_Api_Nvp extends Mage_Paypal_Model_Api_Nvp
{

    protected function _construct() {
        parent::_construct();

        /// Magento 1.9+ has added the DoExpressCheckoutPayment method to the required response params array.
        /// This array is checked prior to any error checking, therefore an error condition will trigger an
        /// early exit (even if the error is recoverable).  So we'll remove the 'AMT' field from the required
        /// params array.
        if (version_compare(Mage::getVersion(), '1.9', '>=')) {
            $this->_requiredResponseParams[static::DO_EXPRESS_CHECKOUT_PAYMENT] = array('ACK', 'CORRELATIONID');
        }
    }
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
		