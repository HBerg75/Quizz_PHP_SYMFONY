<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Question;
use App\Entity\Reponse;
use App\Entity\QuizzHistory;
use App\Form\CategorieType;
use App\Form\QuestionType;
use App\Form\ReponseType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\HttpFoundation\Session\Attribute\AttributeBag;
use Symfony\Component\HttpFoundation\Session\Storage\NativeSessionStorage;

/**
 * @Route("/quizz")
 */
class QuizzController extends AbstractController
{
    /**
     * @Route("/", name="quizz_index", methods={"GET"})
     */
    public function index(): Response
    {
        $categories = $this->getDoctrine()
            ->getRepository(Categorie::class)
            ->findAll();

        return $this->render('quizz/index.html.twig', [
            'categories' => $categories,
        ]);
    }

    /**
     * @Route("/newCategorie", name="quizz_new_categorie", methods={"GET","POST"})
     */
    public function newCategorie(Request $request): Response
    {
        $this->denyAccessUnlessGranted('ROLE_USER', null, 'Unable to access this page!');
        $categorie = new Categorie();
        $form = $this->createForm(CategorieType::class, $categorie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($categorie);
            $entityManager->flush();

            return $this->redirectToRoute('quizz_index');
        }

        return $this->render('categorie/userNew.html.twig', [
            'categorie' => $categorie,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newQuestion", name="quizz_new_question", methods={"GET","POST"})
     */
    public function newQuestion(Request $request): Response
    {
        $question = new Question();
        $form = $this->createForm(QuestionType::class, $question);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($question);
            $entityManager->flush();

            return $this->redirectToRoute('quizz_index');
        }

        return $this->render('question/userNew.html.twig', [
            'question' => $question,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/newReponse", name="quizz_new_response", methods={"GET","POST"})
     */
    public function newReponse(Request $request): Response
    {
        $reponse = new Reponse();
        $form = $this->createForm(ReponseType::class, $reponse);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($reponse);
            $entityManager->flush();

            return $this->redirectToRoute('quizz_index');
        }

        return $this->render('reponse/userNew.html.twig', [
            'reponse' => $reponse,
            'form' => $form->createView(),
        ]);
    }

    /**
     * @Route("/{id}/show", name="quizz_get", methods={"GET","POST"})
     */
    public function getQuizz(Request $request, Question $question, $id): Response
    {
        $score = 0;
        $numberOfQuestions = 0;

        $questions = $this->getDoctrine()
            ->getRepository(Question::class)
            ->findBy(array('categorie' => $id));

        $post = $request->request->all();
        if (!empty($post)) {
            foreach($post as $answer) {
                $numberOfQuestions++;

                $checkAnswer = $this->getDoctrine()
                            ->getRepository(Reponse::class)
                            ->findBy(array('reponse' => $answer));
                if($checkAnswer[0]->getReponseExpected() == true) {
                    $score++;
                }
            }
            $categories = $this->getDoctrine()
                ->getRepository(Categorie::class)
                ->findAll();

            $currentCategorie = $this->getDoctrine()
                        ->getRepository(Categorie::class)
                        ->findBy(array('id' => $id));
            
            $currentUser = $this->getUser();

            if (!empty($currentUser)) {

                $datePassed = date("d-m-Y H:i:s");
    
                $entityManager = $this->getDoctrine()->getManager();
    
                $quizzHistory = new QuizzHistory();
                $quizzHistory->setUser($currentUser);
                $quizzHistory->setCategorie($currentCategorie[0]);
                $quizzHistory->setScore($score);
                $quizzHistory->setNumberOfQuestions($numberOfQuestions);
                $quizzHistory->setDatePassed($datePassed);
    
                $entityManager->persist($quizzHistory);
                $entityManager->flush();
                
                return $this->render('quizz/index.html.twig', [
                    'score' => $score."/".$numberOfQuestions,
                    'categories' => $categories,
                    'currentCategorie' => $currentCategorie,
                    'user' => $currentUser
                ]);
            } else {
                $session = $this->get('session');
                $oldQuizzScore;
                if(!$this->getUser()) {
                    $currentQuizzScore = [
                        'categorie' => $currentCategorie[0]->getName(),
                        'score' => $score,
                        'numberOfQuestions' => $numberOfQuestions,
                        'datePassed' =>  date("d-m-Y H:i:s")
                    ];
                    $oldQuizzScore = $session->get('score');
                    array_push($oldQuizzScore, $currentQuizzScore);
                    $session->set('score', $oldQuizzScore);
                }


                $totalScore = $session->get('score');
                return $this->render('quizz_history/sessionHistory.html.twig', [
                    'scoreTotal' => $totalScore,
                ]);
            }

        }

        return $this->render('quizz/show.html.twig', [
            'questions' => $questions
        ]);

    }
}