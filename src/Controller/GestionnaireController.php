<?php

namespace App\Controller;
use App\Entity\Bien;
use App\Entity\User;
use App\Form\BienType;
use App\Repository\BienRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class GestionnaireController extends AbstractController
{
   /**
     * @Route("/gestionnaire/show", name="gestionnaire_show",methods={"GET"})
     */
    public function show (BienRepository $repo): Response
    {
        $bien=$repo->findAll();
        
        return $this->render('gestionnaire/index.html.twig', [
            'bien' => $bien,
        ]);
    }

     /**
     * @Route("/gestionnaire/delete{id}", name="gestionnaire_delete",methods={"GET"})
     */
    public function delete(bien $article,BienRepository $repo,EntityManagerInterface $manager): Response
    {
        $manager->remove($article);
        $manager->flush();
        return $this->redirectToRoute("gestionnaire_show");
       
    }
     /**
     * @Route("/gestionnaire/add{id?}", name="gestionnaire_add",methods={"POST","GET"})
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
            return $this->redirectToRoute("gestionnaire_show");
        }
        ;
        return $this->render('bien/form.html.twig',['form' => $form->createView()]);
    }


      /**
     * @Route("/gestionnaire/show/user", name="gestionnaire_show_user",methods={"GET"})
     */
    public function shows_user (UserRepository $repo): Response
    {
        $user=$repo->findAll();
        
        return $this->render('gestionnaire/user.html.twig', [
            'user' => $user,
        ]);
    }

     /**
     * @Route("/gestionnaire/delete/user{id}", name="gestionnaire_delete_user",methods={"GET"})
     */
    public function delete_user(User $user,UserRepository $repo,EntityManagerInterface $manager): Response
    {
        $manager->remove($user);
        $manager->flush();
        return $this->redirectToRoute("gestionnaire_show_user");
       
    }

}
