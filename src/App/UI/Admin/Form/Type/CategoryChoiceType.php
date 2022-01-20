<?php

declare(strict_types=1);

namespace App\UI\Admin\Form\Type;

use App\UI\Admin\Form\Transformer\CategoriesToArrayTransformer;
use Mono\Bundle\AoBundle\Context\CRUD\Category\Application\Gateway\FindCategories;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\ChoiceList\ChoiceList;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class CategoryChoiceType extends AbstractType
{
    public function __construct(
        private FindCategories\Gateway $findCategoriesGateway,
    ) {
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        if ($options['multiple']) {
            $builder->addModelTransformer(new CategoriesToArrayTransformer());
        }
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'choice_loader' => ChoiceList::lazy($this, function () {
                return $this->getChoices();
            }),
            'choice_translation_domain' => false,
        ]);
    }

    public function getChoices()
    {
        $choices = [];

        foreach (($this->findCategoriesGateway)(FindCategories\Request::fromData([]))->data() as $category) {
            $choices[$category['name']] = $category['identifier'];
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
