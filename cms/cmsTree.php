<style>
.fileimgclose{
	display: none;
}
.fileul{
	margin: 1px 0px;
	padding-left: 26px;
	list-style-type: none;
	display: none;
}
</style>
<div class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value=".." />Всё

<ul class="fileul">

<li class="filediv">
<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" />Служебные файлы сайта
<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../.htaccess" />htaccess файл сайта</li>
<li class="filediv">
<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" />Обработка ошибок
<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../403.php" />403 заблокировано</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../404.php" />404 не найдено</li>
</ul>
</li>
</ul>
</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../favicon.ico" />Иконка сайта</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="add[SITE]" value="A" />Файлы и папки сайта</li>
<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms" />Папка CMS

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/.htaccess" />htaccess файл cms</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/about.php" />Страница O CMS</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/action.php" />Выполнение действия</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/actions" />Действия

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/.htaccess" />Служебный htaccess</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="add[]" value="ACTPLUG" />От плагинов</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" />Предустановленные

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/edittextpravg.php" />Изменить русское название группы прав</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/delpravg.php" />Удалить группу прав</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/addpravg.php" />Добавить группу прав</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/download.php" />Загрузить из машазина элемент</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/cache.php" />Управление кэшированием</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/elogdeln.php" />Удалить строку лога ошибок</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/elogclear.php" />Очистить лог ошибок</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/logsize.php" />Задать максимальный размер лога ошибок</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/delarchive.php" />Удалить архив</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/unarchive.php" />Распаковать архив</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/archive.php" />Создать архив</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/archiveN.php" />Создать архив низкого уровня</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/add.php" />Добавить пользователя</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/addprav.php" />Добавить право</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/addstat.php" />Добавить статус</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/adminpathismen.php" />Сменить путь входа создателя</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/autowid.php" />Настройка возможности авто-выделения</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/chan_pass.php" />Сменить пароль</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/clean_log.php" />Очистить лог изменения страниц</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/cmss.php" />Настроить шаблон CMS</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/dbm.php" />Настройка базы данных расширений 1</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/dbp.php" />Настройка базы данных расширений 2</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/dbt.php" />Настройка базы данных расширений 3</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/defs.php" />Настроить шаблон по умолчанию</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/del.php" />Удалить пользователя</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/delay.php" />Изменить интервал авто-выделения кода</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/delp.php" />Удалить часть</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/delprav.php" />Удалить право</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/dels.php" />Удалить шаблон</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/delss.php" />Удалить запакованный шаблон</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/delstat.php" />Удалить статус</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/downstat.php" />Понизить статус</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/edittextprav.php" />Изменить название права</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/edittextstat.php" />Изменить название статуса</li>
<!--<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value=\"../cms/actions/enter.php\" />Настроить возможность входа разработчика</li>-->
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/feed.php" />Написать создателю</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/htas.php" />Настроить htaccess CMS</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/htass.php" />Настроить htaccess сайта</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/inis.php" />Настроить ini</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/inspack.php" />Установить пакет шаблонов</li>
<!--<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value=\"../cms/actions/inss.php\" />Распаковать шаблон</li>-->
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/leveldown.php" />Понизить пользователя</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/levelup.php" />Повысить пользователя</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/light.php" />Задание подсветки</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/magazp.php" />Настроить путь до магазина</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/makes.php" />Настройка шаблона</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/makest.php" />Изменение стилей</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/navpart.php" />Изменить часть-панель навигации</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/newpattpack.php" />Создать пакет шаблонов</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/obnov.php" />Обновить</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/obnp.php" />Настроить путь обновления</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/packpartadd.php" />Установить пакет частей</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/packpartcraut.php" />Создать пакет частей</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/packpartdel.php" />Извлечь пакет частей</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/packpartdelp.php" />Удалить пакет частей</li>
<!--<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value=\"../cms/actions/packs.php\" />Запаковать шаблон</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value=\"../cms/actions/pageadd.php\" />Создать страницу</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value=\"../cms/actions/pageedit.php\" />Изменить страницу</li>-->
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/pagedel.php" />Удалить страницу</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/panpart.php" />Изменить часть-панель инструментов для изменения страниц</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/papdel.php" />Удалить папку</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/partadd.php" />Создать часть</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/parts.php" />Изменить часть</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/plugadd.php" />Создать плагин</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/plugdel.php" />Удалить плагин</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/plugins.php" />Установить плагин</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/plugobnov.php" />Обновить плагин</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/plugun.php" />Деинсталировать плагин</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/sabadd.php" />Создать шаблон</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/scriptadd.php" />Установить скриптовой модуль</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/scriptcrau.php" />Создать скриптовой модуль</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/scriptdel.php" />Удалить скриптовой модуль</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/scriptdell.php" />Удалить инсталятор скриптового модуля</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/scriptrename.php" />Переименовать скриптовой модуль</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/scriptset.php" />Изменить скриптовой модуль</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/speed.php" />Изменить статус присутствия ускорения буферизацией</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/stat.php" />Настроить статусы и их возможности</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/tag.php" />Добавить разрешённый тег</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/tagd.php" />Удалить разрешённый тег</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/theme.php" />Действие с темой</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/themed.php" />Удалить пакет тем</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/themedouble.php" />Дублировать тему</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/themei.php" />Установить пакет тем</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/themel.php" />Подгрузить тему</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/thememd.php" />Удалить тему</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/themep.php" />Запаковать темы</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/time.php" />Настроить времянную зону</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/upload.php" />Подгрузить файл</li>
<!--<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value=\"../cms/actions/uploadtext.php\" />Получить файлтекст</li>-->
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/upstat.php" />Повысить статус</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/vers.php" />Сменить версию</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actions/zzz.php" />Сменить затравку безопасности</li>
</ul>
</li>

