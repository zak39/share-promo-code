<?php

namespace App\Controller;

use App\Entity\PromotionCode;
use App\Form\PromotionCodeType;
use App\Repository\PromotionCodeRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

#[IsGranted('ROLE_ADMIN')]
#[Route('/admin/code')]
class PromotionCodeController extends AbstractController
{
    #[Route('/', name: 'app_promotion_code_index')]
    public function index(PromotionCodeRepository $repository): Response
    {
        $promotionCodes = $repository->findAll();

        return $this->render('promotion_code/index.html.twig', [
            'promotionCodes' => $promotionCodes,
        ]);
    }

    #[Route('/{id}', name: 'app_promotion_code_show', requirements: [ 'id' => '\d+' ], methods: ['GET'])]
    public function show(?PromotionCode $code): Response
    {
        return $this->render('promotion_code/show.html.twig', [
            'promotionCode' => $code
        ]);
    }

    #[Route('/create', name: 'app_promotion_code_create', methods: ['GET', 'POST'])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $code = new PromotionCode();

        $form = $this->createForm(PromotionCodeType::class, $code);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em->persist($code);
            $em->flush();

            return $this->redirectToRoute('app_promotion_code_index');
        }

        return $this->render('promotion_code/create.html.twig', [
            'form' => $form
        ]);
    }
}
