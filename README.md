Browser Information for SilverStripe
====================================

A small module for detecting the browser name, version, operating system and device type through the
browser user agent and exposing methods for controllers.

## Requirements

* SilverStripe 3 or higher

## Usage

The module automatically extends all Controllers to have two methods:

```php
$controller->getBrowser();
$controller->Browser();
```

Both returning a Browser class which wraps the browser name, version, operating system and device type.

### Browser Name

```php
$browser->getName();
```

The browser name is crude but will return one of the following:

* ie
* firefox
* chrome
* safari
* netscape
* opera
* konqueror
* unknown

### Browser Version

```php
$browser->getVersion();
```

The browser version will return a string value in the format of "X.X", just the major and minor version numbers
if present.

### Operating System

```php
$browser->getSystem();
```

The operating system will return one of the following values:

* linux
* macintosh
* windows
* ios
* android
* unknown

### Device

```php
$browser->getDevice();
```

Device detects whether the browser is either a handheld or a screen device (mobile/tablet or desktop/laptop) and
will return the following values:

* screen
* handheld

### Engine

```php
$browser->getEngine();
```

Detects the browser rendering engine and will return the following values:

* gecko
* webkit
* trident
* presto

### Templates

When the module is included in your SilverStripe directory structure, the module, through extension, will expose
a browser attribute for use in templates:

```html
<html class="$Browser">
```

Will be evaluated to something like:

```html
<html class="macintosh firefox firefox22 screen gecko">
```