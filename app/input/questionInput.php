<?php

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

$image = sha1_file($_FILES["imageInput"]["tmp_name"]) . "-" . basename($_FILES["imageInput"]["name"]);
echo '<h1>$_FILES["imageInput"]["name"])</h1>';
$image = sanitize($image);

$sql = "INSERT INTO questions VALUES(SNO, :QuestionAuthor, :QuestionText, :QuestionTopic, :CoreDept, :OptA, :OptB, :OptC, :OptD, :CorrectOpt, :Picture)";
$stmt = $pdo->prepare($sql);
$stmt->execute([
  ':QuestionAuthor' => "Althaf",
  ':QuestionText' => $questionText,
  ':QuestionTopic' => "CORE",
  ':CoreDept' => "CIV",
  ':OptA' => $optA,
  ':OptB' => $optB,
  ':OptC' => $optC,
  ':OptD' => $optD,
  ':CorrectOpt' => $correctOpt,
  ':Picture' => $image,
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
<!-- SELECT QuestionTopic, COUNT(QuestionTopic) FROM questions GROUP BY QuestionTopic -->
<!-- SELECT CoreDept, COUNT(CoreDept) FROM questions WHERE QuestionTopic="CORE" GROUP By CoreDept -->
