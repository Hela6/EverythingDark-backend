<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\UrlField;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInPlural('Article');
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title'),
            TextField::new('intro'),
            UrlField::new('image') // Use the 'image_path' property
                ->setLabel('Image URL') // Optional: Provide a label for the field
                ->setSortable(false), // Optional: Disable sorting for this field
            TextEditorField::new('content')->setNumOfRows(30),
            // DateField::new('deposit_date'),
            AssociationField::new('category', 'category_id'),
            AssociationField::new('user', 'user_id'),
        ];
    }
}
