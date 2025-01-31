<?php

require_once 'database/DatabaseConnectionManager.php';

class GetTaskCommand
{
    private DatabaseConnectionManager $manager;

    public function __construct(DatabaseConnectionManager $manager)
    {
        $this->manager = $manager;
    }

    public function action(): ?object
    {
        $id = "";
        $correctId = false;

        while (!$correctId){
            $id = readline("Podaj ID poszukiwanego zadania:");
            echo("\n");

            if($this->manager->findTask($id) == null){
                echo "Nie ma takiego zadania, spróbuj ponownie.\n";
            }else{
                $correctId  = true;
            }
        }

        return $this->manager->findTask($id);
    }
}