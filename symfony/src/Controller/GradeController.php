<?php

namespace App\Controller;

use App\Entity\Grade;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;

class GradeController extends AbstractController
{
    /**
     * @Route(
     *     name="class_grade_average",
     *     path="/api/class-grade-average",
     *     methods={"GET"},
     *     defaults={"_api_item_operation_name"="get_class_grade_average"}
     * )
     * @return JsonResponse
     */
    public function __invoke()
    {
        /** @var Grade[] $grades */
        $grades = $this->getDoctrine()->getRepository(Grade::class)->findAll();

        $total = 0;
        $count = count($grades);
        foreach ($grades as $grade) {
            $total += $grade->getValue();
        }

        $classGradeAverage = $count > 0 ? round($total / $count, 2) : null;

        return new JsonResponse(['classGradeAverage' => $classGradeAverage], JsonResponse::HTTP_OK);
    }
}
