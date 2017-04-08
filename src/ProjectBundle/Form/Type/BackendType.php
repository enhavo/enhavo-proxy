<?php
/**
 * BackendType.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace ProjectBundle\Form\Type;


use ProjectBundle\Entity\Backend;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class BackendType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('hostname', TextType::class);
        $builder->add('port', NumberType::class);
        $builder->add('connectTimeout', NumberType::class);
        $builder->add('firstByteTimeout', NumberType::class);
        $builder->add('betweenBytesTimeout', NumberType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Backend::class
        ]);
    }

    public function getName()
    {
        return 'project_backend';
    }
}