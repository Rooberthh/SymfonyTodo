<?php

namespace App\Controller\Api;

use App\Entity\Tasks;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TasksController extends AbstractController
{
    /**
     * @Route("/api/tasks", name="api_tasks")
     */
    public function index()
    {
        $tasks = $this->getDoctrine()->getRepository(Tasks::class)->findAll();

        return $this->json($tasks);
    }
}
