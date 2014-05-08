Появилась новая рекламация №'<?php echo $value['id']?>
по проекту ПГВР №'<?php echo $value['SmkProjects']['Npgvr']?><br />
Договор: '<?php echo $value['SmkProjects']['dogovor']?> <br />
Объект: '<?php echo $value['SmkProjects']['object']?> <br />
Заказчик: '<?php echo $value['SmkProjects']['customer']?> <br /> 
Работы: '<?php echo $value['SmkProjects']['Works']?> <br /><br />
Проблема - "<?php echo $value['problemname']?>"<br /><br />
<p class="mess">от пользователя  - "<?php echo ServUsers::model()->findbyPk($value['signaturecreator'])->FIO?>"<br />;
    Вы должны принять решение по данной рекламации в срок до - <?php echo Yii::app()->dateFormatter->format('d MMMM yyyy г.', $value['status']['datestop'])?><br />
</p>
<?php if($datetostop>0): ?>
    Срок принятия решения прошел.<br />
<?php endif; ?>
<a href="http://smk.sintek-nn.ru/smk/index.php?r=SmkReklamation/view&id=<?php echo $value['id']?>">ссылка на рекламацию</a>