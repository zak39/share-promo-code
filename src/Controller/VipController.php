<?php

namespace App\Controller;

use App\Repository\PromotionCodeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class VipController extends AbstractController
{
    #[Route('/vip', name: 'app_vip')]
    #[IsGranted('VOTER_VIP')]
    public function index(PromotionCodeRepository $repository): Response
    {

        $codes = $repository->findAll();

        return $this->render('vip/index.html.twig', [
            'codes' => $codes,
        ]);
    }
}
