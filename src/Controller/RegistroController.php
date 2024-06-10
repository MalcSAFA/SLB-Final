<?php

namespace App\Controller;

use App\Entity\Perfil;
use App\Entity\Usuario;
use App\Repository\RtRepository;
use App\Repository\PerfilRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use function Webmozart\Assert\Tests\StaticAnalysis\null;
use function Webmozart\Assert\Tests\StaticAnalysis\string;


#[Route('/api/registro')]
class RegistroController extends AbstractController
{
    #[Route('', name: "registrar_usuario", methods: ["POST"])]
    public function registro(Request $request, UserPasswordHasherInterface $passwordHasher,EntityManagerInterface $entityManager): JsonResponse
    {
        $data = json_decode($request->getContent(), true);


        $user = new Usuario();
        $user->setNombre($data['nombre']);
        $user->setApellido($data['apellido']);
        $user->setNick($data['nick']);
        $user->setCorreo($data['correo']);
        $user->setFechaNacimiento($data['fecha_nacimiento']);
        $user->setFoto($data['foto']);
        $user->setContrasenya($passwordHasher->hashPassword($user, $data['contrasenya']));
        $user->setRol($data['rol']);


        $perfil = new Perfil();
        $perfil->setSubidas((int)null);
        $perfil->setEstado((string)null);
        $perfil->setUsuario($user);
        $perfil->setTweets(null);


        $entityManager->persist($user);
        $entityManager->persist($perfil);
        $entityManager->flush();


        return new JsonResponse(['message' => 'El usuario se registró correctamente'], 201);
    }
}