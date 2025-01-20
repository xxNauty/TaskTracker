<?php

require_once 'database/DatabaseConnectionManager.php';

class CreateTaskCommand
{
    private DatabaseConnectionManager $manager;

    public function __construct(DatabaseConnectionManager $manager)
    {
        $this->manager = $manager;
    }

    public function action(): void
    {
        $content = readline("Wprowadź treść zadania:");

        echo("Ustaw priorytet zadania\n");
        echo("1. Wysoki\n");
        echo("2. Średni\n");
        echo("3. Niski\n");
        $priority = readline("Wybierz z podanych:");

        echo $content." ".$priority;
    }


}