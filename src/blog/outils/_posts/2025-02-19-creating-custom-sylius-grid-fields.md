---
layout: post
title: Creating Custom Sylius Grid Fields
image: /build/front/images/blog/sylius_custom_grid_fields.jpg
alt: A bunch of elePHPants on a bookshelf, with the Sylius one in the foreground
date: 2025-02-19 01:00:00
date_modified: 2025-02-19 01:00:00
category: outils
author: Florian Merle
---

# Creating Custom Sylius Grid Fields

Sylius grids offer a powerful, flexible, and customizable way to present your entities in an HTML table for your back or front office.

`FieldType` services are responsible for rendering each cell in the table, and the Sylius grid bundle currently provides three main types:

* `StringFieldType` Used to render a simple string.
* `DatetimeFieldType` Displays a `Datetime` object, allowing configuration of format and timezone.
* `TwigFieldType` Renders the field using a Twig template, enabling great customization.

A new type is coming to Sylius to give you even more flexibility when configuring grids. **We will cover it at the end of this article.**

While these field types cover many needs, you may want to create custom field types for specific scenarios. This article explains how to do that.

## Implementing `FieldTypeInterface`

First, let's examine the [`FieldTypeInterface` 🔗](https://github.com/Sylius/SyliusGridBundle/blob/1.14/src/Component/FieldTypes/FieldTypeInterface.php). This interface is straightforward and has two methods:

* `render(Field $field, $data, array $options);` – Responsible for returning the HTML content of a cell.
* `configureOptions(OptionsResolver $resolver): void;` – Allows the field type to be configured with options.

For example, let's create a field type for displaying labels:

```php
<?php

declare(strict_types=1);

namespace App\FieldType;

use Sylius\Component\Grid\DataExtractor\DataExtractorInterface;
use Sylius\Component\Grid\Definition\Field;
use Sylius\Component\Grid\FieldTypes\FieldTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class BadgeFieldType implements FieldTypeInterface
{
    public function __construct(
        private DataExtractorInterface $dataExtractor,
    ) {
    }

    public function render(Field $field, $data, array $options): string
    {
        $value = $this->dataExtractor->get($field, $data);

        return sprintf(
            '<span class="badge">%s</span>',
            $value,
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        // Options don't need to be configured for now.
    }
}
```

To configure the field type, specify the service for `$dataExtractor` and add the `sylius.grid_field` tag to register the type. Remember to set its type.

```yaml
# config/services.yaml

services:
    App\FieldType\BadgeFieldType:
        arguments:
            $dataExtractor: '@sylius.grid.data_extractor'
        tags:
            - { name: 'sylius.grid_field', type: 'badge' }
```

Before adding it to a grid, we'll create a builder to make the field easier to configure:

```php
<?php

declare(strict_types=1);

namespace App\FieldType\Builder;

use Sylius\Bundle\GridBundle\Builder\Field\Field;
use Sylius\Bundle\GridBundle\Builder\Field\FieldInterface;

final class BadgeField
{
    public static function create(string $name): FieldInterface
    {
        return Field::create($name, 'badge');
    }
}
```

That's it! You can now configure the field in a grid:

```php
<?php

declare(strict_types=1);

namespace App\Grid;

use App\Entity\Post;
use App\FieldType\Builder\BadgeField;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class PostGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_post';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->addField(
                BadgeField::create('status'),
            )
            ->addField(StringField::create('title'))
        ;
    }

    public function getResourceClass(): string
    {
        return Post::class;
    }
}
```

And voilà!

![Custom field in action](/build/front/images/blog/sylius_custom_grid_fields_1.png)

## Playing with options

Creating such a field is relatively simple, but we haven’t covered options yet, so let’s explore that.

Imagine we want to render the label with different colors and translation keys depending on its type. This is where options come into play. We'll keep it simple here, but note that Symfony's `OptionsResolver` library defines options.

We will set two options: `translationKeys` and `colors`. When configuring the field, you can define values for these options. The `render` method retrieves these values from the `$options` parameter, allowing us to determine the appropriate color and label to use for the field:

