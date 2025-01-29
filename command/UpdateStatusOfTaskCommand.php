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
        $id = "";
        $correctId = false;

        while (!$correctId){
            $id = readline("Podaj ID zadania do zaktualizowania statusu:");

            if($this->manager->findTask($id) == null){
                echo "Nie ma takiego zadania, spróbuj ponownie.\n";
            }else{
                $correctId  = true;
            }
        }

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

        $this->manager->updateStatusOfTask($id, $status);
    }
}