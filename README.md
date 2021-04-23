# Akawaka.fr

## Installation

This project handle multiple environments with target through
`./configure`.

```bash
./configure --env=dev # If you have everything on your computer
./configure --env=dev --with-docker=light # If you want local php/npm but pgsql and mailhog in container
./configure --env=dev --with-docker=full # Full docker installation
./configure --env=dev --with-docker=full --with-proxy # Docker with traefik
```

And extra flag for cleaning files is also available: `--clean-before-tasks`.

Then, run `make install` and profit.

## Tasks

```bash
make start # Start the project
make stop # Stop the project
make clear # Stop and clear the project
make reset # Clear and start the project

make assets # Build assets

# And moar!
```

### URLs (dev/proxy)

Application: <http://www.akawaka.localhost>

## Update infrastructure code

If you want to update an environment you
need to:

- Add your files in `infrastructure\<env>\autoconf`
- Update `configure` bash script
- Test your application against environments.

## Information

This is a monorepository WIP symfony project. Our code is dispatched between two directories:

- packages: Supporting and generic domains (aka something useful in many projects)
- src: Core and User Interface

There are three types of packages :

- Primitive: A primitive functionality - probably just a Value Object
- Component: A PHP package, framework agnostic - probably a bounded context
- Bundle: Symfony package, dedicated to Symfony

Code is split between 4 layers:

- Domain: Entity, Enum, Exception, Identifier, Repository (interface), ValueObject and stuff related to domain
- Application: Layer between User Interface and Domain. Works with Infrastructure
- Infrastructure: Communication with third-parties
- UI: A dedicated Infrastructure layer for User Interfaces (API, CLI, Workers, HTML...)

## About architecture

This project is designed with these ideas:

- We want to iterate over standard operations in a RAD context
- We want to avoid common mistakes of RAD and split process in dedicated scalable/removable operations
- We want to have reusable code between projects because features on project A may be interesting in projects B, C or D

### User Interface

User interface is the entry point for an external operator. An external operator could be a human or
a machine.

User Interface is always in `src` directory because it's dedicated to the current project with all his constraints.
Each subdirectory is dedicated to an external user interface with identified context.

### Bounded context

We want to use bounded context. It's complex, but it's the absolute guarantee that our code will be scalable over years.
A bounded context can use many components and have his own life. Bounded context communicates through Domain Events.
For example, a new administrator is not an author, but an event "AdministratorWasCreated" may be the entry point for a
"CreateAuthor" process.

A bounded context in `src` directory will maybe become a Symfony Bundle over time. For example, our current CMS is the
core domain in our current project (a dedicated website for akawaka) but a supporting/generic domain in another project.

### Gateway

User interface communicates with our application layer through a dedicated Gateway. Gateway take an internal request
through array and give an internal response with getters and array (if we want to chain gateways). Gateway is dedicated
to a process. That means if we want two different processes, we will copy the first one and made our change. If the first process
is not longer useful, we drop it.

### Operation

Operation are split between Command and Queries. In both case a gateway communicate to an <Operation>Handler through
a dedicated object. Command will always dispatch Events, Queries may will dispatch Events. That's up to you.

Operation are dedicated to project. We don't want to create a useless operation "juste because we may want it".
We are free to use the best Operation according to the process. <Operation> + <Operation>Handler can be used with CQS/CQRS/Standard
POO and could be sync/async.

By default, we are using Symfony Messenger with sync buses.

#### About "Create" operations

For the moment, Create operations are always in `src` directory. This is due to Doctrine and we must work on it.

### About Symfony

Symfony is our main framework, but we don't use a lot of standard rules.

- Configuration in bundle must be in PHP
- Form are not related to entities, but a dedicated object
- We don't use controllers but invokable actions
- Bundle structure must follow Symfony one (see Core bundle)

### Tests

Minimum viable tests are in gherkin with Behat. We don't test our User Interface by default but our gateways.
In case of problem, run your tests and if they pass, our problem is in User Interface. Otherwise, our problem is in 
Application/Infrastructure and error message will help.

### UI/UX

UI is made with Tailwind, SASS and UX through Symfony-UX with dedicated components.
You must use Encore, but you are free to use vanilla javascript, React/Vue or anything else according to your needs.

If you create agnostics and dedicated components, this should not be a real problem.
