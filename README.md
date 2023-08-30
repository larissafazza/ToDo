<p align="center"></p>
<h3 align="left">
# ToDo Project
  This project is basically an app of what a to-do list manager project should look like. It was made to be an objective, clean and an easy tool that can be used by anyone to organize their tasks.

##### Used tools and programming languages: 
* Laravel 8;
* JSON PHP Extension + Database (MySQL, SQLite) + Web server (Apache) - recomended: download the development environment through Xampp.
* Correct configuration o the environment variables on the machine (composer, npm, mysql e php).
Composer
* PHP: * Version >= 8.2.6
* OpenSSL PHP Extension 
* PDO PHP Extension 
* Composer.
* Node.

##### Step by step:
1. Clone the repository on your computer;
2. Inside the main folder of the project, create the .env file; 
3. Edit your .env file to your correct information on the database and mail configurations to your ocal information (the mail can be used through mailtrap for testing, it's a highly recommended tool);
4. Access the repository path on your prompt and execute: composer install;
5. Run the composer dump-autoload command
6. Then, still on the prompt, generate an application key running the command: php artisan key:generate;
7. Then, run the migrations using: php artisan migrate --seed (the --seed flag runs the laravel database seeder. In this project, it was used to generate the João user profile ("email" => joao@gmail.com, "password" => "12345678") and 5 tasks to help run some manual tests.
8. To run the autmatic tests, run the command php artisan test, it will test the get and the store method for the users and the to-dos requests.
9. At last, para execute the project, run the command: php artisan serve and access the url on the prompt.

#### Development 

* This project was developed using mainly the Laravel framework and its tools were used to help build a clean and organized project. The front end was made using html, css, javascript and Bootstrap as base for the project.

#### Developed by Larissa Rezende Fazza ####
