<?php

require_once 'database/DatabaseConnectionManager.php';
require_once 'entity/Status.php';
require_once 'entity/Priority.php';

class UpdateTaskCommand
{
    private DatabaseConnectionManager $manager;

    public function __construct(DatabaseConnectionManager $manager)
    {
        $this->manager = $manager;
    }

    public function action(): void
    {
        $correctId = false;
        do {
            $id = readline("Podaj ID zadania do zaktualizowania statusu:");

            if($this->manager->findTask($id) == null){
                echo "Nie ma takiego zadania.\n";
            }else{
                $correctId  = true;
            }
        } while (!$correctId);

        $task = $this->manager->findTask($id);

        echo("Aktualna treść zadania: ". $task->getDescription()."\n");
        echo("Aktualny status zadania: ". $task->getStatus()->value)."\n";
        echo("Aktualny status zadania: ". $task->getStatus()->value)."\n";
        echo("Aktualny priorytet zadania: ".  $task->getPriority()->value)."\n";

        $description = readline("Podaj nową treść zadania: ");
        echo("\n");

        $correctStatus = false;
        do {
            echo("Ustaw nowy status zadania\n");
            echo("1. ".Status::Waiting->value."\n");
            echo("2. ".Status::In_Progress->value."\n");
            echo("3. ".Status::Done->value."\n");
            $status = readline("Wybierz z podanych:");
            echo("\n");

            if(Status::tryFrom($status) == null) {
                echo("Błędna wartość");
            }
            else{
                $correctStatus = true;
            }
        } while (!$correctStatus);

        $correctPriority = false;
        do {
            echo("Ustaw priorytet zadania\n");
            echo("1. ".Priority::High->value."\n");
            echo("2. ".Priority::Medium->value."\n");
            echo("3. ".Priority::Low->value."\n");

            $priority = readline("Wybierz z podanych:");

            if(Priority::tryFrom($priority) == null) {
                echo("Błędna wartość");
            }
            else{
                $correctPriority = true;
            }
        } while (!$correctPriority);

        $task
            ->setDescription($description)
            ->setStatus($status)
            ->setPriority($priority)
            ->setUpdatedAt();

        $this->manager->updateTask($task);
    }
}