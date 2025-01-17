<?php

namespace command;

use entity\Task;

class DeleteTaskCommand
{
    private string $data {
        get {
            return $this->data;
        }
        set {
            $this->data = $value;
        }
    }

    private Task $task {
        get {
            return $this->task;
        }
        set {
            $this->task = $value;
        }
    }

    public function __construct(string $data, Task $task)
    {
        $this->data = $data;
        $this->task = $task;
    }


    public function execute(): string{

    }
}