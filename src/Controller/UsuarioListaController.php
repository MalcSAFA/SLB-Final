<?php

namespace App\Controller;

use App\Entity\UsuarioLista;
use App\Repository\UsuarioListaRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/usuario_lista')]
class UsuarioListaController extends AbstractController
{
    #[Route('', name: "usuario_lista_list", methods: ["GET"])]
    public function list_UsuarioLista(UsuarioListaRepository $usuarioListaRepository): JsonResponse
    {
        $usuarioLista = $usuarioListaRepository->findAll();

        return $this->json($usuarioLista);
    }

    #[Route('', name: "crear_usuario_lista", methods: ["POST"])]
    public function crear_usuario_lista(EntityManagerInterface $entityManager, Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        $nuevoUsuarioLista = new UsuarioLista();

        // Obteniendo el usuario por su ID
        $usuario = $entityManager->getReference('App\Entity\Usuario', $json["id_usuario"]);
        $nuevoUsuarioLista->setUsuario($usuario);

        // Obteniendo la lista por su ID
        $lista = $entityManager->getReference('App\Entity\Lista', $json["id_lista"]);
        $nuevoUsuarioLista->setLista($lista);

        $entityManager->persist($nuevoUsuarioLista);
        $entityManager->flush();

        return $this->json(['message' => 'UsuarioLista creada'], Response::HTTP_CREATED);
    }

    #[Route('/{id}', name: "eliminar_usuario_lista", methods: ["DELETE"])]
    public function eliminar_usuario_lista(EntityManagerInterface $entityManager, int $id): JsonResponse
    {
        // Buscar el UsuarioLista en la base de datos
        $usuarioLista = $entityManager->getRepository(UsuarioLista::class)->find($id);

        // Verificar si se encontró el UsuarioLista
        if (!$usuarioLista) {
            return $this->json(['message' => 'No se encontró el UsuarioLista con el ID proporcionado'], Response::HTTP_NOT_FOUND);
        }

        // Eliminar el UsuarioLista
        $entityManager->remove($usuarioLista);
        $entityManager->flush();

        return $this->json(['message' => 'UsuarioLista eliminada correctamente'], Response::HTTP_OK);
    }

}