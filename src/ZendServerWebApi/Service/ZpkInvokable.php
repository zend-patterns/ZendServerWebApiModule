<?php
namespace ZendServerWebApi\Service;

use Zend\ServiceManager\ServiceLocatorAwareInterface;
use Zend\ServiceManager\ServiceLocatorInterface;
use Zend\Stdlib\ErrorHandler;

/**
 * ZPK Service
 */
class ZpkInvokable implements ServiceLocatorAwareInterface
{
    /**
     * @var ServiceLocatorInterface
     */
    protected $services;

    /**
     *
     * @param string $filename
     * @return \SimpleXMLElement
     */
    public function getMeta($filename)
    {
        $zip = new \ZipArchive;

        ErrorHandler::start();
        $zip->open($filename);
        $content = $zip->getFromName('deployment.xml');
        $zip->close();
        ErrorHandler::stop(true);

        if(!$content) {
            throw new \Zend\Mvc\Exception\RuntimeException('Missing deployment.xml in the zpk file.');
        }

        $xml = new \SimpleXMLElement($content);

        return $xml;
    }

    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::setServiceLocator()
     */
    public function setServiceLocator(ServiceLocatorInterface $serviceLocator)
    {
        $this->services = $serviceLocator;
    }

    /* (non-PHPdoc)
     * @see \Zend\ServiceManager\ServiceLocatorAwareInterface::getServiceLocator()
     */
    public function getServiceLocator()
    {
        return $this->services;
    }

}
