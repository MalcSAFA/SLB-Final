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
    public function crear_respuesta(EntityManagerInterface $entityManager, Request $request):JsonResponse
    {
        $json = json_decode($request-> getContent(), true);

        $nuevarespuesta = new Respuestas();
        $nuevarespuesta->setTexto($json["texto"]);

        $tweet = $entityManager->getRepository(Tweets::class)->findOneBy(["id" => $json["id_tweet"]]);
        $nuevarespuesta->setTweet($tweet);

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
    #[Route('/{id}', name: "delete_by_id", methods: ["DELETE"])]
    public function deleteById_respuesta(EntityManagerInterface $entityManager, Respuestas $respuestas):JsonResponse
    {
        $entityManager->remove($respuestas);
        $entityManager->flush();

        return $this->json(['message' => 'Respuesta eliminada'], Response::HTTP_OK);

    }
}