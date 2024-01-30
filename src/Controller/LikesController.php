<?php

namespace App\Controller;

use App\Entity\Likes;
use App\Entity\Perfil;
use App\Entity\Seguidores;
use App\Repository\LikesRepository;
use App\Repository\NotificacionesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/likes')]
class LikesController
{
    #[Route('', name: "likes_list", methods: ["GET"])]
    public function list_likes(LikesRepository $likesRepository):JsonResponse
    {
        $list = $likesRepository->findAll();

        return $this->json($list);
    }
    #[Route('/{id}', name: "delete_by_id", methods: ["DELETE"])]
    public function deleteById_like(EntityManagerInterface $entityManager, Likes $likes):JsonResponse
    {
        $entityManager->remove($likes);
        $entityManager->flush();

        return $this->json(['message' => 'Like eliminado'], Response::HTTP_OK);

    }
}