<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use AppBundle\Entity\Task;


class TaskController extends Controller{
	 /**
     * @Route("/taskForm", name="taskForm")
     */
	public function CreateTask(Request $request){
        // creates a task and gives it some dummy data for this example
        $task = new Task();
        $task->setTask('Write a Program');
        $task->setTaskPriority('Normal');

        $form = $this->createFormBuilder($task)
            ->add('task', TextType::class,array('attr' => array('class'=> 'form-control')))
            ->add('taskPriority', TextType::class,array('attr' => array('class' => 'form-control')))
           /* ->add('comment'),TextareaType::class,(array('atr' => array('class' => 'form-control')))*/
            ->add('save', SubmitType::class, array('label' => 'Create Task','attr' => (array('class' => 'btn btn-primary'))))
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
        	 $task = $form->getData();
        	 return $this->redirectToRoute('task_success');
        }
        return $this->render('task.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}