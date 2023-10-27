<br/>
<p align="center">
  <a href="https://github.com/IsmoilObidov/ABDigitalTest">
    <img src="https://www.kindpng.com/picc/m/715-7151551_vector-checklist-png-hd-image-list-checking-icon.png" alt="Logo" width="80" height="80">
  </a>

  <h3 align="center">Тестовой задание</h3>

  <p align="center">
    Специальное тестовое задание для проверки моих знаний.
    <br/>
    <br/>
    <a href="https://github.com/IsmoilObidov/ABDigitalTest"><strong>Explore the docs »</strong></a>
    <br/>
    <br/>
    <a href="https://github.com/IsmoilObidov/ABDigitalTest">View Demo</a>
    .
    <a href="https://github.com/IsmoilObidov/ABDigitalTest/issues">Report Bug</a>
    .
    <a href="https://github.com/IsmoilObidov/ABDigitalTest/issues">Request Feature</a>
  </p>
</p>

![Downloads](https://img.shields.io/github/downloads/IsmoilObidov/ABDigitalTest/total) ![Contributors](https://img.shields.io/github/contributors/IsmoilObidov/ABDigitalTest?color=dark-green) 

## Table Of Contents

* [About the Project](#about-the-project)
* [Built With](#built-with)
* [Getting Started](#getting-started)
  * [Prerequisites](#prerequisites)

## About The Project

![Screen Shot](https://avatars.mds.yandex.net/i?id=dc8b7cd32f8c024985674d94342d691eb88547cb-10683820-images-thumbs&n=13)

Создал с просьбой компание ABDigital, * тествое задание

## Built With

Необходимые настройки :
```sh
PHP ^8.1
Laravel ^10.10
MariaDB ^10.8
```

## Getting Started

* git 

```sh
git clone https://github.com/IsmoilObidov/ABDigitalTest.git
```

* для установки библиотеки нашего проекта необходима 
```sh
composer install
```

* Настройте базу данных и выполнить следующие команды чтобы мы начали тестировать с готовый базу данных

```sh
php artisan migrate --seed
```


### Prerequisites

Начинаем:

* Сначала нам нужно создать, настроить и добавить некоторые конфигурации в наш .env-файл.

```JS

LOG_CHANNEL=telegram

TELEGRAM_LOGGER_BOT_TOKEN=6370989311:AAFKWH2YMTO1is18MXlYS_wCMGr8sZzsOos
TELEGRAM_LOGGER_CHAT_ID=укажите_свой_ид_чат 
TELEGRAM_LOGGER_TEMPLATE=laravel-telegram-logging::minimal

MAIL_MAILER=smtp
MAIL_HOST=smtp.gmail.com
MAIL_USERNAME=ismoilobidov10001@gmail.com
MAIL_PASSWORD=nbkxtnzvxhuovaok
MAIL_PORT=465
MAIL_ENCRYPTION=SSL
MAIL_FROM_ADDRESS=nonereply@istamgroup.com
```

* все данные которые я указал вверху нужны чтобы наш проект мог отправить email для `2 степенный аутентификации` и  `обработка ошибки через телеграмм бот` .

* для того чтобы мы могли принимать уведомление через телеграмм бот, необходимо нажимать start на тест бота. 
[Test Telegram Bot](https://t.me/ExceptionHandlerABDbot)

* настройки на MAILER не надо трогать, если не уверены :)

* если хотите быстро тестировать апи статей там есть [POSTMAN коллекция](https://github.com/IsmoilObidov/ABDigitalTest/blob/main/postman_test.postman_collection.json)
