<?php
/**
 * HostType.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace ProjectBundle\Form\Type;

use ProjectBundle\Entity\Backend;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsoleBackendType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('hostname', TextType::class);
        $builder->add('port', TextType::class);
        $builder->add('connectTimeout', TextType::class);
        $builder->add('firstByteTimeout', TextType::class);
        $builder->add('betweenBytesTimeout', TextType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Backend::class
        ]);
    }

    public function getName()
    {
        return 'console_backend';
    }
}