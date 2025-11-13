<?php

namespace App\Controller;

use App\Entity\Voiture;
use App\Form\VoitureType;
use App\Repository\VoitureRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

final class VoitureController extends AbstractController
{
    #[Route('/voiture', name: 'app_voiture')]
    public function listVoiture(VoitureRepository $vr): Response
    {
        $voitures = $vr->findAll();
        return $this->render('voiture/index.html.twig', [
            'listVoitures' => $voitures,
        ]);
    }

    #[Route('/addvoiture', name: 'add_voiture')]
    public function addVoiture(Request $request, EntityManagerInterface $em): Response
    {
        $voiture = new Voiture();
        $form = $this->createForm(VoitureType::class, $voiture);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $em->persist($voiture);
            $em->flush();
            return $this->redirectToRoute('app_voiture');
        }

        return $this->render('voiture/addVoiture.html.twig', ['formV' => $form->createView()]);
    }

    #[Route('/voiture/{id}', name: 'voitureDelete')]
    public function delete(EntityManagerInterface $em, VoitureRepository $vr, $id): Response
    {
        $voiture = $vr->find($id);
        $em->remove($voiture);
        $em->flush();

        return $this->redirectToRoute('app_voiture');


    }

    #[Route('/updateVoiture/{id}', name: 'voitureUpdate')]
    public function updateVoiture(
        Request $request,
        EntityManagerInterface $em,
        VoitureRepository $vr,
        int $id
    ): Response {
        $voiture = $vr->find($id);

        $editform = $this->createForm(VoitureType::class, $voiture);
        $editform->handleRequest($request);

        if ($editform->isSubmitted() && $editform->isValid()) {
            $em->persist($voiture);
            $em->flush();

            return $this->redirectToRoute('app_voiture');
        }

        return $this->render('voiture/updateVoiture.html.twig', [
            'editFormVoiture' => $editform->createView(),
        ]);
    }

    #[Route('/voiture-par-modele', name: 'voiture_par_modele')]
    public function voitureParModele(Request $request, VoitureRepository $vr, EntityManagerInterface $em): Response
    {
        $modeleId = $request->query->get('modele');
        $voitures = [];
        if ($modeleId) {
            $voitures = $vr->findBymodele($modeleId);
        }
        $modeles = $em->getRepository('App\Entity\Modele')->findAll();

        return $this->render('voiture/voitureParModele.html.twig', [
            'voitures' => $voitures,
            'modeles' => $modeles,
            'selectedModele' => $modeleId,
        ]);
    }


}