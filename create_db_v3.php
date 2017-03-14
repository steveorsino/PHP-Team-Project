<?php
  $dsn = 'mysql:host=localhost';
  $username = 'root';
  $password = '';
  $title = 'Create Database';
  include ('header.php');
  echo '<h1>Create User, Database, and Tables</h1>';
  
  
  try {
      $db = new PDO($dsn, $username, $password);
      echo '<p>You are connected to the database as \'root\'.</p>';
    
      $SQL = "CREATE USER IF NOT EXISTS admin@localhost IDENTIFIED BY 'Pa11word';
            GRANT ALL ON *.* TO admin@localhost IDENTIFIED BY 'Pa11word';";
      $db->exec($SQL);
      $dsn = 'mysql:host=localhost';
      $username = 'admin';
      $password = 'Pa11word';
      $db = new PDO($dsn, $username, $password);
      echo '<p>You are connected to the database as \'admin\'.</p>';
      
      $SQL = 'CREATE DATABASE IF NOT EXISTS syllabi';
      $db->exec($SQL);
      echo '<p>The database syllabi has been created.</p>';
      
      $SQL = 'USE syllabi;';
      $db->exec($SQL);
      
      $SQL = 'CREATE TABLE IF NOT EXISTS Term (
                TermID INT(6),
                Title VARCHAR(60),
              PRIMARY KEY (TermID)
              );';
      $db->exec($SQL);
      echo '<p>The table Term has been created.</p>';
      
      $SQL = 'CREATE TABLE IF NOT EXISTS Course (
                 CourseID INT(6),
                 CourseTitle VARCHAR(30),
                 CourseDescription VARCHAR(255),
                PRIMARY KEY (CourseID)
                );';
      $db->exec($SQL);
      echo '<p>The table Course has been created.</p>';
      
      $SQL = 'CREATE TABLE IF NOT EXISTS Session (
                SessionID INT(6),
                StartDate DATE,
                EndDate DATE,
                TermID INT(6),
            PRIMARY KEY (SessionID, TermID)

              );';
      $db->exec($SQL);
      echo '<p>The table Session has been created.</p>';
      
       $SQL = 'CREATE TABLE IF NOT EXISTS Syllabus (
                CourseID INT(6),
                TermID INT(6),
                SessionID INT(6),
              PRIMARY KEY (CourseID, TermID, SessionID)

                );';
      $db->exec($SQL);
      echo '<p>The table Syllabus has been created.</p>';
	  
	  $SQL = 'CREATE TABLE IF NOT EXISTS Units (
                UnitID INT(6),
                CourseID INT(6),
                TermID INT(6),
                SessionID INT(6),
                UnitTitle VARCHAR(30),
                GeneralOutcome VARCHAR(255),
               PRIMARY KEY (UnitID, CourseID, TermID, SessionID)
                );';
      $db->exec($SQL);
      echo '<p>The table Units has been created.</p>';
	  
	  $SQL = 'CREATE TABLE IF NOT EXISTS Outcomes (
                OutcomeID INT(6),
                UnitID INT(6),
                CourseID INT(6),
                TermID INT(6),
                SessionID INT(6),
                SpecificOutcome VARCHAR(255),
			   PRIMARY KEY (OutcomeID, UnitID, CourseID, TermID, SessionID)
			   );';
			   
      $db->exec($SQL);
      echo '<p>The table Outcomes has been created.</p>';
	  
  } catch (PDOException $e) {
    $error_message = $e->getMessage();
    echo "<p>An error occurred while connecting to
             the database: $error_message </p>";
  }
  include('footer.php');
  
?>