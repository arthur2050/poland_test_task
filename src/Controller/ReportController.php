<?php


namespace App\Controller;

use App\Services\ReportService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ReportController extends AbstractController
{
    private $reportService;

    public function __construct(ReportService $reportService)
    {
        $this->reportService = $reportService;
    }

    /**
     * @Route("/report", methods={"GET", "POST"})
     * @param Request $request
     * @return string
     */
    public function getReport(Request $request)
    {
        $dataView = $this->reportService->getRowsByFilter($request);
        return $this->renderForm('report.html.twig' , $dataView);
    }
}