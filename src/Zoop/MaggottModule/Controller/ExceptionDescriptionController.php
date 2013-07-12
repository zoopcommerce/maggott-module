<?php
/**
 * @package    Zoop
 * @license    MIT
 */
namespace Zoop\MaggottModule\Controller;

use Zend\Mvc\Controller\AbstractActionController;

/**
 *
 * @since   1.0
 * @version $Revision$
 * @author  Tim Roediger <superdweebie@gmail.com>
 */
class ExceptionDescriptionController extends AbstractActionController
{

    protected $exceptionMap;

    public function getExceptionMap() {
        return $this->exceptionMap;
    }

    public function setExceptionMap($exceptionMap) {
        $this->exceptionMap = $exceptionMap;
    }

    public function indexAction(){

    }
}
