# wd-rest
REST service converts numbers to words. Uses Lumen framework for routing.

## Requirements
Minimum PHP version is 7.4 (default 8.0)

## Setup

```
//Clonning project
$ git clone https://github.com/olvinize/wd-rest.git

//Starting docker containers
$ docker-compose -f wd-rest/docker/docker-compose.yml up -d

//Installing composer dependencies to wd/php-app container
$ docker exec -it <wd/php-app container name or id> composer install --no-dev
```

To test service, open in browser

```
http://localhost:81/?lang=eng&n=121
```

## Service parameters
Service requires two mandatory params:
* lang - language to transform the number. Accepted values: lat, eng
* n - number to transform. Accepted value from 0 to 9999

Requests examples
```
http://localhost:81/?lang=eng&n=121 (outputs 'one hundred twenty-one')
http://localhost:81/?lang=lat&n=9876 (outputs 'deviņi tūkstoši astoņi simti septiņdesmit seši')
http://localhost:81/ (outputs '')
```

Passing none or incorrect  parameters, will display empty string. 

## Project structure
* code - actual project code
  * app/Models - contains transformation models to latvian and english
  * routes/web.php - default routing
* docker - docker configuration
  * docker/.env - docker containers customization file

## Docker configuration
Docker can be customized through docker/.env file. Accepts following arguments:
* PROXY_PORT - change browser port, if 80 is busy (default 81)
* PHP_VERSION - php version to use. Minimum supported version is 7.4 (default 8.0)
* TZ - container timezone (default Europe/Riga)