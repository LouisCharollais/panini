<?php

namespace App\DataFixtures;

use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class UserFixtures extends Fixture
{
    private UserPasswordHasherInterface $hasher;

    private const USERS = [
        [
            'email' => 'chris@localhost',
            'password' => 'password123',
            'role' => 'ROLE_USER'
        ],
        [
            'email' => 'anna@localhost.com',
            'password' => 'password456',
            'role' => 'ROLE_ADMIN'
        ]
    ];

    public function __construct(UserPasswordHasherInterface $hasher)
    {
        $this->hasher = $hasher;
    }


    public function load(ObjectManager $manager): void
    {
        foreach (self::USERS as $user) {
            $newUser = new User();
            $password = $this->hasher->hashPassword($newUser, $user['password']);
            $newUser->setEmail($user['email']);
            $newUser->setPassword($password);
            $newUser->setRoles([$user['role']]);

            $manager->persist($newUser);
        }

        $manager->flush();
    }
}