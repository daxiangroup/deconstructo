<?php namespace DaxianGroup\Restrictions;

use DaxianGroup\Restrictions\Parsers\RestrictionsParser;

class RestrictionsParserTest extends \TestCase {

    /**
     * A basic functional test example.
     *
     * @return void
     */
    /*
    public function testBasicExample()
    {
        $crawler = $this->client->request('GET', '/');

        $this->assertTrue($this->client->getResponse()->isOk());
    }
    */


    public function setUp()
    {
        $this->restrictionsParser = new RestrictionsParser();
    }

    public function testParserDataIsNullByDefault()
    {
        $this->assertNull($this->restrictionsParser->getData());
    }

    public function testParserDataIsNotNullWhenInstantiatedWithData()
    {
        $xml = '<note>
<to>Tove</to>
<from>Jani</from>
<heading>Reminder</heading>
<body>Don\'t forget me this weekend!</body>
</note>';

        $this->restrictionsParser = new RestrictionsParser($xml);

        $this->assertNotNull($this->restrictionsParser->getData());
    }
}
