<?php
namespace App\Controller\Admin;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\PropertyType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;







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
    * @route("/admin", name="admin")
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
    * @route("/admin/property/{id}", name="admin.property.edit")
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
     
        return $this->render('property/index.html.twig');
       }
      
    return $this->render('admin/property/edit.html.twig', [
        'property' => $property,
        'form' => $form->createview()
    ]);
    }


    
    }

