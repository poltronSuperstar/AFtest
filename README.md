# WeatherProductRecommender (AF test)
## Avant propos
### Ce que j'aurais fait avec plus de temps
* Docstrings à foison
* Plus de granularité, des cas limites dans les TUs

## Conventions
### Commentaires
Je commente tout en anglais, même dans mes projets persos.
Deux exceptions:
* des `TODO` ou `FIXME` de court terme que je m'adresse à moi même (quand c'est en français, je sais que c'est prioritaire)
* Quand je m'adresse sans ambiguité (et de manière future-proof) à des francophones, par exemple dans le cadre d'un test technique. (J'annoterai le code de `//Note: ...` pour preciser les raccourcis que je n'aurais pas pris si j'avais eu plus de temps)

_Du coup ne vous offuquez pas si certains commentaires sont en français, je ne ferais pas ça en prod_

### git flow
Par pur souci de commodité, je ferai tout sur la branch `main` parce que c'est un test technique (pareil, je fais pas ça en prod !)

## Log
Je consignerai ici toutes les étapes en expliquant les raisons de ce que je ferai (juste parce que ça m'a l'air un peu plus agreable qu'un git log)

### Init project 

#### SF project init
```zsh
composer create-project symfony/skeleton
```

#### Add deps
```zsh
composer require --dev symfony/phpunit-bridge
composer require --dev symfony/browser-kit 
```

### Plannification, Archi, écriture de tests
#### API Specs
##### Parti pris
###### **GET** ou **POST**
Je vois plusieurs manières d'interpreter la partie suivante:

> Exemples de requêtes possible

`{ weather : { city : “Paris” }}`

> ou

`{ weather : { city : “Marseille” }, date: “tomorrow”}`

* **1** Le client veut du POST avec un body JSON
* **2** Le client donne un example des params que peut contenir une requete, sans attachement particulier au fait que ce soit du JSON ou du POST (note:dans l'absolu les RFC autorisent un body JSON pour les requetes GET)

J'opterai pour l'interepretation **1** car:
* C'est RESTful, ça resprecte la sémantique des verbes HTTP
* L'example n'est pas exactement en JSON

###### **hot**, **cold** et futureproofness

L'approche la plus naïve consisterait en
```javascript
if($temperature < 10)
    $repository->getAllByType('pull')
...
```

Ce qui fait beaucoup de valeurs magiques.

En general je discuterais avec le client pour définir des besoins et des specs.

En l'occurence, ce qui me parrait pertinent:
* **1** Considérer que mapper la temperature à `cold`, `mild` et `hot` est de la logique métier et doit être dans un service
* **2** Pour éviter des rigidités futures, le model `Product` aura un attribut `forWeather`
* **3** Clean hexagonal overall 

#### Project arbo
##### Directories
```zsh
mkdir -p config/packages 
mkdir -p src/{Application/Service,Domain/{Model,Port,ValueObject},Infrastructure/{Repository,Weather}} 
mkdir -p tests/{Application/Service,Domain/{Model,ValueObject},Infrastructure/{Repository,Weather},Controller}
```

###### Files
```zsh
touch .env
touch README.md
touch config/packages/doctrine.yaml
touch config/services.yaml
touch src/Application/Service/ProductRecommendationService.php
touch src/Domain/Model/Product.php
touch src/Domain/Port/ProductRepositoryPort.php
touch src/Domain/Port/WeatherFetcherPort.php
touch src/Domain/ValueObject/WeatherCondition.php
touch src/Infrastructure/Repository/ProductRepository.php
touch src/Infrastructure/Weather/WeatherApiClient.php
touch tests/Application/Service/ProductRecommendationServiceTest.php
touch tests/Domain/Model/ProductTest.php
touch tests/Domain/ValueObject/WeatherConditionTest.php
touch tests/Infrastructure/Repository/ProductRepositoryTest.php
touch tests/Infrastructure/Weather/WeatherApiClientTest.php
touch tests/Controller/ProductRecommendationControllerTest.php
touch src/Controller/ProductRecommendationController.php
```

#### Creation d'un namespace racine
`composer.json`
```json
{    "autoload": {
        "psr-4": {
            "WeatherProductRecommender\\": "src/",
            "App\\":"src/"
        }
    },
    "autoload-dev": {
        "psr-4": {
            "WeatherProductRecommender\\Tests\\": "tests/",
            "App\\Tests\\": "tests/"


        }
    }
}```

### TDD all the things

#### Ecriture du premier test

* test de `ProductRecommendationController`

```php
<?php

namespace WeatherProductRecommender\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\HttpFoundation\Response;

class ProductRecommendationControllerTest extends WebTestCase
{
    public function testRecommendProductsEndpoint()
    {

        $this->assertEquals(1,1);
        $client = static::createClient();

        //FIXME: Faire fonctionner ça avec l'url relative
        $client->request(
            'GET',
            '/recommendations?city=Paris',
        );

   
        $this->assertResponseStatusCodeSame(Response::HTTP_OK);

        $responseContent = $client->getResponse()->getContent();
        $responseData = json_decode($responseContent, true);

        $this->assertArrayHasKey('products', $responseData);
        $this->assertArrayHasKey('weather', $responseData);
        $this->assertIsArray($responseData['products']);
        foreach ($responseData['products'] as $product) {
            $this->assertArrayHasKey('id', $product);
            $this->assertArrayHasKey('name', $product);
            $this->assertArrayHasKey('price', $product);
        }
        $this->assertEquals('Paris', $responseData['weather']['city']);
        $this->assertContains($responseData['weather']['is'], ['hot', 'mild', 'cold']);
    }
}
```
* Mock code pour passer le test en dur 

#### Test ValueObjects et Models
##### Ecriture du test pour `WeatherCondition`
