<?php

namespace App\DataFixtures;

use App\Entity\Platform\Instance;
use App\Entity\Platform\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $this->loadUsers($manager);


        $manager->flush();
    }

    private function loadUsers($manager)
    {
        $users = [
            [
                'namePrefix' => '',
                'firstName' => 'Csaba',
                'middleName' => '',
                'lastName' => 'Simon-Kovács',
                'nickName' => 'SKCS',
                'phone' => '+36706031724',
                'email' => 'ask-net@gmail.hu',
            ],
            [
                'namePrefix' => 'Dr.',
                'firstName' => 'Ildikó',
                'middleName' => '',
                'lastName' => 'Képes',
                'nickName' => '',
                'phone' => '+36302188190',
                'email' => 'drkepesildiko@gmail.com',
            ],
            [
                'namePrefix' => 'Id.',
                'firstName' => 'József',
                'middleName' => '',
                'lastName' => 'Tóth',
                'nickName' => '',
                'phone' => '+36302188190',
                'email' => 'drkepesildiko@gmail.com',
            ],
        ];
        foreach ($users as $user) {
            $newUser = new User();
            $newUser->setNamePrefix($user['namePrefix']);
            $newUser->setFirstName($user['firstName']);
            $newUser->setMiddleName($user['middleName']);
            $newUser->setLastName($user['lastName']);
            $newUser->setNickName($user['nickName']);
            $newUser->setPhone($user['phone']);
            $newUser->setEmail($user['email']);
            $newUser->setPassword($user['email']);
            $newUser->setStatus(1);
            $manager->persist($newUser);
        }
    }

    private function loadServices($manager)
    {

    }
}
