<?php

require_once 'database/DatabaseConnectionManager.php';
require_once 'entity/Status.php';

class GetFilteredListOfTaskCommand
{
    private DatabaseConnectionManager $manager;

    public function __construct(DatabaseConnectionManager $manager)
    {
        $this->manager = $manager;
    }

    public function action(): void
    {
        $status = "";
        $correctStatus = false;

        while (!$correctStatus){
            echo("Podaj jakie zadania chcesz zobaczyć: \n");
            echo("1. Wszystkie");
            echo("2. ".Status::Done->value."\n");
            echo("3. ".Status::In_Progress->value."\n");
            echo("4. ".Status::Waiting->value."\n");
            $status = readline("Wybierz z podanych:");

            if(Priority::tryFrom($status) == null && $status != "Wszystkie"){
                echo("Nieprawidłowa wartość, spróbuj ponownie");
            }
            else{
                $correctStatus = true;
            }
        }

        if(count($this->manager->findAllTasks()) == 0) {
            echo("Brak zadań do wyświetlenia\n\n");
        }
        else{
            foreach ($this->manager->findByStatus($status) as $task) {
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