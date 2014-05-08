Рекламация №<?php echo $value['id']?>
 по проекту ПГВР №<?php echo $value['SmkProjects']['Npgvr']?><br />
Договор: <?php echo $value['SmkProjects']['dogovor']?><br />
Объект: <?php echo $value['SmkProjects']['object']?><br />
Заказчик: <?php echo $value['SmkProjects']['customer']?><br />
Работы: <?php echo $value['SmkProjects']['Works']?><br /><br />
Проблема - "<?php echo $value['problemname']?>"<br /><br />
приобрела новый статус - "<?php echo $value['status']['status']['name']?>"
<p class="mess">Вы назначены ответственным за данный этап.<br />
    Ваша задача - "<?php echo $value['status']['managercoment']?>"<br />
    Планируемый срок завершения этапа - <?php echo Yii::app()->dateFormatter->format('d MMMM yyyy г.',$value['status']['datestop'])?><br />
    По завершению этапа не забудьте сделать отметку в системе СМК.
</p>
<?php if($datetostop>0): ?>
    <span id="kurs_bold">ВНИМАНИЕ:</span> Срок принятия решения прошел. Срочно оставьте свой коментарий в системе, либо свяжитесь с менеджером по рекламациям.<br />
<?php endif; ?>       
<a href="http://smk.sintek-nn.ru/smk/index.php?r=SmkReklamation/view&id=<?php echo $value['id']?>">ссылка на рекламацию</a>
