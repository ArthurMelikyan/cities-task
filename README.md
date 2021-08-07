## Installation

clone this repository
```sh
git clone https://github.com/ArthurMelikyan/cities-weather-task.git
cd cities-weather-task
```
Install the dependencies 
```sh
 npm install
 composer install
 npm run prod
```

rename .env.example to .env  and setup database name and password
```sh
 php artisan migrate
```
Api settings.Put your api keys on .env file
```sh
GOOGLE_PLACES_API_KEY=
WEATHER_API_KEY=
```
