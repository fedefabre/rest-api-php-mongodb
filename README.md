# REST web service API using PHP MongoDB and Slim Framework

To do List: List of task with due dates

This app allows you to create, update, delete, show, list and filter elements.
Easily you can download this repository and use the structure to starts your own REST project.

# Pre-requisites

- Install PHP 7.0 or later
- Install MongoDB and configure on localhost (anyway you can edit the code to connect it later).

# Install

- Download this repository
- Install 'composer' in your system (https://getcomposer.org/download/).
- In your terminal, Change Directory to the folder thats contains composer.json file
- Run 'composer.phar install'
  - composer.json contains all the dependencies names that the app need so when you run 'install' it automatically download and compile the files in a folder call 'vendor' 
- Thats all.

# Usage

index.php receive requirements and send responses.
The app use get and post HTTP methods to execute functions and show info.

It starts on localhost/ and redirect to localhost/list where show all the tasks to do listing on a table with a limit of five elements.
The app automatically paginate the content to show always a maximum of 5 elements.

When you use filters and functions like create, show, edit and remove the app use an object called mongo that is an instance of the Class dbHandler. 
The methods of this allows to communicate the information of the http requirement with de mongodb database.

# Test now

It's located on one of my websites. Check it now: https://arlanding.com

If you want to know more about my work, check my resume: https://federicofabre.com


