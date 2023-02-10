# OurMarket.com(Web Development-1)

This application is a web-based ads platform that utilizes the following technologies:
- NGINX webserver
- PHP 8.1 
- MariaDB (GPL MySQL fork)
- PHPMyAdmin

**Note:** Because of the PHP version 8.1, it was unable to be hosted on 000webhosting.com.

## Features
- The homepage of the application displays available ads and allows both logged in and non-logged in users to access them, sorted by recent dates.
- Users can register for the application by using the signup page.
- Only logged in users have access to the "My Ads" page, which allows them to perform CRUD operations on ad posts, including editing, marking as sold, and deleting.
- There is a Search bar also where products can be searched in the entire database.
- The application also includes four local APIs for editing, creating, deleting and searching products, and a shopping cart feature for purchasing them. 
- The application use the Argon2 for password hashing and verifying.
- The application includes a script to automatically create the MySQL database, but in case that doesn't work, a file is provided that can be imported.
- In case the database creating while creating dabase doesznot work a file is provied which can be imported
- The application is designed to make it easy and user-friendly.

## Running the Application
 **Note:** docker-compose down -v to delete al the volume of the containers and set it again
To run the application, use the command:
```bash
docker-compose down -v
docker-compose up
```
after docker is composed  open http://localhost/home/myAds 

## Test Users
Two test users have been provided with the following credentials:
#### - First User- Test
email:
```bash
test@inholland.nl
```
password:
```bash
Secret123
```
---------------------------------------
#### - Second User- Bijay
- email:
```bash
bijay@inholland.nl
```
password:
```bash
Developer123
```
