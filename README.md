# Flashcards-PHP

The purpose of this application is to continue developing my PHP skills, more specifically, to practice [PHP Data Objects](http://php.net/manual/en/intro.pdo.php).

An overview of basic PDO features can be found from [Traversy Media](https://www.youtube.com/watch?v=kEW6f7Pilc4).

**Table of Contents**       
[Goals](#goals)     
[What is PDO?](#what-is-pdo)             
[Initial Database Setup with phpMyAdmin](#initial-database-setup-with-phpmyadmin)       
[PDO Project Set Up](#pdo-project-set-up)       
[PDO Query](#pdo-query)       
[Prepared Statements](#prepared-statements)                 
[CRUD Examples](#crud-examples)                 
[Conclusion](#conclusion)                 

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

## PDO Query

[PDO query](http://php.net/manual/en/pdo.query.php) is one of two ways of making queries.  The PDO *query()* method should only be used if there is no type of variable or user input that is determining the query.

In **index.php**, all the flashcard sets available in the database are presented in a list.  To get the data, a query is performed and then [*fetchAll()*](http://php.net/manual/en/pdostatement.fetchall.php) is used to turn the data into an array:

```php
<?php 
    require('./config/config.php');
    $stmt = $pdo->query("SELECT * FROM flashcard_set");
    $sets = $stmt->fetchAll();
?>
```

Using a [foreach](http://php.net/manual/en/control-structures.foreach.php) loop, the data can be presented using HTML:

```php
<?php foreach ($sets as $set): ?>
    <a href="set.php?set_id=<?php echo $set['set_id']; ?>" class="list-group-item list-group-item-action"><?php  echo $set['set_name']; ?></a>
<?php endforeach; ?>
```

**NOTE** PDO *fetch()* and *fetchAll()* has a ```fetch_style``` parameter that determines how the data will be returned.  If no argument is provided, it defaults to *PDO::FETCH_BOTH*.  More information about fetch() options can be found [here](http://php.net/manual/en/pdostatement.fetch.php)

## Prepared Statements

The 2nd way to query a database is through the use of prepared statements, which should be used when a query involves any type of user input, be inside the web URL or from a form.  The two main methods involved with prepared statements are ```prepare()``` and ```execute()```.

Before getting into prepared statements, below is an example taken from [PHP The Right Way](http://www.phptherightway.com/#pdo_extension) that demonstrates the wrong way of querying a database where user input is involved:
```php
$pdo->query("SELECT name FROM users WHERE id = " . $_GET['id']); // <-- NO!
```

```$_GET['id']``` is where the problem is because it's a raw query parameter that gets the id parameter from the URL.  If a query is made in this way, the application's database is vulnerable to SQL Injection, which can destroy the entire database.

The solution is prepared statements, where either named or positional placeholders are used in place of raw query parameters.

**Named Parameters:**       
```php
$stmt = $pdo->prepare('SELECT name FROM users WHERE id = :id');
$id = htmlspecialchars($_GET['id']);
$stmt->execute(['id' => $id]); // variable goes into array
```

**Positional Parameters:**       
```php
$stmt = $pdo->prepare('SELECT name FROM users WHERE id = ?');
$id = htmlspecialchars($_GET['id']);
$stmt->execute([$id]); // variable goes into array
```

## CRUD Examples

Below are examples of CRUD features implemented in this application.  Most of the examles user the *prepareAndExecute()* function I created to perform the routine tasks for preparing the SQL and executing it along with the array of variables inserted into the placeholders (if there are any).

```php
<?php
function prepareAndExecute($sql, $statements, $fetchType = '') {
    require('./config/config.php');
    $stmt = $pdo->prepare($sql);
    $stmt->execute($statements);
    if ($fetchType === 'fetch') {
        return $stmt->fetch();
    } else if ($fetchType === 'fetchAll') {
        return $stmt->fetchAll();
    } else {
        ;
    }
}
```

### Create a table

*General information about creating a table using PHP and SQL can be found [here](https://www.w3schools.com/php/php_mysql_create_table.asp)*

When clicking the *New Set* link, the application is directed to **new-set.php** where a new flashcard set can be created:
```php
$sql ="CREATE TABLE `$posted_set_name`(
    card_id INT( 11 ) AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR( 150 ) NOT NULL, 
    answer VARCHAR( 150 ) NOT NULL);";
    prepareAndExecute($sql, array());
    header('Location: ' . 'index.php' . ''); // Redirect to home page after set created
```

There is more logic attached to this (like checking if the Set Name field is empty), but I just wanted to show an example of creating a table and the **Create** part of CRUD.

### Read data using fetch() and fetchAll()

An example of **reading** data was shown earlier using fetchAll().  Another example of using fetch() along with prepared statements can be found when editing a card within a flashcard set:
```php
// Check if page loaded is a card edit
if (isset($_GET['card_id'])) {
    $card_id = htmlspecialchars($_GET['card_id']);
    $sql = "SELECT * FROM `$setName` WHERE card_id = ?";
    $card = prepareAndExecute($sql, array($card_id), 'fetch');
}
```

In this example, first there is a check to see if ```card_id``` is set within the URL parameter.  The reason for this is because the page that edits a card is the same page loaded when adding a new card.  If ```card_id``` is set, then a card is being edited and information about that card should be presented in the input values.

Next, ```$card_id``` is set to the value in the URL using $_GET.  This value will be used in the prepared statement later.

The SQL statement is created then passed into the prepareAndExecute() function along with the $card_id variable and fetch type string.  In this case, prepareAndExecute is set to a variable because the function will return a value (the data from the fetch()).

### Update Card Information

```php
if (!empty($question) && !empty($answer)) {
    if (isset($_GET['card_id'])) {
        $sql = "UPDATE `$setName` SET question = ?, answer = ? WHERE card_id = ?";
        prepareAndExecute($sql, array($question, $answer, $card_id));
    }
```

In this example, first the input fields are checked if they are empty.  If they aren't empty, then there is a check to see if ```card_id``` is set, if it is then like the example before, the card is being edited and, upon submit, the card should be updated with the new data.  The SQL statement written is the code needed to perform the update and is performed after it is prepared and executed from the prepareAndExecute() function.

###  Delete Flashcard Set

When deleting a flashcard set, two queries need to be performed:
```php
if (isset($_POST['delete'])) {
    $sql = "DELETE FROM flashcard_set WHERE set_id = ?";
    prepareAndExecute($sql, array($set_id));

    $sql = "DROP TABLE `$setName`";
    prepareAndExecute($sql, array());
}
```

In this example, if ```delete``` is posted (if the delete form is submitted), the entry from the flashcard_set is removed then another query is performed that drops the card set table.

## Conclusion

As I add some basic styles, I am looking for opportunities to refactor.  I am also researching more on PDO to see what else I can do to improve this project.

One area I could improve is to hide/show forms on the index.php and set.php pages.  Rather than redirecting to pages where card and set information can be entered, I could use JavaScript/jQuery to hide and show forms based on button clicks.  This may be something I do in the future or in another iteration of this project.

## Update 2/1

Over the past month I've been working on this project along with other projects, while continuing to learn more about PHP.  I have changed several things in this application, below is a list of those changes:

*  Got rid of the prepareAndExecute() function because it interfered with other refactoring and it only saved a few lines of code.

* Cut down on the amount of redirection.  Adding a new set, adding a new card, and editing a card no longer go to separate pages.  Instead they can be submitted from the current page they are on.

* Moved PHP code that handled form submits to their own files.

As always, this project can be improved and refactored to be more concise.  I will look for opportunities to refactor while I continue you on to my next goal.

## Experimenting with the Database

My next goal is to create a branch from the current version and experiment with a different database schema.

As I've been learning PHP, I've also been learning SQL.  Something I've learned recently is the concept of FOREIGN KEYS and CASCADE.  Using these two concepts, I'm thinking that, instead of creating separate tables for each new flash card set, I can make one big Cards table and connect them with their set_names using JOINS.

I will document the process as I figure out exactly how I'm going to go about it.

### Recreating the tables

I dropped the tables from the working branch and set up new tables using SQL:

```sql
CREATE TABLE flashcard_set (
    set_id INT AUTO_INCREMENT PRIMARY KEY,
    set_name VARCHAR(255)
);

CREATE TABLE cards (
    card_id INT AUTO_INCREMENT PRIMARY KEY,
    question VARCHAR(255),
    answer VARCHAR(255),
    set_id INT,
    FOREIGN KEY(set_id)
        REFERENCES flashcard_set(set_id)
        ON DELETE CASCADE
);
```

The ```flashcard_set``` table is the same as before.  The main change is in the ```cards``` table, which will hold all cards created in the application.

As before, a card has a **card_id**, **question**, and **answer** column and now has a ```set_id``` column, which is used as the foreign key that references the ```flashcard_set``` table's ```set_id```.  If a flashcard set is deleted, this change will **CASCADE** and delete all cards where the card's set id matches the flashcard set id.

This is a much more efficient way of removing items from the database.  Before, I was submitting two queries, one to delete the card table and another to remove the item from the flashcard set table.  Now, all I need is one query to delete the flashcard set and all cards associated with that set will be deleted as well.

The next step is to refactor the PHP code

## Update 2/2

After experimenting with the database, it turns out I didn't need to use a JOIN to get the table information.  I could have used it, but it was giving me back results I didn't need (like the entire set_name column, when all I really needed is just one set_name row).

Using this new database schema, I was able to remove several queries that created tables when a new card set was created.  The same applies for deleting a set; as I mentioned earlier, I used a FOREIGN KEY in the cards set that references the set_id in the flashcard_set table.




