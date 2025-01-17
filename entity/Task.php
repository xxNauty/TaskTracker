<?php

require_once 'Priority.php';
require_once 'Status.php';

class Task
{
    public string $id;
    public string $description;
    public Status $status;
    public Priority $priority;
    public DateTime $createdAt;
    public DateTime $updatedAt;

    public function __construct(int $id, string $description, Priority $priority)
    {
        $this->id = $id;
        $this->description = $description;
        $this->status = Status::Waiting;
        $this->priority = $priority;
        $this->createdAt  = new DateTime('now', new DateTimeZone('Europe/Warsaw'));
        $this->updatedAt  = new DateTime('now', new DateTimeZone('Europe/Warsaw'));
    }

    public function getId(): string
    {
        return $this->id;
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

    public function setStatus(Status $status): Task
    {
        $this->status = $status;
        return $this;
    }

    public function getPriority(): Priority
    {
        return $this->priority;
    }

    public function setPriority(Priority $priority): Task
    {
        $this->priority = $priority;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function getUpdatedAt(): DateTime
    {
        return $this->updatedAt;
    }

    public function setUpdatedAt(DateTime $updatedAt): Task
    {
        $this->updatedAt = $updatedAt;
        return $this;
    }
}