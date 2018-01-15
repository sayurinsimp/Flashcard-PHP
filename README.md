# Flashcards-PHP

The purpose of this application is to continue developing my PHP skills, more specifically, to practice [PHP Data Objects](http://php.net/manual/en/intro.pdo.php).

An overview of basic PDO features can be found from [Traversy Media](https://www.youtube.com/watch?v=kEW6f7Pilc4).

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

 