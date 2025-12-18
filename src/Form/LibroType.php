<?php

namespace App\Form;

use App\Entity\Libro;
use App\Entity\Autor;
use App\Entity\Categoria;
use App\Entity\Editorial; // <-- IMPORTANTE
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;

class LibroType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('titulo')
            ->add('autor', EntityType::class, [
                'class' => Autor::class,
                'choice_label' => 'nombre',
                'placeholder' => 'Seleccione un autor',
            ])
            ->add('isbn', null, [
                'required' => false,
            ])

            // 🔥 AHORA EDITORIAL ES UN SELECT
            ->add('editorial', EntityType::class, [
                'class' => Editorial::class,
                'choice_label' => 'nombre',
                'placeholder' => 'Seleccione una editorial',
                'required' => true,
            ])

            ->add('anioPublicacion', null, [
                'required' => false,
                'label' => 'Año de publicación',
            ])
            ->add('categoria', EntityType::class, [
                'class' => Categoria::class,
                'choice_label' => 'nombre',
                'placeholder' => 'Seleccione una categoría',
                'required' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Libro::class,
        ]);
    }
}
