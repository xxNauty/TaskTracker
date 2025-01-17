<?php

require_once 'database/DatabaseConnectionManager.php';
require_once 'Priority.php';

class TaskCreator
{
    private int $lastTaskId;

    private DatabaseConnectionManager $database;

    public function __construct(){
        $this->database = new DatabaseConnectionManager();
        $this->lastTaskId = $this->database->getLastTaskId();
        echo $this->lastTaskId;
    }

    public function createTask(string $description, string $priority): string
    {
        $task = new Task($this->lastTaskId++, $description, Priority::from($priority));
        $this->database->appendData($task);

        return "";
    }
}