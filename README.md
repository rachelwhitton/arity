# Arity Site
##### VSA Partners + Arity

Authors: [Ryan Powszok](mailto:rpowszok@vsapartners.com), [Andrew Falconer](mailto:afalconer@vsapartners.com)

Editors: [Alberto Cristancho](mailto:acristancho@vsapartners.com)

Last Updated: 07/24/2018 Created: 05/15/2017

---
## Helpful URLs

### Arity Site Environments
- [Arity Production - https://www.arity.com/](https://www.arity.com/)
- [Arity VSA Development - http://dev.site.arity.vsadev.com/](http://dev.site.arity.vsadev.com/)
- [Arity VSA Stage - http://stage.site.arity.vsadev.com/](http://stage.site.arity.vsadev.com/) `DEPRECATED`

### Arity Sites
- [Arity - https://www.arity.com/](https://www.arity.com/)
- [Arity Developer - https://developer.arity.com/](https://developer.arity.com/)

---
## Project Structure

```
project/                  # → Root folder for the project.
├── .editorconfig         # → Editor config used for defining indent style/spaces.
├── .env                  # → Dot env file. Configuration for app. This file should never be checked in. It contains secrets.
├── .env.example          # → Dot env file. Configuration for app.
├── .gitignore            # → Git config file to ignore files and directories.
├── .travis.yml           # → Config file used for Travis CI deployments.
├── bin/                  # → Directory for shell scripts and other executable files.
├── certs/                # → Local development SSL certs.
├── CHANGELOG.md          # → Markdown changelog file.
├── composer.json         # → Composer settings.
├── composer.lock         # → Composer lock file generated from Composer.
├── config/               # → Wordpress configuration files.
├── phpcs.xml             # → PHP Codesniffer rules.
├── web/                  # → Docroot folder where index.php is located. Must be web for Pantheon hosting.
    ├── wp-content/       # → Wordpress wp-content folder.
        ├── mu-plugins/   # → Wordpress "must-use" plugins.
        ├── plugins/      # → Wordpress plugins.
        ├── themes/       # → Wordpress themes.
        ├── uploads/      # → Wordpress uploads.
    ├── wp/               # → Wordpress core files installed by Composer.
    ├── wp-config.php     # → Wordpress config file.
├── README.md             # → Markdown readme file.
├── vendor/               # → Vendor files creates from `composer install`.
├── wp-cli.yml            # → Configuration file for WP CLI.
```

---
## Installation using MAMP

### Setup
* Go to Languages PHP and make sure 7.0.x is the default version. Take note of which version of PHP you chose.
* Optional. Go to Languages PHP and make sure Extensions "Xdebug" is checked. This will provide better options for error debugging.

### Add MAMP PHP to your path
See https://indigotree.co.uk/getting-wp-cli-work-mamp

```
$ vi ~/.bash_profile # or vi ~/.profile
Add this line -> export PATH="/Applications/MAMP/bin/php/php{{php_version}}/bin:$PATH"
```

Or somehow install PHP so it doesn't use your machine's default version. Homebrew is one option. PHP 7.0.x or higher is required for Composer.

### Add Host
* Go to Hosts and add 'arity.dev' as the Host name and choose the `web` directory in this project as the document root.
* Navigate to the SSL tab and enable SSL by adding the crt and key files located in this repo. Be sure to check the SSL checkbox as well.
* Restart servers.

### Better SSL, Add VSA CA cert

Follow the readme instructions here: https://bitbucket.org/vsapartners/vsadev-ca-cert/. Using a CA Cert allows green certificates for local development, without it your cert will be red and your browser will prompt a security warning. The cert installation is only required once and can be shared across projects if setup properly. Definitely nice to have but not required.

### Using external images from localhost for local development environment

Instead of having to migrate WP uploads from the dev environment to your local environment, its much easier to add this trick to your MAMP setup. In MAMP, click on the Apache tab and add the following to "Additional Parameters for \<VirtualHost\> directive:"

```
RewriteEngine on
RewriteCond %{REQUEST_URI} ^/wp-content/uploads/[^\/]*/.*$
RewriteRule ^(.*)$ https://dev.site.arity.vsadev.com/$1 [QSA,L]
```

### Install Composer
```
$ curl -sS https://getcomposer.org/installer | php;
$ sudo mv composer.phar /usr/local/bin/composer;
$ composer --version # Double check everything looks good
```

### Install WP-CLI
```
$ curl -O https://raw.githubusercontent.com/wp-cli/builds/gh-pages/phar/wp-cli.phar
$ chmod +x wp-cli.phar
$ sudo mv wp-cli.phar /usr/local/bin/wp
$ wp --info # Double check everything looks good
```

## Project Prerequisites

### Create Database

* Open Sequel Pro and make a connection to your localhost MYSQL.
* Create a new Database, enter your database name (arity_dev), choose "utf8mb4" as the Database Encoding, choose "utf8mb4_unicode_ci" as the Database Collation.
* Download a database export by going to the vsadev.com development site, logging into Wordpress, and navigating to "Migrate DB Pro".
* Choose "Initial Export" and customize the "Find & Replace" settings to match your local environment configuration.
* Using Sequel Pro, import the database dump into the newly created database.

### Create .env file

If you are special, you'll have access - [https://docs.google.com/document/d/1vzUD5ecXFGPZw4M18rkfnAMEnhTMJA7-vdQZu1tW6Gc/view](https://docs.google.com/document/d/1vzUD5ecXFGPZw4M18rkfnAMEnhTMJA7-vdQZu1tW6Gc/view)

```
$ vi .env
Paste the contents from the above Google Doc.
Update database settings if needed.
```

### Theme Setup

Navigate to `/web/wp-content/themes/arity` in your shell. Refer to the theme README and follow the installation instructions. The theme is stubborn if its not built first. WP Admin should always work however.

### Return to project root folder

```
composer install
```

### WP Admin

Visit https://arity.dev/wp-admin Login with your admin credentials — refer to LastPass Shared-Arity Site folder if you don’t have credentials.

### Migrate DB Pro

[Connection Info Secret](https://docs.google.com/document/d/1H2xJGu5TJ1fkHr8DbZjDzeo_uwtEnMCdVT6ulXF5sFY/)

### Licenses

[ACF Pro](https://docs.google.com/document/d/1GBwvOP2YCT7Fw06j0DkNOlCEYtnj4bU1Mefu0CrI0j4/view)<br> 
[Migrate DB Pro](https://docs.google.com/document/d/1PF6eci8T-2dyWRBV7gG_3GRVfhz58eEIdWXP6QOtL4k/view)

---
## Deployments

### Pantheon

#### Install Terminus - [https://pantheon.io/docs/terminus/](https://pantheon.io/docs/terminus/)

You will need to create a machine-token:
* Login to your pantheon account
* Go to "My Dashboard" by first clicking on your profile image in the top right
* Click on the "Account" tab
* Click on "Machine Tokens" in the left sidebar navigation
* Click "Create token" and follow further instructions

Install and authenticate Terminus on your local machine

```
$ curl -O https://raw.githubusercontent.com/pantheon-systems/terminus-installer/master/builds/installer.phar && php installer.phar install
$ terminus auth:login --machine-token=‹machine-token›
```

Once you've authenticated with your machine token, you can authenticate again just using `terminus auth:login --email=<you@domain.com>`

#### Install Terminus Composer - [https://github.com/pantheon-systems/terminus-composer-plugin](https://github.com/pantheon-systems/terminus-composer-plugin)

This Terminus Plugin is required to run Composer commands on the Pantheon server. On your local machine run the following:

```
$ mkdir -p ~/.terminus/plugins
$ composer create-project --no-dev -d ~/.terminus/plugins pantheon-systems/terminus-composer-plugin:~1
```

#### Remote Composer Install using Terminus
```
$ terminus connection:set arity.dev sftp
$ terminus composer arity.dev -- install
$ terminus connection:set arity.dev git
```

#### Pantheon Sample Project

[https://github.com/pantheon-systems/example-wordpress-composer](https://github.com/pantheon-systems/example-wordpress-composer)

#### Adding Pantheon Env Variables to wp-config

See [https://github.com/pantheon-systems/example-wordpress-composer/blob/master/web/wp-config.php](https://github.com/pantheon-systems/example-wordpress-composer/blob/master/web/wp-config.php)


#### References
- [Pantheon Sample Project](https://github.com/pantheon-systems/example-wordpress-composer)
- [Pantheon Composer](https://pantheon.io/docs/composer/)
- [Pantheon Multidev](https://pantheon.io/features/multidev-cloud-environments)
- [Pantheon Team Management](https://pantheon.io/docs/team-management/)

---
## Additional Information

### Known Issues

See [DoneDone](https://vsapartners.mydonedone.com/issuetracker/projects/60250).

### Changelog

See the CHANGELOG.md file

### Reading Recommendations

- [Roots Bedrock](https://github.com/roots/bedrock)
- [Wordplate](https://github.com/wordplate/wordplate)

---

Project repo [Arity CMS](https://vsapartners.beanstalkapp.com/1274-009-05-arity-cms-wordpress).
