<?php

namespace App\Entity;

use ApiPlatform\Core\Annotation\ApiResource;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\GradeRepository")
 * @ApiResource(
 *     itemOperations={
 *         "get",
 *         "put",
 *         "patch",
 *         "delete",
 *         "get_class_grade_average": {"route_name": "class_grade_average"}
 *     },
 *     collectionOperations={"get", "post"}
 * )
 */
class Grade
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
     * @ORM\ManyToOne(targetEntity="App\Entity\Student", inversedBy="grades")
     * @ORM\JoinColumn(nullable=false)
     */
    private $student;

    /**
     * @var int
     *
     * @ORM\Column(type="integer")
     * @Assert\Type("integer")
     * @Assert\Range(min=0, max=20)
     */
    private $value;

    /**
     * @var string
     *
     * @ORM\Column(type="string", length=255)
     * @Assert\Type("string")
     * @Assert\NotBlank()
     * @Assert\NotNull()
     */
    private $subject;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getStudent(): ?Student
    {
        return $this->student;
    }

    public function setStudent(?Student $student): self
    {
        $this->student = $student;

        return $this;
    }

    public function getValue(): ?int
    {
        return $this->value;
    }

    public function setValue(int $value): self
    {
        $this->value = $value;

        return $this;
    }

    public function getSubject(): ?string
    {
        return $this->subject;
    }

    public function setSubject(string $subject): self
    {
        $this->subject = $subject;

        return $this;
    }
}
