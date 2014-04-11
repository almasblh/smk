По проекту ПГВР №<?php echo $value['SmkProjects']['Npgvr']?><br />
Договор: <?php echo $value['SmkProjects']['dogovor']?><br />
Объект: <?php echo $value['SmkProjects']['object']?><br />
Заказчик: <?php echo $value['SmkProjects']['customer']?><br /><br />
Работы: <?php echo $value['SmkProjects']['Works']?><br /><br />
<p class="mess">
    Назначен новый этап (либо изменен) - <span id="kurs_bold"><?php echo $value['SmkProjectStepName']['name']?></span><br />
    планируемая дата начала этапа - <span id="kurs_bold"><?php echo Yii::app()->dateFormatter->format('d MMMM yyyy г.',$value['datestart'])?></span><br />
    планируемая дата окончания этапа - <span id="kurs_bold"><?php echo Yii::app()->dateFormatter->format('d MMMM yyyy г.',$value['datestop'])?></span><br />
    Вы назначены куратором данного этапа и вам необходимо согласовать сроки его проведения.
</p>
<a href="http://smk.sintek-nn.ru/smk/index.php?r=SmkProjects/view&id=<?php echo $value['SmkProjects']['id']?>">ссылка на проект</a>
       
