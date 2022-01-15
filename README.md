# Локальный недо-прокси
Позволяет смотреть заблокированные страницы через кэш Google

* `config/hosts` в `/etc/hosts`
* `config/wproxy.conf` в `/etc/apache2/sites-available/`
* `index/index.php` и `index/main.html` в `/var/www/html/`
* `wproxy/index.php` в `/var/www/wproxy/`

Пример:
`navalny.com -> blackhole.beeline.ru/?url=navalny.com -> 127.0.0.1/?url=navalny.com -> 127.0.0.1:3333/?url=navalny.com -> 127.0.0.1/?view=1&url=navalny.com`
