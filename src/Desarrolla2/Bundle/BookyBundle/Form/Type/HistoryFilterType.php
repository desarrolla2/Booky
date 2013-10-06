<?php
/**
 * This file is part of the booky project.
 *
 * Copyright (c)
 *
 * This source file is subject to the MIT license that is bundled
 * with this package in the file LICENSE.
 */

namespace Desarrolla2\Bundle\BookyBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

/**
 * Class HistoryFilter
 *
 * @author Daniel González <daniel.gonzalez@freelancemadrid.es>
 */

class HistoryFilterType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array                $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add(
                'order',
                'choice',
                array(
                    'required' => true,
                    'choices' => array(
                        'createdAt' => 'created_at',
                        'updatedAt' => 'updated_at',
                        'rating' => 'rating',
                        'price' => 'price',
                        'title' => 'title',
                        'isbn' => 'isbn',
                    ),
                )
            )
            ->add(
                'mode',
                'choice',
                array(
                    'required' => true,
                    'choices' => array(
                        'ASC' => 'ASC',
                        'DESC' => 'DESC',
                    ),
                )
            );
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(
            array(
                'data_class' => 'Desarrolla2\Bundle\BookyBundle\Form\Model\HistoryFilterModel',
                'csrf_protection' => false,
            )
        );
    }

    public function getName()
    {
        return 'history_filter';
    }
}
