<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

namespace App\Controller\admin;

use App\Entity\Environnement;
use App\Entity\Visite;
use App\Repository\EnvironnementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Description of AdminEnvironnementController
 *
 * @author PCAwesomeness
 */
class AdminEnvironnementController extends AbstractController {
   
    /**
     * 
     * @var EnvironnementRepository
     */
    private $repository;
    
    /**
     * 
     * @var EntityManagerInterface
     */
    private $orm;
    
    public function __construct(EnvironnementRepository $repository, EntityManagerInterface $om) {
        $this->repository = $repository;
        $this->orm = $om;
    }

              /** 
     * @Route("/admin/environnement", name="admin.environnements" )
     * @return Reponse
     */
    public function index() : Response
    {
         $environnements = $this->repository->findAll();
         return $this->render("admin/admin.environnements.html.twig",
                 [
                     'environnements' => $environnements
                 ]);
    }
    
     /**
     * @Route("/admin/environnement/suppr/{id}", name="admin.environnement.suppr")
     * @param Visite $visite
     * @return Response
     */
    public function suppr(Environnement $environnement): Response
    {
        $this->orm->remove($environnement);
        $this->orm->flush();
        return $this->redirectToRoute("admin.environnements");
        
    }
    
      /**
     * @Route("/admin/environnement/ajout", name="admin.environnement.ajout")
     * @param Request $request
     * @return Response
     */
    public function ajout(Request $request) : Response
    {
        $nomEnvironnement = $request->get("nom");
         $environnement = new Environnement();
         $environnement->setNom($nomEnvironnement);
         $this->orm->persist($environnement);
         $this->orm->flush();
       return $this->redirectToRoute("admin.environnements");
        
    }
}
