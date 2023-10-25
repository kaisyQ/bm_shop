<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\ImageFormType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new("category", Category::class)
            ->setLabel("Category");

        yield TextField::new('name');
        
        yield TextEditorField::new('description');
        
        yield IntegerField::new('price');
        
        yield IntegerField::new('discountPrice');

        yield IntegerField::new('count');

        yield BooleanField::new('bestseller');
        
        yield TextEditorField::new('delivery');
        
        yield CollectionField::new('images')
            ->onlyOnForms()
            ->setEntryType(ImageFormType::class);
        
        
        yield IntegerField::new('price');
        
        yield IntegerField::new('discountPrice');

        yield DateTimeField::new('createdAt');

        yield DateTimeField::new('updatedAt');
    }
    
}
