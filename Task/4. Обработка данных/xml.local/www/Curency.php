<?php

class Currency
{
    protected $data = array();
    private $request;
    private $finalResult = array();

    public function __construct($arrayOfCurrencys)
    {
        if (!is_array($arrayOfCurrencys)) {
            die('Enter correct data as array format');
        } else {
            foreach ($arrayOfCurrencys as $currency) {
                $this->data[] .= $currency;
            }
        }
    }

    function HandleXmlError($errno, $errstr, $errfile, $errline)
    {
        if ($errno == E_WARNING && (substr_count($errstr, "DOMDocument::loadXML()") > 0)) {
            throw new DOMException($errstr);
        } else
            return false;
    }

    function _pullRequest()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, 'http://www.ecb.europa.eu/stats/eurofxref/eurofxref-daily.xml');
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
        curl_setopt($ch, CURLOPT_HEADER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);

        if (curl_exec($ch) === false) {
            echo 'Ошибка curl: ' . curl_error($ch);
        } else {
            return curl_exec($ch);
        }
    }

    function _prepareCurrencies($request, $currency)
    {
        $requestResult = array();
        $finalResult = array();
        $dom = new DomDocument();
        set_error_handler(array($this, 'HandleXmlError'));
        $dom->loadXML($request);
        $xpath = new DomXPath($dom);

        foreach ($currency as $currentCurrency) {
            $requestResult[] = $xpath->query(".//*[@currency='$currentCurrency']");
        }

        foreach ($requestResult as $currentCurrency) {
            try {
                if ($currentCurrency->item(0)) {
                    $finalResult[$currentCurrency->item(0)->getAttribute('currency')] = $currentCurrency->item(0)->getAttribute('rate');
                }
            } catch (Exception $e) {
                die('Enter the data in the correct format to the constructor or your type of currency does not exist');
            }
        }
        return $finalResult;
    }

    public function getCurrency()
    {
        try {
            try {
                $this->request = $this->_pullRequest();
                $this->finalResult = $this->_prepareCurrencies($this->request, $this->data);
            } catch (Exception $e) {
                die('Connection error or changes in address within the code');
            }
            return $this->finalResult;
        } catch (Exception $e) {
            die(' Do not try to modify the function');
        }
    }
}