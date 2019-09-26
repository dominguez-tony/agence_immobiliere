<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\RegistrationType;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
// use App\Controller\Admin\AdminPropertyController;


class SecurityController extends AbstractController
{
    /**
     * @Route("/inscription", name="registration")
     * @param Request $request
     * @param ObjectManager $manager
     */
    public function registration(Request $request, ObjectManager $manager, UserPasswordEncoderInterface $encoder)
    {
        
        $user = new User();
      $form = $this->createform(RegistrationType::class, $user);

      $form->handleRequest($request);

      if ($form->isSubmitted() && $form->isValid()){
          $hash = $encoder->encodePassword($user, $user->getPassword());
          $user->setPassword($hash);
       $manager->persist($user);
       $manager->flush();
    //    $this->$em->addFlash('success','Membre Créé avec Succès!!!');
       return $this->redirectToRoute('admin.property.index');
      }

   
      return $this->render('security/registration.html.twig', [
        'form' => $form->createview()
    ]);

    }
    /**
     * @route("/connexion", name="security_login")
     */

    public function login()
    {
       
        return $this->render('security/login.html.twig');


        
    }


   





}
