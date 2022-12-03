<?php

namespace App\Controller;

use App\Entity\User;

use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Security\Core\User\User;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    private  UserPasswordHasherInterface $hasher;

    public function __construct(UserPasswordHasherInterface $hasher)
        {
            $this->hasher = $hasher;
        }


    /**
     * @Route("/api/users/list", name="userList", methods={"GET"})
     */
    public function userList(UserRepository $userRepository, SerializerInterface $serializer): JsonResponse
    {
        $userList = $userRepository->findAll();
        $jsonUserList = $serializer->serialize($userList, 'json');

        return new JsonResponse($jsonUserList, Response::HTTP_OK, [], true);
    }


    /**
     * @Route("/api/users/{id}", name="UserShow", methods={"GET"})
     */
    public function UserShow(int $id, SerializerInterface $serializer, UserRepository $userRepository):JsonResponse
    {
        $user = $userRepository->find($id);
        if($user){
            $jsonUser = $serializer->serialize($user, "json");
            return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTO_NOT_FOUND); 

    }

    /**
     * @Route("/api/users/new", name="user_new", methods={"POST", "GET"})
     */
    public function createUser(Request $request, UserRepository $userRepository, 
                                SerializerInterface $serializer): JsonResponse

    {
        //On recupere le contenu de la requete
        $data = $request->getContent();
        //On deserialise l'element $data
        $user = $serializer->deserialize($data, User::class, 'json');
      
        $user->getCreatedAt(new \DateTime('now'));  
        //$user->setClient($this->getClient()); 

        $userNew = $userRepository->add($user);

        $jsonUserNew = $serializer->serialize($userNew, 'json');
        
        return new JsonResponse($jsonUserNew, Response::HTTP_CREATED, [], true);

    }


    /**
     * @Route("/api/users/{id}", name="deleteUser", methods= {"DELETE"})
     */
    //public function deleteUser(int $id, User $user, EntityManagerInterface $em): JsonRespponse
    public function deleteUser(int $id, User $user, UserRepositiry $userRepository): JsonRespponse
    {
        $user = $userRepository->find($id);
        $userRepository->remove($user, true);
        // $em->remove($user);
        // $em->flush();

        return new JsonReponse(null, Response::HTTP_NO_CONTENT);

    }


}