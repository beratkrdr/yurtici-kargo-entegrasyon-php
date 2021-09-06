<?php
Class yurticiKargo {

    protected static $url, $parameters;

    public function __construct(array $attributes = array()) {

        if (isset($attributes['testMode']) && $attributes['testMode']==true){
            self::$url = 'http://testwebservices.yurticikargo.com:9090/KOPSWebServices/ShippingOrderDispatcherServices?wsdl';

            self::$parameters = [
                'wsUserName'   => "YKTEST",
                'wsPassword'   => "YK"
            ];
        }else{

            global $yk_username, $yk_password;

            self::$url = 'http://webservices.yurticikargo.com:8080/KOPSWebServices/ShippingOrderDispatcherServices?wsdl';

            self::$parameters = [
                'wsUserName'   => $yk_username,
                'wsPassword'   => $yk_password
            ];
        }

        self::$parameters['wsLanguage'] = "TR";
    }

    public function createShipment(array $data = array()) {

        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ship="http://yurticikargo.com.tr/ShippingOrderDispatcherServices">
                <soapenv:Header/>
                <soapenv:Body>
                <ship:createShipment>
                            <wsUserName>'.self::$parameters['wsUserName'].'</wsUserName>
                            <wsPassword>'.self::$parameters['wsPassword'].'</wsPassword>
                            <userLanguage>'.self::$parameters['wsLanguage'].'</userLanguage>
                            <ShippingOrderVO>
                                <cargoKey>'.$data['cargoKey'].'</cargoKey>
                                <invoiceKey>'.$data['invoiceKey'].'</invoiceKey>
                                <receiverCustName>'.$data['receiverCustName'].'</receiverCustName>
                                <receiverAddress>'.$data['receiverAddress'].'</receiverAddress>
                                <cityName>'.$data['cityName'].'</cityName>
                                <townName>'.$data['townName'].'</townName>
                                <receiverPhone1>'.$data['receiverPhone1'].'</receiverPhone1>
                                <emailAddress>'.$data['emailAddress'].'</emailAddress>
                                <orgReceiverCustId>'.$data['orgReceiverCustId'].'</orgReceiverCustId>
                            </ShippingOrderVO>
                </ship:createShipment>
                </soapenv:Body>
                </soapenv:Envelope>';


        return $this->sendCurl(self::$url, $xml)['ns1:createShipmentResponse']['ShippingOrderResultVO'];
    }

    public function queryShipment($keys,$keyType,$addHistoricalData=true,$onlyTracking=true) {

        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ship="http://yurticikargo.com.tr/ShippingOrderDispatcherServices">
           <soapenv:Header/>
           <soapenv:Body>
              <ship:queryShipment>
                 <wsUserName>'.self::$parameters['wsUserName'].'</wsUserName>
                 <wsPassword>'.self::$parameters['wsPassword'].'</wsPassword>
                 <wsLanguage>'.self::$parameters['wsLanguage'].'</wsLanguage>
                 <keys>'.$keys.'</keys>
                 <keyType>'.$keyType.'</keyType>
                 <addHistoricalData>'.$addHistoricalData.'</addHistoricalData>
                 <onlyTracking>'.$onlyTracking.'</onlyTracking>
              </ship:queryShipment >
           </soapenv:Body>
        </soapenv:Envelope>';

        return $this->sendCurl(self::$url, $xml)['ns1:queryShipmentResponse']['ShippingDeliveryVO'];

    }

    public function cancelShipment($cargoKeys) {

        $xml = '<soapenv:Envelope xmlns:soapenv="http://schemas.xmlsoap.org/soap/envelope/" xmlns:ship="http://yurticikargo.com.tr/ShippingOrderDispatcherServices">
           <soapenv:Header/>
           <soapenv:Body>
              <ship:cancelShipment>
                 <wsUserName>'.self::$parameters['wsUserName'].'</wsUserName>
                 <wsPassword>'.self::$parameters['wsPassword'].'</wsPassword>
                 <userLanguage>'.self::$parameters['wsLanguage'].'</userLanguage>
                 <cargoKeys>'.$cargoKeys.'</cargoKeys>
              </ship:cancelShipment >
           </soapenv:Body>
        </soapenv:Envelope>';

        return $this->sendCurl(self::$url, $xml)['ns1:cancelShipmentResponse']['ShippingOrderResultVO'];
    }

    public function sendCurl($url, $post_fields = ""){

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
        $oXmlParser = new xmlParser();
        $asArray = $oXmlParser->xmlParser($result);

        return $asArray['env:Envelope']['env:Body'];

    }

    public function xmlParser($contents, $get_attributes=1, $priority = 'tag')
    {
        if(!$contents)
            return array();

        if(!function_exists('xml_parser_create'))
        {
            return array();
        }

        $parser = xml_parser_create('');
        xml_parser_set_option($parser, XML_OPTION_TARGET_ENCODING, "UTF-8");
        xml_parser_set_option($parser, XML_OPTION_CASE_FOLDING, 0);
        xml_parser_set_option($parser, XML_OPTION_SKIP_WHITE, 1);
        xml_parse_into_struct($parser, trim($contents), $xml_values);
        xml_parser_free($parser);

        if(!$xml_values)
            return;

        $xml_array = array();
        $parents = array();
        $opened_tags = array();
        $arr = array();

        $current = &$xml_array;

        $repeated_tag_index = array();

        foreach($xml_values as $data)
        {
            unset($attributes,$value);

            extract($data);

            $result = array();

            $attributes_data = array();

            if(isset($value))
            {
                if($priority == 'tag')
                    $result = $value;
                else
                    $result['value'] = $value;
            }

            if(isset($attributes) and $get_attributes)
            {
                foreach($attributes as $attr => $val)
                {
                    if($priority == 'tag')
                        $attributes_data[$attr] = $val;
                    else
                        $result['attr'][$attr] = $val;
                }
            }

        }

        return($xml_array);
    }

}
?>
