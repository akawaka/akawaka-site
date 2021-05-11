<?php

declare(strict_types=1);

namespace App\UI\Admin\Form\Type;

use App\UI\Admin\Form\Transformer\ChannelsToArrayTransformer;
use Mono\Component\Channel\Application\Gateway\FindChannels;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ChannelChoiceType extends AbstractType
{
    public function __construct(
        private FindChannels\Gateway $findChannelsGateway,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['multiple']) {
            $builder->addModelTransformer(new ChannelsToArrayTransformer());
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choices' => function (Options $options) {
                return $this->getChoices();
            },

            'choice_translation_domain' => false,
        ]);
    }

    public function getChoices(): array
    {
        $choices = [];

        foreach (($this->findChannelsGateway)(FindChannels\Request::fromData([]))->data() as $channel) {
            $choices[$channel['name']] = $channel['identifier'];
        }

        return $choices;
    }

    public function getParent(): string
    {
        return ChoiceType::class;
    }

    private function translate(string $key): string
    {
        return \Safe\sprintf('common.form.type.channel_choice.%s', $key);
    }
}
