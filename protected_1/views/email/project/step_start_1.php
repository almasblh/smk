По проекту ПГВР №<?php echo $value['SmkProjects']['Npgvr']?><br />
Договор: <?php echo $value['SmkProjects']['dogovor']?><br />
Объект: <?php echo $value['SmkProjects']['object']?><br />
Заказчик: <?php echo $value['SmkProjects']['customer']?><br /><br />
Работы: <?php echo $value['SmkProjects']['Works']?><br /><br />
<p class="mess">
Назначен новый этап - <span id="kurs_bold"><?php echo $value['SmkProjectStepName']['name']?></span><br />
планируемая дата начала этапа - <span id="kurs_bold"><?php echo Yii::app()->dateFormatter->format('d MMMM yyyy г.',$value['datestart'])?></span><br />
планируемая дата окончания этапа - <span id="kurs_bold"><?php echo Yii::app()->dateFormatter->format('d MMMM yyyy г.',$value['datestop'])?></span><br />
Вы назначены куратором данного этапа. Не забудьте отметить фактическое начало этапа в системе СМК
</p>
<?php if($datetostop>0): ?>
    <p class="mess"><span id="kurs_bold">ВНИМАНИЕ</span> Срок планового окончания этапа прошел, а вы до сих пор не сделали отметку в журнале о фактитечком его начале.<br />
    Вы срываете сроки плана. Если у вас есть уважительная причина - свяжитесь с куратором проекта для смещения сроков этапа,<br />
    либо срочно сделайте отметку о начале этапа.</p>
<?php endif; ?>
<a href="http://smk.sintek-nn.ru/smk/index.php?r=SmkProjectStep/view&id=<?php echo $value['id']?>">ссылка на этап</a>