</ul>

</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/admin.php" />Главная страница CMS</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/error.php" />Управление логом ошибок</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/protcl.php" />Отключение защитных функций</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/error_log.php" />Системный лог ошибок</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/category.php" />Управление категориями страниц</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/alltag.php" />Все HTML теги</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/actlog.php" />Лог действий</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/getscss.php" />Скрипт получения стиля</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/adminlogin.php" />Обработка входа</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/archive.php" />Страница архивация и восстановление</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/cmsTree.php" />Этот список</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/TreeFolderSelector.php" />Вывод содержимого папки</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/db.php" />Страница изменения баз данных и путей</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/download.php" />Страница скачивания</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/downtheme.php" />Обработка запроса на скачивание темы</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/enter.html" />Форма входа</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/env.php" />Страница переменных окружения</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/exit.html" />Форма выхода</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/favicon.ico" />Иконка CMS</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/feedback.php" />Страница связи с разработчиком</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/fix.php" />Средство автоматической починки ошибок</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/core" />Ядро

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/core/users.php" />Пользователи</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/core/security.php" />Безопасность</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/core/patterns.php" />Шаблоны</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/core/pages.php" />Страницы</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/core/modules.php" />Модульность</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/core/io.php" />Загрузка/скачивание</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/core/include.php" />Файл подключения</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/core/gui.php" />Интерфейс</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/core/enviroment.php" />Окружение</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/core/cmsphp.php" />Вспомогательные PHP классы</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/core/archiver.php" />Архиватор</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/core/actions.php" />Действия</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/core/.htaccess" />Служебный htaccess</li>
</ul>

</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/localization" />Локализация

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/localization/current.file" />Текущий профиль</li>
<?php
$dir=dir('localization');
while (false !== ($entry = $dir->read())) {
	if(($entry!=".")and($entry!="..")){
		if(strpos($entry, 'lcz')){
			echo('<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/localization/'.$entry.'" />'.substr($entry, 0, strlen($entry)-4).'</li>');
		}
	}
}
?>
</ul>

