<?php

include_once 'database/DatabaseConnectionManager.php';
include_once 'entity/Task.php';
include_once 'entity/TaskCreator.php';

$connection = new DatabaseConnectionManager();
$connection->openConnection();

$taskCreator = new TaskCreator($connection);
$taskCreator->createTask('Test1', 'high');
$taskCreator->createTask('Test2', 'low');

$connection->saveData();
$connection->closeConnection();

$connection2 = new DatabaseConnectionManager();
$connection2->openConnection();

$tasks = $connection2->findAllTasks();
//var_dump($tasks);
echo count($tasks)."\n";

$connection2->closeConnection();
