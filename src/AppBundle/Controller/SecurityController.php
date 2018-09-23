<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\members;
use AppBundle\Form\UserType;


class SecurityController extends Controller{

    /**
     * @Route("/register", name="register")
     */
    public function register(Request $request){
        $users = new members();
        $form = $this->createForm(UserType::class, $users);
        return $this->render('register.html.twig', array(
            'registerform' => $form->createView(),
        ));
    }

     /**
     * @Route("/login", name="login")
     */
    public function login(Request $request){
        $users = new members();
        $form = $this->createForm(UserType::class, $users);
        $form->handleRequest($request);
        return $this->render('login.html.twig', array(
            'loginform' => $form->createView(),
        ));
        return $this->render('login.html.twig');
    }
}