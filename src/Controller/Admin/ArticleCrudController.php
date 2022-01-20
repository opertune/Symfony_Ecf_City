<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;

class ArticleCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    
    public function configureFields(string $pageName): iterable
    {
        return [
            AssociationField::new('category', 'Categorie'),
            TextField::new('title', 'Titre'),
            TextEditorField::new('description', 'Description'),
            ImageField::new('image')->setUploadDir('/public/img'),
            DateTimeField::new('date', 'Date de création'),
        ];
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
        ->setPageTitle('index', '<h3>Ajouter, supprimer ou modifier des évènements et des actualités</h3>')
        ->setDefaultSort(['category'=>'ASC'])
        ->setDateTimeFormat('dd/mm/Y hh:mm')
        
        ;
    }
    
}
