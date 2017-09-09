# REST web service API using PHP MongoDB and Slim Framework

To do List: List of task with due dates

This app allows you to create, update, delete, show, list and filter elements.
Easily you can download this repository and use the structure to starts your own REST project.

# Pre-requisites

- Install PHP 7.0 or later
- Install MongoDB and configure it in localhost (anyway, you can edit the code to connect it later).

# Install

- Download this repository
- Install 'composer' in your system (https://getcomposer.org/download/).
- In your terminal, Change Directory to the folder which contains composer.json file
- Run 'composer.phar install'
  - composer.json contains all the dependencies names that the app needs. Therefore, when you run 'install' it automatically downloads and compiles the files into a folder call 'vendor' 
- That's all.

# Usage

index.php receives requirements and sends responses.
The app use HTTP Get and Post's methods to execute functions and show info.

It starts on localhost/ and redirects to localhost/list, where it shows all the tasks to do listed on a table with a limit of five elements.
The app automatically paginate the content to show always a maximum of 5 elements.

When you use filters and functions such as create, show, edit and remove, the app uses an object called mongo which is an instance of dbHandler's class.
Mongo's methods allow to communicate the information of http requirement with mongodb database.

# Test now

It's located in one of my websites. Check it now: https://arlanding.com

If you want to know more about my work, visit my resume: https://federicofabre.com
