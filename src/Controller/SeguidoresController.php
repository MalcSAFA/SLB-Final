<?php

namespace App\Controller;

use App\Entity\Notificaciones;
use App\Entity\Perfil;
use App\Entity\Seguidores;
use App\Entity\Usuario;
use App\Repository\NotificacionesRepository;
use App\Repository\SeguidoresRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/seguidores')]
class SeguidoresController extends AbstractController
{
    #[Route('', name: "seguidores_list", methods: ["GET"])]
    public function list_seguidores(SeguidoresRepository $seguidoresRepository):JsonResponse
    {
        $list = $seguidoresRepository->findAll();

        return $this->json($list);
    }
    #[Route('', name: "crear_seguidores", methods: ["POST"])]
    public function crear_seguidores(EntityManagerInterface $entityManager, Request $request):JsonResponse
    {
        $json = json_decode($request-> getContent(), true);

        $nuevoseguidor = new Seguidores();
        $nuevoseguidor->setSeguidores($json["seguidores"]);
        $nuevoseguidor->setSeguidos($json["seguidos"]);

        $perfil = $entityManager->getRepository(Perfil::class)->findOneBy(["id"=> $json["id_perfil"]]);
        $nuevoseguidor->setPerfil($perfil);

        $entityManager->persist($nuevoseguidor);
        $entityManager->flush();

        return $this->json(['message' => 'Clase creada'], Response::HTTP_CREATED);
    }
    #[Route('/{id}', name: "editar_seguidores", methods: ["PUT"])]
    public function editar_seguidores(EntityManagerInterface $entityManager, Request $request, Seguidores $seguidores):JsonResponse
    {
        $json = json_decode($request-> getContent(), true);

        $seguidores->setSeguidores($json["seguidores"]);
        $seguidores->setSeguidos($json["seguidos"]);

        $perfil = $entityManager->getRepository(Perfil::class)->findBy(["id"=> $json["id_perfil"]]);
        $seguidores->setPerfil($perfil[0]);


        $entityManager->flush();

        return $this->json(['message' => 'Clase modificada'], Response::HTTP_OK);
    }
    #[Route('/{id}', name: "delete_by_id", methods: ["DELETE"])]
    public function deleteById_seguidores(EntityManagerInterface $entityManager, Seguidores $notificaciones):JsonResponse
    {
        $entityManager->remove($notificaciones);
        $entityManager->flush();

        return $this->json(['message' => 'Clase eliminada'], Response::HTTP_OK);
    }
}