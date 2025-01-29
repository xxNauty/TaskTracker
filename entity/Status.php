<?php

//name = value
enum Status: string
{
    case Waiting = 'Oczekujące';
    case In_Progress = 'W trakcie';
    case Done = 'Wykonane';
}