Для вас появился новый дефект №'<?php echo $value['id']?><br />
от пользователя  - "<?php echo $value->GetUsersFIO($value['autorid'])?>"<br />
<p class="mess">
    Суть проблемы - "<?php echo $value['describe']?>"<br /><br />
    Вы должны принять решение по данному дефекту и cделать отметку в журнале дефектов<br />
</p>
<a href="http://smk.sintek-nn.ru/smk/index.php?r=DefectsBook/view&defectid=<?php echo $value['id']?>">ссылка на дефект</a>