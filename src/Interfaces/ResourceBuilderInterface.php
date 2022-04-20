<?php
namespace CarloNicora\Minimalism\Services\ResourceBuilder\Interfaces;

use CarloNicora\JsonApi\Objects\ResourceObject;
use CarloNicora\Minimalism\Interfaces\SimpleObjectInterface;

interface ResourceBuilderInterface extends SimpleObjectInterface
{
    /**
     * @param ResourceableDataInterface[] $data
     * @return ResourceObject[]
     */
    public function buildResources(
        array $data,
        array $additionalData = []
    ): array;

    /**
     * @param ResourceableDataInterface $data
     * @param array $additionalData
     * @return ResourceObject
     */
    public function buildResource(
        ResourceableDataInterface $data,
        array $additionalData = []
    ): ResourceObject;

    /**
     * @param ResourceObject[] $resources
     * @return ResourceableDataInterface[]|null
     */
    public function ingestResources(
        array $resources,
    ): ?array;

    /**
     * @param ResourceObject $resource
     * @return ResourceableDataInterface|null
     */
    public function ingestResource(
        ResourceObject $resource,
    ): ?ResourceableDataInterface;
}