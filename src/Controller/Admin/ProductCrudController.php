<?php

namespace App\Controller\Admin;

use App\Entity\Attachment;
use App\Entity\Category;
use App\Entity\Product;
use App\Form\AttachmentType;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\BooleanField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;

class ProductCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Product::class;
    }

    public function configureActions(Actions $actions) : Actions {
        return $actions
            ->add(Crud::PAGE_INDEX, Action::DETAIL)
        ;
    }
    public function updateEntity(EntityManagerInterface $em, $entity): void
    {

        $attachRepo = $em->getRepository(Attachment::class);
        
        $identificators = array_map(fn($attachment) => $attachment->getId(), $entity->getAttachments()->toArray());

        $attachments = $attachRepo->findBy(['product' => $entity->getId()]);

        foreach ($attachments as $attachment) {
            if (in_array($attachment->getId(), $identificators)) {
                continue;
            }
            $em->remove($attachment);
        }

        $em->flush();
    }
    
    public function configureFields(string $pageName): iterable
    {
        yield AssociationField::new("category", Category::class)
            ->setLabel("Category");

        yield TextField::new('name');
        
        yield TextareaField::new('description')
            ->onlyOnForms();
        
        yield IntegerField::new('price');
        
        yield IntegerField::new('discountPrice');

        yield IntegerField::new('count');

        yield BooleanField::new('bestseller');
        
        yield TextareaField::new('delivery')
            ->onlyOnForms();
        
        yield CollectionField::new('attachments')
            ->onlyOnForms()
            ->setEntryType(AttachmentType::class);
       
        yield DateField::new('createdAt');

        yield DateField::new('updatedAt');
    }
    

}
