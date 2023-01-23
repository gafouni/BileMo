<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Client;
use DateTimeImmutable;
use JMS\Serializer\Serializer;
use App\Repository\UserRepository;
use JMS\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
//use Symfony\Component\Security\Core\User\User;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
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
     *  Cette méthode permet de récupérer l'ensemble des utilisateurs.
     *
     * @OA\Response(
     *     response=200,
     *     description="Retourne la liste des utilisateurs",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=User::class))
     *     )
     * )
     * 
     * @OA\Parameter(
     *     name="page",
     *     in="query",
     *     description="La page que l'on veut récupérer",
     *     @OA\Schema(type="int")
     * )
     *
     * @OA\Parameter(
     *     name="limit",
     *     in="query",
     *     description="Le nombre d'éléments que l'on veut récupérer",
     *     @OA\Schema(type="int")
     * )
     * @OA\Tag(name="Users")
     *
     * 
     */


    /**
     * @Route("/api/users/list", name="userList", methods={"GET"})
     */
    public function userList(UserRepository $userRepository, SerializerInterface $serializer,
                            Request $request): JsonResponse
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 3);

        $userList = $userRepository->findAllWithPagination($page, $limit);
        $jsonUserList = $serializer->serialize($userList, 'json');

        return new JsonResponse($jsonUserList, Response::HTTP_OK, [], true);
    }


    /**  
     *  Cette méthode permet de récupérer les details d'un utilisateur.
     *
     * @OA\Response(
     *     response=200,
     *     description="Retourne les details d'un utilisateur",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=User::class))
     *     )
     * )
     * 
     * @OA\Response(
     *     response=404,
     *     description="L'utilisateur est introuvable"
     * )
     * 
     * @OA\Parameter(
     *     name="id",
     *     in="query",
     *     description="L'utilisateur que l'on veut récupérer",
     *     @OA\Schema(type="int")
     * )
     *
     * *
     * @OA\Tag(name="Users")
     *
     * 
     */    


    /**
     * @Route("/api/users/{id}", name="userShow", methods={"GET"})
     */
    public function UserShow(int $id, SerializerInterface $serializer, UserRepository $userRepository):JsonResponse
    {
        $user = $userRepository->find($id);
        if($user){
            $jsonUser = $serializer->serialize($user, "json");
            return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        
    }
        
    /** 
        * @OA\Response(
        *     response=201,
        *     description="Affiche les details de l'utilisateur cree",
        *     @SWG\Schema(
        *         type="array",
        *         @SWG\Items(ref=@Model(type=User::class))
        *     )
        * )
        * 
        * @OA\Parameter(
        *     name="User",
        *     in="body",
        *     @Model(type=UserType::class)
        * )
        * @OA\Tag(name="users")
        *
        */
    

    /**
     * @Route("/api/users", name="user_new", methods={"POST"})
     */
    public function createUser(Request $request, UserRepository $userRepository, 
                                SerializerInterface $serializer, UrlGeneratorInterface $urlGenerator,
                                ValidatorInterface $validator): JsonResponse

    {
        //On recupere le contenu de la requete recue
        $data = $request->getContent();
        //On deserialise l'element $data
        $user = $serializer->deserialize($data, User::class, 'json');

        //Verification des erreurs
        $errors = $validator->validate($user);

        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), 
            JsonResponse::HTTP_BAD_REQUEST, [], true);
        }
      
        $client = new Client();

        $user->getClient($client);
        $user->getCreatedAt(new DateTimeImmutable('now'));  
        

        $userNew = $userRepository->add($user, true);

        $jsonUserNew = $serializer->serialize($userNew, 'json');

       
        
        return new JsonResponse($jsonUserNew, Response::HTTP_CREATED, [], true);

    }


        /**
        * @OA\Response(
        *     response=204,
        *     description="L'utilisateur a ete supprime"
        * )
        * 
        * @OA\Response(
        *     response=404,
        *     description="L'utilisateur n'existe pas"
        * )
        *    
        * @OA\Tag(name="users")
        */


    /**
     * @Route("/api/users/{id}", name="deleteUser", methods= {"DELETE"})
     */
    public function deleteUser( int $id, UserRepository $userRepository): JsonResponse
    {

        $user = $userRepository->find($id);

        $userRepository->remove($user, true);

        return new JsonResponse(null, Response::HTTP_NO_CONTENT);

    }


}
