<?php
namespace CarloNicora\Minimalism\Services\ResourceBuilder;

use CarloNicora\JsonApi\Document;
use CarloNicora\JsonApi\Objects\ResourceObject;
use CarloNicora\Minimalism\Abstracts\AbstractService;
use CarloNicora\Minimalism\Interfaces\Cache\Enums\CacheType;
use CarloNicora\Minimalism\Interfaces\Cache\Interfaces\CacheBuilderInterface;
use CarloNicora\Minimalism\Interfaces\Cache\Interfaces\CacheInterface;
use CarloNicora\Minimalism\Services\ResourceBuilder\Interfaces\ResourceableDataInterface;
use CarloNicora\Minimalism\Services\ResourceBuilder\Interfaces\ResourceBuilderInterface;
use CarloNicora\Minimalism\Services\ResourceBuilder\Interfaces\ResourceListBuilderInterface;
use Exception;

class ResourceBuilder extends AbstractService
{
    /**
     * @param CacheInterface|null $cache
     */
    public function __construct(
        private ?CacheInterface $cache=null,
    )
    {
        if (!$this->cache->useCaching()){
            $this->cache = null;
        }
    }

    /**
     * @param string $builderClass
     * @param ResourceableDataInterface[] $data
     * @param CacheBuilderInterface|null $cacheBuilder
     * @return ResourceObject[]
     * @throws Exception
     */
    public function buildResources(
        string $builderClass,
        array $data,
        ?CacheBuilderInterface $cacheBuilder=null,
    ): array
    {
        $response = null;
        if ($this->cache !== null && $cacheBuilder !== null && ($response = $this->cache->read($cacheBuilder, CacheType::Json)) !== null){
            $response = unserialize($response, [true]);
        }

        if ($response === null){
            /** @var ResourceBuilderInterface $resourceBuilder */
            $resourceBuilder = $this->objectFactory->create($builderClass);

            $response = $resourceBuilder->buildResources(data: $data);

            if ($this->cache !== null && $cacheBuilder !== null) {
                $this->cache->save($cacheBuilder, serialize($response), CacheType::Json);
            }
        }

        return $response;
    }

    /**
     * @param string $builderClass
     * @param ResourceableDataInterface $data
     * @param CacheBuilderInterface|null $cacheBuilder
     * @return ResourceObject
     * @throws Exception
     */
    public function buildResource(
        string $builderClass,
        ResourceableDataInterface $data,
        ?CacheBuilderInterface $cacheBuilder=null,
    ): ResourceObject
    {
        $response = null;

        if ($this->cache !== null && $cacheBuilder !== null && ($response = $this->cache->read($cacheBuilder, CacheType::Json)) !== null){
            $response = unserialize($response, [true]);
        }

        if ($response === null) {
            /** @var ResourceBuilderInterface $resourceBuilder */
            $resourceBuilder = $this->objectFactory->create($builderClass);
            $response = $resourceBuilder->buildResource(data: $data);

            if ($this->cache !== null && $cacheBuilder !== null) {
                $this->cache->save($cacheBuilder, serialize($response), CacheType::Json);
            }
        }

        return $response;
    }

    /**
     * @param string $listBuilderClass
     * @param ResourceableDataInterface[] $data
     * @return Document
     * @throws Exception
     */
    public function buildResourceList(
        string $listBuilderClass,
        array $data
    ): Document
    {
        /** @var ResourceListBuilderInterface $listBuilder */
        $listBuilder = $this->objectFactory->create($listBuilderClass);

        return $listBuilder->buildResourceList($data);
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