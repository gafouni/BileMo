<?php

namespace App\Controller;
use JMS\Serializer\Serializer;
use OpenApi\Annotations as OA;
use App\Repository\PhoneRepository;
use Nelmio\ApiDocBundle\Annotation\Model;
use Symfony\Contracts\Cache\ItemInterface;
use Nelmio\ApiDocBundle\Annotation\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Contracts\Cache\TagAwareCacheInterface;
use JMS\Serializer\SerializerInterface;
use JMS\Serializer\SerializationContext;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api", name="api_")
 */

class PhoneController extends AbstractController
{
     
    /**
     * Cette méthode permet de récupérer l'ensemble des telephones.
     * 
     * @OA\Response(
     *     response=200,
     *     description="Liste des telephones",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Phone::class))
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
     * @OA\Tag(name="Phones")
     * @Security(name="Bearer")
     *
     * @param PhoneRepository $phoneRepository
     * @param SerializerInterface $serializer
     * @param Request $request
     * @return JsonResponse
     */
    /** 
     * @Route("/phones/list", name="phoneList", methods={"GET"})
     */
    public function phoneList(PhoneRepository $phoneRepository, SerializerInterface $serializer,
                                Request $request, TagAwareCacheInterface $cachePool): JsonResponse

    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 4);

        $idCache = "phoneList-" . $page . "-" . $limit;
        $phoneList = $cachePool->get($idCache, function (ItemInterface $item) use ($phoneRepository, $page, $limit) {
            $item->tag("phonesCache");
            return $phoneRepository->findAllWithPagination($page, $limit);
        });

        // $phoneList = $phoneRepository->findAllWithPagination($page, $limit);
        $jsonPhoneList = $serializer->serialize($phoneList, 'json');

        return new JsonResponse($jsonPhoneList, Response::HTTP_OK, [], true);
    }



    /**
     * Cette méthode permet de récupérer un telephone avec ses details.
     *
     * @OA\Response(
     *     response=200,
     *     description="Details du telephone selectionne",
     *     @OA\JsonContent(
     *        type="array",
     *        @OA\Items(ref=@Model(type=Phone::class))
     *     )
     * )
     * 
     * @OA\Response(
     *     response=404,
     *     description="La ressource demandee est introuvable",
     * )
     * 
     * @OA\Parameter(
     *     name="id",
     *     in="query",
     *     description="L'id du telephone que l'on veut recuperer",
     *     @OA\Schema(type="int")
     * )
     *
     * @OA\Tag(name="Phones")
     * @Security(name="Bearer")
     *
     * @param PhoneRepository $phoneRepository
     * @param SerializerInterface $serializer
     * @param Request $request
     * @return JsonResponse
     */
    /**
     * @Route("/phones/{id}", name="showPhone", methods={"GET"})
     */
    public function showPhone(int $id, SerializerInterface $serializer, PhoneRepository $phoneRepository):JsonResponse
    {
        $phone = $phoneRepository->find($id);
        if($phone){
            $jsonPhone = $serializer->serialize($phone, "json");
            return new JsonResponse($jsonPhone, Response::HTTP_OK, [], true);
        }
        return new JsonResponse(null, Response::HTTP_NOT_FOUND);

    }




}
