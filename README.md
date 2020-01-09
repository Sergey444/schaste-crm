# CRM система для детского центра "Счастье"

<p align="">
    <a href="https://schaste-club.ru" target="_blank">
        <img src="https://schaste-club.ru/images/logo/6.png" height="100px">
    </a>
</p>

## Установка
```bash
  composer install #установка пакетов
  php yii migrate #выполнение миграций
  php yii migrate --migrationPath=@yii/rbac/migrations/ #выполнение миграций RBAC
  php yii rbac/init #инициализация ролей
```

