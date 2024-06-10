<?php

namespace App\Controller;

use App\Entity\Seguidores;
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
    public function list_seguidores(EntityManagerInterface $entityManager): JsonResponse
    {
        $seguidoresRepository = $entityManager->getRepository(Seguidores::class);
        $list = $seguidoresRepository->findAll();

        return $this->json($list);
    }

    #[Route('', name: "crear_seguidores", methods: ["POST"])]
    public function crear_seguidores(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        $nuevoseguidor = new Seguidores();
        $nuevoseguidor->setIdUsuarioSeguidor($json["idUsuarioSeguidor"]);
        $nuevoseguidor->setIdUsuarioSeguido($json["idUsuarioSeguido"]);
        $nuevoseguidor->setFechaSeguimiento(new \DateTime());

        $entityManager->persist($nuevoseguidor);
        $entityManager->flush();

        return $this->json(['message' => 'Seguidor creado'], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: "editar_seguidores", methods: ["PUT"])]
    public function editar_seguidores(EntityManagerInterface $entityManager, Request $request, Seguidores $seguidores): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        $seguidores->setIdUsuarioSeguidor($json["id_usuario_seguidor"]);
        $seguidores->setIdUsuarioSeguido($json["id_usuario_seguido"]);

        $entityManager->flush();

        return $this->json(['message' => 'Seguidor modificado'], Response::HTTP_OK);
    }


    #[Route('/{id}', name: "delete_by_id_seguidores", methods: ["DELETE"])]
    public function deleteById_seguidores(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        // Buscar el RT en la base de datos
        $seguidores = $entityManager->getRepository(Seguidores::class)->find($id);

        // Verificar si se encontró el RT
        if (!$seguidores) {
            return $this->json(['message' => 'No se encontró el RT con el ID proporcionado'], Response::HTTP_NOT_FOUND);
        }

        // Eliminar el RT
        $entityManager->remove($seguidores);
        $entityManager->flush();

        return $this->json(['message' => 'RT eliminado correctamente'], Response::HTTP_OK);
    }
}
