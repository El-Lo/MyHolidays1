<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller\admin;

use App\Entity\Visite;
use App\Form\VisiteType;
use App\Repository\VisiteRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * Description of AdminVoyagesController
 *
 * @author PCAwesomeness
 */
class AdminVoyagesController extends AbstractController {
    /**
     * @var VisiteRepository
     */
    private $repository;
    /**
     * 
     * @var EntityManagerInterface
     */
    private $orm;
    /**
     * 
     * @param VisiteRepository $repository
     * @param EntityManagerInterface $orm
     */
    public function __construct(VisiteRepository $repository, EntityManagerInterface $orm) {
       $this->repository = $repository;
       $this->orm = $orm;
    }

    
            
            
            /** 
     * @Route("/admin", name="admin.voyages" )
     * @return Reponse
     */
    public function index() : Response
    {
         $visites = $this->repository->findAllOrderBy('datecreation','DESC');
        return $this->render("admin/admin.voyage.html.twig", [
            'visites' => $visites
        ]);
    }
    /**
     * @Route("/admin/edit/{id}", name="admin.voyage.edit")
     * @param Visite $visite
     * @return Response
     */
    public function edit(Visite $visite, Request $request) : Response
    {
        $formVisite= $this->createForm(VisiteType::class,$visite);
        $formVisite->handleRequest($request);
        if($formVisite->isSubmitted() && $formVisite->isValid())
        {
            $this->orm->flush();
            return $this->redirectToRoute('admin.voyages');
        }
        return $this->render("admin/admin.voyage.edit.html.twig", [
            'visite' => $visite,
            'formvisite' =>$formVisite->createView()
                
        ]);
    }    
    /**
     * @Route("/admin/ajout", name="admin.voyage.ajout")
     * @param Request $request
     * @return Response
     */
    public function ajout(Request $request) : Response
    {
        $visite = new Visite();
        $formVisite= $this->createForm(VisiteType::class, $visite);
        $formVisite->handleRequest($request);
        if($formVisite->isSubmitted() && $formVisite->isValid())
        {
            $this->orm->persist($visite);
            $this->orm->flush();
            return $this->redirectToRoute('admin.voyages');
            
        }
        return $this->render("admin/admin.voyage.ajout.html.twig", [
            'visite' => $visite,
            'formvisite' => $formVisite->createView()
        ]);
    }
    /**
     * @Route("/admin/suppr/{id}", name="admin.voyage.suppr")
     * @param Visite $visite
     * @return Response
     */
    public function suppr(Visite $visite): Response
    {
        $this->orm->remove($visite);
        $this->orm->flush();
        return $this->redirectToRoute("admin.voyages");
        
    }
}
