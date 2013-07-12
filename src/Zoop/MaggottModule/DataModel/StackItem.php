<?php

namespace Zoop\MaggottModule\DataModel;

//Annotation imports
use Doctrine\ODM\MongoDB\Mapping\Annotations as ODM;
use Zoop\Shard\Annotation\Annotations as Shard;

/**
 * @ODM\EmbeddedDocument
 * @Shard\AccessControl({
 *     @Shard\Permission\Basic(roles="*", allow="create"),
 *     @Shard\Permission\Basic(roles="admin", allow={"read", "delete"})
 * })
 */
class StackItem {

    /**
     * @ODM\Id(strategy="UUID")
     */
    protected $id;

    /**
     * @ODM\String
     */
    protected $file;

    /**
     * @ODM\String
     */
    protected $line;

    public function getId() {
        return $this->id;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function getFile() {
        return $this->file;
    }

    public function setFile($file) {
        $this->file = $file;
    }

    public function getLine() {
        return $this->line;
    }

    public function setLine($line) {
        $this->line = $line;
    }
}
