<?php

namespace App\Controller;

use App\Entity\Student;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class StudentController extends AbstractController
{
    /**
     * @Route(
     *     name="student_grade_average",
     *     path="/students/{id}/grade-average",
     *     methods={"GET"},
     *     defaults={"_api_item_operation_name"="get_student_grade_average"}
     * )
     * @param Request $request
     * @return JsonResponse
     */
    public function __invoke(Request $request)
    {
        /** @var Student $student */
        $student = $this->getDoctrine()
            ->getRepository(Student::class)
            ->find($request->get('id'));

        if (empty($student)) {
            return new JsonResponse(['message' => 'Student not found'], JsonResponse::HTTP_NOT_FOUND);
        }

        return new JsonResponse(['gradeAverage' => $student->calculateGradeAverage()], JsonResponse::HTTP_OK);
    }
}
