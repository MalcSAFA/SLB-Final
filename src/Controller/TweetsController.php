<?php

namespace App\Controller;

use App\Entity\Tweets;
use App\Entity\Usuario;
use App\Repository\TweetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/tweets')]
class TweetsController extends AbstractController
{
    #[Route('', name: "tweet_list", methods: ["GET"])]
    public function list_usuario(TweetsRepository $tweetsRepository):JsonResponse
    {
        $list = $tweetsRepository->findAll();

        return $this->json($list);
    }
    #[Route('', name: "crear_tweet", methods: ["POST"])]
    public function crear_tweet(EntityManagerInterface $entityManager, Request $request):JsonResponse
    {
        $json = json_decode($request-> getContent(), true);

        $nuevotweet = new Tweets();
        $nuevotweet->setTexto($json["texto"]);
        $nuevotweet->setLink($json["link"]);
        $nuevotweet->setFechaPublicacion($json["fecha_publicacion"]);

        $usuario = $entityManager->getRepository(Usuario::class)->findBy(["id"=> $json["id_usuario"]]);
        $nuevotweet->setUsuario($usuario[0]);


        $entityManager->persist($nuevotweet);
        $entityManager->flush();

        return $this->json(['message' => 'Clase creada'], Response::HTTP_CREATED);
    }
    #[Route('/{id}', name: "editar_tweet", methods: ["PUT"])]
    public function editar_tweet(EntityManagerInterface $entityManager, Request $request, Tweets $tweets):JsonResponse
    {
        $json = json_decode($request-> getContent(), true);

        $tweets->setTexto($json["texto"]);
        $tweets->setLink($json["link"]);
        $tweets->setFechaPublicacion($json["fecha_publicacion"]);

        $usuario = $entityManager->getRepository(Usuario::class)->findBy(["id"=> $json["id_usuario"]]);
        $tweets->setUsuario($usuario[0]);

        $entityManager->flush();

        return $this->json(['message' => 'Clase modificada'], Response::HTTP_OK);
    }
    #[Route('/{id}', name: "delete_by_id", methods: ["DELETE"])]
    public function deleteById_tweet(EntityManagerInterface $entityManager, Tweets $tweets):JsonResponse
    {
        $entityManager->remove($tweets);
        $entityManager->flush();

        return $this->json(['message' => 'Clase eliminada'], Response::HTTP_OK);

    }
}