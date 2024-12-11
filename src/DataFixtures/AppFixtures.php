<?php

namespace App\DataFixtures;

use App\Entity\Platform\BillingProfile;
use App\Entity\Platform\Instance;
use App\Entity\Platform\Service;
use App\Entity\Platform\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Contracts\Translation\TranslatorInterface;

class AppFixtures extends Fixture
{
    private TranslatorInterface $translator;
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(TranslatorInterface $translator, UserPasswordHasherInterface $passwordHasher)
    {
        $this->translator = $translator;
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        $this->loadBillingProfiles($manager);
        $this->loadInstances($manager);
        $this->loadUsers($manager);

        $manager->flush();
    }

    private function loadInstances($manager)
    {
        $instances = [
            [
                'name' => 'brandcom.',
                'status' => 1,
            ],
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

    private function loadBillingProfiles($manager)
    {
        // Read CSV file content
        $csvFile = __DIR__ . '/billing-profiles.csv';
        $csvContent = file_get_contents($csvFile);

        // Convert CSV content to an array
        $rows = array_map('str_getcsv', explode("\n", $csvContent));
        $header = array_shift($rows);

        // Loop through the array and create BillingProfile entities
        foreach ($rows as $row) {
            if (count($row) < count($header)) {
                continue; // Skip incomplete rows
            }

            $billingProfileData = array_combine($header, $row);
            $newBillingProfile = new BillingProfile();
            $newBillingProfile->setName($billingProfileData['name']);
            $newBillingProfile->setZip((int)$billingProfileData['zip']);
            $newBillingProfile->setSettlement($billingProfileData['settlement']);
            $newBillingProfile->setAddress($billingProfileData['address']);
            $newBillingProfile->setVat($billingProfileData['vat']);
            $newBillingProfile->setEuVat($billingProfileData['euVat']);
            $newBillingProfile->setEmail($billingProfileData['email']);
            $manager->persist($newBillingProfile);
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
                        'name' => 'tárhely 10 GB',
                        'type' => 'hosting',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'harkalygergo.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'harkaly.eu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'brandcom.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'brandcomstudio.com domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'biecoshop.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'diateka.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'webcard.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'webcard.cz domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'varosinfo.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'telepulesinfo.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'infopedia.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'futoblog.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'sportnagykovet.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
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
                        'name' => 'tárhely 10 GB',
                        'type' => 'hosting',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'ask-net.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
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
                        'name' => 'tárhely 10 GB',
                        'type' => 'hosting',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'bogacsigyogycentrum.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'vitalitashaz.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                ]
            ],
            [
                'namePrefix' => '',
                'firstName' => 'Zoltán',
                'middleName' => '',
                'lastName' => 'Nagy',
                'nickName' => '',
                'phone' => '+36209168791',
                'email' => 'nagydrotfonokft@gmail.com',
                'services' => [
                    [
                        'name' => 'tárhely 10 GB',
                        'type' => 'hosting',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'nagydrotfono.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                ]
            ],
            [
                'namePrefix' => '',
                'firstName' => 'Attila',
                'middleName' => '',
                'lastName' => 'Cseh',
                'nickName' => '',
                'phone' => '+36209805513',
                'email' => 'acs@freemail.hu',
                'services' => [
                    [
                        'name' => 'tárhely 10 GB',
                        'type' => 'hosting',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'digimuhely.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'helloled.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'beolina.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 3000,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'freyadance.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 3000,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                ]
            ],
            [
                'namePrefix' => '',
                'firstName' => 'Diána',
                'middleName' => '',
                'lastName' => 'Standovári',
                'nickName' => '',
                'phone' => '+36305465283',
                'email' => 'standovaridiana@gmail.com',
                'services' => [
                    [
                        'name' => 'tárhely 10 GB',
                        'type' => 'hosting',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'mocorgo.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                ]
            ],
            [
                'namePrefix' => '',
                'firstName' => 'Gizella',
                'middleName' => '',
                'lastName' => 'Herczeg',
                'nickName' => '',
                'phone' => '+36309994427',
                'email' => 'herczegsuzig@gmail.com',
                'services' => [
                    [
                        'name' => 'tárhely 10 GB',
                        'type' => 'hosting',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'izuletmuhely.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                ]
            ],
            [
                'namePrefix' => '',
                'firstName' => 'Péter',
                'middleName' => '',
                'lastName' => 'Novotta',
                'nickName' => '',
                'phone' => '+36208031739',
                'email' => 'novi.peter@gmail.com',
                'services' => [
                    [
                        'name' => 'tárhely 10 GB',
                        'type' => 'hosting',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'margaretaapartman.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'margaretahotel.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'bogacshotel.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 3000,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                ]
            ],
            [
                'namePrefix' => '',
                'firstName' => 'Ferenc',
                'middleName' => '',
                'lastName' => 'Tili',
                'nickName' => '',
                'phone' => '+36302262032',
                'email' => 'ferenc@tili.hu',
                'services' => [
                    [
                        'name' => 'tárhely 10 GB',
                        'type' => 'hosting',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'autoalkatresz.bolt.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'tili.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'etautosbolt.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 3000,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
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
                        'name' => 'tárhely 10 GB',
                        'type' => 'hosting',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'hollandmunkak.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'hunflex.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'hunflex.nl domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 6000,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'flex-go.eu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 4000,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'alfaflex.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 3000,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                ]
            ],
            [
                'namePrefix' => '',
                'firstName' => 'József',
                'middleName' => '',
                'lastName' => 'Sándor',
                'nickName' => '',
                'phone' => '+36205900204',
                'email' => 'joesandor1987@gmail.com',
                'services' => [
                    [
                        'name' => 'tárhely 10 GB',
                        'type' => 'hosting',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2025-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'joetaxi.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2025-12-01 00:00:00'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                ]
            ],
            [
                'namePrefix' => '',
                'firstName' => 'László',
                'middleName' => '',
                'lastName' => 'Molnár',
                'nickName' => '',
                'phone' => '+36703090027',
                'email' => 'lmolnar261@gmail.com',
                'services' => [
                    [
                        'name' => 'tárhely 10 GB',
                        'type' => 'hosting',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2025-12-01'),
                        'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                        'status' => 1,
                    ],
                    [
                        'name' => 'valhallacalling.hu domain név',
                        'type' => 'domain',
                        'description' => '',
                        'annualFee' => 0,
                        'currency' => 'HUF',
                        'nextPaymentDate' => new \DateTimeImmutable('2025-12-01'),
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
            //$newUser->setPassword($this->passwordHasher->hashPassword($newUser, $user['email']));
            $newUser->setPassword(password_hash($user['email'], PASSWORD_DEFAULT));
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
                'type' => 'basic',
                'description' => 'Tartalmazza a platform alapvető szolgáltatásait: 2 domain név, korlátlan aldomain, 10 GB tárhely (honlap, e-mail fiók, adatbázis), SSL tanúsítvány (https), korlátlan e-mail fiók és alias, rendszeres biztonsági mentés, folyamatos karbantartás, továbbfejlesztés, éves rendelkezésre állás technikai kérdésekben.',
                'annualFee' => 30000,
                'currency' => 'HUF',
                'frequencyOfPayment' => $this->translator->trans('payment.annual'),
                'nextPaymentDate' => new \DateTimeImmutable('2024-12-01 00:00:00'),
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
            $newService->setType($service['type']);
            $newService->setFee($service['annualFee']);
            $newService->setCurrency($service['currency']);
            $newService->setFrequencyOfPayment($service['frequencyOfPayment']);
            $newService->setNextPaymentDate($service['nextPaymentDate']);
            $newService->setStatus($service['status']);
            $manager->persist($newService);
        }

    }
}
