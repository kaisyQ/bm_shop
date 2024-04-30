<?php declare(strict_types=1);

namespace App\Infrastructure\DataFixtures;

use App\Domain\Entity\Admin;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixture extends Fixture
{

    public function __construct(private readonly UserPasswordHasherInterface $hasher) {}
    
    public function load(ObjectManager $manager): void
    {
        $user = new Admin();
        $password = $this->hasher->hashPassword($user, '12345');
        $user->setUsername("admin");
        $user->setRoles(["ROLE_ADMIN"]);
        $user->setPassword($password);
        $user->setPending(false);
        $manager->persist($user);
        $manager->flush();
    }
}