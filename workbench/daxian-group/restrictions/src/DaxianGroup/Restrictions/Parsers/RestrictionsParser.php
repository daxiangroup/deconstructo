<?php namespace DaxianGroup\Restrictions\Parsers;

use \SimpleXMLElement;

class RestrictionsParser {

    private $xmlData;

    public function __construct($xmlData = null)
    {
        $this->xmlData = $xmlData;
    }

    public function getData()
    {
        return $this->xmlData;
    }

    public function parse()
    {
        $obj = new SimpleXMLElement($this->xmlData);
        //die('<pre>'.print_r($obj,true));
        dd($obj);
    }
}
