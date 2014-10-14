<?php

namespace Dcwroc\TaskBundle\Entity;

interface TaskRepository
{
    public function findAll();

    public function save(Task $task);

    public function findById($id);

    public function remove(Task $task);
} 
