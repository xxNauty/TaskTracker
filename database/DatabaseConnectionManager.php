<?php

class DatabaseConnectionManager
{
    private const string DATABASE_URL = "database/data.json";
    private mixed $file;
    private static ?array $data = [];

    public function openConnection(): void
    {
        $this->file = fopen(self::DATABASE_URL, 'a+');
        $this->readData();
    }

    public function readData(): array
    {
        return json_decode(file_get_contents(self::DATABASE_URL)) ?? [];
    }

    public function appendData(Task $task): void
    {
        array_push(self::$data, $task);
//        echo count($this->data)."-\n";

        file_put_contents(self::DATABASE_URL, json_encode(self::$data));
    }

    public function findTask(string $id): ?Task
    {
        /** @var Task $task */
//        return array_find($this->data, fn($task) => $task->id === $id);
        foreach (self::$data as $task){
            if ($task->id === $id){
                return $task;
            }
        }
        return null;
    }

    public function getLastTaskId(): int
    {
        $task = end(self::$data);
        if($task){
            return $task->id;
        }
        return 0;
    }

    public function closeConnection(): void
    {
        fclose($this->file);
    }
}