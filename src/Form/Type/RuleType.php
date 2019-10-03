<?php
/**
 * Created by PhpStorm.
 * User: gseidel
 * Date: 2019-10-03
 * Time: 12:19
 */

namespace App\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class RuleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('type', ChoiceType::class, [
            'choices' => [
                'authentication' => 'authentication',
                'transfer' => 'transfer'
            ]
        ]);
        $builder->add('path', TextType::class);
        $builder->add('user', TextType::class);
        $builder->add('password', TextType::class);
        $builder->add('transferType', ChoiceType::class, [
            'choices' => [
                'pipe' => 'pipe',
                'pass' => 'pass'
            ]
        ]);
    }
}
