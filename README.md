Quick how to:

1. Open a Windows command window

2. Change directory to your Symfony folder

3. Download the source code from the repo
    git clone https://github.com/amenabe/docman.git
    https://github.com/amenabe/docman/archive/refs/heads/main.zip

4. Change directory to the downloaded source code
    cd docman

5. Open the docman folder in Visual Studio Code

7. From Visual Studio Code main menu, start a terminal
    View->Terminal

8. Create the docman database by running the following commands
    php bin/console make:migration
    php bin/console doctrine:migrations:migrate

9. Start the web server on port 8000 using any one of the following options
    Option 1: Using the integrated server in Symfony, run the following command
               symfony serve
   
    Option 2: Using php, run the following command
               php -S localhost:8000

    Option 3: Using any other server (nginx, apache, etc) as long as it's listening on port 8000


Miles


        
