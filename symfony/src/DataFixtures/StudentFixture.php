<?php

namespace App\DataFixtures;

use App\Entity\Student;
use DateInterval;
use DateTime;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class StudentFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        for ($i = 0; $i < 10; $i++) {
            $student = $this->createStudent($i);
            $manager->persist($student);
        }

        $manager->flush();
    }

    public function createStudent(int $i): Student
    {
        $firstNames = ['Léa', 'Pierre', 'Nicolas', 'Maxime', 'Claire', 'Benoît', 'Sophie', 'Pauline', 'Philippe', 'Louise'];
        $lastNames = ['Martin', 'Petit', 'Durand', 'Dubois', 'Moreau', 'Lefebvre', 'Roux', 'Leroy', 'Fournier', 'Delabre'];

        $student = new Student();
        $student->setFirstName($firstNames[$i]);
        $student->setLastName($lastNames[$i]);
        $student->setBirthDate($this->getRandomDate());

        return $student;
    }

    public function getRandomDate(): DateTime
    {
        $start = new DateTime();
        $start->sub(new DateInterval('P18Y'));

        $end = new DateTime();
        $end->sub(new DateInterval('P16Y'));

        $randomTimestamp = mt_rand($start->getTimestamp(), $end->getTimestamp());
        $randomDate = new DateTime();
        $randomDate->setTimestamp($randomTimestamp);

        return $randomDate;
    }
}
