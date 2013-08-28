<?php

namespace Zoop\MaggottModule\Test\Controller;

use Zend\Test\PHPUnit\Controller\AbstractHttpControllerTestCase;

class ExceptionDescriptionControllerTest extends AbstractHttpControllerTestCase
{
    public function setUp()
    {
        $this->setApplicationConfig(
            include __DIR__ . '/../../../../test.application.config.php'
        );

        parent::setUp();
    }

    public function testGetApplicationExceptionDescription()
    {
        $this->dispatch('/exception/application-exception');

        $this->assertContains(
            'Sorry, no further information about this exception is available.',
            $this->getResponse()->getContent()
        );
        $this->assertResponseStatusCode(200);
    }

    public function testGetMappedExceptionDescription()
    {
        $this->dispatch('/exception/mapped-exception');

        $this->assertContains(
            'This is an exception created to test maggot module.',
            $this->getResponse()->getContent()
        );
        $this->assertResponseStatusCode(200);
    }
}
