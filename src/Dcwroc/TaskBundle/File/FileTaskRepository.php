<?php

namespace Dcwroc\TaskBundle\File;

use Dcwroc\TaskBundle\Entity\Task;
use Dcwroc\TaskBundle\Entity\TaskRepository;

class FileTaskRepository implements TaskRepository
{
    private $tasks = [];
    private $tmpDir;

    function __construct($tmpDir)
    {
        $this->tmpDir = $tmpDir;
        $this->loadTasks();
    }

    public function findAll()
    {
        return $this->tasks;
    }

    private function getFilePath()
    {
        return $this->tmpDir.'/tasks.txt';
    }

    private function loadTasks()
    {
        if (file_exists($this->getFilePath())) {
            $tasks = unserialize(file_get_contents($this->getFilePath()));
        } else {
            $tasks = [];
        }
        $this->tasks = false !== $tasks ? $tasks : [];
    }

    public function save(Task $task)
    {
        $this->generateIdIfNeeded($task);
        $this->tasks[$task->getId()] = $task;
        $this->saveTasks();
    }

    private function saveTasks()
    {
        file_put_contents($this->getFilePath(), serialize($this->tasks));
    }

    public function findById($id)
    {
        if (isset($this->tasks[$id])){
            return $this->tasks[$id];
        }

        return null;
    }

    public function remove(Task $task)
    {
        unset($this->tasks[$task->getId()]);
        $this->saveTasks();
    }

    /**
     * @param Task $task
     */
    private function generateIdIfNeeded(Task $task)
    {
        if (null === $task->getId()) {
            $task->setId(uniqid());
        }
    }
}
