<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Question;
use App\Entity\Reponse;
use App\Entity\QuizzHistory;
use App\Form\CategorieType;
use App\Form\QuestionType;
use App\Form\ReponseType;
use App\Repository\QuizzHistoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class QuizzHistoryController extends AbstractController
{
    /**
     * @Route("/admin/quizz/history", name="admin_quizz_history")
     */
    public function index(QuizzHistoryRepository $quizzHistoryRepository): Response
    {
        return $this->render('quizz_history/index.html.twig', [
            'quizzHistory' => $quizzHistoryRepository->findAll(),
        ]);
    }

    /**
     * @Route("/quizz/history/{id}", name="quizz_history")
     */
    public function userHistory(QuizzHistoryRepository $quizzHistoryRepository, $id): Response
    {
        return $this->render('quizz_history/show.html.twig', [
            'quizzHistory' => $quizzHistoryRepository->findBy(array('user' => $id)),
        ]);
    }

    /**
     * @Route("/quizz/session/history", name="quizz_history_sessions")
     */
    public function sessionHistory(QuizzHistoryRepository $quizzHistoryRepository): Response
    {
        $session = $this->get('session');
        $totalScore = $session->get('score');
        return $this->render('quizz_history/sessionHistory.html.twig', [
            'scoreTotal' => $totalScore,
        ]);
    }
}
