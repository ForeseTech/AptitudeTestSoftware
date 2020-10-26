<?php

function sanitize($data)
{
	return htmlentities($data, ENT_QUOTES, 'UTF-8');
}

function redirect($pageToRedirect) 
{
	header("Location: $pageToRedirect", true, 303);
	die();
}

function loadAnswers($pdo, $tableName) 
{
	$sql_stmt = "SELECT * FROM ".$tableName;
  $stmt = $pdo->query($sql_stmt);
	$result = $stmt->fetchAll();
	return $result;
}
