<?php

// TODO : Validate if all fields are filled appropriately.
// TODO : Show Bootbox alert on successful submission of question.

// Include necessary modules
require_once '../../includes/pdo.php';
require_once '../../includes/utilities.php';

$questionText = sanitize($_POST['questionInput']);
$optA = sanitize($_POST['optA']);
$optB = sanitize($_POST['optB']);
$optC = sanitize($_POST['optC']);
$optD = sanitize($_POST['optD']);
$correctOpt = sanitize($_POST['correctOpt']);
$topic = sanitize($_POST['topicInput']);

$image = !empty($_FILES["imageInput"]["name"]) ? sha1_file($_FILES["imageInput"]["tmp_name"]) . "-" . basename($_FILES["imageInput"]["name"]) : "NONE";
$image = sanitize($image);

$sql = "INSERT INTO test VALUES(QNO, :questionText, :optA, :optB, :optC, :optD, :correctOpt, :topic, :image)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
  ':questionText' => $questionText,
  ':optA' => $optA,
  ':optB' => $optB,
  ':optC' => $optC,
  ':optD' => $optD,
  ':correctOpt' => $correctOpt,
  ':topic' => $topic,
  ':image' => $image,
]);

if($image !== "NONE") {
  $targetDirectory = "../questions/images/";
  $targetFile = $targetDirectory . $image;

  // Get the extension of the file uploaded
  $fileType = pathinfo($targetFile, PATHINFO_EXTENSION);

  $fileUploadErrors = "";

  $allowedFileTypes = array("jpg", "jpeg", "png", "gif");
  if(!in_array($fileType, $allowedFileTypes)) {
    $fileUploadErrors = "<div>Only jpg, jpeg, png, and gif files are allowed for upload.</div>";
  }

  // Check if an image with the submitted file name already exists.
  if(file_exists($targetFile)) {
    $fileUploadErrors = "<div>Image already exists. Please try renaming the image file</div>";
  }

  if(!is_dir($targetDirectory)) {
    mkdir($targetDirectory, 0777, true);
  }

  if(empty($fileUploadErrors)) {
    // No errors, so try and upload the file.
    if(move_uploaded_file($_FILES["imageInput"]["tmp_name"], $targetFile)) {
      // Photo uploaded successfully
    } else {
      // Unable to upload photo.
      echo "<div class='alert alert-danger'>";
      echo "<div>Unable to upload photo.</div>";
      echo "</div>";
    }
  } else {
    echo "<div class='alert alert-danger'>";
    echo "<div>{$fileUploadErrors}</div>";
    echo "</div>";
  }
}

?>
