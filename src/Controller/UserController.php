<?php

namespace App\Controller;

use DateTime;
use App\Entity\User;
use App\Entity\Client;
use DateTimeImmutable;
use JMS\Serializer\Serializer;
use App\Repository\UserRepository;
use App\Repository\ClientRepository;
use JMS\Serializer\SerializerInterface;
use Doctrine\ORM\EntityManagerInterface;
use JMS\Serializer\SerializationContext;
use Symfony\Contracts\Cache\ItemInterface;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Contracts\Cache\CacheInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserController extends AbstractController
{
    private $userPasswordHacher;

    public function __construct(UserPasswordHasherInterface $userPasswordHacher, 
                                SerializerInterface $serializer)
    {
        $this->userPasswordHasher = $userPasswordHacher;
        $this->serializer = $serializer;
    }

     /**  
     * 
     * 
     * Cette méthode permet de récupérer l'ensemble des utilisateurs.
     * 
     * @OA\Response(
     *     response=200,
     *     description="Liste des utilisateurs",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=User::class, groups={"getUsers"}))
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
     * @Security(name="Bearer")
     * 
     * @param UserRepository $userRepository
     * @param SerializerInterface $serializer
     * @param Request $request
     * @return JsonResponse
     */
    /**
     * @Route("/api/users/list", name="userList", methods={"GET"})
     */
    public function userList(UserRepository $userRepository, SerializerInterface $serializer,
                            Request $request, TagAwareCacheInterface $cachePool): JsonResponse
    {

        $page = $request->get('page', 1);
        $limit = $request->get('limit', 4);

        $idCache = "userList-" . $page . "-" . $limit;
        $userList = $cachePool->get($idCache, function (ItemInterface $item) use ($userRepository,
            $page, $limit) {
            $item->tag("usersCache");
            return $userRepository->findAllWithPagination($page, $limit);
        });

        $context = SerializationContext::create()->setGroups(['getUsers']);

        $jsonUserList = $serializer->serialize($userList, 'json', $context);

        return new JsonResponse($jsonUserList, Response::HTTP_OK, [], true);
        
    }


    /**  
     *  Cette méthode permet de récupérer les details d'un utilisateur.
     *
     * @OA\Response(
     *     response=200,
     *     description="Details de l'utilisateur",
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
     * @Security(name="Bearer")
     * 
     * @param int $id
     * @param UserRepository $userRepository
     * @return JsonResponse
     * 
     */    
    /**
     * @Route("/api/users/{id}", name="userShow", methods={"GET"})
     */
    public function UserShow(int $id, SerializerInterface $serializer, UserRepository $userRepository):JsonResponse
    {
        $user = $userRepository->find($id);
        if($user){
            $context = SerializationContext::create()->setGroups(['getUsers']);
            $jsonUser = $serializer->serialize($user, "json", $context);
            return new JsonResponse($jsonUser, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);
        
    }
        
    /** 
     * Cette methode permet de recuperer les details d'un utilisateur
     * 
     * @OA\Response(
     *     response=201,
     *     description="Details de l'utilisateur cree",
     *     @SWG\Schema(
     *         type="array",
     *         @SWG\Items(ref=@Model(type=User::class, groups={"getUsers"}))
     *     )
     * )
     * 
     * @OA\Parameter(
     *     name="User",
     *     in="body",
     *     @Model(type=UserType::class)
     * )
     * @OA\Tag(name="users")
     * @Security(name="Bearer") 
     *
     */
    /**
     * @Route("/api/users", name="user_new", methods={"POST"})
     */
    public function createUser(Request $request, EntityManagerInterface $em, 
                                SerializerInterface $serializer, UrlGeneratorInterface $urlGenerator,
                                ValidatorInterface $validator, ClientRepository $clientRepository,
                                UserPasswordHasherInterface $userPasswordHacher): JsonResponse

    {
        // //On recupere le contenu de la requete recue
        $data = $request->getContent();

        $user = new User();
              
        //On deserialise l'element $data
        $user = $serializer->deserialize($data, User::class, 'json');
        
        $user->setPassword($userPasswordHacher->hashPassword($user, "password"));
        $user->setClient($this->getUser()); 
        $user->setCreatedAt(new \DateTime('now', ));

        //Verification des erreurs
        $errors = $validator->validate($user);

        if ($errors->count() > 0) {
            return new JsonResponse($serializer->serialize($errors, 'json'), 
            JsonResponse::HTTP_BAD_REQUEST, [], true);
        }
       
        //$user->setCreatedAt(new DateTimeImmutable('now'));  
        
        $em->persist($user);
        $em->flush();
        
        $context = SerializationContext::create()->setGroups(['getUsers']);
        $jsonUser = $serializer->serialize($user, 'json', $context);
        return new JsonResponse($jsonUser, Response::HTTP_CREATED, [], true);

    }


    /**
     * Cette methode permet de supprimer un utilisateur
     * 
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
     * @Security(name="Bearer")    
     *    
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
