<?php

require_once 'command/CommandManager.php';
require_once 'database/DatabaseConnectionManager.php';

$commandManager  = new CommandManager(new DatabaseConnectionManager());

echo("\n---\n\n");

$commandManager->getListOfTask();

$appWorks = true;

while ($appWorks) {
    echo("---\n\n");
    echo("1. Utwórz nowe zadanie\n");
    echo("2. Usuń zadanie\n");
    echo("3. Zaktualizuj status zadania\n");
    echo("4. Zaktualizuj zadanie\n");
    echo("5. Wyświetl treść zadania\n");
    echo("6. Wyświetl listę zadań\n");
    echo("7. Wyświetl listę zadań o wybranym statusie\n");
    echo("8. Wyjdź z programu\n\n");

    $action = readline("Wybierz akcję: ");

    echo("\n---\n\n");

    switch ($action) {
        case 1:
            $commandManager->createTask();
            break;
        case 2:
            $commandManager->deleteTask();
            break;
        case 3:
            $commandManager->updateStatusOfTask();
            break;
        case 4:
            $commandManager->updateTask();
            break;
        case 5:
            $commandManager->getTask();
            break;
        case 6:
            $commandManager->getListOfTask();
            break;
        case 7:
            $commandManager->getFilteredListOfTask();
            break;
        case 8:
            $appWorks = false;
            break;
        default:
            echo("Nieprawidłowy wybór, spróbuj ponownie");
    }
}

