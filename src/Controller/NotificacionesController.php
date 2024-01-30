<?php

namespace App\Controller;

use App\Entity\Notificaciones;
use App\Entity\Tweets;
use App\Entity\Usuario;
use App\Repository\NotificacionesRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/api/notificaciones')]
class NotificacionesController
{
    #[Route('', name: "notificaciones_list", methods: ["GET"])]
    public function list_notificaciones(NotificacionesRepository $notificacionesRepository):JsonResponse
    {
        $list = $notificacionesRepository->findAll();

        return $this->json($list);
    }
    #[Route('', name: "crear_notificaciones", methods: ["POST"])]
    public function crear_notificaciones(EntityManagerInterface $entityManager, Request $request):JsonResponse
    {
        $json = json_decode($request-> getContent(), true);

        $nuevanotificacion = new Notificaciones();
        $nuevanotificacion->setTipoNotificacion($json["tipo"]);
        $nuevanotificacion->setVisto($json["visto"]);

        $usuarioEm = $entityManager->getRepository(Usuario::class)->findBy(["id"=> $json["id_usuarioEm"]]);
        $nuevanotificacion->setTweet($usuarioEm[0]);

        $usuarioRe = $entityManager->getRepository(Usuario::class)->findBy(["id"=> $json["id_usuarioRe"]]);
        $nuevanotificacion->setTweet($usuarioRe[0]);


        $entityManager->persist($nuevanotificacion);
        $entityManager->flush();

        return $this->json(['message' => 'Clase creada'], Response::HTTP_CREATED);
    }
    #[Route('/{id}', name: "editar_notificaciones", methods: ["PUT"])]
    public function editar_notificaciones(EntityManagerInterface $entityManager, Request $request, Notificaciones $notificaciones):JsonResponse
    {
        $json = json_decode($request-> getContent(), true);

        $notificaciones->setTipoNotificacion($json["tipo"]);
        $notificaciones->setVisto($json["visto"]);

        $usuarioEm = $entityManager->getRepository(Usuario::class)->findBy(["id"=> $json["id_usuarioEm"]]);
        $notificaciones->setUsuarioEmisor($usuarioEm[0]);

        $usuarioRe = $entityManager->getRepository(Usuario::class)->findBy(["id"=> $json["id_usuarioRe"]]);
        $notificaciones->setUsuarioReceptor($usuarioRe[0]);

        $entityManager->flush();

        return $this->json(['message' => 'Clase modificada'], Response::HTTP_OK);
    }
    #[Route('/{id}', name: "delete_by_id", methods: ["DELETE"])]
    public function deleteById_notificaciones(EntityManagerInterface $entityManager, Notificaciones $notificaciones):JsonResponse
    {
        $entityManager->remove($notificaciones);
        $entityManager->flush();

        return $this->json(['message' => 'Clase eliminada'], Response::HTTP_OK);
    }
}