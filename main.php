<?php

require_once 'database/DatabaseConnectionManager.php';
require_once 'entity/Task.php';
require_once 'entity/TaskCreator.php';
require_once 'command/CreateTaskCommand.php';

$connection = new DatabaseConnectionManager();

$command = new CreateTaskCommand($connection);
$command->action();
