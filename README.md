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

##### Passo a passo:
1. Clone the repository on your computer;
2. Inside the main folder of the project, create the .env file; 
3. Edit your .env file to your correct information on the database and mail configurations to your ocal information (the mail can be used through mailtrap for testing, it's a highly recommended tool);
4. Access the repository path on your prompt and execute: composer install;
5. Then, still on the prompt, generate an application key running the command: php artisan key:generate;
6. Then, run the migrations using: php artisan migrate --seed (the --seed flag runs the laravel database seeder. In this project, it was used to generate the João user profile ("email" => joao@gmail.com, "password" => "12345678") and 5 tasks to help run the automatic tests.
7. At last, para execute the project, run the command: php artisan serve and access the url on the prompt.

#### Desenvolvimento 

* This project was developed using mainly the Laravel framework and javascript. The front end was made using html, css and javascript and Bootstrap as base for the project 
stylization.

#### Desenvolvido por Larissa Rezende Fazza ####
