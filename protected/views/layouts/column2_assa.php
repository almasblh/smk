<?php if(Yii::app()->user->id==217): ?>
    <?php $this->beginContent('//layouts/main'); ?>
    <div class="span-7 last">
        <div id="sidebar">
        <?php 
            if(Yii::app()->user->id==217)
                $this->widget('application.components.Tree');
        ?>
        </div><!-- sidebar -->
    </div>
    <div class="span-22">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <?php $this->endContent(); ?>
<?php else: ?>
    <?php $this->beginContent('//layouts/main'); ?>
    <div class="span-30">
        <div id="content">
            <?php echo $content; ?>
        </div><!-- content -->
    </div>
    <?php $this->endContent(); ?>
<?php endif; ?>