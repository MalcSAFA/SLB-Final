<?php

namespace App\Controller;

use App\Entity\Perfil;
use App\Entity\Respuestas;
use App\Entity\Seguidores;
use App\Entity\Tweets;
use App\Entity\Usuario;
use App\Repository\RespuestasRepository;
use App\Repository\RtRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/respuesta')]
class RespuestaController extends AbstractController
{
    #[Route('', name: "respuesta_list", methods: ["GET"])]
    public function list_respuesta(RespuestasRepository $respuestasRepository):JsonResponse
    {
        $list = $respuestasRepository->findAll();

        return $this->json($list);
    }
    #[Route('', name: "crear_respuesta", methods: ["POST"])]
    public function crear_respuesta(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        $nuevarespuesta = new Respuestas();
        $nuevarespuesta->setTexto($json["texto"]);

        // Obtener el tweet basado en el id_tweet
        $tweet = $entityManager->getRepository(Tweets::class)->findOneBy(["id" => $json["id_tweet"]]);
        $nuevarespuesta->setTweet($tweet);

        // Obtener el usuario basado en el id_usuario
        $usuario = $entityManager->getRepository(Usuario::class)->findOneBy(["id" => $json["id_usuario"]]);
        $nuevarespuesta->setUsuario($usuario);

        $entityManager->persist($nuevarespuesta);
        $entityManager->flush();

        return $this->json(['message' => 'Respuesta creada'], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: "editar_respuesta", methods: ["PUT"])]
    public function editar_respuesta(EntityManagerInterface $entityManager, Request $request, Respuestas $respuestas):JsonResponse
    {
        $json = json_decode($request-> getContent(), true);

        $respuestas->setTexto($json["texto"]);

        $tweet = $entityManager->getRepository(Tweets::class)->findOneBy(["id" => $json["id_tweet"]]);
        $respuestas->setTweet($tweet);

        $entityManager->flush();

        return $this->json(['message' => 'Respuesta modificada'], Response::HTTP_OK);
    }


    #[Route('/{id}', name: "respuesta_delete_by_id", methods: ["DELETE"])]
    public function deleteById_respuesta(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        // Buscar el tweet en la base de datos
        $respuestas = $entityManager->getRepository(Respuestas::class)->find($id);

        // Verificar si se encontró el tweet
        if (!$respuestas) {
            return $this->json(['message' => 'No se encontró el tweet con el ID proporcionado'], Response::HTTP_NOT_FOUND);
        }

        // Eliminar el tweet
        $entityManager->remove($respuestas);
        $entityManager->flush();

        return $this->json(['message' => 'Tweet eliminado correctamente'], Response::HTTP_OK);
    }

}