<?php

namespace App\Service;

use App\Dto\ProductListResponse;
use App\Repository\ProductRepository;
use App\Dto\ProductListItem;
use App\Entity\Product;
use App\Mapper\ProductsMapper;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\SerializerInterface;

class ProductService {

    public function __construct(
        private ProductRepository $productRepository,
        private SerializerInterface $serializer,
        private ProductsMapper $productsMapper
    ) {}
    public function getProducts() {
        
        $products = $this->productRepository->findAll();

        $serializedProducts = $this->serializer->serialize($products, 'json', ['groups' => ['product']]);
   
        return $this->productsMapper->map(json_decode($serializedProducts));
    }
}