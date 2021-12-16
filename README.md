# UAS PWeb 2

## Kelompok 5

- Irvan Malik Azantha (09021282025060)
- Anwaripasha Akbar (09021282025072)
- Alif Toriq Alkausar (09021182025016)
- Alvanza Ipanda Putra (09021182025024)

## Prerequisite

- PHP v7.3 or newer, with `intl` and `mbstring` extension installed and enabled
- MySQL 5.1 or newer
- Apache Web Server
- Composer

You can install `composer` by following this tutorial <https://getcomposer.org/doc/00-intro.md#using-the-installer> for Windows. If you use Linux (or any *nix system), you can install it through this tutorial <https://getcomposer.org/doc/00-intro.md#installation-linux-unix-macos>.

> Note: you need to add XAMPP's `php` directory to `PATH` environment variable if you're on Windows.

## Initial Setup

1. Activate `Apache` and `MySQL` in XAMPP's control panel.
2. Run `composer install` or `composer update`.
3. Make a database and run the provided SQL file queries.
4. Modify the configurations in `.env` file. You would need to change the database's name, your MySQL username and password there.

## Testing

To test, run `php spark serve`. The page will be served at <http://localhost:8080>.

### Testing Accounts

1. Username: irvanmalik48 | Password: test1234
2. Username: aliftoriq | Password: test1234

## License

MIT
