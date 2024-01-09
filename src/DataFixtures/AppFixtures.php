<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\Event;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    public function __construct(
        private UserPasswordHasherInterface $passwordHasher
    ) {
    }

    public function load(ObjectManager $manager): void
    {
        $activtity1 = (new Activity())
            ->setName('Football');

        $user1 = (new User())
            ->setEmail('name@mail.com')
            ->setFirstname('John')
            ->setLastname('Doe')
            ->setPassword($this->passwordHasher->hashPassword(new User(), 'test123'))
            ->addFavactivity($activtity1);

        $event = (new Event())
            ->setName('Football match')
            ->setStartdate(new \DateTime('2021-09-01 12:00:00'))
            ->setEnddate(new \DateTime('2021-09-01 14:00:00'))
            ->setOrganiser($user1)
            ->setLevel(1)
            ->setAddress('Rue de la paix 1, 1000 Bruxelles');

        $activtity1->addEvent($event);

        $manager->persist($activtity1);
        $manager->persist($user1);
        $manager->persist($event);


        $manager->flush();
    }
}
