<?php
namespace App\Controller\Admin;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\PropertyType;
use Symfony\Component\Security\Csrf\CsrfToken;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;


class AdminPropertyController extends AbstractController{

   /**
    *@var PropertyRepository  
     */

    private $repository;

   /**
    *@var ObjectManager  
     */
    private $em;


    public function __construct(PropertyRepository $repository, ObjectManager $em)
    {
       $this->repository = $repository;
       $this->em = $em;
    }

 /**
    * @route("/admin", name="admin.property.index")
    *@param PropertyRepository  $repository
    * @return Response
     */
    
    public function index(PropertyRepository $repository): Response
    {
    
        $properties = $repository->findAll();
    
    return $this->render('admin/property/index.html.twig', [
        'properties' => $properties
    ]);
    }


 /**
    * @route("/admin/property/create", name="admin.property.new")
    * @param  Property $property
    * @param  PropertyType $form
    *@param  Request $request
    *@param  PropertyRepository $repository
    * @return Response
     */

    public function new(Request $request)
    {
       $property = new Property;
       $form = $this->createform(PropertyType::class, $property);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()){

        $this->em->persist($property);
        $this->em->flush();
        $this->addFlash('success','Bien Créé avec Succès!!!');
        return $this->redirectToRoute('admin.property.index');
       }
      
    return $this->render('admin/property/new.html.twig', [
        'property' => $property,
        'form' => $form->createview()
    ]);

    }

 /**
    * @route("/admin/property/{id}", name="admin.property.edit", methods="GET|POST")
    * @param  Property $property
    * @param  PropertyType $form
    *@param  Request $request
    *@param  PropertyRepository $repository
    * @return Response
     */
    
    public function edit(Property $property,PropertyType $form,Request $request)
    {
    
    $form = $this->createform(PropertyType::class, $property);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()){

        $this->em->flush();
        $this->addFlash('success','Bien Modifié avec Succès!!!');

       
     
        return $this->redirectToRoute('admin');
       }
      
    return $this->render('admin/property/edit.html.twig', [
        'property' => $property,
        'form' => $form->createview()
    ]);
    }


    /**
    * @route("/admin/property/{id}", name="admin.property.delete", methods="DELETE")
    * @param  Property $property
    *@param  Request $request
    *@param Symfony\Component\Security\Csrf\CsrfToken
    * @return Symfony\Component\HttpFoundation\Response
     */


    public function delete(Property $property,Request $request, CsrfTokenManagerInterface $csrfTokenManager)
    {
        $token = new CsrfToken('delete', $request->query->get('_csrf_token'));
        if (!$csrfTokenManager->isTokenValid($token)) {
            throw $this->createAccessDeniedException('Token CSRF invalide');
        }

        $this->em->remove($property);
        $this->em->flush();
        $this->addFlash('success','Bien Supprimé avec Succès!!!');
        return $this->redirectToRoute('admin');
    }

    
    }

