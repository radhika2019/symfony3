<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\ORM\EntityRepository;

class membersController extends Controller{
	 /**
     * @Route("/members", name="members")
     */
	public function listUsers(){
		$em = $this->getDoctrine()->getManager();
	 	$result = $em->getRepository('AppBundle:members')
            ->getMembers();
        //dump($result);
        //die;
       // return new Response($result);
        return $this->render('members.html.twig', array(
            'users' => $result,
        ));
    }
}
?>