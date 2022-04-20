<?php
namespace CarloNicora\Minimalism\Services\ResourceBuilder\Abstracts;

use CarloNicora\JsonApi\Objects\ResourceObject;
use CarloNicora\Minimalism\Services\ResourceBuilder\Interfaces\ResourceableDataInterface;
use CarloNicora\Minimalism\Services\ResourceBuilder\Interfaces\ResourceBuilderInterface;

abstract class AbstractResourceBuilder implements ResourceBuilderInterface
{
    /**
     * @param ResourceableDataInterface[] $data
     * @param array $additionalData
     * @return ResourceObject[]
     */
    public function buildResources(
        array $data,
        array $additionalData = []
    ): array
    {
        $response = [];

        foreach ($data as $resourceableData) {
            $response[] = $this->buildResource($resourceableData, $additionalData);
        }

        return $response;
    }

    /**
     * @param ResourceableDataInterface $data
     * @param array $additionalData
     * @return ResourceObject
     */
    abstract public function buildResource(
        ResourceableDataInterface $data,
        array $additionalData = []
    ): ResourceObject;

    /**
     * @param ResourceObject[] $resources
     * @return ResourceableDataInterface[]|null
     */
    public function ingestResources(
        array $resources,
    ): ?array
    {
        $response = [];

        foreach ($resources as $resource) {
            $response[] = $this->ingestResource(
                resource: $resource,
            );
        }

        if ($response === []) {
            $response = null;
        }

        return $response;
    }

    /**
     * @param ResourceObject $resource
     * @return ResourceableDataInterface|null
     */
    public function ingestResource(
        ResourceObject $resource,
    ): ?ResourceableDataInterface
    {
        return null;
    }
}