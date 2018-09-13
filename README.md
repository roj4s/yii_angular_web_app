# Simple Microservice Architecture based Web App (Yii2 REST API + Angular 2 + Docker)

Technologies employed:
  * Yii2 for providing RESTful API and for DB migrations
  * Angular 4 
  * Bootstrap Sass
  * Wallmart Free Api
  * Docker


Requirements:
  * Docker

How to execute:
  * If you have mysql-server installed please stop its service with: service mysql stop
  * Once you've cloned this repository locally with git clone execute: docker-compose up to start the necessary images 
  * Once all containers are up and built execute the init script inside de backend container. Such script run migrations to create Db schema 
and populates tables with data from the Wallmart Free Api. 
  * To run init script you need to open a console inside the backed container with: docker exec -it fpftest_backend_1 /bin/bash
  * Once inside the backend container execute the init script with  ./init
  
If all the previous steps for set up went well youll be able to access the front-end app through localhost:4200 and the rest api through localhost:4201.
Please reach me through call or whatspp (92 982114961) if you find too much trouble to execute this project.

Thanks in advance. 
