<?php

namespace CarloNicora\Minimalism\Services\ResourceBuilder\Interfaces;

use CarloNicora\JsonApi\Document;
use CarloNicora\Minimalism\Interfaces\SimpleObjectInterface;

interface ResourceListBuilderInterface extends SimpleObjectInterface
{

    /**
     * @param ResourceableDataInterface[] $data
     * @return Document
     */
    public function buildResourceList(
        array $data,
    ): Document;

}