<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Canciones;
use LDAP\Result;

class MusicController extends AbstractController
{
    private $canciones = [
        1 => ["nombre" => "Billie Jean", "artista" => "Michael Jackson", "publicacion" => "1983"],
        2 => ["nombre" => "Without Me", "artista" => "Eminem", "publicacion" => "2002"],
        5 => ["nombre" => "Con Calma", "artista" => "Daddy Yankee", "publicacion" => "2019"],
        7 => ["nombre" => "In the End", "artista" => "Linkin Park", "publicacion" => "2001"],
        9 => ["nombre" => "The Real Slim Shady", "artista" => "Eminem", "publicacion" => "2002"],
        10 => ["nombre" => "Where She Goes", "artista" => "Bad Bunny", "publicacion" => "2023"]
    ];

    #[Route('/music/insertar', name: "insertar_cancion")]
    public function insertar(ManagerRegistry $doctrine)
    {
        $entityManager = $doctrine->getManager();
        foreach ($this->canciones as $c) {
            $cancion = new Canciones();
            $cancion->setNombre($c["nombre"]);
            $cancion->setArtista($c["artista"]);
            $cancion->setPublicacion($c["publicacion"]);
            $entityManager->persist($cancion);
        }

        try {
            $entityManager->flush();
            return new Response("Canciones insertadas");
        } catch (\Exception $e) {
            return new Response("Error insertando objetos");
            $e->getMessage();
        }
    }

    #[Route('/music/delete/{id}', name:"eliminar_cancion")]
    public function delete(ManagerRegistry $doctrine, $id): Response{
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Canciones::class);
        $cancion = $repositorio->find($id);

        if($cancion) {
            try {
                $entityManager->remove($cancion);
                $entityManager->flush();
                return new Response("Canción eliminada");
            } catch(\Exception $e) {
                return new Response("Error eliminando canción");
            }
        } else {
            return $this->render('ficha_cancion.html.twig', ['cancion' => null]);
        }
    }
    
    #[Route('/music', name: 'app_music')]
    public function index(): Response
    {
        return $this->render('music/index.html.twig', [
            'controller_name' => 'MusicController',
        ]);
    }

    #[Route('/music/{codigo}', name: "ficha_cancion")]
    public function ficha(ManagerRegistry $doctrine, $codigo): Response
    {
        $repositorio = $doctrine->getRepository(Canciones::class);
        $cancion = $repositorio->find($codigo);

        return $this->render('ficha_cancion.html.twig', ['cancion' => $cancion]);
    }

    #[Route('/music/buscar/{texto}', name: "buscar_cancion")]
    public function buscar(ManagerRegistry $doctrine, $texto): Response
    {
        $repositorio = $doctrine->getRepository(Canciones::class);
        $canciones = $repositorio->findByName($texto);
        return $this->render('lista_canciones.html.twig', ['canciones' => $canciones]);
    }

    #[Route('/music/update/{id}/{nombre}', name:"modificar_contacto")]
    public function update(ManagerRegistry $doctrine, $id, $nombre):Response {
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Canciones::class);
        $cancion = $repositorio->find($id);
        if($cancion) {
            $cancion->setNombre($nombre);
            try {
                $entityManager->flush();
                return $this->render('ficha_cancion.html.twig', ['cancion' => $cancion]);
            } catch(\Exception $e) {
                return new Response("Error insertando objetos" . $e->getMessage());
            }
        } else {
            return $this->render('ficha_cancion.html.twig', ['cancion' => null]);
        }
    }
}
