# Quick Start

## Starter Kit
We provide a starter kit [awes-io-project](https://github.com/awes-io/awes-io) for you.

## Installation
We are hosted on a package management platform [Package Kit](https://www.pkgkit.com). For start of work you have to create an account (if non-exist), create a project and get an `API` token to get the possibility to install our packages.

**Step-by-step way:**
1. Create an account on [Package Kit](https://www.pkgkit.com/register)
2. Follow the link to [create an project](https://www.pkgkit.com/projects#add_project)
3. Connect one or more packages to your new project
4. Copy your `API` token for the project
5. Add the config to `composer.json`

```json
{
 "repositories": [{
   "type": "composer",
   "url": "https://repo.pkgkit.com",
   "options":  {
     "http": {
       "header": [
         "API-TOKEN: <!-- API token from pkgkit.com -->"
       ]
     }
   }
 }]
}
```

**Enjoy!** Now, you are ready to install our modules in standard way like:

```bash
composer require awes-io/{package-name}
```