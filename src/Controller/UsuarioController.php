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
    public function list_Usuarios(UsuarioRepository $usuarioRepository): JsonResponse
    {
        // Obtener todos los usuarios
        $usuarios = $usuarioRepository->findAll();

        // Construir el array con los datos de los usuarios
        $formattedUsuarios = [];
        foreach ($usuarios as $usuario) {
            $formattedUsuarios[] = [
                'id' => $usuario->getId(),
                'nombre' => $usuario->getNombre(),
                'apellido' => $usuario->getApellido(),
                'nick' => $usuario->getNick(),
                'contrasenya' => $usuario->getContrasenya(),
                'correo' => $usuario->getCorreo(),
                'foto' => $usuario->getFoto(),
                'fechaNacimiento' => $usuario->getFechaNacimiento()->format('Y-m-d'),
                'rol' => $usuario->getRol(),
            ];
        }

        // Devolver la respuesta JSON con los usuarios
        return $this->json($formattedUsuarios);
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
    public function editar_usuario(EntityManagerInterface $entityManager, Request $request, UsuarioRepository $usuarioRepository, int $id): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        // Obtener el usuario por su ID
        $usuario = $usuarioRepository->find($id);

        // Verificar si el usuario existe
        if (!$usuario) {
            return $this->json(['error' => 'Usuario no encontrado'], Response::HTTP_NOT_FOUND);
        }

        // Obtener el valor de 'rol' del JSON
        $rol = $json['rol'] ?? 'USER';

        // Actualizar los datos del usuario
        $usuario->setNombre($json["nombre"]);
        $usuario->setApellido($json["apellido"]);
        $usuario->setNick($json["nick"]);
        $usuario->setContrasenya($json["contrasenya"]);
        $usuario->setCorreo($json["correo"]);
        $usuario->setFoto($json["foto"]);
        $usuario->setFechaNacimiento($json['fechaNacimiento']);


        $usuario->setRol($rol);

        $entityManager->flush();

        return $this->json(['message' => 'Usuario modificado'], Response::HTTP_OK);
    }
    #[Route('/{id}', name: "delete_by_id", methods: ["DELETE"])]
    public function deleteById_usuario(EntityManagerInterface $entityManager, Usuario $usuario):JsonResponse
    {
        $entityManager->remove($usuario);
        $entityManager->flush();

        return $this->json(['message' => 'Clase eliminada'], Response::HTTP_OK);

    }


}