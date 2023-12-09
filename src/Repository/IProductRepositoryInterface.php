<?php

namespace App\Repository;

use App\Entity\Category;
use App\Entity\Product;

interface IProductRepositoryInterface
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
     *
     * @return Product[]
     *
     * Method returns paginated products
     * By default paginate all products
     */

    public function paginateProducts(int $limit, int $offset, ?Category $category=null): array;

    /**
     * @param Category|null $category
     * @return int
     *
     * Method return total count of products
     *
     */
    public function getTotalProductsCount(?Category $category): int;
}