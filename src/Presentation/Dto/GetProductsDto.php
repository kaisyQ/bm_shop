<?php declare(strict_types=1);

namespace App\Presentation\Dto;

final readonly class GetProductsDto
{
    public ?string $category;
    public ?int $limit;
    public ?int $page;
    public ?int $priceFrom;
    public ?int $priceTo;
    public ?bool $alphabetAtoZ;
    public ?bool $alphabetZtoA;
    public ?bool $oldest;
    public ?bool $newest;

    public function __construct(
        string $category = null,
        int $limit = null,
        int $page = null,
        int $priceFrom = null,
        int $priceTo = null,
        bool $alphabetAtoZ = null,
        bool $alphabetZtoA = null,
        bool $oldest = null,
        bool $newest = null
    ) {
        $this->category = $category;
        $this->limit = $limit;
        $this->page = $page;
        $this->priceFrom = $priceFrom;
        $this->priceTo = $priceTo;
        $this->alphabetAtoZ = $alphabetAtoZ;
        $this->alphabetZtoA = $alphabetZtoA;
        $this->oldest = $oldest;
        $this->newest = $newest;
    }

}