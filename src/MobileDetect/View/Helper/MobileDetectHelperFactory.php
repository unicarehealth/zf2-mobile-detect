<?php
namespace Neilime\MobileDetect\View\Helper;

use Laminas\ServiceManager\FactoryInterface;
use Laminas\ServiceManager\ServiceLocatorInterface;
use Interop\Container\ContainerInterface;

class MobileDetectHelperFactory implements FactoryInterface
{
    /**
     * {@inheritDoc}
     */
    public function __invoke(ContainerInterface $container, $requestedName, array $options = null)
    {
        return new MobileDetectHelper(
            $container->get('mobileDetect')
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
