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
        $this->loadInstances($manager);
        $this->loadUsers($manager);


        $manager->flush();
    }

    private function loadInstances($manager)
    {
        $instances = [
            [
                'name' => 'Harkály Gergő',
                'status' => 1,
            ],
            [
                'name' => 'ASK-NET',
                'status' => 1,
            ],
            [
                'name' => 'Dr. Képes Ildikó',
                'status' => 1,
            ],
            [
                'name' => 'Hunflex',
                'status' => 1,
            ],
        ];

        foreach ($instances as $instance) {
            $newInstance = new Instance();
            $newInstance->setName($instance['name']);
            $newInstance->setStatus($instance['status']);
            $manager->persist($newInstance);
        }
    }

    private function loadUsers($manager)
    {
        $users = [
            [
                'namePrefix' => '',
                'firstName' => 'Gergő',
                'middleName' => '',
                'lastName' => 'Harkály',
                'nickName' => 'harkalygergo',
                'phone' => '+36706081384',
                'email' => 'platform@harkalygergo.hu',
                'services' => [
                    [
                        'name' => 'tárhely 5 GB',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'harkalygergo.hu domain név',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'harkaly.eu domain név',
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
                'namePrefix' => '',
                'firstName' => 'Csaba',
                'middleName' => '',
                'lastName' => 'Simon-Kovács',
                'nickName' => 'SKCS',
                'phone' => '+36706031724',
                'email' => 'ask-net@gmail.hu',
                'services' => [
                    [
                        'name' => 'tárhely 5 GB',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'ask-net.hu domain név',
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
                        'name' => 'tárhely 5 GB',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
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
                        'name' => 'vitalitashaz.hu domain név',
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
                'phone' => '+36703185810',
                'email' => 'j.toth@hunflex.hu',
                'services' => [
                    [
                        'name' => 'tárhely 5 GB',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'hollandmunkak.hu domain név',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'hunflex.hu domain név',
                        'description' => '',
                        'annualFee' => 3000,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'hunflex.nl domain név',
                        'description' => '',
                        'annualFee' => 6000,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'flex-go.eu domain név',
                        'description' => '',
                        'annualFee' => 4000,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                ]
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

            // get new user id
            $newUserId = $newUser->getId();
            $this->loadServices($manager, $newUserId, $user['services']);
        }
    }

    private function loadServices($manager, $newUserId, $userServices)
    {
        $services = [
            [
                'name' => 'Platform alapszolgáltatás',
                'description' => 'Tartalmazza a platform alapvető szolgáltatásait: egy domain név, korlátlan aldomain, 5 GB tárhely (honlap, e-mail fiók, adatbázis), SSL tanúsítvány (https), korlátlan e-mail fiók és alias, rendszeres biztonsági mentés, folyamatos karbantartás, továbbfejlesztés, éves rendelkezésre állás technikai kérdésekben.',
                'annualFee' => 30000,
                'currency' => 'HUF',
                'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                'nextPaymentDate' => new \DateTimeImmutable('2024-12-01'),
                'status' => 1,
            ],
        ];

        // add user services to $services
        foreach ($userServices as $userService) {
            $services[] = $userService;
        }

        foreach ($services as $service) {
            $newService = new Service();
            $newService->setName($service['name']);
            $newService->setDescription($service['description']);
            $newService->setStatus($service['status']);
            $manager->persist($newService);
        }

    }
}
