<?php

namespace App\Controller;

use App\Entity\Tweets;
use App\Entity\Usuario;
use App\Repository\UsuarioRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/usuario')]
class UsuarioController extends AbstractController
{
    #[Route('', name: "usuario_list", methods: ["GET"])]
    public function list_usuario(UsuarioRepository $usuarioRepository):JsonResponse
    {
        $list = $usuarioRepository->findAll();

        return $this->json($list);
    }
    #[Route('', name: "crear_usuario", methods: ["POST"])]
    public function crear_usuario(EntityManagerInterface $entityManager, Request $request):JsonResponse
    {
        $json = json_decode($request-> getContent(), true);

        $nuevousuario = new Usuario();
        $nuevousuario->setNombre($json["nombre"]);
        $nuevousuario->setApellido($json["apellido"]);
        $nuevousuario->setContrasenya($json["contrasenya"]);
        $nuevousuario->setCorreo($json["correo"]);
        $nuevousuario->setFoto($json["foto"]);
        $nuevousuario->setFechaNacimiento($json["fecha_nacimiento"]);


        $entityManager->persist($nuevousuario);
        $entityManager->flush();

        return $this->json(['message' => 'Clase creada'], Response::HTTP_CREATED);
    }
    #[Route('/{id}', name: "editar_usuario", methods: ["PUT"])]
    public function editar_usuario(EntityManagerInterface $entityManager, Request $request, Usuario $usuario):JsonResponse
    {
        $json = json_decode($request-> getContent(), true);

        $usuario->setNombre($json["nombre"]);
        $usuario->setApellido($json["apellido"]);
        $usuario->setContrasenya($json["contrasenya"]);
        $usuario->setCorreo($json["correo"]);
        $usuario->setFoto($json["foto"]);
        $usuario->setFecha_nacimiento($json["fecha_nacimiento"]);


        $entityManager->flush();

        return $this->json(['message' => 'Clase modificada'], Response::HTTP_OK);
    }
    #[Route('/{id}', name: "delete_by_id", methods: ["DELETE"])]
    public function deleteById_usuario(EntityManagerInterface $entityManager, Usuario $usuario):JsonResponse
    {
        $entityManager->remove($usuario);
        $entityManager->flush();

        return $this->json(['message' => 'Clase eliminada'], Response::HTTP_OK);

    }


}