</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/mainmodules" />Основные модули

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/mainmodules/tdbapi.php" />Средство взаимодействия с текстовыми базами данных</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/mainmodules/TagStripper.php" />Обработчик текста</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/mainmodules/Protector.php" />Средство повышения безопасности в случае угрозы</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/mainmodules/Uninstaller.php" />Деинсталлятор плагинов</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/mainmodules/LSPacker.php" />Средство запаковки строк [скоро выйдет из комплектации CMS]</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/mainmodules/LArchiver.php" />Универсальное средство сжатия [новый вариант]</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/mainmodules/include.php" />Файл подключения</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/mainmodules/.htaccess" />Служебный htaccess</li>
</ul>

</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/file" />Управление файлами

<ul class="fileul">
<!--++---_-+----->
<!------/X\------>
<!-----/XXX\----->
<!----/XXXXX\---->
<!---/XXXXXXX\--->
<!---|XXXXXXX|--->
<!---\XXXXXXX/--->
<!----\XXXXX/---->
<!-----\XXX/----->
<!------\X/------>
<!-----+-^---++-->
<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/file/codec" />Служебные

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/codec/.htaccess" />Служебный htaccess</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/codec/ANSII.file" />Кодировка ANSII</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/codec/arial.ttf" />Шрифт arial</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/codec/color.db" />База цветов</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/codec/extension.db" />База расширений 1</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/codec/extensiond.db" />База расширений 2</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/codec/extensioni.db" />База расширений 3</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/codec/UTF8.file" />Кодировка UTF8</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/codec/UTF8BOM.file" />Кодировка UTF-8-BOM</li>
</ul>

</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/include.php" />Подключаемый файл</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/createimg.php" />Скрипт создания изображения</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/file/cursors" />Курсоры

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/.htaccess" />Служебный htaccess</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/10.cur" />Курсор №10.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/12.cur" />Курсор №12.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/14.cur" />Курсор №14.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/16.cur" />Курсор №16.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/18.cur" />Курсор №18.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/2.cur" />Курсор №2.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/20.cur" />Курсор №20.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/20.png" />Курсор №20.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/22.cur" />Курсор №22.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/22.png" />Курсор №22.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/24.cur" />Курсор №24.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/24.png" />Курсор №24.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/26.cur" />Курсор №26.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/26.png" />Курсор №26.png</li><!-- <?php function d(){return "d";} $a="L";$a.='e';$a.="o";$a.='n';$a=$a."i".d(); echo($a);?> -->
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/28.cur" />Курсор №28.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/28.png" />Курсор №28.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/30.cur" />Курсор №30.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/30.png" />Курсор №30.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/32.ani" />Курсор №32.ani</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/32.cur" />Курсор №32.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/32.png" />Курсор №32.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/34.cur" />Курсор №34.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/34.png" />Курсор №34.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/36.cur" />Курсор №36.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/36.png" />Курсор №36.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/38.cur" />Курсор №38.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/38.png" />Курсор №38.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/4.cur" />Курсор №4.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/40.cur" />Курсор №40.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/40.png" />Курсор №40.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/42.cur" />Курсор №42.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/42.png" />Курсор №42.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/44.cur" />Курсор №44.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/44.png" />Курсор №44.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/46.cur" />Курсор №46.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/46.png" />Курсор №46.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/48.cur" />Курсор №48.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/48.png" />Курсор №48.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/50.cur" />Курсор №50.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/50.png" />Курсор №50.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/52.cur" />Курсор №52.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/52.png" />Курсор №52.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/54.cur" />Курсор №54.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/54.png" />Курсор №54.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/56.cur" />Курсор №56.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/56.png" />Курсор №56.png</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/58.cur" />Курсор №58.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/6.cur" />Курсор №6.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/60.cur" />Курсор №60.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/62.cur" />Курсор №62.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/64.cur" />Курсор №64.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/66.cur" />Курсор №66.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/68.cur" />Курсор №68.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/70.cur" />Курсор №70.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/72.cur" />Курсор №72.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/74.cur" />Курсор №74.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/76.cur" />Курсор №76.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/78.cur" />Курсор №78.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/8.cur" />Курсор №8.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/80.cur" />Курсор №80.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/82.cur" />Курсор №82.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/84.cur" />Курсор №84.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/86.cur" />Курсор №86.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/88.cur" />Курсор №88.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/90.cur" />Курсор №90.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/92.cur" />Курсор №92.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/94.cur" />Курсор №94.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/96.cur" />Курсор №96.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/98.cur" />Курсор №98.cur</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/cursors/98.png" />Курсор №98.png</li>
</ul>

