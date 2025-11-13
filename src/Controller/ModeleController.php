<?php

namespace App\Controller;

use App\Repository\ModeleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class ModeleController extends AbstractController
{
    #[Route('/add', name: 'modele_add')]
    public function add(ModeleRepository $repo): Response
    {
        $modele = $repo->addModele('Clio', 'France');

        return new Response('Added new modele with id ' . $modele->getId());
    }
    #[Route('/list', name: 'modele_list')]
    public function list(ModeleRepository $repo): Response
    {
        $modeles = $repo->findallModele();
        $output = "<h2> </h2>List of Modeles</h2><ul>";
        foreach ($modeles as $m) {
            $output .= "<li>" . $m->getLibelle() . " - " . $m->getPays() . "</li>";

        }
        $output .= "</ul>";
        return new Response($output);
    }

    #[Route('/update/{id}', name: 'modele_update')]
    public function update(int $id, ModeleRepository $repo): Response
    {
        $rows = $repo->updateModele($id, 'Megane', 'France');
        return new Response("Updated $rows modele(s) ");
    }
    #[Route('/delete/{id}', name: 'modele_delete')]
    public function delete(int $id, ModeleRepository $repo): Response
    {
        $rows= $repo->deleteModele($id);
        return new Response("Deleted $rows modele(s) ");
    }
    
}