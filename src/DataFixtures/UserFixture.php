<?php

namespace App\DataFixtures;

use App\Entity\Admin;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{

    public function __construct(private UserPasswordHasherInterface $hasher) {
    }
    public function load(ObjectManager $manager): void
    {
        $user = new Admin();

        $password = $this->hasher->hashPassword($user, '12345');

        $user->setUsername("admin");
        $user->setRoles(["USER_ADMIN"]);
        $user->setPassword($password);

        $manager->persist($user);

        $manager->flush();
    }
}