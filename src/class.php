<?php
Class yurticiKargo {

    protected static $url, $oAuth, $cleanResult;

    public function __construct(array $attributes = array()) {

        if (isset($attributes['testMode']) && $attributes['testMode']==true){
            self::$url = 'http://testwebservices.yurticikargo.com:9090/KOPSWebServices/ShippingOrderDispatcherServices?wsdl';

            self::$oAuth = '<wsUserName>YKTEST</wsUserName>
                            <wsPassword>YK</wsPassword>
                            <userLanguage>TR</userLanguage>';
        }else{
            self::$url = 'http://webservices.yurticikargo.com:8080/KOPSWebServices/ShippingOrderDispatcherServices?wsdl';

            self::$oAuth = '<wsUserName>'.$attributes['wsUserName'].'</wsUserName>
                            <wsPassword>'.$attributes['wsPassword'].'</wsPassword>
                            <userLanguage>'.$attributes['wsLanguage'].'</userLanguage>';
        }

        if (isset($attributes['cleanResult'])){
            self::$cleanResult = $attributes['cleanResult'];
        }else{
            self::$cleanResult = true;
        }

    }


    /* BEGIN::Functions */
    public function createShipment(array $data = array()) {

        $accepted_parameters = array(
            'cargoKey',
            'invoiceKey',
            'receiverCustName',
            'receiverAddress',
            'receiverPhone1',
            'receiverPhone2',
            'receiverPhone3',
            'cityName',
            'townName',
            'custProdId',
            'desi',
            'desiSpecified',
            'kg',
            'cargoCount',
            'waybillNo',
            'taxOfficeId',
            'ttDocumentId',
            'dcSelectedCredit',
            'dcCreditRule',
            'emailAddress',
            'orgReceiverCustId'
        );

        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ship="http://yurticikargo.com.tr/ShippingOrderDispatcherServices">
                <soapenv:Header/>
                <soapenv:Body>
                <ship:createShipment>
                    '.self::$oAuth.'
                    <ShippingOrderVO>';

        foreach ($data as $param => $value) {
            if (in_array($param, $accepted_parameters)){
                $xml .= '<'.$param.'>'.$value.'</'.$param.'>';
            }
        }

        $xml .= '   </ShippingOrderVO>
                </ship:createShipment>
                </soapenv:Body>
                </soapenv:Envelope>';

        if (self::$cleanResult){
            $result = $this->sendCurl(self::$url, $xml)['ns1_createShipmentResponse']['ShippingOrderResultVO'];
        }else{
            $result = $this->sendCurl(self::$url, $xml);
        }

        return $result;
    }

    public function queryShipment($keys,$keyType,$addHistoricalData=true,$onlyTracking=true) {

        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ship="http://yurticikargo.com.tr/ShippingOrderDispatcherServices">
           <soapenv:Header/>
           <soapenv:Body>
              <ship:queryShipment>
                 '.str_replace("userLanguage","wsLanguage", self::$oAuth).'
                 <keys>'.$keys.'</keys>
                 <keyType>'.$keyType.'</keyType>
                 <addHistoricalData>'.$addHistoricalData.'</addHistoricalData>
                 <onlyTracking>'.$onlyTracking.'</onlyTracking>
              </ship:queryShipment >
           </soapenv:Body>
        </soapenv:Envelope>';

        if (self::$cleanResult){
            $result = $this->sendCurl(self::$url, $xml)['ns1_queryShipmentResponse']['ShippingDeliveryVO'];
        }else{
            $result = $this->sendCurl(self::$url, $xml);
        }

        return $result;
    }

    public function cancelShipment($cargoKeys) {

        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ship="http://yurticikargo.com.tr/ShippingOrderDispatcherServices">
           <soapenv:Header/>
           <soapenv:Body>
              <ship:cancelShipment>
                 '.self::$oAuth.'
                 <cargoKeys>'.$cargoKeys.'</cargoKeys>
              </ship:cancelShipment >
           </soapenv:Body>
        </soapenv:Envelope>';

        if (self::$cleanResult){
            $result = $this->sendCurl(self::$url, $xml)['ns1_cancelShipmentResponse']['ShippingOrderResultVO'];
        }else{
            $result = $this->sendCurl(self::$url, $xml);
        }

        return $result;
    }
    /* END::Functions */


    /* BEGIN::Tools */
    private function sendCurl($url, $post_fields = ""){

        $curl_request = curl_init();

        $curlConfig = array(
            CURLOPT_URL => $url,
            CURLOPT_POST => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FOLLOWLOCATION => false,
            CURLOPT_VERBOSE => false,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_POSTFIELDS => $post_fields,
            CURLOPT_HTTPHEADER => array('Content-Type: text/xml;')
        );

        curl_setopt_array($curl_request, $curlConfig);

        $result = curl_exec($curl_request);

        if (curl_errno($curl_request)) {
            $result = curl_error($curl_request);
        }

        curl_close($curl_request);

        return $this->xmlParser($result);

    }

    private function xmlParser($xml){

        $obj = SimpleXML_Load_String(trim($xml));
        if ($obj === FALSE) return $xml;

        // Get Namespaces
        $nss = $obj->getNamespaces(TRUE);
        if (empty($nss)) return $xml;

        // Replace ns: to ns_
        $nsm = array_keys($nss);
        foreach ($nsm as $key)
        {
            $rgx
                = '#'
                . '('
                . '\<'
                . '/?'
                . preg_quote($key)
                . ')'
                . '('
                . ':{1}'
                . ')'
                . '#'
            ;

            $rep
                = '$1'
                . '_'
            ;

            $xml =  preg_replace($rgx, $rep, $xml);
        }

        $xml = json_decode(json_encode(SimpleXML_Load_String($xml, 'SimpleXMLElement', LIBXML_NOCDATA)), true);

        if (self::$cleanResult){
            $result = $xml['env_Body'];
        }else{
            $result = $xml;
        }

        return $result;

    }
    /* END::Tools */

}
?>
