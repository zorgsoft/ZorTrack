﻿=== Russain
=[ ZorTrack Ver 0.02 ]====================
ZorTrack - Менеджер задач.

Предназначен для управления задачами пользователей.
Возможен просмотр статистики за определённые интервалы времени по каждому пользователю.

Разделение прав на обычных пользователей и администраторов.
Администраторы могут пользоваться всеми фунциями ZorTrack.
Пользователи, могут просматривать свои задачи, закрывать их, создавать для себя задачи.
Пользователи не могут просматривать или редактировать других пользователей или удалять задачи созданные не ими.

Для установки необходим веб сервер потдерживающий PHP >5 и MySQLбаза данных.

[УСТАНОВКА]
1)  Скопируйте файлы в нужную вам папку на сервере
2)  Откройте файл /system/application/config/config.php
    Замените в переменной $config['base_url'] на урл вашего сайта
3)  Откройте файл /system/application/config/database.php
    Поменяйте настройки доступа к базе на ваши
4)  В вашей базе создайте таблицу с именем которое вы вписали при настройке базы, как указанно выше
5)  Сделайте импорт sql файла со структурой таблиц zortrack.sql
6)  Зайдите через броузер по адрессу который вы прописали для этого менеджера, например http://localhost/zortrack
7)  При первом открытии менеджера, когда ещё нет пользователей, вам будет предложено создать первого пользователя, он будет с административными правами.
    Введите логин (логин обязательно должен быть в виде e-mail) и пароль (минимум 4 символа)
8)  Можете пользоваться

[НАСТРОЙКА]
Других настроек в менеджере практически нет, разабраться и работать с ним довольно просто.
Если вы захотите сменить оформление, то вам нужно будет менять файлы вида (представления) которые находятся /system/application/views/
CSS, JS скрипты, изображения находятся в корне с именами css, js, images
Практически всё оформление можно ноастроить меняя css файл /css/ztrack.css

P.S. Использование данного менеджера полностью на ваш страх и риск. Приложение не тестировалось на устойчивость к взломам и писалось для внутренних нужд фирмы.
Но если у вас появятся замечания или предложения, то я  с радостью выслушаю их.

P.P.S. Написанно с использованием CodeIgniter и NetBeans :)

(C) by ZoRg Soft (Sergey Agarkov)
E-Mail: zorgsoft@gmail.com
ICQ: 6371025, Jabber (GoogleTalk): zorgsoft@gmail.com
URL Blog  : http://agarkov.org
URL Resume: http://www.agarkov.org/p/blog-page_4133.html


[ИСТОРИЯ ИЗМЕНЕНИЙ]
(0.02 - 04/08/2010)
+	Добавленна возможность пользователям вести учёт своей посещаемости, указывать время прихода/ухода на работу и обеда.
	В статистике теперь также отображается общее отработанное время пользователя за вычетом времени обедов.
	Время прихода/ухода учитывается только если пользователь вводил время и сохранял. Редактировать прошедшие даты нет возможности.

(0.01b)	-	Первая публичная версия
+ Добавленна возможность оставлять комментарии при закрытии задачи

=== English
ZorTrack - Task Manager.

Designed to manage the tasks of users.
You can view statistics for the specified intervals for each user.

The division of rights to ordinary users and administrators.
Administrators can use all the functions being ZorTrack.
Users can view their tasks, close them, to create for themselves the task.
Users can not view or edit or delete other users' tasks were not created by them.

To install the necessary web server PHP > 5 and MySQL base.

[SET]
1) Copy the files to the desired folder on the server
2) Open the file /system/application/config/config.php
    Replace the variable $ config ['base_url'] url on your site
3) Open the file /system/application/config/database.php
    Change the setting up access to the database on your
4) In your database, create a table with the name that you entered when you set up the base, as above
5) Make the import sql file with the structure of the tables zortrack.sql
6) Go through the browser to the address that you have registered for this manager, for example http://localhost/zortrack
7) When you first open the manager, when there are no users, you will be prompted to create the first user, it will be with administrative rights.
    Enter your login (username must be in the form of e-mail) and password (minimum 4 characters)
8) You can use the

[SETUP]
Other settings in the manager there is little, work with it rather easy.
If you want to change your registration, you will need to change the file type (view) that are /system/application/views/
CSS, JS scripts, images are at the root named css, js, images
Almost all the design can changing in the css file /css/ztrack.css

P.S. Use of this manager's entirely at your own risk. The application has not been tested for resistance to burglary and was written for the internal needs of the company.
But if you have any comments or suggestions, I'm happy to hear them.

P.P.S. This manager was written using CodeIgniter and NetBeans :)

(C) by ZoRg Soft (Sergey Agarkov)
E-Mail: zorgsoft@gmail.com
ICQ: 6371025, Jabber (GoogleTalk): zorgsoft@gmail.com
URL Blog: http://agarkov.org
URL Resume: http://www.agarkov.org/p/blog-page_4133.html


[HISTORY]
(0.02 - 04/08/2010)
+ Added the possibility to users to keep records of their attendance, indicate the time of arrival / departure for work and dinner.
In statistics now also displays the total hours worked by less time lunches.
Time of arrival / departure only taken into account if the user enters the time and kept. Last edit date is not possible.

(0.01b) - The first public version
+ Added the ability to leave comments at the close of the problem