<?php

enum Status: string
{
    case Waiting = 'waiting';
    case In_Progress = 'in_progress';
    case Done = 'done';
}