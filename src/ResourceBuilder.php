<?php
namespace CarloNicora\Minimalism\Services\ResourceBuilder;

use CarloNicora\JsonApi\Objects\ResourceObject;
use CarloNicora\Minimalism\Abstracts\AbstractService;
use CarloNicora\Minimalism\Services\ResourceBuilder\Interfaces\ResourceableDataInterface;
use CarloNicora\Minimalism\Services\ResourceBuilder\Interfaces\ResourceBuilderInterface;
use Exception;

class ResourceBuilder extends AbstractService
{
    /**
     * @param string $builderClass
     * @param ResourceableDataInterface[] $data
     * @return ResourceObject[]
     * @throws Exception
     */
    public function buildResources(
        string $builderClass,
        array $data,
    ): array
    {
        /** @var ResourceBuilderInterface $resourceBuilder */
        $resourceBuilder = $this->objectFactory->create($builderClass);

        return $resourceBuilder->buildResources(data: $data);
    }

    /**
     * @param string $builderClass
     * @param ResourceableDataInterface $data
     * @return ResourceObject
     * @throws Exception
     */
    public function buildResource(
        string $builderClass,
        ResourceableDataInterface $data,
    ): ResourceObject
    {
        /** @var ResourceBuilderInterface $resourceBuilder */
        $resourceBuilder = $this->objectFactory->create($builderClass);

        return $resourceBuilder->buildResource(data: $data);
    }

    /**
     * @param string $dataClass
     * @param ResourceObject[] $resources
     * @return ResourceableDataInterface[]
     * @throws Exception
     */
    public function ingestResources(
        string $dataClass,
        array $resources,
    ): array
    {
        /** @var ResourceBuilderInterface $resourceBuilder */
        $resourceBuilder = $this->objectFactory->create($dataClass);

        return $resourceBuilder->ingestResources(resources: $resources);
    }

    /**
     * @param string $dataClass
     * @param ResourceObject $resource
     * @return ResourceableDataInterface
     * @throws Exception
     */
    public function ingestResource(
        string $dataClass,
        ResourceObject $resource,
    ): ResourceableDataInterface
    {
        /** @var ResourceBuilderInterface $resourceBuilder */
        $resourceBuilder = $this->objectFactory->create($dataClass);

        return $resourceBuilder->ingestResource(resource: $resource);
    }
}