<?php

namespace App\Providers;

use Psr\Http\Message;
use GuzzleHttp\Psr7 as Guzzle;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\Argument\ResolvableArgument;

/**
 * Class HttpServiceProvider
 *
 * Registers HTTP-related services with the container.
 *
 * This service provider integrates various HTTP message factories from
 * the Guzzle library into the League container, allowing for easy
 * management and instantiation of HTTP request and response objects.
 *
 * @package App\Providers
 */
class HttpServiceProvider extends AbstractServiceProvider
{
    /**
     * Determines if the provider can provide the specified service.
     *
     * @param string $id The service identifier.
     * 
     * @return bool True if the service can be provided, false otherwise.
     */
    public function provides(string $id): bool
    {
        $services = [
            Message\ServerRequestInterface::class,
            'http.factory',
            Message\RequestFactoryInterface::class,
            Message\ResponseFactoryInterface::class,
            Message\ServerRequestFactoryInterface::class,
            Message\StreamFactoryInterface::class,
            Message\UploadedFileFactoryInterface::class,
            Message\UriFactoryInterface::class,
        ];

        return in_array($id, $services);
    }

    /**
     * Registers the HTTP services in the container.
     *
     * This method defines the shared services for handling HTTP messages
     * and requests, utilizing Guzzle's HTTP factory.
     */
    public function register(): void
    {
        $container = $this->getContainer();

        $container->addShared(Message\ServerRequestInterface::class, fn() => Guzzle\ServerRequest::fromGlobals());
        $container->addShared('http.factory', Guzzle\HttpFactory::class);
        $container->addShared(Message\RequestFactoryInterface::class, new ResolvableArgument('http.factory'));
        $container->addShared(Message\ResponseFactoryInterface::class, new ResolvableArgument('http.factory'));
        $container->addShared(Message\ServerRequestFactoryInterface::class, new ResolvableArgument('http.factory'));
        $container->addShared(Message\StreamFactoryInterface::class, new ResolvableArgument('http.factory'));
        $container->addShared(Message\UploadedFileFactoryInterface::class, new ResolvableArgument('http.factory'));
        $container->addShared(Message\UriFactoryInterface::class, new ResolvableArgument('http.factory'));
    }
}
