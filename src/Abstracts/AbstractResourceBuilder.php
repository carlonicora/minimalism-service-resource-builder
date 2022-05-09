<?php
namespace CarloNicora\Minimalism\Services\ResourceBuilder\Abstracts;

use CarloNicora\JsonApi\Objects\ResourceObject;
use CarloNicora\Minimalism\Interfaces\Encrypter\Interfaces\EncrypterInterface;
use CarloNicora\Minimalism\Services\ResourceBuilder\Interfaces\ResourceableDataInterface;
use CarloNicora\Minimalism\Services\ResourceBuilder\Interfaces\ResourceBuilderInterface;

abstract class AbstractResourceBuilder implements ResourceBuilderInterface
{
    /**
     * @param EncrypterInterface $encrypter
     */
    public function __construct(
        protected EncrypterInterface $encrypter,
    )
    {
    }

    /**
     * @param ResourceableDataInterface[] $data
     * @return ResourceObject[]
     */
    public function buildResources(
        array $data,
    ): array
    {
        $response = [];

        foreach ($data as $resourceableData) {
            $response[] = $this->buildResource($resourceableData);
        }

        return $response;
    }

    /**
     * @param ResourceableDataInterface $data
     * @return ResourceObject
     */
    abstract public function buildResource(
        ResourceableDataInterface $data,
    ): ResourceObject;

    /**
     * @param ResourceObject[] $resources
     * @param ResourceableDataInterface[]|null $dataObjects
     * @return array|null
     */
    public function ingestResources(
        array $resources,
        ?array $dataObjects,
    ): ?array
    {
        $response = [];

        foreach ($resources as $resource) {
            $selectedDataObject = null;

            if ($dataObjects !== null){
                foreach ($dataObjects as $dataObject){
                    if ($dataObject->getId() === $this->encrypter->decryptId($resource->id)){
                        $selectedDataObject = $dataObject;
                        break;
                    }
                }
            }

            $response[] = $this->ingestResource(
                resource: $resource,
                dataObject: $selectedDataObject,
            );
        }

        if ($response === []) {
            $response = null;
        }

        return $response;
    }

    /**
     * @param ResourceObject $resource
     * @param ResourceableDataInterface|null $dataObject
     * @return ResourceableDataInterface|null
     */
    public function ingestResource(
        ResourceObject $resource,
        ?ResourceableDataInterface $dataObject,
    ): ?ResourceableDataInterface
    {
        return null;
    }
}