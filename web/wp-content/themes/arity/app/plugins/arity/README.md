# Arity Wordpress Plugin
##### VSA Partners

Authors: [Ryan Powszok](mailto:rpowszok@vsapartners.com), [Andrew Falconer](mailto:afalconer@vsapartners.com)

Last Updated: 08/20/2017 Created: 08/20/2017

---
## Project Structure

```
plugin/                   # → Root folder for the WP plugin.
├── .gitignore            # → Git config file to ignore files and directories.
├── autoload.php          # → Plugin autoloader if Composer doesn't autoload first.
├── composer.json         # → Composer settings.
├── composer.lock         # → Composer lock file generated from Composer.
├── helpers.php           # → Helper functions for Wordpress theme building.
├── index.php             # → Sssh..
├── README.md             # → Markdown readme file for Wordpress plugin files.
├── src/                  # → Contains the PHP class files.
├── vendor/               # → Vendor files creates from `composer install`.
├── arity.php             # → Main start file for plugin.
```

---
## Additional Information
