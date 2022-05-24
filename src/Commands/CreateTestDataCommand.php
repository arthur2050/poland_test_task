<?php


namespace App\Commands;


use App\Entity\Report;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

class CreateTestDataCommand extends Command
{
    /** @var string $defaultName */
    protected static $defaultName = 'create-test-data';

    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        parent::__construct();
        $this->entityManager = $entityManager;
    }

    protected function configure()
    {
        $this
            ->setDescription('Crete test data')
        ;
    }


    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $numberPlace = 1;
        for($i=0;$i<20;$i++){
            $report = new Report();
            $number = $i;
            $number++;
            if(($i +1) %3 == 0 ) {
                $numberPlace++;
            }
            $report->setExportName("Export {$number}");
            $writeDate = new DateTime("-{$number} day");
            $report->setDate($writeDate);
            $report->setTime($writeDate->setTime($number,$number+10,00));
            $report->setUserName("User {$number}");
            $report->setPlace("Place {$numberPlace}");
            $this->entityManager->persist($report);
        }
        $this->entityManager->flush();
        $output->writeln('Fill in test data was done');
        return Command::SUCCESS;
    }
}