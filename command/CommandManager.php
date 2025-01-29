<?php

require_once 'CreateTaskCommand.php';
require_once 'DeleteTaskCommand.php';
require_once 'UpdateTaskCommand.php';
require_once 'GetTaskCommand.php';
require_once 'GetListOfTaskCommand.php';
require_once 'UpdateStatusOfTaskCommand.php';

class CommandManager
{
    private CreateTaskCommand $createTaskCommand;
    private DeleteTaskCommand $deleteTaskCommand;
    private UpdateTaskCommand $updateTaskCommand;
    private UpdateStatusOfTaskCommand $updateStatusOfTaskCommand;
    private GetTaskCommand $getTaskCommand;
    private GetListOfTaskCommand $getListOfTaskCommand;
    private GetFilteredListOfTaskCommand $getFilteredListOfTaskCommand;

    public function __construct(
        DatabaseConnectionManager $manager
    ){
        $this->createTaskCommand = new CreateTaskCommand($manager);
        $this->deleteTaskCommand = new DeleteTaskCommand($manager);
        $this->updateTaskCommand = new UpdateTaskCommand($manager);
        $this->updateStatusOfTaskCommand = new UpdateStatusOfTaskCommand($manager);
        $this->getTaskCommand = new GetTaskCommand($manager);
        $this->getListOfTaskCommand = new GetListOfTaskCommand($manager);
        $this->getFilteredListOfTaskCommand = new GetFilteredListOfTaskCommand($manager);
    }

    public function createTask(): void
    {
        $this->createTaskCommand->action();
    }

    public function deleteTask(): void
    {
        $this->deleteTaskCommand->action();
    }

    public function updateTask(): void
     {
         $this->updateTaskCommand->action();
     }

     public function updateStatusOfTask(): void
    {
        $this->updateStatusOfTaskCommand->action();
    }

    public function getTask(): void
     {
         $this->getTaskCommand->action();
     }

    public function getListOfTask(): void
    {
        $this->getListOfTaskCommand->action();
    }

    public function getFilteredListOfTask(): void
    {
        $this->getFilteredListOfTaskCommand->action();
    }
}