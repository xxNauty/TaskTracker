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
        $id = "";
        $correctId = false;

        while (!$correctId){
            $id = readline("Podaj ID zadania do zaktualizowania statusu:");

            if($this->manager->findTask($id) == null){
                echo "Nie ma takiego zadania.\n";
            }else{
                $correctId  = true;
            }
        }

        $task = $this->manager->findTask($id);

        echo("Aktualna treść zadania: ". $task->getDescription());
        echo("Aktualny status zadania: ". $task->getStatus()->value); //todo: do posprzątania
        echo("Aktualny status zadania: ". $task->getStatus()->value);
        echo("Aktualny priorytet zadania: ".  $task->getPriority()->value);

        $description = readline("Podaj nową treść zadania: ");

        $status = "";
        $correctStatus = false;

        while (!$correctStatus){
            echo("Ustaw nowy status zadania\n");
            echo("1. ".Status::Waiting->value."\n");
            echo("2. ".Status::In_Progress->value."\n");
            echo("3. ".Status::Done->value."\n");
            $status = readline("Wybierz z podanych:");

            if(Status::tryFrom($status) == null) {
                echo("Błędna wartość");
            }
            else{
                $correctStatus = true;
            }
        }



        $priority = "";
        $correctPriority = false;

        while (!$correctPriority) {
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
        }

        $task->setDescription($description);
        $task->setStatus($status);
        $task->setPriority($priority);
        $task->setUpdatedAt();

        $this->manager->updateTask($task);
    }
}