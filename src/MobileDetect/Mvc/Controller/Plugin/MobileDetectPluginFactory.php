<?php
namespace Neilime\MobileDetect\Mvc\Controller\Plugin;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;

class MobileDetectPluginFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new MobileDetectPlugin(
            $container->get($requestedName)
        );
    }
    /**
     * {@inheritDoc}
     */
    public function createService(ServiceLocatorInterface $serviceLocator)
    {
		if (!method_exists($serviceLocator, 'getServiceLocator')) return;
		return $this($serviceLocator->getServiceLocator(), 'mobileDetect');		
    }
}
