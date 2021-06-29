<?php
require __DIR__ . "/functions.php";
$dataInputJson = file_get_contents("php://input");
$dataInput = json_decode($dataInputJson, true);
$board = $dataInput["fields"];
$errors = array_merge(validateRow($board), validateColumn($board), validateCell($board));
header('Content-Type:application/json');
if (!empty($errors))
    echo json_encode([['id' => $dataInput["id"]], ['fields' => $dataInput["fields"]], ['errors' => $errors], ['state' => 'INVALID']]);
elseif (isFull($board))
    echo json_encode([['id' => $dataInput["id"]], ['fields' => $dataInput["fields"]], ['state' => 'COMPLETED']]);
else
    echo json_encode([['id' => $dataInput["id"]], ['fields' => $dataInput["fields"]], ['state' => 'VALID']]);



