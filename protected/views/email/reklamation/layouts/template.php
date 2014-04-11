<?php 
   // Yii::app()->clientScript->registerCssFile(Yii::app()->request->baseUrl .'/css/email/email.css');
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

<?php
    echo $content;
?>

<div class="foot-note">
    ---<br />
    <span id="kurs1"> Пожалуйста, задите на сайт СМК компании ООО &quot;Синтек&quot; для дальнейшего продвижения работ по данной рекламации</span><br />
        <span id="kurs1">Для входа на сайт &quot;СМК&quot; - перейдите по ссылке: <a href="http://smk.sintek-nn.ru/">http://smk.sintek-nn.ru/</a> и введите свои учетные данные.</span><br />
        <span id="bold">прим. </span><span id="kurs">Данное письмо сгенерировано автоматически и не требует ответа.<br />
        По всем вопросам обращайтесь к Маслову А.Ю. тел 220</span>
</div>
