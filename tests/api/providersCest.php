<?php 

use CrEOF\Spatial\PHP\Types\Geography\Point;
use Doctrine\ORM\EntityManager;
use Domain\Provider;

class providersCest
{
    private $providers;

    private function createProviders(ApiTester $I)
    {
    	$this->providers = [
    		new Provider(
    			['name' => 'Alaa Sarhan', 'email' => 'sarhan.alaa@gmail.com'],
    			['name' => 'Web Development', 'description' => 'blah blah']
    		),
    		new Provider(
    			['name' => 'Majd Sarhan', 'email' => 'majd.sarhan1990@gmail.com'],
    			['name' => 'Business Development', 'description' => 'blah']
    		),
    		new Provider(
    			['name' => 'Anas Sarhan', 'email' => 'anas.sarhan@gmail.com'],
    			['name' => 'Accounting', 'description' => 'blahhhhh']
    		)
    	];

    	foreach ($this->providers as $provider) {
    		$I->persistEntity($provider);
    	}
    }

    /**
     * @before createProviders
     */
    public function tryToRetrieveProviders(ApiTester $I)
    {
    	$I->sendGET('/providers');

    	$I->seeResponseContainsJson([
    		[
    			'contact' => [
    				'name' => 'Alaa Sarhan',
    				'email' => 'sarhan.alaa@gmail.com'
    			],
    			'service' => [
    				'name' => 'Web Development',
    				'description' => 'blah blah'
    			]
    		],
    		[
    			'contact' => [
    				'name' => 'Majd Sarhan',
    				'email' => 'majd.sarhan1990@gmail.com'
    			],
    			'service' => [
    				'name' => 'Business Development',
    				'description' => 'blah'
    			]
    		],
    		[
    			'contact' => [
    				'name' => 'Anas Sarhan',
    				'email' => 'anas.sarhan@gmail.com'
    			],
    			'service' => [
    				'name' => 'Accounting',
    				'description' => 'blahhhhh'
    			]
    		]
    	]);
    }

    /**
     * @before createProviders
     */
    public function tryToRetrieveProvider(ApiTester $I)
    {
        $I->sendGet('/providers/' . $this->providers[0]->getId());

        $I->seeResponseIsJson([
            'contact' => [
                'name' => 'Alaa Sarhan',
                'email' => 'sarhan.alaa@gmail.com'
            ],
            'service' => [
                'name' => 'Web Development',
                'description' => 'blah blah'
            ]
        ]);
    }

    public function tryToCreateProvider(ApiTester $I)
    {
        $recordFields = [
            'contact' => [
                'name' => 'Alaa Sarhan',
                'email' => 'sarhan.alaa@gmail.com'
            ],
            'service' => [
                'name' => 'Web Development',
                'description' => 'blah blah'
            ]
        ];

        $I->sendPost('/providers', $recordFields);
        $I->seeResponseContainsJson($recordFields);
        $I->seeResponseCodeIs(201);
    }

    /**
     * @before createProviders
     */
    public function tryToUpdaeProvider(ApiTester $I)
    {
        $recordFields = [
            'id' => $this->providers[0]->getId(),
            'contact' => [
                'name' => 'Alaa Sarhan 2',
                'email' => 'sarhan.alaa2@gmail.com'
            ],
            'service' => [
                'name' => 'Web Development 2',
                'description' => 'blah blah blah 2'
            ]
        ];

        $I->sendPut('/providers/' . $this->providers[0]->getId(), $recordFields);

        $I->seeResponseContainsJson($recordFields);
        $I->seeResponseCodeIs(200);
    }

    /**
     * @before createProviders
     */
    public function tryToDeleteProvider(ApiTester $I)
    {
        $I->sendDelete('/providers/' . $this->providers[0]->getId());

        $I->dontSeeInRepository(Provider::class, [
            'id' => $this->providers[0]->getId()
        ]);
        $I->seeResponseCodeIs(200);
    }
}
