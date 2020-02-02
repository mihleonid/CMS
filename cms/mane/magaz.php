<?php
$back=array('height'=>'250px','alt'=>"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Назад", 'width'=>'250px', 'src'=>'/cms/pic/bigback.png', 'name'=>'Назад', 'ops'=>'', 'small'=>'', 'a'=>'?list=', 'type'=>'just');
switch($_GET['list']){
	case "plugins":
		$mag[]=array('height'=>'250px','alt'=>"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Нет изображения", 'width'=>'250px', 'file'=>'http://localhost/cms/mane/file.pack', 'src'=>'pic/obj.png', 'name'=>'Плагин file', 'ops'=>'Файловый менеджер', 'id'=>'file', 'small'=>'', 'a'=>'http://www.localhost/cms/mane/file.pack', 'type'=>'down', 'kuda'=>'moduls/plugins/file.pack');
		$mag[]=$back;
	break;
	case "script":
		$mag[]=array('height'=>'250px','alt'=>"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Нет изображения", 'width'=>'250px', 'file'=>'http://localhost/cms/mane/clock.pack', 'src'=>'pic/obj.png', 'name'=>'Часы', 'ops'=>'Часы', 'id'=>'file', 'small'=>'', 'a'=>'http://www.localhost/cms/mane/clock.pack', 'type'=>'down', 'kuda'=>'moduls/script/clock.pack');
		$mag[]=$back;
	break;
	default:
		$mag[]=array('height'=>'250px','alt'=>"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Плагины", 'width'=>'250px', 'src'=>'/cms/pic/plugbig.png', 'name'=>'Плагины', 'ops'=>'Выбрать плагин', 'small'=>'', 'a'=>'?list=plugins', 'type'=>'just');
		$mag[]=array('height'=>'250px','alt'=>"&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Скриптовые модули", 'width'=>'250px', 'src'=>'/cms/pic/plugbigmod.png', 'name'=>'Скриптовые модули', 'ops'=>'Выбрать скриптовой модуль', 'small'=>'', 'a'=>'?list=script', 'type'=>'just');
	break;
}
echo(serialize($mag));
?>