---
layout: post
title: Bring Sylius Components to Your Project
image: /build/front/images/blog/sylius_stack.jpg
alt: The Loïc Fremont Key Contributor Award trophy, surrounded by two Sylius elePHPants
date: 2024-12-19 10:00:00
date_modified: 2024-12-19 10:00:00
category: outils
author: Florian Merle
---

## Bring Sylius Components to Your Project

Sylius CRUD components are both powerful and highly extensible. When used correctly, they become incredible tools for building reliable, rapid application development (RAD) apps.

Historically, integrating Sylius bundles into a Symfony app has been a challenging task. There were two primary approaches:
- Install the **SyliusNoCommercePlugin** into a Sylius app;
- Use **Monofony**, a stripped-down Sylius skeleton with all e-commerce features removed.

Both of these solutions required using a skeleton app and couldn’t be seamlessly installed into an existing or barebones Symfony project.

Thankfully, those limitations are now a thing of the past. With the introduction of [the Sylius Stack](https://stack.sylius.com/), you can use Sylius components in any Symfony project.

This blog post introduces the Sylius Stack, explains how you can leverage it in your projects (or a Sylius e-commerce project), and demonstrates how to efficiently customize Sylius resources.

> **_NOTE:_** At the end of this blog post, you'll find a link to the repository of a demo app that includes all what's we'll cover.
{: .note }

## Getting Started with the Stack

First, we need to install the stack. As mentioned earlier, this can be done in any Symfony project, whether it’s an existing one or a fresh installation.

To get started, run the following command:

```bash
$ composer require sylius/admin-ui
$ composer require sylius/bootstrap-admin-ui
$ php bin/console asset-map:compile
```

That’s it! With a few commands, you get everything you need for a working Sylius admin application. For more details on what’s included, check the [composer.json](https://github.com/Sylius/AdminUi/blob/main/composer.json) of this package.

Additionally, the installation adds a minimal set of files to bootstrap: 
- A dashboard,
- Login/logout routes,
- Templates for CRUD operations.

With just a few steps, you’re ready to begin customizing and extending your admin interface using Sylius components.

## Let’s Create Our First Doctrine Entity: Movie

In Sylius, an entity that requires CRUD functionality should implement the [`ResourceInterface`](https://github.com/Sylius/Resource/blob/master/Model/ResourceInterface.php).

For our example, let’s create a `Movie` entity with the following properties:
- An `id`,
- A `title`,
- A `releaseDate`,
- A list of actors.

> **_NOTE:_** Only implementing this `ResourceInterface` is not enough for an entity to become a resource. We'll see in the next section what's missing.
{: .note }

```php
<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Model\ResourceInterface;
use Symfony\Component\Validator\Constraints as Constraints;

#[ORM\Entity]
class Movie implements ResourceInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[Constraints\NotBlank]
    #[ORM\Column(length: 180)]
    public string $title = '';

    #[Constraints\NotBlank]
    #[ORM\Column(type: 'date_immutable')]
    public \DateTimeImmutable $releaseDate;

    /** @var Collection<int, Actor> $actors */
    #[Constraints\Valid]
    #[ORM\OneToMany(
        targetEntity: Actor::class,
        mappedBy: 'movie',
        cascade: ['persist', 'remove'],
        orphanRemoval: true,
    )]
    public Collection $actors;

    public function __construct(
    ) {
        $this->actors = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function addActor(Actor $actor): self
    {
        if (!$this->actors->contains($actor)) {
            $this->actors[] = $actor;
            $actor->movie = $this;
        }

        return $this;
    }

    public function removeActor(Actor $actor): self
    {
        $this->actors->removeElement($actor);

        return $this;
    }
}
```

As stated above, only entities that need CRUD functionalities must implement the `ResourceInterface`. This is not the case for the `Actor` entity so we will not implement the interface.

```php
<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Constraints;

#[ORM\Entity]
class Actor
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    public ?int $id = null;

    #[ORM\ManyToOne(targetEntity: Movie::class, cascade: ['persist'], inversedBy: 'actors')]
    #[ORM\JoinColumn(nullable: false)]
    public Movie $movie;

    #[Constraints\NotBlank]
    #[ORM\Column(length: 180)]
    public string $name = '';
}
```

You can now generate the database table with the `php bin/console doctrine:schema:update` command.

> **_NOTE:_** While we use Doctrine to retrieve and save entities in this example, other data providers could be used.
{: .note }

## What Is a Sylius Resource?

Before going further, let’s take a step back and define what a **resource** is in the context of Sylius.

A Sylius resource is essentially a model (usually a Doctrine entity) on steroids. It’s a basic entity enhanced with additional functionality, including:

- **Factory**: Creates new instances of the entity.
- **Manager**: An alias to Doctrine’s `ObjectManager`.
- **Repository**: Provides a repository for the entity.
- **Controller**: Handles CRUD operations.
- **Form**: Generates basic forms for creating and updating the resource.

By defining your entity as a resource, Sylius automatically generates and wires everything you need for full CRUD operations and more. This reduces boilerplate code and ensures a consistent structure across your application.

> **_NOTE:_** Since we don’t need CRUD operations for the `Actor` entity yet, it does not implement `ResourceInterface`. If we needed a factory or other resource functionalities, implementing the interface would make sense.
{: .note }

## Adding CRUD Operations

Now that we have our resource, we can add CRUD operations. In older versions of Sylius, this was only possible through PHP, YAML, or XML configuration. Now, we can use **PHP attributes** for this.

Let’s update our resource:

```php
<?php

namespace App\Entity;

// ...
use Sylius\Resource\Metadata\AsResource;
use Sylius\Resource\Metadata\Create;
use Sylius\Resource\Metadata\Delete;
use Sylius\Resource\Metadata\Index;
use Sylius\Resource\Metadata\Show;
use Sylius\Resource\Metadata\Update;
// ...

#[AsResource(
    section: 'admin',
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: '/admin',
    operations: [
        new Create(),
        new Index(),
        new Show(),
        new Update(),
        new Delete(),
    ],
)]
#[ORM\Entity]
class Movie implements ResourceInterface
{
    // ...
}
```

We configured the following:

- A **section**, so the route name is prefixed with `app_<section>_`.
- A **route prefix**.
- The **template directory** for minimal styling.

After running `php bin/console debug:router`, new routes will appear.


```bash
$ php bin/console debug:router | grep movie
app_admin_movie_create                             GET|POST       ANY      ANY    /admin/movies/new
app_admin_movie_index                              GET            ANY      ANY    /admin/movies
app_admin_movie_show                               GET            ANY      ANY    /admin/movies/{id}
app_admin_movie_update                             GET|PUT|POST   ANY      ANY    /admin/movies/{id}/edit
app_admin_movie_delete                             DELETE|POST    ANY      ANY    /admin/movies/{id}/delete
```

It’s that easy! However, when accessing the index page, you’ll encounter an error. This is because we haven’t defined a **Grid** for this action yet.

![Index action error](/build/front/images/blog/sylius_stack_index_action_error.png)

## The Grid

In the past, grid definitions could only be created using configuration files. With modern Sylius versions, grids can be defined as **services**, which is more flexible and allows us to construct grids using well-defined objects.

A grid service must implement the **ResourceAwareGridInterface**.

```php
<?php

namespace App\Grid;

use App\Entity\Movie;
use Sylius\Bundle\GridBundle\Builder\Action\CreateAction;
use Sylius\Bundle\GridBundle\Builder\Action\DeleteAction;
use Sylius\Bundle\GridBundle\Builder\Action\ShowAction;
use Sylius\Bundle\GridBundle\Builder\Action\UpdateAction;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\ItemActionGroup;
use Sylius\Bundle\GridBundle\Builder\ActionGroup\MainActionGroup;
use Sylius\Bundle\GridBundle\Builder\Field\DateTimeField;
use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\GridBuilderInterface;
use Sylius\Bundle\GridBundle\Grid\AbstractGrid;
use Sylius\Bundle\GridBundle\Grid\ResourceAwareGridInterface;

final class MovieGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_movie';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->addField(
                StringField::create('id')
                    ->setEnabled(false)
                    ->setSortable(true),
            )
            ->addField(
                StringField::create('title')
                    ->setSortable(true),
            )
            ->addField(
                DateTimeField::create('releaseDate')
                    ->setSortable(true),
            )
            ->addActionGroup(
                MainActionGroup::create(
                    CreateAction::create(),
                ),
            )
            ->addActionGroup(
                ItemActionGroup::create(
                    ShowAction::create(),
                    UpdateAction::create(),
                    DeleteAction::create()
                ),
            )
        ;
    }

    public function getResourceClass(): string
    {
        return Movie::class;
    }
}
```

We now configure the grid for the **Index** route and update the `Movie` entity accordingly.

```php
<?php

namespace App\Entity;

use App\Grid\MovieGrid;
// ...

#[AsResource(
    section: 'admin',
    templatesDir: '@SyliusAdminUi/crud',
    routePrefix: '/admin',
    operations: [
        // ..
        new Index(grid: MovieGrid::class),
        // ..
    ],
)]
#[ORM\Entity]
class Movie implements ResourceInterface
{
    // ...
}
```

After refreshing the page, no errors appear.

![Index action](/build/front/images/blog/sylius_stack_index_action.png)


> **_NOTE:_** I did not translate the app, but this can be done just like in any other Symfony application.
{: .note }

> **_NOTE:_** To add an entry to the sidebar, you need to decorate the `sylius_admin_ui.knp.menu_builder` service. Refer to the [Sylius documentation](https://stack.sylius.com/cookbook/index/menu) for more details.
{: .note }

## Creating and Updating movies

When accessing the create page, a basic form is already available. This is one of the strengths of Sylius resources: many features come pre-configured out of the box, covering both basic and specific needs.

Since the `Movie` entity has a one-to-many relationship with the `Actor` entity, we need to create and configure the form.

Let’s start by creating `MovieType` and `ActorType`.

```php
<?php

namespace App\Form\Type;

use App\Entity\Movie;
use Symfony\Component\Clock\ClockInterface;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Form\Type\LiveCollectionType;

final class MovieType extends AbstractType
{
    public function __construct(
        private ClockInterface $clock,
    ) {
    }


    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'empty_data' => '',
            ])
            ->add('releaseDate', DateType::class, [
                'input' => 'datetime_immutable',
                'empty_data' => $this->clock->now()->format('Y-m-d'),
            ])
            ->add('actors', LiveCollectionType::class, [
                'required' => false,
                'entry_type' => ActorType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'by_reference' => false,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Movie::class,
        ]);
    }
}
```

> **_NOTE:_** Since all previously defined entity properties are non-nullable, a valid `empty_data` configuration is required. This includes using empty strings and Symfony’s Clock component.
{: .note }


```php
<?php

namespace App\Form\Type;

use App\Entity\Actor;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

final class ActorType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name', TextType::class, [
                'label' => 'app.ui.name',
                'empty_data' => '',
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Actor::class,
        ]);
    }
}
```

Next, we configure the form on the resource.

```php
<?php

namespace App\Entity;

#[AsResource(
    // ...
    formType: MovieType::class,
    operations: [
        // ..
    ],
)]
#[ORM\Entity]
class Movie implements ResourceInterface
{
    // ...
}
```

After refreshing the page, the form now includes an **Actor** entry. However, clicking the **Add** button does nothing. This is because we haven’t defined a **LiveComponent** for the form yet.

```php
<?php

namespace App\Twig\Components;

use App\Entity\Movie;
use App\Form\Type\MovieType;
use Sylius\TwigHooks\LiveComponent\HookableLiveComponentTrait;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;

#[AsLiveComponent(template: '@SyliusBootstrapAdminUi/shared/crud/common/content/form.html.twig')]
class MovieComponent extends AbstractController
{
    use LiveCollectionTrait;
    use DefaultActionTrait;
    use HookableLiveComponentTrait;

    #[LiveProp]
    public Movie $resource;

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(MovieType::class, $this->resource);
    }
}
```

The final step is to update the part of the template where the form is rendered. This is done using **Sylius Twig Hooks**.

> **_NOTE:_** Sylius Twig Hooks allow you to override templates. They replace Sylius Template Events. This will be covered in more detail in a future blog post. In the meantime, you can check out [the documentation](https://docs.sylius.com/the-customization-guide/customizing-templates) to learn more.
{: .note }

```yaml
sylius_twig_hooks:
    hooks:
        'sylius_admin.movie.create.content':
            form:
                component: 'App\Twig\Components\MovieComponent'
                props:
                    form: '@=_context.form'
                    resource: '@=_context.resource'
        'sylius_admin.movie.update.content':
            form:
                component: 'App\Twig\Components\MovieComponent'
                props:
                    form: '@=_context.form'
                    resource: '@=_context.resource'
```

The form is now fully functional, and actors can be added seamlessly.

![Create action](/build/front/images/blog/sylius_stack_create_action.png)


## Duplicating a Movie

We’ve covered the basics, but let’s explore additional capabilities by adding the ability to **duplicate a movie**. This will allow us to create a new movie based on an existing one.

To achieve this, we add a second **Create** operation with custom configuration.

```php
<?php

declare(strict_types=1);

namespace App\Entity;

// ..
use Sylius\Resource\Metadata\Create;
// ..

#[AsResource(
    // ...
    operations: [
        new Create(),
        new Create(
            shortName: 'duplicate',
            path: 'movies/{id}/duplicate',
            template: '@SyliusAdminUi/crud/create.html.twig',
            factoryMethod: 'createFromMovie',
            factoryArguments: ['request.attributes.get("id")'],
        ),
        // ...
    ],
)]
#[ORM\Entity]
class Movie implements ResourceInterface
{
    // ...
}
```

The new operation includes:

- *`shortName`*: The route name will be suffixed with `_<shortName>`.
- *`path`*: Since a standard create action already exists, we specify a custom path for the duplicate route.
- *`template`*: Sylius uses the `shortName` to determine the template, but here we want to reuse the create template, so it must be explicitly specified.
- *`factoryMethod`*: The method used to construct the base entity.
- *`factoryArguments`*: The arguments passed to the factory method.

Next, we decorate the base factory for the `Movie` entity using the `AsDecorator` attribute.

```php
<?php

namespace App\Factory;

use App\Entity\Actor;
use App\Entity\Movie;
use Sylius\Bundle\ResourceBundle\Doctrine\ORM\EntityRepository;
use Sylius\Resource\Factory\FactoryInterface;
use Symfony\Component\DependencyInjection\Attribute\AsDecorator;

#[AsDecorator(decorates: 'app.factory.movie')]
final class MovieFactory implements FactoryInterface
{
    public function __construct(
        private FactoryInterface $baseFactory,
        private EntityRepository $movieRepository,
    ) {
    }

    public function createNew(): Movie
    {
        return $this->baseFactory->createNew();
    }

    public function createFromMovie(string $id): Movie
    {
        $old = $this->movieRepository->findOneBy(['id' => $id]);

        $new = $this->baseFactory->createNew();
        $new->title = $old->title;
        $new->releaseDate = $old->releaseDate;
        foreach ($old->actors as $oldActor) {
            $newActor = new Actor();
            $newActor->name = $oldActor->name;
            $new->addActor($newActor);
        }

        return $new;
    }
}
```

> **_NOTE:_** Thanks to the Sylius Resource Bundle, `EntityRepository $movieRepository` is automatically aliased to the `app.repository.movie` service. No additional service configuration is required to wire the repository.
{: .note }

The final step is to add the duplicate action to the grid. Using `Action::create()`, we can define generic actions with custom routes, parameters, labels, icons, and more.

```php
<?php

namespace App\Grid;

// ...

final class MovieGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_movie';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            // ...
            ->addActionGroup(
                ItemActionGroup::create(
                    // ...
                    Action::create('duplicate', 'create')
                        ->setLabel('app.ui.duplicate')
                        ->setOptions([
                            'link' => [
                                'route' => 'app_admin_movie_duplicate',
                                'parameters' => [
                                    'id' => 'resource.id',
                                ],
                            ],
                        ]),
                    // ...
                ),
            )
        ;
    }

    public function getResourceClass(): string
    {
        return Movie::class;
    }
}
```

And voilà! Duplicating a resource is now available.

![Index action grid](/build/front/images/blog/sylius_stack_index_action_grid.png)

## Soft deleting entities

Let’s take things further with **processors** by implementing soft deletion using an `archive` boolean property.

First, we add the new property to the entity and update the **Delete** operation to use a processor that handles the soft delete logic.

```php
<?php

declare(strict_types=1);

namespace App\Entity;

// ..
use App\Processor\MovieArchiveProcessor;
// ..

#[AsResource(
    // ...
    operations: [
        // ...
        new Delete(processor: MovieArchiveProcessor::class),
    ],
)]
#[ORM\Entity]
class Movie implements ResourceInterface
{
    // ...

    #[ORM\Column(type: 'boolean')]
    public bool $archived = false;

    // ...
}
```

A Sylius processor is a service that implements the `ProcessorInterface`. We’ll use it to set the `archive` property to `true`.

```php
<?php

namespace App\Processor;

use Doctrine\ORM\EntityManagerInterface;
use Sylius\Resource\State\ProcessorInterface;

final class MovieArchiveProcessor implements ProcessorInterface
{
    public function __construct(
        private EntityManagerInterface $em,
    ) {
    }

    public function process(mixed $data, Operation $operation, Context $context): mixed
    {
        $data->archived = true;

        $this->em->flush();

        return null;
    }
}
```

Now, when clicking the **Delete** button, the resource won’t be removed from the database. Instead, its `archive` property will be updated.

To make this behavior easier to visualize, we add a **grid filter** and a **grid field** for the `archive` property.

```php
<?php

namespace App\Grid;

use Sylius\Bundle\GridBundle\Builder\Field\StringField;
use Sylius\Bundle\GridBundle\Builder\Filter\BooleanFilter;

final class MovieGrid extends AbstractGrid implements ResourceAwareGridInterface
{
    public static function getName(): string
    {
        return 'app_movie';
    }

    public function buildGrid(GridBuilderInterface $gridBuilder): void
    {
        $gridBuilder
            ->addFilter(
                BooleanFilter::create('archived')
                    ->setLabel('app.ui.archived')
                    ->setDefaultValue('false'),
            )
            ->addField(
                StringField::create('archived'),
            )
            // ...
        ;
    }

    public function getResourceClass(): string
    {
        return Movie::class;
    }
}
```

Deleting an entity now results in soft deletion, and the resource can still be accessed by filtering the grid. 

![Index action delete](/build/front/images/blog/sylius_stack_index_action_delete.png)


## Conclusion & Going Further

I hope this article has helped you understand how to work with Sylius resources and customize CRUD operations effectively. We’ve covere key features, including:

* Using *processors* to extend functionality;
* Leveraging *LiveCollectionType* to manage more complex forms for your resources;
* Adding *custom actions* and defining them with flexibility;
* Creating grids and seamlessly integrating resource-based CRUD operations.

These tools allow you to take full advantage of Sylius components while keeping your project clean and maintainable.

## What’s Next?

Sylius resources offer even more capabilities. In upcoming articles, I’ll cover:

- Integrating **API Platform** with Sylius resources;
- Writing **tests** for Sylius applications;
- Customizing templates with **Sylius Twig Hooks**.

In the meantime, check out the [Sylius Stack documentation](https://stack.sylius.com) for a comprehensive guide and deeper insights into Sylius components.

You can find the complete demo application with all the features covered in this blog post in the following repository: [Sylius Stack Demo](https://github.com/Florian-Merle/sylius-stack-demo/).

Happy coding! 🚀
