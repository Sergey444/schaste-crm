# CRM система для детского центра "Счастье"

<p align="">
    <a href="https://schaste-club.ru" target="_blank">
        <img src="https://schaste-club.ru/images/logo/6.png" height="100px">
    </a>
</p>

## Параметры базы данных
Создать в папке /config/ файл db.php
```bash
<?php

  return [
      'class' => 'yii\db\Connection',
      'dsn' => 'mysql:host=%HOST_NAME%;dbname=%DB_NAME%',
      'username' => '%USER_NAME%',
      'password' => '%PASSWORD%',
      'charset' => 'utf8'
  ];
```

## Параметры SMTP 
Создать в папке /config/ файл mailer.php
```bash
<?php 

  return [
      'class'      => 'Swift_SmtpTransport',
      'host'       => 'smtp.yandex.ru',
      'username'   => 'noreply@my-site.ru',
      'password'   => 'password',
      'port'       => '465',
      'encryption' => 'ssl',
  ];
```

## Установка
```bash
  composer install #установка пакетов
  php yii migrate #выполнение миграций
  php yii migrate --migrationPath=@yii/rbac/migrations/ #выполнение миграций RBAC
  php yii rbac/init #инициализация ролей
```

## Запуск 
<p>При первом входе необходимо зарегистрироваться по ссылке /site/signup</p>
<p>Будет создан пользователь с правами администратора</p>