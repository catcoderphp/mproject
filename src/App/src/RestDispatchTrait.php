<?php
declare(strict_types=1);

namespace App;

use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Zend\Diactoros\Response\JsonResponse;
use Zend\Expressive\Hal\HalResponseFactory;
use Zend\Expressive\Hal\ResourceGenerator;
use Zend\Expressive\Hal\ResourceGenerator\Exception\OutOfBoundsException;

trait RestDispatchTrait
{
    /**
     * @var ResourceGenerator
     */
    private $resourceGenerator;

    /**
     * @var HalResponseFactory
     */
    private $responseFactory;

    /**
     * Proxies to method named after lowercase HTTP method, if present.
     *
     * Otherwise, returns an empty 501 response.
     *
     * {@inheritDoc}
     *
     * @throws Exception\MethodNotAllowedException if no matching method is found.
     */
    public function handle(ServerRequestInterface $request) : ResponseInterface
    {
        $method = strtolower($request->getMethod());
        if (method_exists($this, $method)) {
            return $this->$method($request);
        }
        throw Exception\MethodNotAllowedException::create(sprintf(
            'Method %s is not implemented for the requested resource',
            strtoupper($method)
        ));
    }

    /**
     * Create a HAL response from the given $instance, based on the incoming $request.
     *
     * @param object $instance
     * @throws Exception\OutOfBoundsException if an `OutOfBoundsException` is
     *     thrown by the response factory and/or resource generator.
     */
    private function createResponse(ServerRequestInterface $request, $instance): ResponseInterface
    {
        try {
            $resource = $this->resourceGenerator->fromObject($instance, $request);
            return $this->responseFactory->createResponse(
                $request,
                $resource
            );
        } catch (OutOfBoundsException $e) {
            throw Exception\OutOfBoundsException::create($e->getMessage());
        }
    }

    /**
     * Create a HAL response from the given $array, based on the incoming $request.
     *
     * @param array $data
     * @throws \App\Exception\OutOfBoundsException if an `OutOfBoundsException` is
     *     thrown by the response factory and/or resource generator.
     */
    private function createResponseByArray(ServerRequestInterface $request, $data) : ResponseInterface
    {
        try {
            $resource = $this->resourceGenerator->fromArray($data);
            return $this->responseFactory->createResponse($request, $resource);
        } catch (OutOfBoundsException $exception) {
            throw OutOfBoundsException::create($exception);
        }
    }

    private function createResponseByJsonObject($data, $headers = [], $statusCode = 200) : JsonResponse
    {
        try {
            $jsonObject = new JsonResponse($data, $statusCode, $headers);
            return $jsonObject;
        } catch (OutOfBoundsException $exception) {
            throw OutOfBoundsException::create($exception);
        }
    }
}
