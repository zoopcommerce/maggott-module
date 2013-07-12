<?php

namespace Zoop\MaggottModule\Test;

use Zend\Http\Header\Accept;
use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class JsonExceptionStrategyTest extends AbstractHttpControllerTestCase{

    public function setUp(){

        $this->setApplicationConfig(
            include __DIR__ . '/../../../test.application.config.php'
        );

        parent::setUp();
    }

    public function testExceptionDisplayExceptionsFalse(){

        $accept = new Accept;
        $accept->addMediaType('application/json');

        $this->getRequest()
            ->setMethod('GET')
            ->getHeaders()->addHeader($accept);

        $this->dispatch('/test_exception/throwException');

        $this->assertResponseStatusCode(500);

        $result = json_decode($this->getResponse()->getContent(), true);

        $this->assertEquals('/exception/application-exception', $result['describedBy']);
        $this->assertEquals('Application Exception', $result['title']);
        $this->assertFalse(isset($result['detail']));
    }

    public function testExceptionDisplayExceptionsTrue(){

        $this->getApplicationServiceLocator()->get('Zoop\MaggottModule\JsonExceptionStrategy')->setDisplayExceptions(true);

        $accept = new Accept;
        $accept->addMediaType('application/json');

        $this->getRequest()
            ->setMethod('GET')
            ->getHeaders()->addHeader($accept);

        $this->dispatch('/test_exception/throwException');

        $this->assertResponseStatusCode(500);

        $result = json_decode($this->getResponse()->getContent(), true);

        $this->assertEquals('/exception/application-exception', $result['describedBy']);
        $this->assertEquals('Application Exception', $result['title']);
        $this->assertEquals('Test exception', $result['detail']);
        $this->assertTrue(isset($result['class']));
        $this->assertTrue(isset($result['line']));
        $this->assertTrue(isset($result['file']));
    }

    public function testMappedExceptionDisplayExceptionsFalse(){

        $this->getApplicationServiceLocator()->get('Zoop\MaggottModule\JsonExceptionStrategy')->setDisplayExceptions(false);

        $accept = new Accept;
        $accept->addMediaType('application/json');

        $this->getRequest()
            ->setMethod('GET')
            ->getHeaders()->addHeader($accept);

        $this->dispatch('/test_exception/throwMappedException');

        $this->assertResponseStatusCode(500);

        $result = json_decode($this->getResponse()->getContent(), true);

        $this->assertEquals('/exception/mapped-exception', $result['describedBy']);
        $this->assertEquals('Mapped Exception', $result['title']);
        $this->assertTrue(isset($result['publicInfo']));
        $this->assertFalse(isset($result['detail']));
    }

    public function testMappedExceptionDisplayExceptionsTrue(){

        $this->getApplicationServiceLocator()->get('Zoop\MaggottModule\JsonExceptionStrategy')->setDisplayExceptions(true);

        $accept = new Accept;
        $accept->addMediaType('application/json');

        $this->getRequest()
            ->setMethod('GET')
            ->getHeaders()->addHeader($accept);

        $this->dispatch('/test_exception/throwMappedException');

        $this->assertResponseStatusCode(500);

        $result = json_decode($this->getResponse()->getContent(), true);

        $this->assertEquals('/exception/mapped-exception', $result['describedBy']);
        $this->assertEquals('Mapped Exception', $result['title']);
        $this->assertTrue(isset($result['publicInfo']));
        $this->assertTrue(isset($result['restrictedInfo']));
        $this->assertTrue(isset($result['detail']));
        $this->assertTrue(isset($result['class']));
        $this->assertTrue(isset($result['line']));
        $this->assertTrue(isset($result['file']));
    }

    public function testNoException(){

        $this->getApplicationServiceLocator()->get('Zoop\MaggottModule\JsonExceptionStrategy')->setDisplayExceptions(true);

        $accept = new Accept;
        $accept->addMediaType('application/json');

        $this->getRequest()
            ->setMethod('GET')
            ->getHeaders()->addHeader($accept);

        $this->dispatch('/test_exception/noException');

        $this->assertResponseStatusCode(200);

        $result = json_decode($this->getResponse()->getContent(), true);

        $this->assertEquals('all good', $result['value']);
    }
}
