<?php
/**
 * Created by PhpStorm.
 * User: pauldossantos
 * Date: 16/11/2018
 * Time: 16:20
 */

namespace App\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;

class ArticleSearchType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('searchField');
    }

}