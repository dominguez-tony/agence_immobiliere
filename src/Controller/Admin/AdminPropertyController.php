<?php
namespace App\Controller\Admin;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Entity\Property;
use Doctrine\Common\Persistence\ObjectManager;





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
    * @return Response
     */
    

    public function edit(Property $property): Response
    {
    
    
       
    
    return $this->render('admin/property/edit.html.twig', [

        'property' => $property,
    ]);
    }


    
    }

