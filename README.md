PHP-Dirty-API Prototype
=======================

This repo is a template for building a long-living api prototype, backed by Slim
framework and Doctrine ORM and Migrations.

## Features
* Slim Framework with Doctrine ORM and CLI integration (`composer run db`).
* Codeception integration with configured api and unit test suits.
* Procedural example of endpoint handler code/structure.
* Example endpoints, model, repository, migration and api tests.

## Provided and recommended Code Structure
* `api/` contains first level endpoints (REST resources). example [api/providers.php](api/providers.php)]. Tested in api suit [tests/api/providerCest.php](tests/api/providerCest.php)
* `domain/` contains domain models (probably they would be Doctrine entities too). example [domain/Provider.php](api/Provider.php)
* `repository/` contains Doctrine repositories. example [repositories/Providers.php](repositories/Providers.php)
* `unit/` contains reusable code split into units (name comes from unit testing). tested in unit suit (example to be provided)

## Usage
1. Clone this repo
2. Change configs and required packages to suite your needs
3. If result of previous step form a generic template on their own,
please consider submitting that as a project to https://github.com/quicktemplates
4. Fill in your project info in composer.json (placeholders denoted with < and >)
5. Happy coding!
