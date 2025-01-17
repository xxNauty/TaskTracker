<?php

include_once 'database/DatabaseConnectionManager.php';
include_once 'entity/Task.php';
include_once 'entity/TaskCreator.php';

$connection = new DatabaseConnectionManager();
$connection->openConnection();

$creator = new TaskCreator();
$creator->createTask("Test", "low");
$creator->createTask("Test", "medium");
$creator->createTask("Test", "high");
$creator->createTask("Test", "high");
$creator->createTask("Test", "high");

$connection->closeConnection();