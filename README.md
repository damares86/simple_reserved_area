# simple_reserved_area (by damares86)
An easy to use reserved area, that allow you to set roles for user and set permission to get file for specific roles.

It is possbile to:
* create user and assign them roles
* create roles
* upload files and assign the permission to download them to a specific user's role

## Easy quick start

To setup your reserved area you need to download the package as zip or clone the repository.

It is necessary that you have an **empty database** and a **user** with a **password**.

### Basic database configuration

Open the file `functions.php` in the folder `reserved_area/core`.

You will find this at line 15, change the definition with your db's data.
```php
    $conn = new mysqli("YOUR_SERVER_HOST(ES.LOCALHOST", "USER", "PASSWORD", "DB_NAME");
```
Ok, everything is done! Too easy?

## Usage

With your browser, go to the main folder of the reserved area, you will see a login form.

The default admin user is:

> user: **admin**
> 
> password: **admin**

Once you are in you can change your username and password (please, do it!).

You have to create the roles you want (e.g Editor, Viewer,etc), create the users and assign them specific roles and upload files (.pdf, .doc, .docx, .zip) assigning them role's permission.

If you find some problems, open an issue and I'll fix that.

**Enjoy your reserved area!**
