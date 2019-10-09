<?php

use Twig\Loader\FilesystemLoader;
use Twig\Environment;
use Doctrine\Common\Annotations\AnnotationRegistry;
use Doctrine\ODM\MongoDB\Configuration;
use Doctrine\ODM\MongoDB\DocumentManager;
use Doctrine\ODM\MongoDB\Mapping\Driver\AnnotationDriver;
use MongoDB\Client;

$container->set('document_manager', function () use ($loader) {
    $loader->add('Documents', __DIR__);

    AnnotationRegistry::registerLoader([$loader, 'loadClass']);

    $config = new Configuration();
    $config->setProxyDir(__DIR__ . '/Proxies');
    $config->setProxyNamespace('App\Proxies');
    $config->setHydratorDir(__DIR__ . '/Hydrators');
    $config->setHydratorNamespace('App\Hydrators');
    $config->setDefaultDB('fakers');
    $config->setMetadataDriverImpl(AnnotationDriver::create(__DIR__ . '/Model'));

    $client = new Client('mongodb://fakers_data', [], ['typeMap' => DocumentManager::CLIENT_TYPEMAP]);

    return DocumentManager::create($client, $config);
});

$container->set('view', function () {
    $twigLoader = new FilesystemLoader(__DIR__ . '/Views');
    return new Environment($twigLoader, ['cache' => __DIR__ . '/../cache']);
});

$container->set('session', function () {
    return new SlimSession\Helper();
});

$container->set('uri', function () {
    return new App\Helper\Uri($_SERVER);
});
