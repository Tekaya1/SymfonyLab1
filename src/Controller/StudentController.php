<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    #[Route('/students', name: 'student_list', methods: ['GET'])]

    public function index(): Response
    {
        return new Response('Hello from StudentController!');
    }
    #[Route('/students/{id<\d{2}>}', name: 'student_detail', methods: ['GET'])]
    public function show($id): Response
    {
        return new Response("Details of student with ID: $id");
    }

    #[Route('/students/{name}', name: 'student_name', methods: ['GET', 'POST'])]
    public function voirNom($name): Response
    {
        // Logic to edit the student with name $name
        return $this->render('student/student.html.twig', [
            'name' => $name,
        ]);
    }
}


