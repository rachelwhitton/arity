# Arity Wordpress Theme
##### VSA Partners + Arity

Authors: [Ryan Powszok](mailto:rpowszok@vsapartners.com), [Andrew Falconer](mailto:afalconer@vsapartners.com), [Rob Smith](mailto:rsmith@vsapartners.com)

Last Updated: 08/20/2017 Created: 05/24/2017

---
## Helpful URLs

See README.md in root directory.

---
## Project Structure

```
theme/                        # → Root folder for the WP theme.
├── .babelrc                  # → Babel config.
├── .editorconfig             # → Editor config.
├── .eslintrc                 # → Javascript linting config.
├── .stylelintrc              # → CSS styles linting config.
├── .gitignore                # → Git config file to ignore files and directories.
├── 404.php                   # → Default Wordpress 404 template file. Just points to "resources/templates/layout/404".
├── app/                      # → Wordpress theme bootstrapping. Extends Wordpress default functionality.
    ├── acf-settings.php      # →
    ├── assets.php            # →
    ├── bootstrap/            # →
    ├── config/               # →
        ├── app.php           # → Main Theme config file.
    ├── customize.php         # → Customize theme functionality here.
    ├── filters.php           # → Wordpress filters and actions that customize Wordpress default behavior.
    ├── helpers.php           # → PHP helper functions. Add more PHP helper functions here.
    ├── init.php              # → Main init file for this Wordpress theme. This file will autoload other required PHP files.
    ├── lib/                  # → Contains Wordpress plugins that can be required from a Theme.
    ├── nav-walker.php        # →
    ├── post-types/           # →
    ├── shortcodes/           # →
    ├── theme-settings/       # →
    ├── widgets/              # →
├── composer.json             # → Composer settings.
├── composer.lock             # → Composer lock file generated from Composer.
├── dist/                     # → Built assets directory. Should be git ignored.
├── footer.php                # → Default Wordpress footer template file. Go to "resources/templates/layout/footer" to edit html.
├── functions.php             # → Default Wordpress functions file. This is the beginnings of the theme bootstrap.
├── header.php                # → Default Wordpress header template file. Go to "resources/templates/layout/header" to edit html.
├── index.php                 # → Default Wordpress index template file. Just points to "resources/templates/layout/index".
├── node_modules/             # → Node modules. Should be git ignored.
├── package.json              # → Main package file for NPM.
├── phpcs.xml                 # → PHP codesniffer config.
├── README.md                 # → Markdown readme file for Wordpress theme files.
├── resources/                # → Main location for templates and assets.
    ├── assets/               # →
    ├── languages/            # →
    ├── templates/            # →
        ├── layout/           # →
        ├── page-templates/   # →
        ├── partials/         # →
├── screenshot.png            # → Default Wordpress theme screenshot. This will show up in the WP Admin theme selection.
├── style.css                 # → Default Wordpress style file. This is only used for theme configuration, not for styles.
├── vendor/                   # → Vendor files creates from `composer install`.
├── yarn.lock                 # → Generated by yarn. Keep in the repo. Do not git ignore.
```

---
## Theme Prerequisites

### Composer Install

```
$ composer install
```

### Install and run Yarn

```
$ npm install -g yarn
$ yarn
```

**Troubleshooting note:** If the `yarn` command generates a lot of errors related to nvm, check your node version:

```
node --version
```

`yarn` errors have been reported from node v10^ users. Try using node v9.3.0 instead:

```
# if necessary
nvm install 9.3.0
# -or-
nvm use 9.3.0
```

### Run dev gulp task

```
$ yarn run dev
```

### Log into Wordpress

Go to your local install /wp-admin to log in. This assumes you have access to an existing Wordpress login account from the database import to your local database.

---
## Theme Development

### Watch task

```
$ yarn run watch
```

---
## Theme Documentation

### Theme Bootstrap

How does this thing run?

1. /functions.php -> Wordpress main bootstrap file.
2. /vendor/autoload.php -> Autoloads Composer packages. This is all generated from Composer.
3. /app/bootstrap/libs.php -> Autoloads plugins found in "/app/lib". Some plugins are added in this folder by Composer. The Arity plugin is checked into the repo and is not registered through Composer.
4. /app/bootstrap/compatibility.php -> Checks the Theme's compatibility. Is the right version of PHP running? Did Gulp create the dist folder? Etc.
5. /app/bootstrap/theme.php -> Bootstraps the theme.
  * Create new Theme instance from class "\Arity\Theme"
  * Using "/config/app.php", create Theme config instance from class "\Arity\Config"
6. The "\Arity\Theme" will autoload files configured in "/config/app.php"

---
### Arity Plugin

See README.md in "/app/lib/arity/"

The Arity Plugin contains classes that start with "\Arity" and also "\ModuleBuilder". The plugin also contains helper php functions that are commonly used in the .html.php template files.

---
### ACF

---
## Additional Information

### Known Issues

See README.md in root directory.

### Changelog

See README.md in root directory.

### Reading Recommendations

- [Wordplate](https://github.com/wordplate/wordplate)
- [Wordplate ACF](https://github.com/wordplate/acf)
- [ACF](https://www.advancedcustomfields.com/)

---

Project repo [Arity CMS](https://vsapartners.beanstalkapp.com/1274-009-05-arity-cms-wordpress).
 	