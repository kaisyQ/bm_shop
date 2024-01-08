<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $hasher) {
    }
    public function load(ObjectManager $manager): void
    {
        $user = new Admin();

        $password = $this->hasher->hashPassword($user, '12345');

        $user->setUsername("admin");
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword($password);

        $manager->persist($user);

        $manager->flush();
    }
}