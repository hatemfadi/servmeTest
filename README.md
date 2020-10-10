# ServMe Test Exercise


## How to Run Application
```
docker-compose up -d
```
Set up should take up to 3 min depending on Internet Speed to download composer packages and seed data.

## Get user to authenticate
In order to test the APIs you need a user to authenticate
```
docker exec -it app php artisan servme:fetch-user
```
