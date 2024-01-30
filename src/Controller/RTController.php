<?php

namespace App\Controller;

use App\Entity\Likes;
use App\Entity\Rt;
use App\Repository\LikesRepository;
use App\Repository\RtRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
#[Route('/api/rt')]
class RTController
{
    #[Route('', name: "rt_list", methods: ["GET"])]
    public function list_rt(RtRepository $rtRepository):JsonResponse
    {
        $list = $rtRepository->findAll();

        return $this->json($list);
    }
    #[Route('/{id}', name: "delete_by_id", methods: ["DELETE"])]
    public function deleteById_rt(EntityManagerInterface $entityManager, Rt $rt):JsonResponse
    {
        $entityManager->remove($rt);
        $entityManager->flush();

        return $this->json(['message' => 'Rt eliminado'], Response::HTTP_OK);

    }
}