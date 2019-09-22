<?php
namespace App\Controller\Admin;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Form\UserType;
use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use App\Controller\Admin\AdminPropertyController;




class AdminUserController extends AbstractController
{


  /**
    *@var UserRepository  
     */

    private $repository;

   /**
    *@var ObjectManager  
     */
    private $em;


    public function __construct(UserRepository $repository, ObjectManager $em)
    {
       $this->repository = $repository;
       $this->em = $em;
    }

  /**
    * @route("/admin/user", name="admin.user.register")
    * @return Response
    */
    
    public function index(): Response
    {
    
    return $this->render('admin/user/register.html.twig');
    }

    /**
    * @route("/admin/register", name="admin.user.register")
    * @param  User $user
    * @param  userType $form
    *@param  Request $request
    *@param  UserRepository $repository
    * @return Response
     */

    public function new(Request $request)
    {
       $user = new User;
       $form = $this->createform(UserType::class, $user);
       $form->handleRequest($request);

       if ($form->isSubmitted() && $form->isValid()){

        $this->em->persist($user);
        $this->em->flush();
        $this->addFlash('success','Bien joué vous êtes nouveau membre!!!');
        return $this->redirectToRoute('admin');
       }
      
    return $this->render('admin/user/register.html.twig', [
        'user' => $user,
        'form' => $form->createview()
    ]);

    }


  //   /**
  //   * @route("/admin", name="admin")
  //   *@param  Request $request
  //   *@param PropertyRepository  $repository
  //   *@param  UserRepository $repository
  //   * @return Response
  //    */
  

  //   public function getBackOffice(): Response
  //   {
    
    

  // }

}