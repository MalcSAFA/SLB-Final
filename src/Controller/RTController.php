<?php

namespace App\Controller;

use App\Entity\Rt;
use App\Entity\Tweets;
use App\Entity\Usuario;
use App\Repository\RtRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request; // Agrega esta línea
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/rt')]
class RTController extends AbstractController
{
    #[Route('', name: "rt_list", methods: ["GET"])]
    public function list_rt(RtRepository $rtRepository): JsonResponse
    {
        $list = $rtRepository->findAll();

        return $this->json($list);
    }

    #[Route('', name: "crear_rt", methods: ["POST"])]
    public function crear_rt(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        $rt = new Rt();

        $usuario = $entityManager->getRepository(Usuario::class)->find($json["id_usuario"]);
        $tweet = $entityManager->getRepository(Tweets::class)->find($json["id_tweet"]);

        if (!$usuario || !$tweet) {
            return $this->json(['message' => 'Usuario o Tweet no encontrado'], Response::HTTP_NOT_FOUND);
        }

        $rt->setUsuario($usuario);
        $rt->setTweet($tweet);

        $entityManager->persist($rt);
        $entityManager->flush();

        return $this->json(['message' => 'RT creado'], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: "delete_by_id_rt", methods: ["DELETE"])]
    public function deleteById_rt(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        // Buscar el RT en la base de datos
        $rt = $entityManager->getRepository(Rt::class)->find($id);

        // Verificar si se encontró el RT
        if (!$rt) {
            return $this->json(['message' => 'No se encontró el RT con el ID proporcionado'], Response::HTTP_NOT_FOUND);
        }

        // Eliminar el RT
        $entityManager->remove($rt);
        $entityManager->flush();

        return $this->json(['message' => 'RT eliminado correctamente'], Response::HTTP_OK);
    }
}
