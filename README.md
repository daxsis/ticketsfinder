# TicketsFinder
Tickets Finder application Laravel v6.4.1 / Vuejs 2.6.10

## Installation

1) Clone the repo:

    ```bash
    https://github.com/daxsis/ticketsfinder /path/to/application
    cd /path/to/application
    ```

2) Install Composer dependencies:

    ```bash
    composer install
    ```

3) Create and configure the .env file:

    ```bash
    cp .env.example .env
    nano .env
    ```

4) Generate an application key:

    ```bash
    php artisan key:generate
    ```

5) Migrate and seed the database:

    ```bash
    php artisan migrate --seed
    ```

6) Serve on localhost:8000:

    ```bash
    php artisan serve
    ```

## Documentation

### API Endpoints

``` bash
+--------+-----------+----------------------------------------------------------+----------------+-------------------------------------------------------------------+------------+    
| Domain | Method    | URI                                                      | Name           | Action                                                            | Middleware |    
+--------+-----------+----------------------------------------------------------+----------------+-------------------------------------------------------------------+------------+    
|        | GET|HEAD  | /                                                        |                | Closure                                                           | web        |    
|        | GET|HEAD  | api/airlines                                             | airlines.index | App\Http\Controllers\AirlineController@index                      | api        |    
|        | GET|HEAD  | api/airlines/{airline}                                   | airlines.show  | App\Http\Controllers\AirlineController@show                       | api        |    
|        | GET|HEAD  | api/airports                                             | airports.index | App\Http\Controllers\AirportController@index                      | api        |    
|        | GET|HEAD  | api/airports/{airport}                                   | airports.show  | App\Http\Controllers\AirportController@show                       | api        |    
|        | GET|HEAD  | api/flights                                              | flights.index  | App\Http\Controllers\FlightController@index                       | api        |    
|        | GET|HEAD  | api/flights/{flight}                                     | flights.show   | App\Http\Controllers\FlightController@show                        | api        |    
|        | POST      | api/trips                                                | trips.store    | App\Http\Controllers\TripController@store                         | api        |    
|        | GET|HEAD  | api/trips                                                | trips.index    | App\Http\Controllers\TripController@index                         | api        |    
|        | DELETE    | api/trips/{trip}                                         | trips.destroy  | App\Http\Controllers\TripController@destroy                       | api        |    
|        | PUT|PATCH | api/trips/{trip}                                         | trips.update   | App\Http\Controllers\TripController@update                        | api        |    
|        | GET|HEAD  | api/trips/{trip}                                         | trips.show     | App\Http\Controllers\TripController@show                          | api        |    
+--------+-----------+----------------------------------------------------------+----------------+-------------------------------------------------------------------+------------+    
```

### Example Requests

* Fetches all airports with the given query parameters. Parameters chained with `&`

    ``` bash
    GET /api/airports?[Parameters]
    ```

    Parameter | Value |
    --- | --- |
    city= | `Montreal`|
    icao= | `CYUL` |
    name= | `Trudeau` |
    region= | `Quebec`|

* Fetches all flights with the given query parameters. Parameters chained with `&`

    ```bash
    GET /api/flights?[Parameters]
    ```

    Parameter | Value |
    --- | --- |
    departure= | `Montreal` |
    arrival= | `Toronto` |
    icao_from= | `YUL` |
    icao_to= | `YZD` |
    date= | `2019-12-25` |
    airline= | `Air Canada` |
    
* Fetches all trips stored in the databse

    ```bash
    GET /api/trips
    ```
    
* Generates a new trip and returnes $tripUid

    ```bash
    POST /api/trips
    ```
* References flights objects given in the body of the request to the $tripUid

    ```bash
    PUT /api/trips/{$tripUid}
    ```
* Fetches all flights for the trip with $tripUid

    ```bash
    GET /api/trips/{$tripUid}
    ```
* Removes the trip with $tripUid and dataches all of its flights from pivot table

    ```bash
    DELETE /api/trips/{$tripUid}
    ```

## Notes

### External data sources

Two external sources were used in order to seed the table.
File are included in the repository under `/storage/app/test_data`.

* [mwgg/Airports](https://github.com/mwgg/Airports) - A JSON database of 28k+ airports with ICAO/IATA codes, names, cities, two-letter country identifiers, elevation, latitude & longitude, and a timezone identifier 
* [npow/airline-codes](https://github.com/npow/airline-codes/blob/master/airlines.json) - An NPM module containing airline codes (IATA) and other information

### Database Seeding

When you run `php artisan migrate --seed`, Laravel will run two seeder classes:

* `AirlinesTableSeeder` - read the data from `airlines.json`
* `AirportsTableSeeder` - reads data from `airports.json`
* `FlightsSeeder` - uses seeded cities and airlines to generate 500 flights

Flights are generated for all Canadian airports from the moment of the generation up to 1 year

### Application contains Laravel/Telescope for easy monitoring during the develoment. It can be access be `/telescope`
