<?php

namespace App\DataFixtures;

use App\Entity\Platform\Instance;
use App\Entity\Platform\Service;
use App\Entity\Platform\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Contracts\Translation\TranslatorInterface;

class AppFixtures extends Fixture
{
    private TranslatorInterface $translator;

    public function __construct(TranslatorInterface $translator)
    {
        $this->translator = $translator;
    }

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
                'services' => [
                    [
                        'name' => 'ask-net.hu domain név',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'ask-net.hu tárhely',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                ]
            ],
            [
                'namePrefix' => 'Dr.',
                'firstName' => 'Ildikó',
                'middleName' => '',
                'lastName' => 'Képes',
                'nickName' => '',
                'phone' => '+36302188190',
                'email' => 'drkepesildiko@gmail.com',
                'services' => [
                    [
                        'name' => 'bogacsigyogycentrum.hu domain név',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'bogacsigyogycentrum.hu tárhely',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'vitalitashaz.hu domain név',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'vitalitashaz.hu tárhely',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                ]

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
        $services = [
            [
                'name' => 'Platform alapszolgáltatás',
                'description' => 'Tartalmazza a platform alapvető szolgáltatásait: egy domain név, 1 GB tárhely, SSL tanúsítvány, korlátlan e-mail fiók és alias, 1 GB e-mail fiók tárhely, rendszeres biztonsági mentések, folyamatos karbantartás, továbbfejlesztés, éves rendelkezésre állás technikai kérdésekben.',
                'annualFee' => 30000,
                'currency' => 'HUF',
                'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                'status' => 1,
            ],
        ];

        foreach ($services as $service) {
            $newService = new Service();
            $newService->setName($service['name']);
            $newService->setDescription($service['description']);
            $newService->setStatus($service['status']);
            $manager->persist($newService);
        }

    }
}
