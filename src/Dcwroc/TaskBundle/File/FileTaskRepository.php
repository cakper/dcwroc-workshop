<?php

namespace Dcwroc\TaskBundle\File;

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
        $tasks = json_decode(file_get_contents($this->getFilePath()));
        $this->tasks = false !== $tasks ? $tasks : [];
    }
}
