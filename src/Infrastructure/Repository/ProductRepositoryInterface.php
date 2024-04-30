<?php

namespace App\Infrastructure\Repository;

use App\Domain\Entity\Category;
use App\Domain\Entity\Product;


interface ProductRepositoryInterface
{
    /**
     * @param string $name
     * @return array
     *
     * method return all products where product name contains string $name
     */
    public function findByContainingName(string $name): array;

    /**
     *
     * Count of elements on one page
     * @param int $limit
     *
     * First element from which the selection begins
     * @param int $offset
     *
     * Nullable param category
     * @param Category|null $category
     *
     * Price lowest value
     * @param int|null $priceFrom
     *
     * Price highest value
     * @param int|null $priceTo
     *
     * Alphabet filter a-z
     * @param bool|null $alphabetAtoZ
     *
     * Alphabet filter z-a
     * @param bool|null $alphabetZtoA
     *
     * Date filters
     * //
     * @param bool|null $newest
     * @param bool|null $oldest
     * //
     *
     * @return Product[]
     *
     * Method returns paginated products
     * By default paginate all products
     */

    public function paginateProducts(
        int $limit,
        int $offset,
        ?Category $category=null,
        ?int $priceFrom=null,
        ?int $priceTo=null,
        ?bool $alphabetAtoZ=false,
        ?bool $alphabetZtoA=false,
        ?bool $oldest=false,
        ?bool $newest=false
    ): array;

    /**
     * @param Category|null $category
     * @return int
     *
     * Method return total count of products
     *
     */
    public function getTotalProductsCount(?Category $category, ?int $priceFrom, ?int $priceTo): int;


    /**
     * Method returning products by ids
     * @return Product[]
     */
    public function getByIds(array $ids): array;
}