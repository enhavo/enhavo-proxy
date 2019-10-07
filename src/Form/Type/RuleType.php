<?php
/**
 * Created by PhpStorm.
 * User: gseidel
 * Date: 2019-10-03
 * Time: 12:19
 */

namespace App\Form\Type;

use App\Entity\Rule;
use Enhavo\Bundle\FormBundle\Form\Type\PositionType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

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
        $builder->add('path', TextType::class, [
            'label' => 'Url (Regex)'
        ]);
        $builder->add('user', TextType::class);
        $builder->add('password', TextType::class);
        $builder->add('transferType', ChoiceType::class, [
            'choices' => [
                'pipe' => 'pipe',
                'pass' => 'pass'
            ]
        ]);

        $builder->add('position', PositionType::class, []);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Rule::class
        ]);
    }
}
