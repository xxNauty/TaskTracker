<?php

class DatabaseConnectionManager
{
    private const string DATABASE_URL = "database/data.json";
    private mixed $file;
    private array $data = [];

    public function openConnection(): void
    {
        $this->file = fopen(self::DATABASE_URL, 'a+');
        $this->readData();
    }

    public function readData(): void
    {
        $this->data = json_decode(file_get_contents(self::DATABASE_URL)) ?? [];
    }

    public function appendData(Task $task): void
    {
        $this->data[] = $task;
    }

    public function findTask(string $id): ?object //todo: sprawdzić czy da się poprawić na ?Task
    {
        foreach ($this->data as $task){
            if ($task->id === $id){
                /** @var Task $task */
                return $task;
            }
        }
        return null;
    }

    public function findAllTasks(): array
    {
        return $this->data;
    }

    public function getLastTaskId(): int
    {
        $task = end($this->data);
        if($task){
            return $task->id;
        }
        return 0;
    }

    public function saveData(): void
    {
//        var_dump($this->data);
        file_put_contents(self::DATABASE_URL, json_encode($this->data));
    }

    public function closeConnection(): void
    {
        fclose($this->file);
    }
}