<?php

namespace App\Controller;

use App\Repository\PhoneRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\SerializerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/api", name="api_")
 */

class PhoneController extends AbstractController
{
    /** 
     * @Route("/phones/list", name="phoneList", methods={"GET"})
     */
    public function phoneList(PhoneRepository $phoneRepository, SerializerInterface $serializer,
                                Request $request): JsonResponse
    {
        $page = $request->get('page', 1);
        $limit = $request->get('limit', 4);
        $phoneList = $phoneRepository->findAllWithPagination($page, $limit);
        $jsonPhoneList = $serializer->serialize($phoneList, 'json');

        return new JsonResponse($jsonPhoneList, Response::HTTP_OK, [], true);
    }


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
