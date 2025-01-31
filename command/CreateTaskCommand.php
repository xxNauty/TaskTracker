<?php

require_once 'database/DatabaseConnectionManager.php';
require_once 'entity/Priority.php';

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

        $priority = "";
        $correctPriority = false;

        do {
            echo("\nUstaw priorytet zadania\n");
            echo("1. ".Priority::High->value."\n");
            echo("2. ".Priority::Medium->value."\n");
            echo("3. ".Priority::Low->value."\n");

            $priority = readline("Wybierz z podanych:");
            echo("\n");

            if(Priority::tryFrom($priority) == null) {
                echo("Błędna wartość, spróbuj ponownie");
            }
            else{
                $correctPriority = true;
            }
        }while (!$correctPriority);

        $this->manager->createTask($content, $priority);
    }
}