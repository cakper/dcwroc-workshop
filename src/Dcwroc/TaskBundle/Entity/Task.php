<?php

namespace Dcwroc\TaskBundle\Entity;

use DateTime;
use DateTimeImmutable;
use DateTimeInterface;
use Symfony\Component\Validator\Constraints as Assert;

class Task
{
    /**
     * @Assert\NotBlank()
     * @Assert\Length(min="3")
     */
    private $name;

    /**
     * @Assert\NotBlank()
     * @Assert\DateTime()
     */
    private $dueDate;

    /**
     * @Assert\Type(type="boolean")
     */
    private $completed = false;

    function __construct($name = '', DateTime $dueDate = null)
    {
        $this->name = $name;
        $this->dueDate = $dueDate ? $dueDate : new DateTime('now');
    }

    private $id;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @param mixed $dueDate
     */
    public function setDueDate($dueDate)
    {
        $this->dueDate = $dueDate;
    }

    /**
     * @param mixed $completed
     */
    public function setCompleted($completed)
    {
        $this->completed = $completed;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getDueDate()
    {
        return $this->dueDate;
    }

    public function isCompleted()
    {
        return $this->completed;
    }
}
