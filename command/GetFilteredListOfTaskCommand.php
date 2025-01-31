<?php

require_once 'database/DatabaseConnectionManager.php';
require_once 'entity/Status.php';

class  GetFilteredListOfTaskCommand
{
    private DatabaseConnectionManager $manager;

    public function __construct(DatabaseConnectionManager $manager)
    {
        $this->manager = $manager;
    }

    public function action(): void
    {
        $correctStatus = false;
        do {
            echo("Podaj jakie zadania chcesz zobaczyć: \n");
            echo("1. ".Status::Done->value."\n");
            echo("2. ".Status::In_Progress->value."\n");
            echo("3. ".Status::Waiting->value."\n");
            $status = readline("Wybierz z podanych:");
            echo("\n");

            if(Status::tryFrom($status) == null){
                echo("Nieprawidłowa wartość, spróbuj ponownie");
            }
            else{
                $correctStatus = true;
            }
        } while (!$correctStatus);

        if(count($this->manager->filterByStatus($status)) == 0) {
            echo("Brak zadań do wyświetlenia\n\n");
        }
        else{
            foreach ($this->manager->filterByStatus($status) as $task) {
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