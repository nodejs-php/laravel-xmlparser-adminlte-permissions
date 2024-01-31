# Парсер товаров. Сложная программа с админкой и командами парсера, правами, ролями и пользователями

Установка docker и запуск сервера
``./vendor/bin/sail up``

Запуску миграции
``./vendor/bin/sail artisan migrate``

Загрузка данных в БД
``./vendor/bin/sail artisan db:seed``

Команда выполнения загрузки данных
``./vendor/bin/sail artisan products:load``

Для просмотра данных, выгрузки данных в Excel реализована админка ``AdminLTE``
В админке рализованы роли, права на каждого из пользователей для просмотра админки.
``/admin``

# Работа с внешним API, загрузка и выгрузка с Excel. Админка AdminLTE

## Демонстрация работы приложения:
[![IMAGE ALT TEXT HERE](resources/video.png)](https://www.youtube.com/watch?v=aF0bDYYOHqI&t=118s)





