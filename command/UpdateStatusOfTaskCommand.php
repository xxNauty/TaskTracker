<?php

require_once 'database/DatabaseConnectionManager.php';
require_once 'entity/Status.php';

class UpdateStatusOfTaskCommand
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
            echo("\n");

            if($this->manager->findTask($id) == null){
                echo "Nie ma takiego zadania, spróbuj ponownie.\n";
            }else{
                $correctId  = true;
            }
        } while (!$correctId);

        $correctStatus = false;
        do {
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
        } while (!$correctStatus);

        $this->manager->updateStatusOfTask($id, $status);
    }
}