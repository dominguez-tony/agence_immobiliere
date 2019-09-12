<?php
namespace App\Controller;

use App\Entity\Property;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;


 class PropertyController extends AbstractController
 {
     
   public function __construct(PropertyRepository $repository, ObjectManager $em)
   {
      $this->repository = $repository;
      $this->em = $em;
   }


    /**
 * @route("/biens", name="property.index")
 * @return Response
 */

   public function index(): Response
   {
     
   
    
    return $this->render('property/index.html.twig' ,[
        'current_menu' => 'properties'
    ]);   }


 }