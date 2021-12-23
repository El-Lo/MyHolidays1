<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

 
// src/Controller/MainController.php
namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;
 
/**
 * Description of HomeController
 *
 * @author PCAwesomeness
 */
class HomeController extends AbstractController {

    /**
     * @Route("/", name="home" )
     * @return Reponse
     */
    public function index() : Response
    {
        return $this->render("pages/home.html.twig");
    }
}
