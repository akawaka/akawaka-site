# Akawaka.fr

## Installation

This project handle multiple environments with target through
`./configure`.

```bash
./configure --env=dev # If you have npm on your computer
./configure --with-docker # If you want docker with http://localhost
./configure --with-docker --with-proxy # Docker with traefik
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
make watch # Watch assets

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

This project is a good old fashioned html static website
with webpack encore and tailwind.
