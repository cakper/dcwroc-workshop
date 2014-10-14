<?php

namespace Dcwroc\TaskBundle\Entity;

interface TaskRepository
{
    public function findAll();

    public function save(Task $task);
} 
