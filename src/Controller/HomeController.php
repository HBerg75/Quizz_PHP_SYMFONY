<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    private $fp;
    private $nbr;
    /**
     * @Route("/home", name="home")
     */
    public function __construct()
    {
        $this->fp = fopen(__DIR__ . '/compteur.txt', 'r+');
        $this->nbr = fgets($this->fp);
        $this->inc();
    }
    public function __destruct()
    {
        fclose($this->fp);
    }

    public function index(): Response
    {
        $session = $this->get('session');
        $previousScore = $session->set('score', array());
        
        return $this->render('home/index.html.twig', [
            'nombre_visiteurs' => $this->afficher()
        ]);
    }

    public function inc(){
        // if($this->getUser()){
            $this->nbr++;
            fseek($this->fp,0);
            fputs($this->fp, $this->nbr);
        // }
    }
    public function afficher(){
        return $this->nbr;
    }
}