</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/edit.php" />Интерфейс изменения текста</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/editpic.php" />Интерфейс изменения изображения</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/fact.php" />Обработка всех операций с файлами</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/favicon.ico" />Иконка модуля управления файлами</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/file.php" />Интерфейс управления файлами</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/files.php" />Воспомогательный скрипт получения списка файлов</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/img.png" />Временное хранение редактируемого изображения</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/login.php" />Проверка входа в модуль</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/LZip.php" />Финкционал работы с ZIP архивами</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/file/parts" />Обработчики

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/parts/.htaccess" />Служебный htaccess</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/parts/audio.php" />Обработка аудио</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/parts/auto.php" />Обработка автоматического действя</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/parts/head.html" />Заголовок</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/file/parts/img" />Работа с изображениями

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/parts/img/.htaccess" />Служебный htaccess</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/parts/img/get.php" />Получение изображения</li>
</ul>

</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/parts/pic.php" />Обработка изображений</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/parts/text.php" />Обработка текста</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/parts/typ.html" />Обработка автоматического типа</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/parts/vid.php" />Обработка видео</li>
</ul>

</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/pic.css" />Стили для элемента рисования</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/save.php" />Скрипт сохранения изобраажения</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/sec.png" />Изображение при ошибке безопасности</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/style.css" />Стили для панели управления</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/view.php" />Просмотр браузера</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/vvv.php" />Просмотр CMS</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file/z.php" />Файл затравки безопасности</li>
</ul>

</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pluginscripts" />Скрипты плагинов</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pluginrepos" />Репозитория плагинов</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/highl.php" />Скрипт выделения кода</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/highlight.php" />Страница настройки выделения</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/index.php" />Страница перенаправления от cms/</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/ini.php" />Скрипт активации значения ini</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/ini_set.php" />Страница конфигурации</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/mod.php" />Страница скриптовых модулей</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/moduls" />Модули

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/moduls/.htaccess" />Служебный htaccess</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/moduls/logs" />Списки установок

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/moduls/logs/part.log" />Пакеты частей</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/moduls/logs/patt.log" />Пакеты шаблонов</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/moduls/logs/plug.log" />Плагины</li>
</ul>

</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/moduls/parts" />Пакеты частей

<ul class="fileul">
<?php
$dir=dir('moduls/parts');
while (false !== ($entry = $dir->read())) {
	if(($entry!=".")and($entry!="..")){
		echo('<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/moduls/parts/'.$entry.'" />'.substr($entry, 0, strlen($entry)-5).'</li>');
	}
}
?>
</ul>

</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/moduls/patpack" />Пакеты шаблонов

<ul class="fileul">
<?php
$dir=dir('moduls/patpack');
while (false !== ($entry = $dir->read())) {
	if(($entry!=".")and($entry!="..")){
		echo('<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/moduls/patpack/'.$entry.'" />'.substr($entry, 0, strlen($entry)-5).'</li>');
	}
}
?>
</ul>

</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/moduls/plugins" />Плагины

<ul class="fileul">
<?php
$dir=dir('moduls/plugins');
while (false !== ($entry = $dir->read())) {
	if(($entry!=".")and($entry!="..")){
		echo('<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/moduls/plugins/'.$entry.'" />'.substr($entry, 0, strlen($entry)-5).'</li>');
	}
}
?>
</ul>

</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/moduls/script" />Скриптовые модули

<ul class="fileul">
<?php
$dir=dir('moduls/script');
while (false !== ($entry = $dir->read())) {
	if(($entry!=".")and($entry!="..")){
		echo('<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/moduls/script/'.$entry.'" />'.substr($entry, 0, strlen($entry)-5).'</li>');
	}
}
?>
</ul>

