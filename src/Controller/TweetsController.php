<?php

namespace App\Controller;

use App\Entity\Tweets;
use App\Entity\Usuario;
use App\Repository\TweetsRepository;
use DateTime;
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
        $fechaPublicacion = new DateTime(datetime: 'now');
        $nuevotweet->setFechaPublicacion($fechaPublicacion);

        $usuario = $entityManager->getRepository(Usuario::class)->findOneBy(["id" => $json["id_usuario"]]);
        $nuevotweet->setUsuario($usuario);


        $entityManager->persist($nuevotweet);
        $entityManager->flush();

        return $this->json(['message' => 'Clase creada'], Response::HTTP_CREATED);
    }
//    #[Route('/{id}', name: "editar_tweet", methods: ["PUT"])]
//    public function editar_tweet(EntityManagerInterface $entityManager, Request $request, Tweets $tweets):JsonResponse
//    {
//        $json = json_decode($request-> getContent(), true);
//
//        $tweets->setTexto($json["texto"]);
//        $tweets->setLink($json["link"]);
//        $fechaPublicacion = new DateTime($json["fecha_publicacion"]);
//        $tweets->setFechaPublicacion($fechaPublicacion);
//
//        $usuario = $entityManager->getRepository(Usuario::class)->findOneBy(["id" => $json["id_usuario"]]);
//        $tweets->setUsuario($usuario);
//
//        $entityManager->flush();
//
//        return $this->json(['message' => 'Clase modificada'], Response::HTTP_OK);
//    }
    #[Route('/{id}', name: "api_delete_by_id", methods: ["DELETE"])]
    public function deleteById_tweet(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        // Buscar el tweet en la base de datos
        $tweets = $entityManager->getRepository(Tweets::class)->find($id);

        // Verificar si se encontró el tweet
        if (!$tweets) {
            return $this->json(['message' => 'No se encontró el tweet con el ID proporcionado'], Response::HTTP_NOT_FOUND);
        }

        // Eliminar el tweet
        $entityManager->remove($tweets);
        $entityManager->flush();

        return $this->json(['message' => 'Tweet eliminado correctamente'], Response::HTTP_OK);
    }
}