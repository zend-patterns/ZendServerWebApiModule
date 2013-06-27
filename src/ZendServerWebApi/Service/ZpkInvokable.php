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
    
    public function validateMeta($filename)
    {
        $zip = new \ZipArchive;

        ErrorHandler::start();
        $zip->open($filename);
        $content = $zip->getFromName('deployment.xml');
        $zip->close();
        ErrorHandler::stop(true);
        
        $dom = new \DOMDocument();
        $dom->loadXML($content);
        
        libxml_use_internal_errors(true);
        if(!$dom->schemaValidate(__DIR__.'/../../../config/zpk/schema.xsd')){
            $message = "";
            $errors = libxml_get_errors();
            foreach ($errors as $error) {
                $message.= $error->message;
            }
            libxml_clear_errors();
            throw new \DOMException($message);
        }
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
