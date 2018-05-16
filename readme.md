* [app/Console/Commands/SendMoney.php](https://github.com/fortael/test-task-command/blob/master/app/Console/Commands/SendMoney.php)   
* [app/Helpers/TransactionHelper.php](https://github.com/fortael/test-task-command/blob/master/app/Helpers/TransactionHelper.php)     
* [app/User.php](https://github.com/fortael/test-task-command/blob/master/app/User.php)
## Запуск

    CREATE TABLE `users` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT, `name` varchar(255) NOT NULL,
    `balance` decimal(10,2) NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
        
    CREATE TABLE `comments` (
    `id` int(10) unsigned NOT NULL AUTO_INCREMENT, `user_id` int(10) unsigned NOT NULL,
    `text` text NOT NULL,
    PRIMARY KEY (`id`)
    ) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
    
    
Скачать [архив](https://github.com/fortael/test-task-command/archive/master.zip)

Вписать данные от базы данных в файл `.env`

    DB_CONNECTION=mysql
    DB_HOST=localhost
    DB_PORT=3306
    DB_DATABASE=база
    DB_USERNAME=аккаунт
    DB_PASSWORD=пароль
    
Команда

    php artisan send-money {from} {to} {amount}
    
`from` - от кого, `to` - кому, `amount` - сумма. Например:

    php artisan send-money vasya petya 100