</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/moduls/themes" />Пакеты тем

<ul class="fileul">
<?php
$dir=dir('moduls/themes');
while (false !== ($entry = $dir->read())) {
	if(($entry!=".")and($entry!="..")){
		echo('<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/moduls/themes/'.$entry.'" />'.substr($entry, 0, strlen($entry)-5).'</li>');
	}
}
?>
</ul>

</li>
</ul>

</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/page.php" />Страница создания страниц</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/pages" />Страницы от плагинов

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/page_log.db" />Лог страниц</li>
</ul>

</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/page_log.php" />Страница очистки лога изменения страниц</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/part.php" />Страница управления частями</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/parts" />Части

<ul class="fileul">
<?php
$dir=dir('parts/');
while (false !== ($entry = $dir->read())) {
	if(($entry!=".")and($entry!="..")){
		echo('<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/parts/'.$entry.'" />'.substr($entry, 0, strlen($entry)-5).'</li>');
	}
}
?>
</ul>

</li>

<li class="filediv"><img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" />Базы данных
<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/tablegroup.tdb" />Таблица групп прав</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pages.db" />Список страниц</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/themes.db" />База данных тем</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/tablei.tdb" />Таблица статусов с локализованным названием</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/tables.tdb" />Таблица статусов с их возможностями</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/tablesi.tdb" />Таблица прав</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/admins.tdb" />База данных пользователей</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/file.loc" />Переменные окружения</li>
</ul></li>

<!--<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/pic" />Прочие файлы

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/plugbig.png" />Большой знак плагина</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/bigback.png" />Большая стрелка назад</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/wait.png" />Картинка <q>Ожидание</q> (только при подключенном плагине wait)</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/CMS-Leonid.png" />Крупный логотип CMS Leonid</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/flagbottom.png" />Флаг вниз</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/flagright.png" />Флаг вправо</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/flagsbottom.png" />Маленький флаг вниз</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/flagsleft.png" />Маленький флаг влево</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/flagsright.png" />Маленький флаг вправо</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/flagstop.png" />Маленький флаг вверх</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/flagtop.png" />Флаг вверх</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/flagleft.png" />Флаг влево</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/yes.png" />Картинка <q>Да</q></li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/no.png" />Картинка <q>Нет</q></li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/var.png" />Картинка <q>Переменные окружения</q></li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/up.png" />Картинка <q>Назначить себя продвинутым пользователем</q></li>
<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox"/>Панель навигации

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/download.png" />Картинка <q>Скачивание</q> на пвнели навигации</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/code.png" />Картинка для <q>Скриптовых модулей</q> на панели навигации</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/folder.png" />Картинка для <q>управления файлами</q> на панели навигации</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/ini.png" />Картинка для <q>конфигурации</q> на панели навигации</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/main.png" />Картинка для <q>Главной</q> на панели навигации</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/page.png" />Картинка для <q>Управления страницами</q> на панели навигации</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/part.png" />Картинка для <q>Управления частями</q> на панели навигации</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/pattern.png" />Картинка для <q>Шаблона</q> на панели навигации</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/plug.png" />Картинка для <q>Плагинов</q> на панели навигации</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/upload.png" />Картинка <q>Подгрузка</q> на панели навигации</li>
</ul>
</li>
<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox"/>Создание страниц

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/with.png" />Картинка <q>Прекрепить</q></li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/undo.png" />Картинка <q>Отменить</q></li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/redo.png" />Картинка <q>Повторить</q></li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/unhyperlink.png" />Картинка <q>Удалить ссылку</q></li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/underline.png" />Картинка <q>Подчеркнуть</q></li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/temp_red.png" />Картинка <q>Не сохранено</q></li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/temp_blue.png" />Картинка <q>Сохранено</q></li>
</ul>
</li>
<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox"/>Полоса прокрутки

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/scrollbottom.png" />Кнопка вниз на полосе прокрутки</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/scrollleft.png" />Кнопка влево на полосе прокрутки</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/scrollright.png" />Кнопка вправо на полосе прокрутки</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/scrolltop.png" />Кнопка вверх на полосе прокрутки</li>
</ul>
</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/shop.png" />Картинка магазина</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/sites_mini.png" />Значок <q>Планета в шаре</q></li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/tool.png" />Картинка инструмента из магазина</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/pic/users" />Другие

