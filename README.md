# Flashcards-PHP

The purpose of this application is to continue developing my PHP skills, more specifically, to practice [PHP Data Objects](http://php.net/manual/en/intro.pdo.php).

An overview of basic PDO features can be found from [Traversy Media](https://www.youtube.com/watch?v=kEW6f7Pilc4).

**Table of Contents**       
[Goals](#goals)     
[What is PDO?](#what-is-pdo)             
[Initial Database Setup with phpMyAdmin](#initial-database-setup-with-phpmyadmin)       
[PDO Project Set Up](#pdo-project-set-up)       

## Goals

1.  Practice PDO
2.  Get a better understanding of basic SQL commands
3.  Fully functional CRUD application


## What is PDO?

From the PHP docs:
```
The PHP Data Objects (PDO) extension defines a lightweight, consistent interface for accessing databases in PHP
```

In a [previous project](https://github.com/xmtrinidad/VideoGameMusic-PHP), I used the [MySQL Improved Extension](http://php.net/manual/en/book.mysqli.php) to access and manipulate a database.  One of the advantages of PDO over mysqli is that PDO works with multiple databases.  PDO is also Object Oriented, which means it has its own methods and properties

Other benefits include:

*  Security through the use of *prepared statements*, which can help avoid [SQL injections](https://www.youtube.com/watch?v=_jKylhJtPmI) into the database.
    *  More info about creating Prepared Statements using PDO can be found [here](https://www.youtube.com/watch?v=9QSAOTrM9H4)
*  Usability because of the amount of helper functions that make working with routine database operations easier.
*  Excellent Error Handling

 ## Initial Database Setup with phpMyAdmin

 For this project, I am using XAMPP for my PHP development environment.  After running Apache and MySQL through XAMPP and navigating to ```http://localhost/phpmyadmin/``` a database can be created

 Many of these actions are performed using SQL with PHP in the application.  Initial set up, however, was performed using the phpMyAdmin interface:

 1.  From the phpMyAdmin home page, click **Databases** from the toolbar at the top

        ![Select Database](/img/readme-img/selectdb.png)

 2.  Inside the **Create database** input box, enter the database name then click create

        ![Create Database](/img/readme-img/createdb.png)        


 3.  Inside the **Create table** field, enter a table name and number of columns then click **Go**.


 4.  Enter table information then click **Save**   

        ### Two Tables     

        For this project, I initially created two tables within a *flashcards* database.  The first table *flashcard_set* has two columns.  **set_name** and **set_id** and a table of the first flashcard set named *spanish verbs*.  Within phpMyAdmin, the *flashcard_set* table looks like so:

        ![Flashcard Set Table](/img/readme-img/flashcard_set_table.png)

        Each new flashcard set gets its own table (named after the *set_name* found within the *flashcard_set* table) and have **card_id**, **question** and **answer** fields.  Here's an example of the 'spanish verbs' table:

        ![Set Table](/img/readme-img/set_tabledb.png)



        ### Auto Increment
        
        *set_id* and *card_id* are set to AUTO INCREMENT.  While testing, I've deleted and created several flashcard sets and cards.  Each new set created will increase the Auto Increment counter from where it last left off, which is why the ids may be missing numbers between them.

        To reset the Auto Increment counter, a solution can be found at this [stack overflow](https://stackoverflow.com/questions/8923114/how-to-reset-auto-increment-in-mysql) page.  Essentially, the following SQL command is:

        ```sql
        -- int can be any number
        -- replace tablename with the name of the table being affected
        ALTER TABLE tablename AUTO_INCREMENT = int
        ```

        SQL can be performed within phpMyAdmin by clicking on the SQL tab, entering the SQL then clicking Go.


## PDO Project Set Up

To use PDO and the database created with PHP, an initial config needs to be set up.  For this project, I created a *config.php* file and it inside of a *config* folder.  The structure looks like this:

```php
<?php
    $host = 'localhost';
    $user = 'root';
    $password = 'USER_PASSWORD';
    $dbname = 'flashcards';

    // Set DSN (Data Source Name)
    $dsn = 'mysql:host='. $host . ';dbname='. $dbname;

    // PDO Instance
    $pdo = new PDO($dsn, $user, $password);
?>
```

**$host** is set to ```localhost``` if the project is local.  When deploying, $host would be set to the name of the server.

$user is set to ```root``` because that is the user name I am using within my **User Accounts**.  A list of User Accounts can be found from the phpMyAdmin page.

When first installing XAMPP, a password isn't set.  If a password isn't set **$password** can be set to ```''```, but I have a password set and it is set to the $password variable.

**$dbname** for this project is ```flashcards``` because that's the database I created within phpMyAdmin.

To use PDO, a *data source name* needs to be defined using the format ```$dsn = 'mysql:host='. $host . ';dbname='. $dbname;```

Then finally a *PDO Instance* needs to be defined using the $dsn, $user, and $passwords variables.
```php
// PDO Instance
$pdo = new PDO($dsn, $user, $password);
```

This *config.php* file is included in any other file that uses PDO.





    