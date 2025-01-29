<?php

require_once 'entity/Task.php';
require_once 'entity/Status.php';

class DatabaseConnectionManager
{
    private const string DATABASE_URL = "database/tasks/";
    private const string DATABASE_FILE_URL = "database/tasks/task-";
    private const string DATABASE_EXTENSION = ".json";
    private const string TIMEZONE = "Europe/Warsaw";

    public function findTask(string $id): ?Task
    {
        $data = json_decode(file_get_contents(self::DATABASE_FILE_URL.$id.self::DATABASE_EXTENSION), true);

        return Task::fullConstructor(
            $data['id'],
            $data['description'],
            $data['status'],
            $data['priority'],
            DateTime::createFromFormat("Y-m-d H:i:s.u", $data['createdAt']['date'], new DateTimeZone(self::TIMEZONE)),
            DateTime::createFromFormat("Y-m-d H:i:s.u", $data['updatedAt']['date'], new DateTimeZone(self::TIMEZONE))
        );
    }

    public function findAllTasks(): array
    {
        $files = scandir(self::DATABASE_URL);
        $files = array_slice($files, 2); //usuwa folder . oraz ..

        $tasks = [];

        foreach ($files as $task) {
            $data = json_decode(file_get_contents(self::DATABASE_URL.$task), true);

            $tasks[] = Task::fullConstructor(
                $data['id'],
                $data['description'],
                $data['status'],
                $data['priority'],

                DateTime::createFromFormat("Y-m-d H:i:s.u", $data['createdAt']['date'], new DateTimeZone(self::TIMEZONE)), //u -> mikrosekundy
                DateTime::createFromFormat("Y-m-d H:i:s.u", $data['updatedAt']['date'], new DateTimeZone(self::TIMEZONE))
            );
        }

        return $tasks;
    }

    public function findByStatus(string $status): array
    {
        $tasks = $this->findAllTasks();
        $filteredTasks = [];

        /** @var Task $task */
        foreach ($tasks as $task){
            if($task->getStatus() == $status){
                $filteredTasks[] = $task;
            }
        }

        return $filteredTasks;
    }

    private function getLastTaskId(): int
    {
        $files = scandir(self::DATABASE_URL);

        sort($files);

        return (int) substr(end($files), -6, 1) ;
    }

    public function createTask(string $description, string $priority): void
    {
        $task = Task::defaultConstructor(
            $this->getLastTaskId() + 1,
            $description,
            Status::Waiting->value,
            $priority,
        );

        file_put_contents(self::DATABASE_FILE_URL.$task->getId().self::DATABASE_EXTENSION, json_encode($task, JSON_PRETTY_PRINT));
    }

    public function removeTask(string $id): void
    {
        unlink(self::DATABASE_FILE_URL.$id.self::DATABASE_EXTENSION);
    }

    public function updateStatusOfTask(string $id, string $status): void
    {
        $task = $this->findTask($id);

        $task->setStatus($status);

        $this->updateTask($task);
    }

    public function updateTask(Task $task): void
    {
        file_put_contents(self::DATABASE_FILE_URL.$task->getId().self::DATABASE_EXTENSION, json_encode($task, JSON_PRETTY_PRINT));
    }

}