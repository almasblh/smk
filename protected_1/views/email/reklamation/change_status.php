У рекламации № <?php echo $value['id']?>
 по проекту ПГВР № <?php echo $value['SmkProjects']['Npgvr']?><br />
Договор:  <?php echo $value['SmkProjects']['dogovor']?><br />
Объект:  <?php echo $value['SmkProjects']['object']?><br />
Заказчик:  <?php echo $value['SmkProjects']['customer']?><br />
Работы:  <?php echo $value['SmkProjects']['Works']?><br />
Проблема - "<?php echo $value['problemname']?>"<br /><br />
<p class="mess">к текущему статусу - "<?php echo $value['status']['status']['name']?>"<br />
    появился новый коментарий  - от пользователя  - <?php echo ServUsers::model()->findbyPk($value['status']['responsibleuserid1'])->FIO ?><br />
    "<?php echo $value['status']['comment']?>"<br />
    Вы должны принять решение по данной рекламации в срок до -  <?php echo Yii::app()->dateFormatter->format('d MMMM yyyy г.',$value['status']['datestop'])?><br />
</p>
<?php if($datetostop>0): ?>
    <span id="kurs_bold">ВНИМАНИЕ:</span> Срок принятия решения прошел. Срочно эделайте отметку о выполнении.<br />
<?php endif; ?>
<a href="http://smk.sintek-nn.ru/smk/index.php?r=SmkReklamation/view&id=<?php echo $value['id']?>">ссылка на рекламацию</a>