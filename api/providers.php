<?php

use Doctrine\ORM\EntityManager;
use CrEOF\Spatial\PHP\Types\Geography\Point;
use Domain\Provider;

define('API_ENDPOINT_PROVIDERS', '/providers');
define('API_ENDPOINT_PROVIDERS_ARG_ID', 'id');

app()->get(API_ENDPOINT_PROVIDERS, function ($request, $response, $args) {
	$repository = em()->getRepository(Provider::class);

	$providers = $repository->search(
		$request->getQueryParam('service', null),
		$request->getQueryParam('name', null),
		$request->getQueryParam('limit', 20),
		$request->getQueryParam('offset', 0)
	);


	return $response->withJson($providers, 200);
});

app()->get(API_ENDPOINT_PROVIDERS . sprintf("/{%s}", API_ENDPOINT_PROVIDERS_ARG_ID), function ($request, $response, $args) {
	$provider = em()->getRepository(Provider::class)->findOneById($args[API_ENDPOINT_PROVIDERS_ARG_ID]);

	if (!$provider) {
		return $response->withStatus(400)->withBody('Provider was not found.');
	} else {
		return $response->withJson($provider, 200);
	}
});

app()->post(API_ENDPOINT_PROVIDERS, function ($request, $response, $args) {
	$providerFields = $request->getParsedBody();

	$provider = new Provider(
		$providerFields['contact'],
		$providerFields['service']
	);

	$em = container()[EntityManager::class];
	$em->persist($provider);
	$em->flush();

	return $response->withJson($provider, 201);
});

app()->put(API_ENDPOINT_PROVIDERS . sprintf("/{%s}", API_ENDPOINT_PROVIDERS_ARG_ID), function ($request, $response, $args) {
	$provider = em()->getRepository(Provider::class)->findOneById($args[API_ENDPOINT_PROVIDERS_ARG_ID]);

    if (!$provider) {
		return $response->withStatus(400);
	} else {
		$providerFields = $request->getParsedBody();
		
		if (isset($providerFields['contact'])) {
			$provider->setContact($providerFields['contact']);
		}
		if (isset($providerFields['service'])) {
			$provider->setService($providerFields['service']);
		}

		em()->persist($provider);
		em()->flush();
		
		return $response->withJson($provider, 200);
	}
});

app()->delete(API_ENDPOINT_PROVIDERS . sprintf("/{%s}", API_ENDPOINT_PROVIDERS_ARG_ID), function ($request, $response, $args) {
	$provider = em()->getRepository(Provider::class)->findOneById($args[API_ENDPOINT_PROVIDERS_ARG_ID]);

    if (!$provider) {
		return $response->withStatus(400);
	}
    
    em()->remove($provider);
    em()->flush();

    return $response->withStatus(200);
});
