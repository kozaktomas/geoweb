<?php

namespace Test;

use Jednoadem\Communications\Point;
use Jednoadem\Communications\StreamReader;
use Nette,
    Tester,
    Tester\Assert;


$container = require __DIR__ . '/../bootstrap.php';

class StreamReaderTest extends Tester\TestCase
{

    /**
     * @var \DOMDocument
     */
    protected $document;

    /**
     * @var \Jednoadem\Communications\StreamReader
     */
    protected $reader;

    function __construct()
    {
        $this->document = new \DOMDocument();
        $this->document->load(__DIR__ . "/../files/out.xml");

        $this->reader = new StreamReader($this->document);
    }


    function testId()
    {
        Assert::same("123456798", $this->reader->getId());
    }


    function testCount()
    {
        Assert::equal(2, count($this->reader));
    }

    function testData()
    {

        foreach ($this->reader as $point) {

            Assert::type('Jednoadem\Communications\Point', $point);
            Assert::equal(49.396599287069, $point->getLatitude());
            Assert::equal(16.710938821824893, $point->getLongitude());
            break;
        }
    }

    function testPoint()
    {
        $point = new Point();
        $point->setLatitude(14.7);
        $point->setLongitude("14.78566");
        Assert::equal(14.7, $point->getLatitude());
        Assert::equal(14.78566, $point->getLongitude());
    }

}


$test = new StreamReaderTest();
$test->run();
