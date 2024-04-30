<?php declare(strict_types=1);

namespace App\Application\Command;

use App\Application\Enums\ProductStatusEnums;
use App\Infrastructure\Repository\ProductRepository;
use App\Infrastructure\Repository\ProductRepositoryInterface;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;

#[AsCommand('app:application:command:update-status', 'Update product status every 1 hour')]
final class UpdateProductStatusesCommand extends Command
{
    private ProductRepositoryInterface $productRepository;
    private EntityManagerInterface $em;
    public function __construct(ProductRepository $productRepository,EntityManagerInterface $em)
    {
        $this->productRepository = $productRepository;
        $this->em = $em;
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);

        $io->note('Start updating product statuses');


        $products = $this->productRepository->findAll();

        try {
            foreach ($products as $product) {
                $io->writeln('Updating status of product: ' . $product->getId());
                $product->setStatus(ProductStatusEnums::AVAILABLE);
            }

            $this->em->flush();

        } catch (\Throwable $e) {
            $io->error($e->getMessage());
        }

        $io->note('End updating product statuses');

        return 0;
    }
}