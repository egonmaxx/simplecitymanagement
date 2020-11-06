#Clone the project

* git clone https://github.com/egonmaxx/simplecitymanagement.git

#Create a docker image and a container

* docker-compose up --build

#Install composer packages

* docker exec -ti simplecitymanagement_app_1 bash
* composer install
* exit

#create an dotenv file

* cp env.example .env

#Migrations

* docker exec -ti simplecitymanagement_app_1 bash
* ./vendor/bin/phpmig status (check status of migration files)
* ./vendor/bin/phpmig migrate (run migration)
* exit

#Try the applicaton

* Type http://localhost:8080 into you browser seach field
