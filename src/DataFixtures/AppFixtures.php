<?php

namespace App\DataFixtures;

use App\Entity\Activity;
use App\Entity\Event;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $activtity1 = (New Activity())
            ->setName('Football');

        $user1 = (new User())
            ->setEmail('name@mail.com')
            ->setFirstname('John')
            ->setLastname('Doe')
            ->setPassword('$argon2id$v=19$m=65536,t=4,p=1$Z0Z6Z0Z6Z0Z')
            ->addFavactivity($activtity1);

        $event = (new Event())
            ->setName('Football match')
            ->setStartdate(new \DateTime('2021-09-01 12:00:00'))
            ->setEnddate(new \DateTime('2021-09-01 14:00:00'))
            ->setOrganiser($user1)
            ->setLevel(1);

        $activtity1->addEvent($event);

        $manager->persist($activtity1);
        $manager->persist($user1);
        $manager->persist($event);


        $manager->flush();
    }
}
