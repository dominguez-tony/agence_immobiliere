<?php
namespace App\Controller\Admin;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use Doctrine\Common\Persistence\ObjectManager;
use App\Form\PropertyType;






class AdminPropertyController extends AbstractController{


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
    * @return Response
     */
    

    public function edit(Property $property,PropertyType $form): Response
    {
    
    $form = $this->createform(PropertyType::class, $property);
       
    
    return $this->render('admin/property/edit.html.twig', [
        'property' => $property,
        'form' => $form->createview()
    ]);
    }


    
    }

