<?php

namespace CarloNicora\Minimalism\Services\ResourceBuilder\Interfaces;

use CarloNicora\JsonApi\Document;
use CarloNicora\Minimalism\Interfaces\SimpleObjectInterface;

interface DocumentBuilderInterface extends SimpleObjectInterface
{

    /**
     * @param DocumentableDataInterface $data
     * @return Document
     */
    public function buildDocument(
        DocumentableDataInterface $data,
    ): Document;

}