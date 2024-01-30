<?php

namespace App\Controller;

use App\Entity\Usuario;
use App\Repository\RtRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;


#[Route('/api/registro')]
class RegistroController extends AbstractController
{
    #[Route('', name: "registrar_usuario", methods: ["POST"])]
    public function registro(Request $request, UserPasswordHasherInterface $passwordHasher,EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);


        $user = new Usuario();
        $user->setNombre($data['nombre']);
        $user->setApellido($data['nombre']);
        $user->setNick($data['nick']);
        $user->setCorreo($data['correo']);
        $user->setFechaNacimiento($data['fecha_nacimiento']);
        $user->setFoto($data['foto']);
        $user->setContrasenya($passwordHasher->hashPassword($user, $data['contraseña']));
        $user->setRol($data['rol']);


        $entityManager->persist($user);
        $entityManager->flush();


        return new JsonResponse(['message' => 'El usuario se registró correctamente'], 201);
    }
}