# TG project

[![Open Source Love](https://badges.frapsoft.com/os/v2/open-source.png?v=103)](https://github.com/ellerbrock/open-source-badges/) [![MIT Licence](https://badges.frapsoft.com/os/mit/mit.png?v=103)](https://opensource.org/licenses/mit-license.php)


## Introduction

This project aims to establish a **"bridge"** between small / medium sized companies with **free software** professionals. In this way, if the company needs support, training or some service for **free software**, then it will have **"a place"** to find such resources.

<hr>

## Profiles types

  * User:
This type of profile is enabled to create a summary of its characteristics, that is, you can edit the following sections:
      * About
      * Experience
      * Education
      * Skills

&nbsp;&nbsp;In this way, the **user** will expose their knowledge, being able to be more **attractive** to the companies.

* Company:
This type of profile will also be enabled to create a summary, but in a way more appropriate for your needs.

* Admin
Similar to the **user**, but with access to the administrative panel of the project, where it will be possible to obtain and edit various information (either on other **users**, or on specific pages, such as **frequently asked questions**, and others)

## How install

1 - Clone this repository "git clone https://github.com/chsjr1996/project_tg.git";

2 - Enter the command line inside the created directory **"project_tg"**;

3 - Install dependencies with **"composer install"**;

4 - Copy **".env.example"** file and change name of your copy to **".env"**;

5 - Configure ".env" file defining the environment variables below:

- DB_CONNECTION
- DB_HOST
- DB_PORT
- DB_DATABASE
- DB_USERNAME
- DB_PASSWORD

**OBS:** The configuration can vary according to the chosen DBMS, being they sqlite, mysql, pgsql or sqlsrv.

6 - Generate app key with **"php artisan key:generate"** (this key will be inserted in **".env"** file);

7 - Make the default tables with **"php artisan migrate"**;

8 - If you use Linux change the permissions of the **"storage"** directory with **"chmod -R 777 storage"**;

9 - Lastly, seed the **"UserType"** table with **"php artisan db:seed --class=UsersTypeTableSeeder"**;

Ready, the project is set up and can now be used. Remember that to compile sass files into **"resources"**, you must install **"node_modules"**, in this case use **"npm install"** and execute the command **"npm run watch"**.

---

## Under development

The project is still under development, there are still more modules to be included, besides visual modifications, creation of name / logo among others. Soon it will be created a list to determine the steps necessary for completion.



