<?php

namespace App\Controller;

use App\Entity\Perfil;
use App\Entity\Tweets;
use App\Entity\Usuario;
use App\Repository\PerfilRepository;
use App\Repository\TweetsRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/perfil')]
class PerfilController extends AbstractController
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

        $usuario = $entityManager->getRepository(Usuario::class)->findOneBy(["id"=> $json["id_usuario"]]);
        $nuevoperfil->setUsuario($usuario);

        $tweet = $entityManager->getRepository(Tweets::class)->findOneBy(["id"=> $json["id_tweet"]]);
        $nuevoperfil->setTweets($tweet);


        $entityManager->persist($nuevoperfil);
        $entityManager->flush();

        return $this->json(['message' => 'Clase creada'], Response::HTTP_CREATED);
    }
    #[Route('/{id}', name: "editar_perfil", methods: ["PUT"])]
    public function editar_perfil(EntityManagerInterface $entityManager, Request $request, PerfilRepository $perfilRepository, int $id): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        // Obtener el perfil por su ID
        $perfil = $perfilRepository->find($id);

        // Verificar si el perfil existe
        if (!$perfil) {
            return $this->json(['error' => 'Perfil no encontrado'], Response::HTTP_NOT_FOUND);
        }

        // Actualizar los datos del perfil
        $perfil->setSubidas($json["subidas"] ?? $perfil->getSubidas());
        $perfil->setEstado($json["estado"] ?? $perfil->getEstado());

        // Obtener y asignar el usuario asociado
        if (isset($json["id_usuario"])) {
            $usuario = $entityManager->getRepository(Usuario::class)->find($json["id_usuario"]);
            if ($usuario) {
                $perfil->setUsuario($usuario);
            } else {
                return $this->json(['error' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
            }
        }

        // Obtener y asignar el tweet asociado
        if (isset($json["id_tweet"])) {
            $tweet = $entityManager->getRepository(Tweets::class)->find($json["id_tweet"]);
            if ($tweet) {
                $perfil->setTweets($tweet);
            } else {
                return $this->json(['error' => 'Tweet no encontrado'], Response::HTTP_NOT_FOUND);
            }
        }

        $entityManager->flush();

        return $this->json(['message' => 'Perfil modificado'], Response::HTTP_OK);
    }





    #[Route('/{id}', name: "delete_by_id", methods: ["DELETE"])]
    public function deleteById_perfil(EntityManagerInterface $entityManager, Perfil $perfil):JsonResponse
    {
        $entityManager->remove($perfil);
        $entityManager->flush();

        return $this->json(['message' => 'Clase eliminada'], Response::HTTP_OK);

    }
}