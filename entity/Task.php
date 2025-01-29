<?php

require_once 'Priority.php';
require_once 'Status.php';

class Task
{
    private(set) string $id;
    private(set) string $description;
    private(set) Status $status;
    private(set) Priority $priority;
    private(set) DateTime $createdAt;
    private(set) DateTime $updatedAt;

    private function __construct(){
        $this->createdAt = new DateTime(); //todo rozwiązać to lepiej
    }

    public static function defaultConstructor(
        string $id,
        string $description,
        string $status,
        string $priority
    ): Task
    {
        $task = new Task();

        $task->setId($id);
        $task->setDescription($description);
        $task->setStatus($status);
        $task->setPriority($priority);

        $task->setCreatedAt();
        $task->setUpdatedAt();

        return $task;
    }

    public static function fullConstructor(
        string $id,
        string $description,
        string $status,
        string $priority,
        DateTime $createdAt,
        DateTime $updatedAt
    ): Task
    {
        $task = new Task();

        $task->setId($id);
        $task->setDescription($description);
        $task->setStatus($status);
        $task->setPriority($priority);

        $task->setCreatedAt($createdAt);
        $task->setUpdatedAt($updatedAt);

        return $task;
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function setId(string $id): Task
    {
        $this->id = $id;
        return $this;
    }

    public function getDescription(): string
    {
        return $this->description;
    }

    public function setDescription(string $description): Task
    {
        $this->description = $description;
        return $this;
    }

    public function getStatus(): Status
    {
        return $this->status;
    }

    public function setStatus(string $status): Task
    {
        $this->status = Status::from($status);
        return $this;
    }

    public function getPriority(): Priority
    {
        return $this->priority;
    }

    public function setPriority(string $priority): Task
    {
        $this->priority = Priority::from($priority);
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $dateTime = null): Task
    {
        $this->updatedAt = $dateTime ?? new DateTime('now', new DateTimeZone('Europe/Warsaw'));
        return $this;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(?DateTime $dateTime = null): Task
    {
        $this->updatedAt = $dateTime ?? new DateTime('now', new DateTimeZone('Europe/Warsaw'));
        return $this;
    }
}