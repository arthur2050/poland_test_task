<?php


namespace App\Services;


use App\Entity\Report;
use App\Form\ReportFilterForm;
use App\Repository\ReportRepository;
use Symfony\Component\Form\FormFactoryInterface;
use Symfony\Component\HttpFoundation\Request;

class ReportService
{


    private $reportRepository;
    private $formFactoryInterface;

    /**
     * ReportService constructor.
     * @param ReportRepository $reportRepository
     * @param FormFactoryInterface $formFactoryInterface
     */
    public function __construct(ReportRepository $reportRepository, FormFactoryInterface $formFactoryInterface)
    {
        $this->reportRepository = $reportRepository;
        $this->formFactoryInterface = $formFactoryInterface;
    }

    /**
     * @param Request $request
     * @return array
     */
    public function getRowsByFilter(Request $request): array
    {
        $report = new Report();
        $form = $this->formFactoryInterface->create(ReportFilterForm::class,);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formData = $form->getData();
            return
                [
                    'filteredData' => $this->reportRepository->getByArrangeDateAndPlace(
                        $formData['from'], $formData['to'], $formData['place']
                    ),
                    'form' => $form
                ];
        }
        return
            [
                'filteredData' => $this->reportRepository->findAll(),
                'form' => $form
            ];
    }

}