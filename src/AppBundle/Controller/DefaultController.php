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
     * @Route("/genus/{genusName}")
     */ 
    public function ShowAction($genusName){
        return new Response('Under the sea: '.$genusName);
    }

      /**
     * @Route("/task", name="task")
     */
    public function task(Request $request){

        $task = new Task();
        $task->setTaskPriority('Normal'); //default value
        $form = $this->createForm(FormType::class, $task);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
             $task = $form->getData();
             // saving the data to the database
             $entityManager = $this->getDoctrine()->getManager();
             $entityManager->persist($task);
             $entityManager->flush();
             return new Response('<html><body>Task Created</body></html>');
            // return $this->redirectToRoute('task_success');
        }
        return $this->render('task.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
