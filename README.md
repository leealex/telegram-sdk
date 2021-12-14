# Telegram Bot API SDK (PHP)

![Telegram SDK logo](https://user-images.githubusercontent.com/8910097/103632467-2753e480-4f66-11eb-9fe1-2623439a4974.jpg)

<p align="center">
<img src="https://img.shields.io/github/license/leealex/telegram-sdk?style=flat-square" alt="GitHub">
<img src="https://img.shields.io/packagist/php-v/leealex/telegram-sdk?style=flat-square" alt="Packagist PHP Version Support">
<img src="https://img.shields.io/github/v/release/leealex/telegram-sdk?style=flat-square" alt="GitHub release (latest by date)">
<img src="https://img.shields.io/github/repo-size/leealex/telegram-sdk?style=flat-square" alt="GitHub repo size">
<a href="https://packagist.org/packages/leealex/telegram-sdk"><img src="https://img.shields.io/packagist/dt/leealex/telegram-sdk?style=flat-square" alt="Packagist Downloads"></a>
<img src="https://img.shields.io/github/last-commit/leealex/telegram-sdk?style=flat-square" alt="GitHub last commit">
</p>

## About

Telegram Bot API SDK lets you develop Telegram Bots in PHP.

It offers interactions with user by generating inline or custom keyboards.

Please refer to the official documentation https://core.telegram.org/bots/api

## Installation

The recommended way to install SDK is through [Composer](https://getcomposer.org/).

```bash
composer require leealex/telegram-sdk
```

## Usage

```php
// Pass your bot's token to the Bot's constructor
$bot = new leealex\telegram\Bot(BOT_TOKEN);
// Optional. Directory path to store DB files at. Default value: sys_get_temp_dir()
$bot->setDb(DB_DIR_PATH);
// Optional. Array of admins IDs
$bot->setAdmins([123456789]);
// Required. Directory path to store all bot's commands 
$bot->setCommandsPath(COMMANDS_DIR_PATH);
// Optional. Aliases are primarily used for reply keyboards, which, unlike inline keyboards,
// cannot pass callback queries. Reply keyboard passes the text of the button itself,
// which may contain emoji.
$bot->setCommandsAliases([
    'Button 1️⃣ 🙂' => 'SomeCommand argument1 argument2',
    'Button 2️⃣ 👍' => 'AnotherCommand argument1',   
]);
$bot->run();
```

## Data storage

SDK uses lightweight NoSQL database [SleekDB](https://sleekdb.github.io/) to store data.

Bot instance holds SleekDB object to interact with database. Use getDb() method to get SleekDB instance.

```php
// Get DB
$db = $bot->getDb();
// Fetch data
$user = $db->findBy(['user_id', '=', 123]);
// Fetch data with query builder
$users = $db->createQueryBuilder()
    ->where(['type', '=', 'user'])
    ->orderBy(['age' => 'desc'])
    ->limit(10)
    ->getQuery()
    ->fetch();
// Insert data
$db->insert([
    'type' => 'user', 
    'user_id' => 123, 
    'username' => 'John', 
    'age' => 18
]);
// Update data
$db->createQueryBuilder()
    ->where(['user_id', '=', 123])
    ->getQuery()
    ->update(['age' => 20]);
```

See full documentation at [https://sleekdb.github.io](https://sleekdb.github.io)