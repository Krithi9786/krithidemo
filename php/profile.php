<?php

$UserName = $_POST['UserName'];
$Age = $_POST['Age'];
$Dob = $_POST['Dob'];
$Contact = $_POST['Contact'];

if (empty($UserName)) {
  echo json_encode(array('Message' => 'User Name is required'));
  return false;
}

if (empty($Age)) {
  echo json_encode(array('Message' => 'Age is Required'));
  return false;
}

if (empty($Dob)) {
  echo json_encode(array('Message' => 'Dob is required'));
  return false;
}

if (empty($Contact)) {
  echo json_encode(array('Message' => 'Contact is required'));
  return false;
}


$redis = new Redis();
$redis->connect('localhost', 6379);

$userId = $redis->get('session:' . $sessionId);

if (empty($userId)) {
  http_response_code(401);
  echo json_encode(array('message' => 'Invalid session ID'));
  return;
}

$mongo = new MongoDB\Client('mongodb://127.0.0.1:27017');
$collection = $mongo->demokrithi->users;

$collection->updateOne(
  array('_id' => new MongoDB\BSON\ObjectID($userId)),
  array(
    '$set' => array(
      'UserName' => $UserName,
      'Age' => $Age,
      'Dob' => $Dob,
      'Contact' => $Contact
    )
  )
);

echo json_encode(array('Message' => 'Profile updated successfully', "Status" => true));
?>
