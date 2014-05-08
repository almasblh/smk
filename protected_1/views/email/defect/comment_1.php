Дефект №'<?php echo ' '.$value['defectid'].' '?><br />
приобрел новое состояние'<?php echo $value->GetDefectStatusList($value['state'])?><br />
с коментарием - "<?php echo $value['comment']?>"<br />
от пользователя  - "<?php echo $value->GetUsersFIO($value['signaturecreatorid'])?>"<br />
<p class="mess">
    Для продвижения работы по данному дефекту вам необходимо перевести дефект в новое состояние, назначить ответсвенного, и оставить свой коменатарий.<br />
</p>
<a href="http://smk.sintek-nn.ru/smk/index.php?r=DefectsBook/view&defectid=<?php echo $value['defectid']?>">ссылка на дефект</a>