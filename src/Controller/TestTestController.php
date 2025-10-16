<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Routing\RouterInterface;

#[Route('/advert', name: 'app_')]
final class TestTestController extends AbstractController
{
    // #[Route('/test/test', name: 'app_test_test')]
    // public function index(): Response
    // {   //add table 
    //     $data = [
    //         ['id' => 1, 'name' => 'John Doe', 'email' => 'john@example.com'],
    //         ['id' => 2, 'name' => 'Jane Smith', 'email' => 'jane@example.com'],
    //         ['id' => 3, 'name' => 'Alice Johnson', 'email' => 'alice@example.com'],
    //     ];

    //     return $this->render('test_test/index.html.twig', [
    //         'controller_name' => 'TestTestController',
    //         'data' => $data,
    //     ]);
    // }

    // //create object student 
    // #[Route('/test/student', name: 'app_test_student')]
    // public function create(): Response
    // {
    //     $student = new Student(4, 'Bob Brown', 'bob@example.com');

    //     return $this->render('test_test/student.html.twig', [
    //         'student' => $student,
    //     ]);
    // }

    #[Route('/', name: 'app_view')]
    public function store(RouterInterface $router): Response
    {

        $url = $router->generate('app_oc_view', ['id' => 5]);

        // Logic to handle the advert view
        return new Response("Viewing advert ID: " . $url);
    }

    #[Route('/app_view/{id}', name: 'oc_view')]
    public function show(int $id): Response 
    {
        return new Response("This is advert $id");
    }

}
