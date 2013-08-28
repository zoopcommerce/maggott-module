<?php
/**
 * @package    Zoop
 * @license    MIT
 */
namespace Zoop\MaggottModule;

use Zend\Mvc\MvcEvent;

/**
 *
 * @license MIT
 * @link    http://www.doctrine-project.org/
 * @since   0.1.0
 * @author  Tim Roediger <superdweebie@gmail.com>
 */
class Module
{
    /**
     *
     * @return array
     */
    public function getConfig()
    {
        return include __DIR__ . '/../../../config/module.config.php';
    }

    /**
     *
     * @param \Zend\EventManager\Event $event
     */
    public function onBootstrap(MvcEvent $event)
    {

        $application = $event->getTarget();
        $serviceManager = $application->getServiceManager();
        $application->getEventManager()->getSharedManager()->attach(
            'Zend\Mvc\Application',
            MvcEvent::EVENT_DISPATCH_ERROR,
            function ($closureEvent) use ($serviceManager) {
                $config = $serviceManager->get('Config');
                if (! $config['zoop']['maggott']['enable_json_exception_strategy']) {
                    return;
                }
                $serviceManager->get('Zoop\MaggottModule\JsonExceptionStrategy')
                    ->prepareExceptionViewModel($closureEvent);
            },
            100
        );
    }
}
