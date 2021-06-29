<?php
//$id=$_GET['id'];
header('Content-Type:application/json');
echo json_encode(file_get_contents(__DIR__."/GET_board.json"));

