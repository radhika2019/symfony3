<?php
namespace AppBundle\Entity;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;
/**
 * @ORM\Entity
 * @ORM\Table(name="task")
 */
Class Task{

	/**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    public $id;
	/**
     * @Assert\NotBlank()
     * @ORM\Column(type="string")
     */
	public $task;
	 /**
     * @ORM\Column(type="string")
     * @Assert\NotBlank()
     */
	public $taskPriority;
	 /**
     * @ORM\Column(type="string",nullable=true)
     */
	public $taskComment;
	 /**
     * @ORM\Column(type="string")
     */
    public $taskStatus;
	
	public function getTask(){
		return $this->task;
	}

	public function getTaskPriority(){
		return $this->taskPriority;
	}

	public function getTaskComment(){
		return $this->taskComment;
	}

	public function getStatus(){
		return $this->taskStatus;
	}

	public function setTask($task){
		return $this->task = $task;
	}

	public function setTaskPriority($taskPriority){

		return $this->taskPriority = $taskPriority;
	}
	public function setTaskComment($taskComment){
		return $this->taskComment = $taskComment;
	}
	public function setStatus($taskStatus){

		return $this->task = $taskStatus;
	}
}
?>