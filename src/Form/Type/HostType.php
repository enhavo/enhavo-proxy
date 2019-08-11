<?php
/**
 * HostType.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace ProjectBundle\Form\Type;


use Enhavo\Bundle\AppBundle\Form\Type\BooleanType;
use Enhavo\Bundle\AppBundle\Form\Type\ListType;
use ProjectBundle\Entity\Host;
use Sylius\Bundle\ResourceBundle\Form\Type\AbstractResourceType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class HostType extends AbstractResourceType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('domain', TextType::class);
        $builder->add('redirect', TextType::class);
        $builder->add('default', BooleanType::class);
        $builder->add('https', ChoiceType::class, [
            'choices_as_values' => true,
            'choices'=> [
                'Off' => Host::HTTPS_OFF,
                'On' => Host::HTTPS_ON,
                'Only' => Host::HTTPS_ONLY
            ]
        ]);
        $builder->add('backends', ListType::class, [
            'type' => 'project_backend',
            'border' => true,

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

        $builder->add('certificate', TextareaType::class);
        $builder->add('certificateRequest', TextareaType::class);
        $builder->add('certificateKey', TextareaType::class);
        $builder->add('certificateType', ChoiceType::class, [
            'choices_as_values' => true,
            'choices'=> [
                'None' => Host::CERTIFICATE_TYPE_NONE,
                'Lets Encrypt' => Host::CERTIFICATE_TYPE_LETS_ENCRYPT,
            ]
        ]);
    }

    public function getName()
    {
        return 'project_host';
    }
}