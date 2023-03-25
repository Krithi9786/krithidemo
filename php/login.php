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


$stmt = $pdo->prepare('SELECT id, Password,Email FROM users WHERE Email = :Email');
$stmt->execute(array('Email' => $Useremail));
$user = $stmt->fetch();


if (!$user || $Userpassword !== $user['Password']) {
  echo json_encode(array('Message' => 'Invalid User Email or User Password'));
  return;
}

$redis = new Redis();
$redis->connect('localhost', 6379);

$sessionId = uniqid();
$redis->setex('sessionId:' . $sessionId, 3600, $user['id']);

echo json_encode(array('user'=>json_encode($user),'sessionId' => $sessionId,'Status'=>true,"Message"=>"Login Success"));