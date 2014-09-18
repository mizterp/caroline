<?php

use CertifiedWebNinja\Caroline\Analysis;

class CarolineTest extends PHPUnit_Framework_TestCase
{
    private $caroline;

    protected function setUp()
    {
        $this->caroline = new Analysis;
    }

    public function testAnalyzeReturnsInstanceOfResult()
    {
        $this->assertInstanceOf('CertifiedWebNinja\Caroline\Result', $this->caroline->analyze('good'));
    }

    public function testAnalyzePositiveResult()
    {
        $result = $this->caroline->analyze('good');
        $this->assertEquals('good', $result->getString());
        $this->assertEquals(3, $result->getScore());
        $this->assertEquals(-3, $result->getComparative());
        $this->assertEquals(['good'], $result->getTokens());
        $this->assertEquals(['good'], $result->getWords());
        $this->assertEquals(['good'], $result->getPositive());
        $this->assertEquals([], $result->getNegative());
    }

    public function testAnalyzeNegativeResult()
    {
        $result = $this->caroline->analyze('bad');
        $this->assertEquals('bad', $result->getString());
        $this->assertEquals(-3, $result->getScore());
        $this->assertEquals(3, $result->getComparative());
        $this->assertEquals(['bad'], $result->getTokens());
        $this->assertEquals(['bad'], $result->getWords());
        $this->assertEquals(['bad'], $result->getNegative());
        $this->assertEquals([], $result->getPositive());
    }
}