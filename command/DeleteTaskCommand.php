<?php

require_once 'database/DatabaseConnectionManager.php';

class DeleteTaskCommand
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
            $id = readline("Podaj ID zadania do usunięcia:");
            echo("\n");

            if($this->manager->findTask($id) == null){
                echo "Nie ma takiego zadania, spróbuj ponownie.\n";
            }
            else{
                $correctId  = true;
            }
        }

        $this->manager->removeTask($id);
    }
}