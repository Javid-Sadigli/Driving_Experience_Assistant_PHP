# Driving Experience Assistant with Backend using PHP
This project is the continuation of the Driving Experience Assistant project (using HTML, CSS and JavaScript). Instead of JavaScript, the logic is handled using PHP. And for data storage, instead of local storage, a MySQL database is used. 

## Table of Contents 

## Features
* Nice frontend created using HTML/CSS. 
* Saves the data in MySQL database. 
* CRUD operations on Driving Experience. 
* Calculates the total kilometers. 

## Getting Started
For getting started with the application, you need to go through the following steps: 

#### Step 1: Clone the repository
Firstly, you need to clone the repository, to get application code. Type these commands : 
```sh
git clone https://github.com/Javid-Sadigli/Driving_Experience_Assistant_PHP.git
cd Driving_Experience_Assistant_PHP
```

#### Step 2: Config the database credentials
Inside `db` folder, you can see a PHP file named `DB.php`. Inside this file, you need to enter your MySQL database credentials, in the top of DB class : 
```php 
private static $host="DB_HOST";
private static $username="DB_USERNAME"; 
private static $password="DB_PASSWORD";
private static $db="DB_DB";
```

#### Step 3: Run the application 
In this project, no frameworks are used. So, you can run the application in a PHP server. You can use Xampp, WampServer or just any extension of your IDE that gives you a PHP server. 

## See the application 
If you don't want to install and run the project locally, but still want to see it, you can see the deployed version. Just go to this <a href="https://javidsadigli.alwaysdata.net/driving_experience_project">link</a>.

## Technical aspects 
* The `DB` class utilizes the Singleton Design Pattern to ensure a single, shared instance of the database connection, optimizing resource usage and maintaining consistency across the application.
* MVC (Model-View-Controller) architecture is used, separating the application into three layers: Model for data and business logic, View for data representation, and Controller for handling user interactions and requests.
* The primary key (ID) of Driving Experiences is hidden from the user for security purposes. Instead, a randomly generated key is displayed to the user, while the actual ID is securely stored in session storage.

## Contributing 
Contributions are welcome! Follow these steps to contribute:
* Fork the project.
* Create a new branch: `git checkout -b feature/your-feature`.
* Make your changes.
* Submit a pull request.

## Thanks for your attention! 