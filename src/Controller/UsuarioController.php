<?php

namespace App\Controller;

use App\Entity\Tweets;
use App\Entity\Usuario;
use App\Repository\UsuarioRepository;
use DateTime;
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

        if (array_key_exists('rol', $json)) {
            $rol = $json['rol'];
        } else {
            // Si la clave 'rol' no está presente, asignar un valor predeterminado o manejar el caso según tus necesidades
            $rol = 'USER';
        }

        $nuevousuario = new Usuario();
        $nuevousuario->setNombre($json["nombre"]);
        $nuevousuario->setApellido($json["apellido"]);
        $nuevousuario->setContrasenya($json["contrasenya"]);
        $nuevousuario->setCorreo($json["correo"]);
        $nuevousuario->setFoto($json["foto"]);
        $fechaNacimiento = new DateTime($json["fecha_nacimiento"]);
        $nuevousuario->setFechaNacimiento($fechaNacimiento);
        $nuevousuario->setRol($rol);


        $entityManager->persist($nuevousuario);
        $entityManager->flush();

        return $this->json(['message' => 'Clase creada'], Response::HTTP_CREATED);
    }
    #[Route('/{id}', name: "editar_usuario", methods: ["PUT"])]
    public function editar_usuario(EntityManagerInterface $entityManager, Request $request, Usuario $usuario):JsonResponse
    {
        $json = json_decode($request-> getContent(), true);

        if (array_key_exists('rol', $json)) {
            $rol = $json['rol'];
        } else {
            // Si la clave 'rol' no está presente, asignar un valor predeterminado o manejar el caso según tus necesidades
            $rol = 'USER';
        }
        $usuario->setNombre($json["nombre"]);
        $usuario->setApellido($json["apellido"]);
        $usuario->setContrasenya($json["contrasenya"]);
        $usuario->setCorreo($json["correo"]);
        $usuario->setFoto($json["foto"]);
        $usuario->setFechanacimiento($json["fecha_nacimiento"]);
        $usuario->setRol($rol);


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