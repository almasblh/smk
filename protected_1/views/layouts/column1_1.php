<?php /* @var $this Controller */ ?>

<?php $this->widget('application.components.Tree'); ?>

<?php $this->beginContent('//layouts/main'); ?>
<div id="content">
	<?php echo $content; ?>
</div><!-- content -->
<?php $this->endContent(); ?>