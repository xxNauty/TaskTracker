<?php

require_once 'database/DatabaseConnectionManager.php';
require_once 'Priority.php';

class TaskCreator
{
    private int $lastTaskId;

    private DatabaseConnectionManager $database;

    public function __construct(DatabaseConnectionManager $manager){
        $this->database = $manager;
        $this->lastTaskId = $this->database->getLastTaskId();
    }

    public function createTask(string $description, string $priority): void
    {
        $task = new Task(++$this->lastTaskId, $description, Priority::from($priority));
        $this->database->appendData($task);
    }
}