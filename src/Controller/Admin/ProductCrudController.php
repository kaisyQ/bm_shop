<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\Product;
use App\Form\AttachmentType;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Vich\UploaderBundle\Form\Type\VichFileType;

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
        
        yield TextareaField::new('description');
        
        yield IntegerField::new('price');
        
        yield IntegerField::new('discountPrice');

        yield IntegerField::new('count');

        yield BooleanField::new('bestseller');
        
        yield TextareaField::new('delivery');
        
        yield CollectionField::new('attachments')
            ->onlyOnForms()
            ->setEntryType(AttachmentType::class);
       
        //yield ImageField::new('imageFile')->setFormType(VichFileType::class)->setLabel("Images");
        


        yield IntegerField::new('price');
        
        yield IntegerField::new('discountPrice');

        yield DateTimeField::new('createdAt');

        yield DateTimeField::new('updatedAt');
    }
    
}
