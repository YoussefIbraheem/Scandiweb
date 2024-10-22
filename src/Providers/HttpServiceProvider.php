<?php

namespace App\Providers;

use Psr\Http\Message;
use GuzzleHttp\Psr7 as Guzzle;
use League\Container\ServiceProvider\AbstractServiceProvider;
use League\Container\Argument\ResolvableArgument;

class HttpServiceProvider extends AbstractServiceProvider
{
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
