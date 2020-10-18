<?php
// src/Controller/MainController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MainController extends AbstractController
{
    /**
      * @Route("/lucky/number")
      */
    public function number(): Response
    {
        $number = random_int(0, 100);

        return $this->render('main/number.html.twig', [
            'number' => $number,
        ]);
    }
}