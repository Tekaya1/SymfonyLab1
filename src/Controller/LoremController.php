<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class LoremController extends AbstractController
{
    #[Route('/lorem', name: 'app_lorem')]
    public function index(): Response
    {
        return new Response('<html><body><font color=red>Bonjour tous le monde</font></body></html>');
    }

    #[Route('/lorem/about/{id}', name: 'app_lorem_about')]
    public function about($id, Request $request): Response
    {
        $tag = $request->query->get('tag');
        $age = $request->query->get('age');
        return new Response('<html><body>About page. ID: ' . htmlspecialchars($id) . ', Tag: ' . htmlspecialchars((string) $tag) . ', Age: ' . htmlspecialchars((string) $age) . '</body></html>');
    }

   #[Route('/list', name: 'liste')]
public function listEtudiants(): Response
{
    // Liste des étudiants
    $etudiants = array("ali", "med", "Ravi");

    // Liste des modules avec détails
    $modules = array(
        array(
            "id" => 1,
            "nom" => "Symfony",
            "enseignant" => "Ali",
            "nbrHeures" => 42,
            "date" => "12-12-2021"
        ),
        array(
            "id" => 2,
            "nom" => "JEE",
            "enseignant" => "Med",
            "nbrHeures" => 31,
            "date" => "12-10-2021"
        ),
        array(
            "id" => 3,
            "nom" => "BD",
            "enseignant" => "Islem",
            "nbrHeures" => 21,
            "date" => "12-09-2021"
        ),
    );

    // Envoi des données à la vue
    return $this->render('lorem/list.html.twig', [
        'etudiants' => $etudiants,
        'listeModules' => $modules
    ]);
}

#[Route('/affectation', name: 'app_affectation')]
public function affectation(): Response
{
    return $this->render('lorem/affectation.html.twig');
}
#[Route('/indexFils', name: 'index_fils')]
public function indexFils(): Response
{
    return $this->render('lorem/index.html.twig');
}

}