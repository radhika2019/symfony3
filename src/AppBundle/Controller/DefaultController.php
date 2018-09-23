<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Task;
use AppBundle\Form\FormType;

class DefaultController extends Controller{
    /**
     * @Route("/", name="home")
     */
    public function indexAction(Request $request){
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
    /**
    * @Route("/about", name="about")
    */
    public function about(){
        return $this->render('about.html.twig');
    }

    /**
    * @Route("/TaskManagement", name="task_manage")
    */
    public function TaskManagement(){
        $entityManager = $this->getDoctrine()->getManager();
        $TaskArr =  $entityManager->getRepository('AppBundle:Task')->findAll();
        //dump($TaskArr);
        //die;
        return $this->render('task_manage.html.twig', array(
            'TaskArr' => $TaskArr
        ));
    }

    /**
    * @Route("/task", name="add_task")
    */
    public function CreateTask(Request $request){

        $task = new Task();
        $form = $this->createForm(FormType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             $task = $form->getData();
             // saving the data to the database
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($task);
             $entityManager->flush();
            // return new Response('<html><body>Task Created</body></html>');
             return $this->TaskManagement();
        }
        return $this->render('task.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
    * @Route("/edit_task/{task_id}", name="edit_task")
    */ 
    public function fetchTask_UpdateTask($task_id, Request $request){
        $entityManager = $this->getDoctrine()->getManager();
        $TaskArr = $entityManager->getRepository('AppBundle:Task')->find($task_id);
        
        $taskobj = new Task();
        $taskobj->setTask($TaskArr->task);
        $taskobj->setTaskPriority($TaskArr->taskPriority);
        $taskobj->setTaskComment($TaskArr->taskComment);
        $taskobj->setStatus($TaskArr->taskStatus);
        $form = $this->createForm(FormType::class, $taskobj);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            
            $getformData = $form->getData();
            $TaskArr->setTask($getformData->task);
            $TaskArr->setTaskPriority($getformData->taskPriority);
            $TaskArr->setTaskComment($getformData->taskComment);
            $TaskArr->setStatus($getformData->taskStatus);

            $entityManager->flush();
            return $this->TaskManagement();
           // return new Response('<html><body>Task Updated Successfully</body></html>');
        }
        return $this->render('task.html.twig', array(
            'form' => $form->createView(),
        ));
    }

    /**
    * @Route("/delete_task", name="delete_task")
    */ 
    public function deleteTask(Request $request){
        $task_id =  $request->request->get('del_id');
        $entityManager = $this->getDoctrine()->getManager();
        $TaskRecord = $entityManager->getRepository('AppBundle:Task')->find($task_id);
        $entityManager->remove($TaskRecord);
        $entityManager->flush();
        return new Response('Task Deleted Successfully');
    }

}
