<?php
/**
 * @package    Zoop
 * @license    MIT
 */
namespace Zoop\MaggottModule\Service;

use Zoop\MaggottModule\Controller\ExceptionDescriptionController;
use Zend\ServiceManager\FactoryInterface;
use Zend\ServiceManager\ServiceLocatorInterface;

/**
 *
 * @since   1.0
 * @version $Revision$
 * @author  Tim Roediger <superdweebie@gmail.com>
 */
class ExceptionDescriptionControllerFactory implements FactoryInterface
{

    /**
     *
     * @param \Zend\ServiceManager\ServiceLocatorInterface $serviceLocator
     * @return object
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
        $config = $serviceLocator->get('Config');

        $controller = new ExceptionDescriptionController();

        if (isset($config['zoop']['maggott']['exception_map'])){
            $controller->setExceptionMap($config['zoop']['maggott']['exception_map']);
        }

        return $controller;
    }
}
