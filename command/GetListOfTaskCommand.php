<?php

require_once 'database/DatabaseConnectionManager.php';

class GetListOfTaskCommand
{
    private DatabaseConnectionManager $manager;

    public function __construct(DatabaseConnectionManager $manager)
    {
        $this->manager = $manager;
    }

    public function action(): void
    {
        if(count($this->manager->findAllTasks()) == 0) {
            echo("Brak zadań do wyświetlenia\n\n");
        }
        else{
            foreach ($this->manager->findAllTasks() as $task) {
                /** @var Task $task */
                echo sprintf(
                    "ID: %s\nOpis zadania: %s\nStatus: %s\nPriorytet: %s\nData utworzenia: %s\nData ostatniej aktualizacji: %s\n\n",
                    $task->getId(),
                    $task->getDescription(),
                    $task->getStatus()->value,
                    $task->getPriority()->value,
                    $task->getCreatedAt()->format('Y-m-d H:i:s'),
                    $task->getUpdatedAt()->format('Y-m-d H:i:s')
                );
            }
        }
    }
}