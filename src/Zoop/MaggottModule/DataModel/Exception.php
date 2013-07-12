<?php

namespace Zoop\MaggottModule\DataModel;

use Doctrine\Common\Collections\ArrayCollection;
use Zoop\Shard\Stamp\DataModel\CreatedOnTrait;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\Document
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="create"),
 *     @Shard\Permission\Basic(roles="admin", allow={"read", "delete"})
 * })
 */
class Exception {

    use CreatedOnTrait;

    /**
     * @ODM\Id(strategy="UUID")
     */
    protected $id;

    /**
     * @ODM\String
     * @Shard\Validator\Required
     */
    protected $name;

    /**
     * @ODM\String
     */
    protected $message;

    /**
     * @ODM\String
     */
    protected $severity;

    /**
     * @ODM\EmbedMany(targetDocument="StackItem")
     */
    protected $stack;

    /**
     * @ODM\String
     */
    protected $ip;

    /**
     * @ODM\String
     */
    protected $pageUrl;

    /**
     * @ODM\String
     */
    protected $pageTitle;

    /**
     * @ODM\String
     */
    protected $referrerUrl;

    /**
     * @ODM\String
     */
    protected $operatingSystem;

    /**
     * @ODM\String
     */
    protected $browserVersion;

    public function __construct() {
        $this->stack = new ArrayCollection();
    }

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getName() {
        return $this->name;
    }

    public function setName($name) {
        $this->name = $name;
    }

    public function getMessage() {
        return $this->message;
    }

    public function setMessage($message) {
        $this->message = $message;
    }

    public function getSeverity() {
        return $this->severity;
    }

    public function setSeverity($severity) {
        $this->severity = $severity;
    }

    public function getStack() {
        return $this->stack;
    }

    public function setStack($stack) {
        $this->stack = $stack;
    }

    public function getIp() {
        return $this->ip;
    }

    public function setIp($ip) {
        $this->ip = $ip;
    }

    public function getPageUrl() {
        return $this->pageUrl;
    }

    public function setPageUrl($pageUrl) {
        $this->pageUrl = $pageUrl;
    }

    public function getPageTitle() {
        return $this->pageTitle;
    }

    public function setPageTitle($pageTitle) {
        $this->pageTitle = $pageTitle;
    }

    public function getReferrerUrl() {
        return $this->referrerUrl;
    }

    public function setReferrerUrl($referrerUrl) {
        $this->referrerUrl = $referrerUrl;
    }

    public function getOperatingSystem() {
        return $this->operatingSystem;
    }

    public function setOperatingSystem($operatingSystem) {
        $this->operatingSystem = $operatingSystem;
    }

    public function getBrowserVersion() {
        return $this->browserVersion;
    }

    public function setBrowserVersion($browserVersion) {
        $this->browserVersion = $browserVersion;
    }
}
