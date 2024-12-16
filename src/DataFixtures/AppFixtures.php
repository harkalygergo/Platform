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
        $this->loadUsers($manager);
        $this->loadInstances($manager);
        $this->loadServices($manager);
        $this->loadBillingProfiles($manager);
    }

    public function loadUsers($manager)
    {
        $csvContent = file_get_contents(__DIR__.'/users.csv');

        $rows = array_map('str_getcsv', explode("\n", $csvContent));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            if (count($row) < count($header)) {
                continue; // Skip incomplete rows
            }

            $data = array_combine($header, $row);

            $user = new User();
            $user->setNamePrefix($data['name_prefix']);
            $user->setFirstName($data['first_name']);
            $user->setMiddleName($data['middle_name']);
            $user->setLastName($data['last_name']);
            $user->setNickName($data['nick_name']);
            $user->setPassword(password_hash($data['email'], PASSWORD_DEFAULT));
            $user->setBirthName($data['birth_name']);
            $user->setPhone($data['phone']);
            $user->setEmail($data['email']);
            $user->setStatus($data['status']);
            $user->setProfileImageUrl($data['profile_image_url']);

            $manager->persist($user);
        }

        $manager->flush();
    }

    public function loadInstances($manager)
    {
        $csvContent = file_get_contents(__DIR__.'/instances.csv');

        $rows = array_map('str_getcsv', explode("\n", $csvContent));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            if (count($row) < count($header)) {
                continue; // Skip incomplete rows
            }

            $data = array_combine($header, $row);

            $instance = new Instance();
            $instance->setName($data['name']);
            $instance->setStatus($data['status']);

            $userRepository = $manager->getRepository(User::class);
            $user = $userRepository->findOneBy(['email' => $data['owner_email']]);
            if ($user) {
                $instance->setOwner($user);
                $instance->addUser($user);
            }

            $manager->persist($instance);
        }

        $manager->flush();
    }

    public function loadServices($manager)
    {
        $csvContent = file_get_contents(__DIR__.'/services.csv');

        $rows = array_map('str_getcsv', explode("\n", $csvContent));
        $header = array_shift($rows);

        foreach ($rows as $row) {
            if (count($row) < count($header)) {
                continue; // Skip incomplete rows
            }

            $data = array_combine($header, $row);

            $service = new Service();
            if ($data['instance']) {
                $instanceRepository = $manager->getRepository(Instance::class);
                $instance = $instanceRepository->findOneBy(['name' => $data['instance']]);
                $service->setInstance($instance);
            }
            $service->setName($data['name']);
            $service->setDescription($data['description']);
            $service->setFee($data['fee']);
            $service->setCurrency($data['currency']);
            $service->setFrequencyOfPayment($this->translator->trans($data['frequency_of_payment']));
            $service->setNextPaymentDate(new \DateTimeImmutable($data['next_payment_date']));
            $service->setStatus($data['status']);
            $service->setType($data['type']);

            $manager->persist($service);
        }

        $manager->flush();
    }

    private function loadBillingProfiles($manager)
    {
        // Read CSV file content
        $csvFile = __DIR__ . '/billing-profiles.csv';
        $csvContent = file_get_contents($csvFile);

        // Convert CSV content to an array
        $rows = array_map('str_getcsv', explode("\n", $csvContent));
        $header = array_shift($rows);

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

        $manager->flush();
    }
}