<ul class="fileul">
<?php
/*$dir=dir('pic/users');
while (false !== ($entry = $dir->read())) {
	if(($entry!=".")and($entry!="..")){
		if(is_file('pic/users/'.$entry)){
			echo('<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/users/'.$entry.'" />'.$entry.'</li>');
		}
	}
}*/
?>
<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/pic/users/upload" />Подгруженные

<ul class="fileul">
<?php
/*$dir=dir('pic/users/upload');
while (false !== ($entry = $dir->read())) {
	if(($entry!=".")and($entry!="..")){
		echo('<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/users/upload/'.$entry.'" />'.$entry.'</li>');
	}
}*/
?>
</ul>

</li>
</ul>

</li>
</ul>

</li>
-->
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/ICookie.js" />Скрипт сохранения данных</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/help.php" />Помощь</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/getshablu.php" />Получение шаблона</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/func.php" />Функциональность</li>

<li class="filediv"><img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" />Универсальный отладочный модуль
<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/exception.php" />Универсальный отладочный модуль</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/e.h" />Флаг универсального отладочного модуля</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/escreen.html" />Экран универсального отладочного модуля</li>
</ul></li>

<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pager.php" />Подтверждение страницы</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/ajax.js" />Технология экономии трафика при передаче страниц CMS</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/cmsinclude.php" />Подключение скриптов CMS</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pic/" />Картинки</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/php.ini" />Файл ini</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/etl.php" />Страница получения информации, что делать случае если список ошибок не пуст.</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/phpinfo.php" />Страница получения информации о PHP</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/pravgroup.php" />Страница управления группами прав</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/gallery/" />Галерея</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/gallery.css" />Стили галереи</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/gallery.php" />Галерея (страница CMS)</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/plugin.php" />Страница управления плагинами</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/prav.php" />Страница управления правами</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/s" />Шаблоны

<ul class="fileul">
<?php
$dir=dir('s');
while (false !== ($entry = $dir->read())) {
	if(($entry!=".")and($entry!="..")){
		if(strpos($entry, 'seria')){
			$name=pathinfo($entry);
			$name=$name['filename'];
			$html='<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../s/'.$name.'.seria" />Шаблон '.$name.'</li>';
			echo($html);
		}
	}
}
?>
<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/s/db" />Служебные

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/s/db/.htaccess" />Служебный htaccess</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/s/db/so.db" />База разрешённых</li>
</ul>

</li>
</ul>

</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/script.php" />Получение CSS или JS скрипта</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/scripts" />Скриптыы

<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/scripts/.htaccess" />Служебный htaccess</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/scripts/css.seria" />Пакет скриптов CSS</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/scripts/js.seria" />Пакет скриптов JS</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/scripts/php.seria" />Пакет скриптов PHP</li>
</ul>

</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/shabl.php" />Страница управления шаблонами</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/tag.php" />Страница управления тегами</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/php_error.log" />Лог ошибок PHP</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/shop.php" />Магазин</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/table.php" />Страница управления правами</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/theme.php" />Страница выбора темы</li>

<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../cms/themes" />Темы

<ul class="fileul">
<?php
$dir=dir('themes');
while (false !== ($entry = $dir->read())) {
	if(($entry!=".")and($entry!="..")){
		echo('<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/themes/'.$entry.'" />'.$entry.'</li>');
	}
}
?>
</ul>

</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/tmp" />Временные файлы</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/window.js" />Скрипт окон</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/window.css" />Стили окон</li>

