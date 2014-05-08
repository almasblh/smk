<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('fname')); ?>:</b>
	<?php echo CHtml::encode($data->fname); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('sname')); ?>:</b>
	<?php echo CHtml::encode($data->sname); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('tname')); ?>:</b>
	<?php echo CHtml::encode($data->tname); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('departamentid')); ?>:</b>
	<?php echo CHtml::encode($data->ServUsersDepartament['name']); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('otdelid')); ?>:</b>
	<?php echo CHtml::encode($data->ServUsersOtdel['name']); ?>
        
        <b><?php echo CHtml::encode($data->getAttributeLabel('dolgnostid')); ?>:</b>
	<?php echo CHtml::encode($data->ServUsersDolgnost['name']); ?>

        <b><?php echo CHtml::encode($data->getAttributeLabel('category')); ?>:</b>
	<?php echo CHtml::encode($data->ServUsersCategory['name']); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo '<a href="mailto:'.CHtml::encode($data->email).'">'.CHtml::encode($data->email).'</a>'; ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('tel_in')); ?>:</b>
	<?php echo CHtml::encode($data->tel_in); ?>

	<b><?php echo CHtml::encode($data->getAttributeLabel('tel_mob')); ?>:</b>
	<?php echo CHtml::encode($data->tel_mob); ?>
	<br />

        <?php
            echo CHtml::link(
                'Редактировать',
                CHtml::normalizeUrl(array('ServUsers/update&id='.$data->id))
            );
        ?>
</div>