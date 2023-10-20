<?php

namespace App\Controller;

use Doctrine\Persistence\ManagerRegistry;
use LDAP\Result;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Canciones;
use App\Entity\Artista;
use App\Form\CancionType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;

class MusicController extends AbstractController
{
    private $canciones = [
        1 => ["nombre" => "Billie Jean", "publicacion" => "1983", "artista" => 5],
        2 => ["nombre" => "Without Me", "publicacion" => "2002", "artista" => 1],
        5 => ["nombre" => "Con Calma", "publicacion" => "2019", "artista" => 2],
        7 => ["nombre" => "In the End", "publicacion" => "2001", "artista" => 3],
        9 => ["nombre" => "The Real Slim Shady", "publicacion" => "2002", "artista" => 1],
        10 => ["nombre" => "Where She Goes", "publicacion" => "2023", "artista" => 4]
    ];

    #[Route('/music/insertar', name: "insertar_cancion")]
    public function insertar(ManagerRegistry $doctrine): Response
    {
        foreach ($this->canciones as $c) {
            $id = $c["artista"];
            $entityManager = $doctrine->getManager();
            $repositorio = $doctrine->getRepository(Artista::class);
            $artista = $repositorio->find($id);
            $cancion = new Canciones();
            $cancion->setNombre($c["nombre"]);
            $cancion->setPublicacion($c["publicacion"]);
            $cancion->setArtista($artista);
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

    #[Route("/music/insertarConArtista", name: "insertar_cancion_con_artista")]
    public function insertarConProvincia(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $artista = new Artista();

        $artista->setNombre("Eladio Carrión");
        $cancion = new Canciones();

        $cancion->setNombre("Mbappe");
        $cancion->setPublicacion("2022");
        $cancion->setArtista($artista);

        $entityManager->persist($artista);
        $entityManager->persist($cancion);

        $entityManager->flush();
        return $this->render('ficha_cancion.html.twig', ['cancion' => $cancion]);
    }

    #[Route("/music/insertarSinArtista", name: "insertar_cancion_sin_provincia")]
    public function insertarSinProvincia(ManagerRegistry $doctrine): Response
    {
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Artista::class);

        $artista = $repositorio->findOneBy(["nombre" => "Eladio Carrión"]);

        $cancion = new Canciones();

        $cancion->setNombre("Inserción de prueba sin artista");
        $cancion->setPublicacion("2009");
        $cancion->setArtista($artista);

        $entityManager->persist($cancion);

        $entityManager->flush();
        return $this->render('ficha_cancion.html.twig', ['cancion' => $cancion]);
    }

    #[Route("/music/nuevo", name: "nuevo_cancion")]
    public function nuevo(ManagerRegistry $doctrine, Request $request)
    {
        $cancion = new Canciones();

        $formulario = $this->createForm(CancionType::class, $cancion);

        $formulario->handleRequest($request);

        if ($formulario->isSubmitted() && $formulario->isValid()) {
            $cancion = $formulario->getData();
            $entityManager = $doctrine->getManager();
            $entityManager->persist($cancion);
            $entityManager->flush();
            return $this->redirectToRoute('ficha_cancion', ["codigo" => $cancion->getId(), "cancion" => $cancion]);
        }

        return $this->render('nuevo.html.twig', array('formulario' => $formulario->createView()));
    }

    #[Route("/music/editar/{codigo}", name: "editar_cancion")]
    public function editar(ManagerRegistry $doctrine, Request $request, $codigo)
    {
        $repositorio = $doctrine->getRepository(Canciones::class);
        $cancion = $repositorio->find($codigo);

        if ($cancion) {
            $formulario = $this->createForm(CancionType::class, $cancion);

            $formulario->handleRequest($request);

            if ($formulario->isSubmitted() && $formulario->isValid()) {
                $cancion = $formulario->getData();
                $entityManager = $doctrine->getManager();
                $entityManager->persist($cancion);
                $entityManager->flush();
                return $this->redirectToRoute('ficha_cancion', ["codigo" => $cancion->getId(), "cancion" => $cancion]);
            }

            return $this->render('editar.html.twig', array('formulario' => $formulario->createView()));
        } else {
            return $this->render('ficha_cancion.html.twig', ['cancion' => null]);
        }
    }


    #[Route('/music/delete/{id}', name: "eliminar_cancion")]
    public function delete(ManagerRegistry $doctrine, $id): Response
    {
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Canciones::class);
        $cancion = $repositorio->find($id);

        if ($cancion) {
            try {
                $entityManager->remove($cancion);
                $entityManager->flush();
                return new Response("Canción eliminada");
            } catch (\Exception $e) {
                return new Response("Error eliminando canción");
            }
        } else {
            return $this->render('ficha_cancion.html.twig', ['cancion' => null]);
        }
    }

    #[Route('/music', name: 'app_music')]
    public function index(): Response
    {
        return $this->render('inicio.html.twig', [
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
        $contador = count($canciones);
        return $this->render('lista_canciones.html.twig', ['canciones' => $canciones, 'texto' => $texto, 'contador' => $contador]);
    }

    #[Route('/music/update/{id}/{nombre}', name: "modificar_contacto")]
    public function update(ManagerRegistry $doctrine, $id, $nombre): Response
    {
        $entityManager = $doctrine->getManager();
        $repositorio = $doctrine->getRepository(Canciones::class);
        $cancion = $repositorio->find($id);
        if ($cancion) {
            $cancion->setNombre($nombre);
            try {
                $entityManager->flush();
                return $this->render('ficha_cancion.html.twig', ['cancion' => $cancion]);
            } catch (\Exception $e) {
                return new Response("Error insertando objetos" . $e->getMessage());
            }
        } else {
            return $this->render('ficha_cancion.html.twig', ['cancion' => null]);
        }
    }
}