```php
<?php

declare(strict_types=1);

namespace App\FieldType;

use Sylius\Component\Grid\DataExtractor\DataExtractorInterface;
use Sylius\Component\Grid\Definition\Field;
use Sylius\Component\Grid\FieldTypes\FieldTypeInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Contracts\Translation\TranslatorInterface;

final class BadgeFieldType implements FieldTypeInterface
{
    public function __construct(
        private DataExtractorInterface $dataExtractor,
        private TranslatorInterface $translator,
    ) {
    }

    public function render(Field $field, $data, array $options): string
    {
        $value = $this->dataExtractor->get($field, $data);

        return sprintf(
            '<span class="badge bg-%s-lt">%s</span>',
            $this->getColor($value, $options['colors']),
            $this->getLabel($value, $options['translationKeys']),
        );
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefault('translationKeys', []);
        $resolver->setDefault('colors', []);
    }

    private function getColor(mixed $value, array $colors): mixed
    {
        return $colors[$value] ?? 'secondary';
    }

    private function getLabel(mixed $value, array $translationKeys): mixed
    {
        $translationKey = $translationKeys[$value] ?? null;
        if ($translationKey === null) {
            return $value;
        }

        return $this->translator->trans($translationKey);
    }
}
```

Since we added new options, let's update the builder so it's easy to define them:

```php
<?php

declare(strict_types=1);

namespace App\FieldType\Builder;

use Sylius\Bundle\GridBundle\Builder\Field\Field;
use Sylius\Bundle\GridBundle\Builder\Field\FieldInterface;

final class BadgeField
{
    public static function create(
        string $name,
        array $translationKeys = [],
        array $colors = [],
    ): FieldInterface
    {
        return Field::create($name, 'badge')
            ->setOption('translationKeys', $translationKeys)
            ->setOption('colors', $colors)
        ;
    }
}
```

Finally, let’s update the grid to specify colors and translation keys:

```php
<?php

declare(strict_types=1);

namespace App\Grid;

use App\Entity\Post;
use App\FieldType\Builder\BadgeField;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class PostGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_post';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->addField(
                BadgeField::create(
                    'status',
                    [
                        'draft' => 'app.ui.draft',
                        'published' => 'app.ui.published',
                    ],
                    [
                        'draft' => 'secondary',
                        'published' => 'primary',
                    ],
                ),
            )
            ->addField(StringField::create('title'))
        ;
    }

    public function getResourceClass(): string
    {
        return Post::class;
    }
}
```

We have an easy-to-configure and reusable `BadgeFieldType`. This is great because custom field types allow business logic to stay in PHP classes rather than Twig templates, as is traditionally done with `TwigFieldType`.

![Updated custom field in action](/build/front/images/blog/sylius_custom_grid_fields_2.png)


## A new field type: `CallableFieldType`

Now that you know how to create custom field types, keep in mind that this approach can be time-consuming, especially for one-time use cases.

To simplify this process, I’ve implemented a new callable field type that will be available in the `SyliusGridBundle`. This field type enables you to configure a PHP callable to display your data, supporting both `PHP` and `YAML` grids.

The pull request for this new field type can be found [here](https://github.com/Sylius/SyliusGridBundle/pull/321), though it has not been officially released yet.

To try it out, you must install the `1.14` branch of the bundle using Composer:

```sh
composer require sylius/grid-bundle:1.14.x-dev
```

Once installed, you can use the callable field in YAML by prefixing a callable with `callable:`. This supports both static methods and PHP functions.

```yaml
sylius_grid:
    grids:
        app_user:
            fields:
                id:
                    type: callable
                    options:
                        callable: "callable:App\\Helper\\GridHelper::addHashPrefix"
                    label: app.ui.id
                name:
                    type: callable
                    options:
                        callable: "callable:strtoupper"
                    label: app.ui.name
```

When configuring grids with PHP, you can use any callable, including arrays, services, and callback functions.

```php
<?php

declare(strict_types=1);

namespace App\Grid;

use App\Entity\User;
use Sylius\Bundle\GridBundle\Builder\Field\CallableField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class UserGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
           return 'app_user';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->addField(
                CallableField::create('id', GridHelper::addHashPrefix(...))
                    ->setLabel('app.ui.id')
            )
            ->addField(
                CallableField::create('name', 'strtoupper')
                    ->setLabel('app.ui.name')
            )
            ->addField(
                CallableField::create('roles' fn (array $roles): string => implode(', ', $roles))
                    ->setLabel('app.ui.roles')
            )
        ;
    }

    public function getResourceClass(): string
    {
        return User::class;
    }
}
```

This feature simplifies the definition of custom field types, reducing the need for `TwigFieldType` and custom templates while keeping your grid configuration clean and efficient. Stay tuned for updates on its release!
