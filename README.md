# Queue-RESTAPI-number-guesser
Web application tries to guess a number using a job in a queue many times by genereting a random number. It equals a genereted number and a number has configured. If number is not guessed the job returns to queue once again and it will be continued for a number of tries has configured. App uses RESTAPI to: direct it, input parameters, get result info, get log info.  (Used docker configuration info from user 'sagar290', thanks to him)

```
Default configurations:  
    Backoff = 0
    Tries = 100
    Guess number = 50
    Range start = 0
    Range end = 100
```

## Up the services
docker-compose up -d

## Go to the container
docker exec -it queue-restapi-number-guesser_app_1 bash

## Run inside the container
php artisan migrate  
cp .env.example .env

## HTTP requests to direct the app or them combinations:
* Start guessing a number which has configured by default with the others default configurations
```
GET http://localhost:80/api/app/start
Accept: application/json

###
```

* Start guessing a number which has configured in the request
```
GET http://localhost:80/api/app/start?guess_number=32
Accept: application/json

###
```

* Start guessing a number which has configured by default and using trial number's range
  from request
```
GET http://localhost:80/api/app/start?range[start]=0&range[end]=200
Accept: application/json

###
```
* Start guessing a number which has configured from request and trial number's range which has
  configured from request also
```
GET http://localhost:80/api/app/start?guess_number=32&range[start]=0&range[end]=200
Accept: application/json

###
```

* Start guessing a number which has configured from request and trial number's range which has
  configured from request also
```
GET http://localhost:80/api/app/start?guess_number=32&range[start]=0&range[end]=200
Accept: application/json

###
```

* Start guessing a number with tries, backoff, range which has configured and from request
```
GET http://localhost:80/api/app/start?tries=100&backoff=0&guess_number=32&range[start]=0&range[end]=200
Accept: application/json

###
```

* View the logs of all transactions
```
GET http://localhost:80/api/app/logs
Accept: application/json

###
```

* View the logs of tries for transaction 1652350657
```
GET http://localhost:80/api/app/logs?transaction=1652350657
Accept: application/json

###
```

* View the totals all transaction (Info about: was a number guessed or not, number of tries had made
  start, end time, spended time, used number's range, backoff and other params had inputed)
```
GET http://localhost:80/api/app/total
Accept: application/json

###
```
* Clear all the logs
```
GET http://localhost:80/api/app/logs/clear
Accept: application/json

###
```

## Down services if you are exit
docker-compose down  