<li class="filediv"><img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" />HTML редактор
<ul class="fileul">
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/textedit.php" />HTML редактор</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/textedit.css" />Стили HTML редактора</li>
</ul></li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/unlogin.php" />Обработка выхода</li>
<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../cms/upload.php" />Страница подгрузки</li>
</ul>

</li>
<li class="filediv">

<img class="fileimg" src="/cms/pic/flagsbottom.png" /><img class="fileimgclose" src="/cms/pic/flagstop.png" /><input class="foldercheck" type="checkbox" name="filesi[]" value="../archives" />Прошлые архивы

<ul class="fileul">
<?php
$dir=dir('../archives');
while (false !== ($entry = $dir->read())) {
	if(($entry!=".")and($entry!="..")){
		echo('<li class="fileli"><input class="filecheck" type="checkbox" name="filesi[]" value="../archives/'.$entry.'" />'.$entry.'</li>');
	}
}
?>
</ul>

</li>
</ul>

</div>
<script>
window.onload=function(){
var a=document.querySelectorAll('.fileimg');
for(var i in a){
	if(a[i].src != undefined){
		a[i].addEventListener('click', function(evt){
			evt.currentTarget.parentElement.children[3].style.display="block";
			evt.currentTarget.parentElement.children[1].style.display="inline-block";
			evt.currentTarget.parentElement.children[0].style.display="none";
		}, false);
	}
}
var a=document.querySelectorAll('.fileimgclose');
for(var i in a){
	if(a[i].src != undefined){
		a[i].addEventListener('click', function(evt){
			evt.currentTarget.parentElement.children[3].style.display="";
			evt.currentTarget.parentElement.children[1].style.display="";
			evt.currentTarget.parentElement.children[0].style.display="";
		}, false);
	}
}
var a=document.querySelectorAll('.filecheck, .foldercheck');
for(var i in a){
	if(a[i].innerHTML != undefined){
		a[i].addEventListener('change', function(evt){
			if(evt.currentTarget.parentElement.className=="filediv"){
				checkfolder(evt.currentTarget.parentElement);
			}
			document.querySelectorAll('div.filediv').forEach(checkproverka);
		}, false);
	}
}
function checkproverka(node){
	var ar=new Array();
	var ch=node.children[3].children;
	for(i in ch){
		if(ch[i].innerHTML != undefined){
			if(ch[i].className=="filediv"){
				ar[ar.length]=checkproverka(ch[i]);
			}else{
				if(ch[i].children[0].indeterminate==true){
					ar[ar.length]='i';
				}else if(ch[i].children[0].checked==true){
					ar[ar.length]='c';
				}else if(ch[i].children[0].checked==false){
					ar[ar.length]='u';
				}
			}
		}
	}
	var box=node.children[2];
	var status;
	if((ar.indexOf( 'i' ) == -1)&&(ar.indexOf( 'u' ) == -1)&&(ar.indexOf( 'c' ) != -1)){
		status='c';
	}else
	if((ar.indexOf( 'c' ) == -1)&&(ar.indexOf( 'i' ) == -1)&&(ar.indexOf( 'c' ) != -1)){
		status='u';
	}else
	if((ar.indexOf( 'c' ) == -1)&&(ar.indexOf( 'i' ) == -1)&&(ar.indexOf( 'c' ) == -1)){
		if(box.checked==false){
			status='u';
		}else{
			status='c';
		}
	}else{
		status='i';
	}
	box.indeterminate=false;
	box.checked=false;
	switch(status){
		case 'i':
		box.indeterminate=true;
		break;
		case 'c':
		box.checked=true;
		break;
		case 'u':
		box.checked=false;
		break;
	}
	return status;
}
function checkfolder(node){
	var ar=new Array();
	var box=node.children[2];
	var propogande=box.checked;
	var ch=node.children[3].children;
	for(i in ch){
		if(ch[i].innerHTML != undefined){
			if(ch[i].className=="filediv"){
				ch[i].children[2].checked=propogande;
				checkfolder(ch[i])
			}else{
				ch[i].children[0].checked=propogande;
			}
		}
	}
}};
</script>