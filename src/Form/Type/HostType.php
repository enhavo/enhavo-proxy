<?php
/**
 * HostType.php
 *
 * @since 07/04/17
 * @author gseidel
 */

namespace App\Form\Type;

use App\Entity\Host;
use Enhavo\Bundle\FormBundle\Form\Type\BooleanType;
use Enhavo\Bundle\FormBundle\Form\Type\DateTimeType;
use Enhavo\Bundle\FormBundle\Form\Type\ListType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;

class HostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('domain', TextType::class);
        $builder->add('redirect', TextType::class);
        $builder->add('default', BooleanType::class);
        $builder->add('https', ChoiceType::class, [
            'choices'=> [
                'Off' => Host::HTTPS_OFF,
                'On' => Host::HTTPS_ON,
                'Only' => Host::HTTPS_ONLY
            ]
        ]);
        $builder->add('backends', ListType::class, [
            'entry_type' => BackendType::class,
            'border' => true,

        ]);
        $builder->add('transferType', ChoiceType::class, [
            'choices'=> [
                'Pipe' => Host::TRANSFER_TYPE_PIPE,
                'Pass' => Host::TRANSFER_TYPE_PASS
            ]
        ]);
        $builder->add('backendStrategy', ChoiceType::class, [
            'choices'=> [
                'Round Robin' => Host::BACKEND_STRATEGY_ROUND_ROBIN,
                'Fallback' => Host::BACKEND_STRATEGY_FALLBACK,
            ]
        ]);

        $builder->add('certificate', TextareaType::class, [
            'attr' => [
                'data-form-certificate' => ''
            ]
        ]);
        $builder->add('certificateRequest', TextareaType::class);
        $builder->add('certificateKey', TextareaType::class);
        $builder->add('certificateType', ChoiceType::class, [
            'choices'=> [
                'SSL' => Host::CERTIFICATE_TYPE_NONE,
                'Lets Encrypt' => Host::CERTIFICATE_TYPE_LETS_ENCRYPT,
            ]
        ]);
        $builder->add('certificateValidTo', DateTimeType::class, [
            'attr' => [
                'readonly' => true
            ]
        ]);


        $builder->add('authentication', BooleanType::class);
        $builder->add('user', TextType::class);
        $builder->add('password', TextType::class);

        $builder->add('rules', ListType::class, [
            'entry_type'=> RuleType::class,
            'border' => true,
            'sortable' => true
        ]);
    }
}
