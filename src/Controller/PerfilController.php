<?php

namespace App\Controller;

use App\Entity\Perfil;
use App\Entity\Tweets;
use App\Entity\Usuario;
use App\Repository\PerfilRepository;
use App\Repository\TweetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/perfil')]
class PerfilController
{
    #[Route('', name: "perfil_list", methods: ["GET"])]
    public function list_perfil(PerfilRepository $perfilRepository):JsonResponse
    {
        $list = $perfilRepository->findAll();

        return $this->json($list);
    }
    #[Route('', name: "crear_perfil", methods: ["POST"])]
    public function crear_perfil(EntityManagerInterface $entityManager, Request $request):JsonResponse
    {
        $json = json_decode($request-> getContent(), true);

        $nuevoperfil = new Perfil();
        $nuevoperfil->setSubidas($json["subidas"]);
        $nuevoperfil->setEstado($json["estado"]);

        $usuario = $entityManager->getRepository(Usuario::class)->findBy(["id"=> $json["id_usuario"]]);
        $nuevoperfil->setUsuario($usuario[0]);

        $tweet = $entityManager->getRepository(Tweets::class)->findBy(["id"=> $json["id_tweet"]]);
        $nuevoperfil->setTweet($tweet[0]);


        $entityManager->persist($nuevoperfil);
        $entityManager->flush();

        return $this->json(['message' => 'Clase creada'], Response::HTTP_CREATED);
    }
    #[Route('/{id}', name: "editar_perfil", methods: ["PUT"])]
    public function editar_perfil(EntityManagerInterface $entityManager, Request $request, Perfil $perfil):JsonResponse
    {
        $json = json_decode($request-> getContent(), true);

        $perfil = new Clase();
        $perfil->setTexto($json["texto"]);
        $perfil->setLink($json["link"]);
        $perfil->setFechaPublicacion($json["fecha_publicacion"]);

        $usuario = $entityManager->getRepository(Usuario::class)->findBy(["id"=> $json["id_usuario"]]);
        $perfil->seTweet($usuario[0]);

        $tweet = $entityManager->getRepository(Tweets::class)->findBy(["id"=> $json["id_tweet"]]);
        $perfil->setTweet($tweet[0]);

        $entityManager->flush();

        return $this->json(['message' => 'Clase modificada'], Response::HTTP_OK);
    }
    #[Route('/{id}', name: "delete_by_id", methods: ["DELETE"])]
    public function deleteById_perfil(EntityManagerInterface $entityManager, Perfil $perfil):JsonResponse
    {
        $entityManager->remove($perfil);
        $entityManager->flush();

        return $this->json(['message' => 'Clase eliminada'], Response::HTTP_OK);

    }
}