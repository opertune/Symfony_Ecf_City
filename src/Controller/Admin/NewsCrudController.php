<?php

namespace App\Controller\Admin;

use App\Entity\News;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class NewsCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return News::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('title', 'Titre'),
            TextEditorField::new('description', 'Description'),
            ImageField::new('image')->setUploadDir('/public/image/new'),
            DateTimeField::new('date', 'Date de création'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle('index', '<h3>Ajouter, supprimer ou modifier des actualités.</h3>')
        ->setDateTimeFormat('dd/mm/Y hh:mm')
        
        ;
    }
}
