<?php
namespace Neilime\MobileDetect\Mvc\Controller\Plugin;

use Laminas\Mvc\Controller\Plugin\AbstractPlugin;

class MobileDetectPlugin extends AbstractPlugin
{
    /**
     * @var \Mobile_Detect
     */
    protected $mobileDetect;

    /**
     * @param \Mobile_Detect $mobileDetect
     */
    public function __construct(\Mobile_Detect $mobileDetect)
    {
        $this->mobileDetect = $mobileDetect;
    }

    /**
     * Retrieve Mobile-detect service
     *
     * @param \Laminas\Http\Headers $oHeaders
     *
     * @throws \LogicException
     * @return \Mobile_Detect
     */
    public function __invoke(?\Laminas\Http\Headers $oHeaders = null)
    {
        $oController = $this->getController();
        if (!$oController) {
            throw new \LogicException('Controller is undefined for MobileDetect controller plugin');
        }

        if ($oHeaders !== null) {
            $this->mobileDetect->setHttpHeaders($oHeaders->toArray());
			
			$userAgentObj = $oHeaders->get('user-agent');
			
			if ($userAgentObj instanceof \Laminas\Http\Header\HeaderInterface)
			{
				$this->mobileDetect->setUserAgent($userAgentObj->getFieldValue());
			}		
            else if ($userAgentObj instanceof \ArrayIterator)
			{
				$this->mobileDetect->setUserAgent($userAgentObj[0]->getFieldValue());
			}
        }

        return $this->mobileDetect;
    }
}