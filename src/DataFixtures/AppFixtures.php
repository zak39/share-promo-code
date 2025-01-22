<?php

namespace App\DataFixtures;

use App\Entity\PromotionCode;
use App\Entity\User;
use App\Factory\PromotionCodeFactory;
use App\Factory\UserFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $userPasswordHasher
    )
    {
    }
    
    public function load(ObjectManager $manager): void
    {
        $commonPassword = 'password';

        $admin = new User();
        $admin
            ->setEmail('admin@vip.com')
            ->setPassword($this->userPasswordHasher->hashPassword($admin, $commonPassword))
            ->setRoles(['ROLE_ADMIN', 'ROLE_VIP'])
        ;

        $vip = new User();
        $vip
            ->setEmail('vip@test.com')
            ->setPassword($this->userPasswordHasher->hashPassword($vip, $commonPassword))
            ->setRoles(['ROLE_VIP'])
        ;

        $userTest = new User();
        $userTest
            ->setEmail('test@test.com')
            ->setPassword($this->userPasswordHasher->hashPassword($userTest, $commonPassword))
        ;

        $promoCode01 = new PromotionCode();
        $promoCode01
            ->setProductName('GoPro Hero 13')
            ->setRate(35)
            ->setCode('#CAM130987')
        ;

        $promoCode02 = new PromotionCode();
        $promoCode02
            ->setProductName('Vélo Elops 120')
            ->setRate(20)
            ->setCode('#BIK3D4389')
        ;

        $promoCode03 = new PromotionCode();
        $promoCode03
            ->setProductName('The witcher 3')
            ->setRate(75)
            ->setCode('#GAM3G0G03')
        ;
        
        $manager->persist($admin);
        $manager->persist($vip);
        $manager->persist($userTest);
        $manager->persist($promoCode01);
        $manager->persist($promoCode02);
        $manager->persist($promoCode03);

        $manager->flush();

        UserFactory::createMany(5);
        PromotionCodeFactory::createMany(6);
    }
}
