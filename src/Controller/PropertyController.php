<?php
namespace App\Controller;

use App\Entity\Property;
use App\Entity\PropertySearch;
use App\Form\PropertySearchType;
use App\Repository\PropertyRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\Common\Persistence\ObjectManager;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;




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

   public function index(Request $request, PaginatorInterface $paginator) // Nous ajoutons les paramètres requis
   {
      $search = new PropertySearch;
      $form = $this->createform(PropertySearchType::class, $search);
      $form->handleRequest($request);
       // Méthode findBy qui permet de récupérer les données avec des critères de filtre et de tri
       $donnees = $this->getDoctrine()->getRepository(Property::class)->findAllVisibleQuery($search);

       $properties = $paginator->paginate(
           $donnees, // Requête contenant les données à paginer (ici nos articles)
           $request->query->getInt('page', 1), // Numéro de la page en cours, passé dans l'URL, 1 si aucune page
           6 // Nombre de résultats par page
       );
       
       return $this->render('property/index.html.twig', [
         'current_menu' => 'properties',
               'properties' => $properties,
               'form' => $form->createview()
       ]);
   }


   /**
 * @route("/biens/{slug}-{id}", name="property.show", requirements={"slug": "[a-z0-9\-]*"})
 * @param  Property $property
 * @return Response
 */

 public function show(Property $property,string $slug): Response
 {
    if ($property->getslug() !== $slug)
    {
      return $this->redirectToRoute('property.show', [
         'id' => $property->getId(),
         'slug' => $property->getSlug()
      ], 301);
    }
   return $this->render('property/show.html.twig', [
      'property' => $property,
      'current_menu' => 'properties'

   ]);
 }
 }