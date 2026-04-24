# Description

This is a work in progress... no specific timeline.



# Quick How-To

## A. Install PHP
### &emsp;1. At least PHP version 8.5
### &emsp;2. The php.ini must have the following uncommented:
```
extension=openssl
extension=fileinfo
extension=pdo_sqlite
```
## B. Install Composer
## C. Install Symfony CLI
## D. Install Git
## E. Install Visual Studio Code
## F. Get the source code from the Github repository

### &emsp;&emsp;1. Open a Powershell, DOS Command or Terminal window
### &emsp;&emsp;2. Change directory to your Symfony projects folder
### &emsp;&emsp;3. Download the source code from the repo using the command
```
        git clone https://github.com/amenabe/docman.git
```

### &emsp;&emsp;4. Change directory to the downloaded source code
```
        cd docman
```

### &emsp;&emsp;5. Open the docman folder in Visual Studio Code
```
        code .
```

### &emsp;&emsp;6. From Visual Studio Code main menu, start a terminal
```
        Main Menu -> View -> Terminal
```

### &emsp;&emsp;7. From the Terminal, execute the following:
```
        composer require symfony/orm-pack
```
```
        composer require --dev symfony/maker-bundle
```

```
        symfony make:migration
```

```
        php bin/console make:migration
```

```
        php bin/console doctrine:migrations:migrate
```
### &emsp;&emsp;8. Start Symfony's built-in web server on port 8000
&emsp;&emsp;&emsp;&emsp;Web browser from localhost only:

```
        symfony serve
```
            
&emsp;&emsp;&emsp;&emsp;Web browsers from external hosts too:

```
        symfony serve --allow-all-ip
```

