<?php

namespace App\Controller;

use App\Entity\Likes;
use App\Entity\Usuario;
use App\Entity\Tweets;
use App\Repository\LikesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/likes')]
class LikesController extends AbstractController
{
    #[Route('', name: "likes_list", methods: ["GET"])]
    public function list_likes(LikesRepository $likesRepository): JsonResponse
    {
        $list = $likesRepository->findAll();
        return $this->json($list);
    }

    #[Route('', name: "crear_like", methods: ["POST"])]
    public function crear_like(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        $like = new Likes();
        $like->setRecuento(1); // Assuming recuento means count and starts with 1

        $usuario = $entityManager->getRepository(Usuario::class)->find($json["id_usuario"]);
        $tweet = $entityManager->getRepository(Tweets::class)->find($json["id_tweet"]);

        if (!$usuario || !$tweet) {
            return $this->json(['message' => 'Usuario o Tweet no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $like->setUsuario($usuario);
        $like->setTweet($tweet);

        $entityManager->persist($like);
        $entityManager->flush();

        return $this->json(['message' => 'Like creado'], Response::HTTP_CREATED);
    }



    #[Route('/{id}', name: "likes_delete_by_id", methods: ["DELETE"])]
    public function deleteById_likes(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        // Buscar el tweet en la base de datos
        $likes = $entityManager->getRepository(Likes::class)->find($id);

        // Verificar si se encontró el tweet
        if (!$likes) {
            return $this->json(['message' => 'No se encontró el like con el ID proporcionado'], Response::HTTP_NOT_FOUND);
        }

        // Eliminar el tweet
        $entityManager->remove($likes);
        $entityManager->flush();

        return $this->json(['message' => 'Like eliminado correctamente'], Response::HTTP_OK);
    }

}
