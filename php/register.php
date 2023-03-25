<?php

  $Useremail = $_POST['Useremail'];
  $Userpassword = $_POST['Userpassword'];

  if (empty($Useremail)) {

    echo json_encode(array('Message' => 'Email is required',"Stauts"=>false));
    return;
  }
  
  if (empty($Userpassword)) {
  
    echo json_encode(array('Message' => 'Password is required',"Stauts"=>false));
    return;
  }

  $Connection = 'mysql:host=localhost;dbname=demokrithi';
  $DBUserName = 'root';
  $Password = '';
  $Dboptions = array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false
  );
  $pdo = new PDO($Connection, $DBUserName, $Password, $Dboptions);


  // prepare the SQL statement for inserting new user into users table
  $stmt = $pdo->prepare('INSERT INTO users (Email, Password) VALUES (:Email, :Password)');

  $stmt->bindParam(':Email', $Useremail);
  $stmt->bindParam(':Password', $Userpassword);

  try {
    $stmt->execute();
  } catch (PDOException $e) {

    echo json_encode(array('Message' => 'Insert Failed',"Stauts"=>false));
    return;
  }

  echo json_encode(array('Message' => 'User Registered successfully',"Stauts"=>true));
?>