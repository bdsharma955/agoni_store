<?php 
session_start();
require_once('../../config.php');

DeleteTableData('categories',$_REQUEST['id']);

$url = 'all-categories.php?success=Data Delete Successfully!';

header("location:$url");

?>