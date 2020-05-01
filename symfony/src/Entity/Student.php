<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StudentRepository")
 * @ApiResource(
 *     itemOperations={
 *         "get",
 *         "put",
 *         "patch",
 *         "delete",
 *         "get_student_grade_average": {"route_name": "student_grade_average"}
 *     },
 *     collectionOperations={"get", "post"}
 * )
 */
class Student
{
    /**
     * @var int
     *
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $firstName;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $lastName;

    /**
     * @var \DateTime
     *
     * @ORM\Column(type="date")
     * @Assert\Type("\DateTimeInterface")
     * @Assert\NotNull()
     */
    private $birthDate;

    /**
     * @ORM\OneToMany(targetEntity="App\Entity\Grade", mappedBy="student", orphanRemoval=true)
     */
    private $grades;

    public function __construct()
    {
        $this->grades = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getFirstName(): ?string
    {
        return $this->firstName;
    }

    public function setFirstName(string $firstName): self
    {
        $this->firstName = $firstName;

        return $this;
    }

    public function getLastName(): ?string
    {
        return $this->lastName;
    }

    public function setLastName(string $lastName): self
    {
        $this->lastName = $lastName;

        return $this;
    }

    public function getBirthDate(): ?\DateTimeInterface
    {
        return $this->birthDate;
    }

    public function setBirthDate(\DateTimeInterface $birthDate): self
    {
        $this->birthDate = $birthDate;

        return $this;
    }

    /**
     * @return Collection|Grade[]
     */
    public function getGrades(): Collection
    {
        return $this->grades;
    }

    public function addGrade(Grade $grade): self
    {
        if (!$this->grades->contains($grade)) {
            $this->grades[] = $grade;
            $grade->setStudent($this);
        }

        return $this;
    }

    public function removeGrade(Grade $grade): self
    {
        if ($this->grades->contains($grade)) {
            $this->grades->removeElement($grade);
            // set the owning side to null (unless already changed)
            if ($grade->getStudent() === $this) {
                $grade->setStudent(null);
            }
        }

        return $this;
    }

    /**
     * Calculates the student grade average.
     *
     * @return float|null
     */
    public function calculateGradeAverage(): ?float
    {
        $total = 0;
        $count = $this->getGrades()->count();

        foreach ($this->getGrades() as $grade) {
            $total += $grade->getValue();
        }

        return $count > 0 ? round($total / $count, 2) : null;
    }
}
