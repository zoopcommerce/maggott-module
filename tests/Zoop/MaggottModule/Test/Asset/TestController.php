<?php
/**
 * @package    Zoop
 * @license    MIT
 */
namespace Zoop\MaggottModule\Test\Asset;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\JsonModel;

/**
 *
 * @since   1.0
 * @version $Revision$
 * @author  Tim Roediger <superdweebie@gmail.com>
 */
class TestController extends AbstractActionController
{

    public function throwExceptionAction()
    {
        throw new \Exception('Test exception');
    }

    public function throwMappedExceptionAction()
    {
        $e = new MappedException('Mapped exception');
        $e->setPublicInfo('all can see this');
        $e->setRestrictedInfo('only visible when display exceptions = true');
        throw $e;
    }

    public function noExceptionAction()
    {
        return new JsonModel(['value' => 'all good']);
    }
}
