# Quick How-To

## A. Install PHP

### 1. At least PHP version 8.5
### 2. The php.ini must have the following uncommented:
```
        extension=openssl
        extension=pdo_sqlite
```
## B. Install Composer

## C. Install Symfony CLI

## D. Install Git

## E. Install Visual Studio Code

## F. Get the source code from the Github repository

    1. Open a Powershell, DOS Command or Terminal window


    2. Change directory to your Symfony projects folder


    3. Download the source code from the repo using the command

        git clone https://github.com/amenabe/docman.git


    4. Change directory to the downloaded source code

        cd docman


    5. Open the docman folder in Visual Studio Code

        code .


    6. From Visual Studio Code main menu, start a terminal

        View->Terminal


    7. From the Terminal, execute the following:

        composer require symfony/orm-pack

        composer require --dev symfony/maker-bundle

        symfony make:migration

        php bin/console make:migration

        php bin/console doctrine:migrations:migrate


    8. Start Symfony's built-in web server on port 8000

        Localhost only:

            symfony serve

            
        External hosts in addition to localhost:

            symfony serve --allow-all-ip




        
