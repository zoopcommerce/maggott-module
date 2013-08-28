<?php
/**
 * @package    Zoop
 * @license    MIT
 */
namespace Zoop\MaggottModule\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

/**
 *
 * @since   1.0
 * @version $Revision$
 * @author  Tim Roediger <superdweebie@gmail.com>
 */
class ExceptionDescriptionController extends AbstractActionController
{

    protected $exceptionMap;

    public function getExceptionMap()
    {
        return $this->exceptionMap;
    }

    public function setExceptionMap($exceptionMap)
    {
        $this->exceptionMap = $exceptionMap;
    }

    public function indexAction()
    {
        $id = $this->getEvent()->getRouteMatch()->getParam('id');

        foreach ($this->exceptionMap as $exception) {
            if (isset($exception['described_by']) && $exception['described_by'] == $id) {
                $result = new ViewModel(['title' => $exception['title']]);
                $result->setTemplate('zoop/maggott/' . $exception['described_by']);
                break;
            }
        }

        if (! isset($result)) {
            $result = new ViewModel(['title' => 'Application Exception']);
            $result->setTemplate('zoop/maggott/' . 'application-exception');
        }

        return $result;
    }
}
