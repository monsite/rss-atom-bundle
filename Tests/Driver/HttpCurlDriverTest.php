<?php

namespace Debril\RssAtomBundle\Driver;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2013-02-06 at 23:48:53.
 */
class HttpCurlDriverTest extends \PHPUnit_Framework_TestCase
{

    const URL = 'https://raw.github.com/alexdebril/rss-atom-bundle/master/Resources/sample-atom.xml';

    /**
     * @var HttpCurlDriver
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp()
    {
        $this->object = new HttpCurlDriver;
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown()
    {

    }

    /**
     * @covers Debril\RssAtomBundle\Driver\HttpCurlDriver::getResponse
     */
    public function testGetResponse()
    {
        $date = \DateTime::createFromFormat('j-M-Y', '10-Feb-2002');
        try
        {
            $response = $this->object->getResponse(self::URL, $date);

            $this->assertInstanceOf("Debril\RssAtomBundle\Driver\HttpDriverResponse", $response);
            $this->assertInternalType("integer", $response->getHttpCode());

            $this->assertInternalType("string", $response->getBody());
            $this->assertGreaterThan(0, strlen($response->getBody()));
        } catch (DriverUnreachableResourceException $e)
        {
            $this->markTestIncomplete(
                    'This test cannot be run.'
            );
        }
    }

    /**
     * @covers Debril\RssAtomBundle\Driver\HttpCurlDriver::getResponse
     * @expectedException Debril\RssAtomBundle\Driver\DriverUnreachableResourceException
     */
    public function testGetResponseException()
    {
        $date = \DateTime::createFromFormat('j-M-Y', '10-Feb-2002');
        $this->object->getResponse('http://idonotexist', $date);
    }

    public function testGetHttpResponse()
    {
        $headers = file_get_contents(dirname(__FILE__) . '/../../Resources/tests/curl-200-headers.txt');
        $body = file_get_contents(dirname(__FILE__) . '/../../Resources/sample-atom.xml');

        $response = $this->object->getHttpResponse($headers, $body);

        $this->assertInstanceOf("\Debril\RssAtomBundle\Driver\HttpDriverResponse", $response);
    }

}
