<?php 
  //  Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl .'/css/email/email.css');
?>
<style type="text/css">
mess {
	font-family: Verdana, Geneva, sans-serif;
	font-size:12px
}
mess1 {
	font-family: Verdana, Geneva, sans-serif;
	font-size:10px
}
#a1{
	font-size:16px	
}
#bold{
	font-weight: bold;
	font-size:14px	
}
#kurs{
	font-style: italic;
	font-size:14px	
}
#kurs_bold{
	font-weight: bold;
	font-style: italic;
	font-size:14px;
}
#bold1{
	font-weight: bold;
	font-size:12px	
}
#kurs1{
	font-style: italic;
	font-size:12px	
}
#kurs_bold1{
	font-weight: bold;
	font-style: italic;
	font-size:10px;
}
foot-note{
    	font-style: italic;
	font-size:12px
}
</style>
<p id="kurs_bold">
    Копия письма<br />
    Оригинал - для пользователя: <?php echo $adresat[0]; ?>
</p>
<?php
    echo $content;
?>
