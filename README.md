# likeIt
### Порядок установки
1. Склонить проект
1. Запустить docker compose up -d
1. docker exec -it <имя контейнера php> bash
  1. тут выполнить php composer.phar install, если ошибки какие есть то лучше update
1. Далее перейти на страницу [http://localhost:8080/install.php](http://localhost:8080/install.php) - это установит таблицу для дальнейшей работы, запустить нужно только единожды
1. Переходим на страницу [http://localhost:8080/index.php](http://localhost:8080/) там задачи по пунктам

### Возможные проблемы
Может быть проблема с папкой /var/www/html/reviews/images/, тогда нужно дать ей права на запись для всех 
Самый простой способ это выполнить chmod 777 {PATH TO REPOSITORY}src/reviews/images/ 
