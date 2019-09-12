<?php
namespace App\Controller;

use App\Repository\PropertyRepository;
use Symfony\Component\HttpFoundation\Response;
use Twig\Environment;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;



class HomeController extends AbstractController
{

    /**
    * @route("/", name="home")
    *@param PropertyRepository  $repository
    * @return Response
     */
    
    // private $twig;

    // public function __construct(Environment $twig)
    // {
    //     $this->twig = $twig;
    // }

public function index(PropertyRepository $repository): Response
{


    $properties = $repository->findLatest();

return $this->render('pages/home.html.twig', [
    'properties' => $properties
]);
}

}