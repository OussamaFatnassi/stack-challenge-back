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
            ->setName('SKI');

        $user1 = (new User())
            ->setEmail('amine@mail.com')
            ->setFirstname('User')
            ->setLastname('Test')
            ->setRoles(["ROLE_ADMIN"])
            ->setPassword($this->passwordHasher->hashPassword(new User(), 'test123'))
            ->addFavactivity($activtity1);

        $event = (new Event())
            ->setName('Ski event')
            ->setStartdate(new \DateTime('2024-09-24 12:00:00'))
            ->setEnddate(new \DateTime('2024-09-28 14:00:00'))
            ->setOrganiser($user1)
            ->setLevel("intermédiaire")
            ->setAddress('Val thorens')
            ->setMaxParticipants(12);

        $activtity1->addEvent($event);

        $manager->persist($activtity1);
        $manager->persist($user1);
        $manager->persist($event);


        $manager->flush();
    }
}
