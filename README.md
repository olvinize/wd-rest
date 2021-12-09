# wd-rest
REST service converts numbers to words

## Installation

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
