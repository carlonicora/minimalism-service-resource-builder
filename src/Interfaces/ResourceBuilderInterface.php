<?php
namespace CarloNicora\Minimalism\Services\ResourceBuilder\Interfaces;

use CarloNicora\JsonApi\Objects\ResourceObject;
use CarloNicora\Minimalism\Interfaces\SimpleObjectInterface;

interface ResourceBuilderInterface extends SimpleObjectInterface
{
    /**
     * @param int[] $ids
     * @return ResourceObject[]
     */
    public function buildMinimalResources(
        array $ids
    ): array;

    /**
     * @param int $id
     * @return ResourceObject
     */
    public function buildMinimalResource(
        int $id
    ): ResourceObject;

    /**
     * @param ResourceableDataInterface[] $data
     * @return ResourceObject[]
     */
    public function buildResources(
        array $data,
    ): array;

    /**
     * @param ResourceableDataInterface $data
     * @return ResourceObject
     */
    public function buildResource(
        ResourceableDataInterface $data,
    ): ResourceObject;

    /**
     * @param array $resources
     * @param ResourceableDataInterface[]|null $dataObjects
     * @return array|null
     */
    public function ingestResources(
        array $resources,
        ?array $dataObjects,
    ): ?array;

    /**
     * @param ResourceObject $resource
     * @param ResourceableDataInterface|null $dataObject
     * @return ResourceableDataInterface|null
     */
    public function ingestResource(
        ResourceObject $resource,
        ?ResourceableDataInterface $dataObject,
    ): ?ResourceableDataInterface;
}