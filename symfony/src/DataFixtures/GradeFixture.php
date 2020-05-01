<?php

namespace App\DataFixtures;

use App\Entity\Grade;
use App\Entity\Student;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Persistence\ObjectManager;

class GradeFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        /** @var Student[] $students */
        $students = $manager->getRepository(Student::class)->findBy([], null, 10);

        foreach ($students as $student) {
            for ($i = 0; $i < rand(0, 5); $i++) {
                $grade = new Grade();
                $grade->setValue(rand(0, 20));
                $grade->setSubject($this->getRandomSubject());
                $grade->setStudent($student);
                $manager->persist($grade);
            }
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            StudentFixture::class
        );
    }

    public function getRandomSubject(): string
    {
        $subjects = ['Français', 'Mathématiques', 'Physique', 'Chimie', 'SVT', 'Anglais', 'Espagnol', 'Histoire', 'Géographie', 'Sport'];
        $i = rand(0, 9);

        return $subjects[$i];
    }
}
