<p align="center"><a href="https://laravel.com" target="_blank"><img src="https://raw.githubusercontent.com/laravel/art/master/logo-lockup/5%20SVG/2%20CMYK/1%20Full%20Color/laravel-logolockup-cmyk-red.svg" width="400"></a></p>

## Application

A simple Running Competitions Rest API, to register competitions, competitors and a start/end time to generate leaderboards.

## Tecnologies

This project was fully builded with **Laravel 6**, and Rest API endpoints were tested in **Postman** (collection file is attached). Remains to do: PHP Unit Tests and Docker File.

## Installation

*Clone this repository*
`git clone https://github.com/PauloAK/RunningCompetitionAPI.git`

*Access the folder*
`cd RunningCompetitionAPI`

*Install dependencies*
`composer install`

*Copy the example .env file*
`cp .env.example .env`

*Generate the application key*
`php artisan key:generate`

*Change bootstrap and storage folders permissions*
`chmod -R 777 storage bootstrap/cache`

*Configure database enviroment*
`php artisan migrate`

*Run the server*
`php artisan serve`

## Endpoints

### Competitions

**Index**
----
  Lists all competitions

* **URL**

  /api/competition

* **Method:**

  `GET`
  
*  **Params**

None

**Show**
----
  Show a competition

* **URL**

  /api/competition/:id

* **Method:**

  `GET`
  
*  **Params**

None

**Create**
----
  Create a new competition

* **URL**

  /api/competition

* **Method:**

  `POST`
  
*  **Params**

    * *type* | required | string | In: [3, 5, 10, 21, 42]
    * *date* | required | date

**Update**
----
  Update a competition

* **URL**

  /api/competition/:id

* **Method:**

  `POST`
  
*  **Params**

    * *type* | required | string | In: [3, 5, 10, 21, 42]
    * *date* | required | date

**Delete**
----
  Delete a competition

* **URL**

  /api/competition/:id

* **Method:**

  `DELETE`
  
*  **Params**

None


### Competitors

**Index**
----
  Lists all competitors

* **URL**

  /api/competitor

* **Method:**

  `GET`
  
*  **Params**

None

**Show**
----
  Show a competitor

* **URL**

  /api/competitor/:id

* **Method:**

  `GET`
  
*  **Params**

None

**Create**
----
  Create a new competitor

* **URL**

  /api/competitor

* **Method:**

  `POST`
  
*  **Params**

    * *name* | required | string
    * *cpf* | required | string
    * *birthdate*  | required | date

**Update**
----
  Update a competitor

* **URL**

  /api/competitor/:id

* **Method:**

  `POST`
  
*  **Params**

    * *name* | required | string
    * *cpf* | required | string
    * *birthdate*  | required | date

**Delete**
----
  Delete a competitor

* **URL**

  /api/competitor/:id

* **Method:**

  `DELETE`
  
*  **Params**

None


### Entries

**Index**
----
  Lists all entries

* **URL**

  /api/entry

* **Method:**

  `GET`
  
*  **Params**

None

**Show**
----
  Show a entry

* **URL**

  /api/entry/:id

* **Method:**

  `GET`
  
*  **Params**

None

**Create**
----
  Create a new entry

* **URL**

  /api/entry

* **Method:**

  `POST`
  
*  **Params**

    * *competitor_id* | required | int
    * *competition_id* | required | int
    * *start*  | optional | timestamp
    * *finish*  | optional | timestamp

**Update**
----
  Update a entry

* **URL**

  /api/entry/:id

* **Method:**

  `POST`
  
*  **Params**

    * *competitor_id* | required | int
    * *competition_id* | required | int
    * *start*  | optional | timestamp
    * *finish*  | optional | timestamp

**Delete**
----
  Delete a entry

* **URL**

  /api/entry/:id

* **Method:**

  `DELETE`
  
*  **Params**

None



### Leaderboards

**General**
----
  General leaderboard, grouped by competition type

* **URL**

  /api/leaderboard

* **Method:**

  `GET`
  
*  **Params**

None

**Competition**
----
  Single competition leaderboard

* **URL**

  /api/leaderboard/competition/:id

* **Method:**

  `GET`
  
*  **Params**

None

**Age**
----
  General leaderboard, grouped by competitors age range

* **URL**

  /api/leaderboard/age

* **Method:**

  `GET`
  
*  **Params**

None
