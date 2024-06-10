<?php

namespace App\Controller;

use App\Entity\Lista;
use App\Repository\ListaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/lista')]
class ListaController extends AbstractController
{
    #[Route('', name: "lista_list", methods: ["GET"])]
    public function list_Lista(ListaRepository $listaRepository): JsonResponse
    {
        $lista = $listaRepository->findAll();


        return $this->json($lista);
    }

    #[Route('', name: "crear_lista", methods: ["POST"])]
    public function crear_lista(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        $nuevaLista = new Lista();
        $nuevaLista->setNombreLista($json["nombre_lista"]);

        // Obteniendo el usuario por su ID
        $usuario = $entityManager->getReference('App\Entity\Usuario', $json["id_usuario"]);
        $nuevaLista->setUsuario($usuario);

        $entityManager->persist($nuevaLista);
        $entityManager->flush();

        return $this->json(['message' => 'Lista creada'], Response::HTTP_CREATED);
    }


    #[Route('/{id}', name: "lista_delete_by_id", methods: ["DELETE"])]
    public function deleteById_lista(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        // Buscar el tweet en la base de datos
        $lista = $entityManager->getRepository(Lista::class)->find($id);

        // Verificar si se encontró el tweet
        if (!$lista) {
            return $this->json(['message' => 'No se encontró el like con el ID proporcionado'], Response::HTTP_NOT_FOUND);
        }

        // Eliminar el tweet
        $entityManager->remove($lista);
        $entityManager->flush();

        return $this->json(['message' => 'Like eliminado correctamente'], Response::HTTP_OK);
    }

}
