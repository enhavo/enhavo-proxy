<?php
/**
 * HostType.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace App\Form\Type;

use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use App\Entity\Host;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ConsoleHostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('domain', TextType::class);
        $builder->add('redirect', TextType::class);
        $builder->add('https', ChoiceType::class, [
            'choices_as_values' => true,
            'choices'=> [
                'Off' => Host::HTTPS_OFF,
                'On' => Host::HTTPS_ON,
                'Only' => Host::HTTPS_ONLY
            ]
        ]);
        $builder->add('transferType', ChoiceType::class, [
            'choices_as_values' => true,
            'choices'=> [
                'Pipe' => Host::TRANSFER_TYPE_PIPE,
                'Pass' => Host::TRANSFER_TYPE_PASS
            ]
        ]);
        $builder->add('backendStrategy', ChoiceType::class, [
            'choices_as_values' => true,
            'choices'=> [
                'Round Robin' => Host::BACKEND_STRATEGY_ROUND_ROBIN,
                'Fallback' => Host::BACKEND_STRATEGY_FALLBACK,
            ]
        ]);

        $builder->add('backends', CollectionType::class, [
            'type' => new ConsoleBackendType(),
            'allow_add' => true
        ]);

        $builder->add('certificateType', ChoiceType::class, [
            'choices_as_values' => true,
            'choices'=> [
                'None' => Host::CERTIFICATE_TYPE_NONE,
                'Lets Encrypt' => Host::CERTIFICATE_TYPE_LETS_ENCRYPT,
            ]
        ]);

        $builder->add('certificate', TextareaType::class);
        $builder->add('certificateRequest', TextareaType::class);
        $builder->add('certificateKey', TextareaType::class);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Host::class
        ]);
    }

    public function getName()
    {
        return 'console_host';
    }
}