<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;


class SecurityController extends Controller{
 /**
     * @Route("/login", name="login")
     */
    public function login(){
        return $this->render('login.html.twig');
    }
    /**
     * @Route("/register", name="register")
     */
    public function register(){
        return $this->render('register.html.twig');
    }
}