<?php

namespace Dcwroc\TaskBundle\InMemory;

use Dcwroc\TaskBundle\Entity\Task;
use Dcwroc\TaskBundle\Entity\TaskRepository;

class InMemoryTaskRepository implements TaskRepository
{
    public function findAll()
    {
        return [new Task('Test!')];
    }

    public function save(Task $task)
    {
        // TODO: Implement save() method.
    }
}
