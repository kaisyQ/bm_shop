<?php


namespace App\Controller;

use App\Service\ProductService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

#[Route(path: "/api/v1/products", name: "product_controller")]
class ProductController extends AbstractController {
    public function __construct(private ProductService $productService) {}
    
    #[Route(path: "/", name: "index", methods: ["GET"])]
    public function index() {
        return $this->json($this->productService->getProducts());
    }
    public function store() {}
    public function show($id) {}
    public function update($id) {}
    public function destroy($id) {}
}