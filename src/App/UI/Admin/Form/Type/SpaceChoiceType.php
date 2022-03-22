<?php

declare(strict_types=1);

namespace App\UI\Admin\Form\Type;

use App\UI\Admin\Form\Transformer\SpacesToArrayTransformer;
use App\Context\Admin\Space\Application\Gateway\BrowseSpaces;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\Options;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class SpaceChoiceType extends AbstractType
{
    public function __construct(
        private BrowseSpaces\Gateway $findSpacesGateway,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['multiple']) {
            $builder->addModelTransformer(new SpacesToArrayTransformer());
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

        foreach (($this->findSpacesGateway)(BrowseSpaces\Request::fromData([]))->data() as $space) {
            $choices[$space['name']] = $space['identifier'];
        }

        return $choices;
    }

    public function getParent(): ?string
    {
        return ChoiceType::class;
    }

    private function translate(string $key): string
    {
        return \Safe\sprintf('common.form.type.space_choice.%s', $key);
    }
}
