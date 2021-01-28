<?php

namespace App\Controller;

use App\Entity\Bien;
use App\Form\BienType;
use App\Repository\BienRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BienController extends AbstractController
{
    /**
     * @Route("/bien/show", name="bien_show",methods={"GET"})
     */
    public function show (BienRepository $repo): Response
    {
        $bien=$repo->findAll();
        
        return $this->render('bien/index.html.twig', [
            'bien' => $bien,
        ]);
    }

     /**
     * @Route("/bien/add{id?}", name="bien_add",methods={"POST","GET"})
     */
    public function add ($id,BienRepository $repo,EntityManagerInterface $manager,Request $request): Response
    {
        if (!empty($id)){
            //gestion du formulaire en mode modification
           $bien=$repo->find($id);
        }else {
       //gestion de formuaire en mode ajout
       $bien=new Bien();
         }
         $form = $this->createForm(BienType::class, $bien);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $manager->persist($bien);
            $manager->flush();
            return $this->redirectToRoute("bien_show");
        }
        ;
        return $this->render('bien/form.html.twig',['form' => $form->createView()]);
    }


     /**
     * @Route("/bien/delete", name="bien_delete",methods={"GET"})
     */
    public function delete (): Response
    {
       
        return $this->render('bien/index.html.twig', [
            'controller_name' => 'BienController',
        ]);
    }

     /**
     * @Route("/bien/update", name="bien_update",methods={"POST"})
     */
    public function update (): Response
    {
       
        return $this->render('bien/index.html.twig', [
            'controller_name' => 'BienController',
        ]);
    }
    
}
