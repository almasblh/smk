<h1>Управление пунктами меню</h1>
<div class="catcontrol">
<?php echo CHtml::beginForm(); ?>
<table>
  <tr >
    <td><!--1.1-->
        <?php echo CHtml::hiddenField('tree','manage'); ?>
        <div id="menulist">
            <?php echo $this->renderPartial('_menu_list', array('data'=>$data), false, true); ?>
        </div>    
    </td><!--1.1-->
    <td><!--1.2-->
        <table>
            <tr>
                <td>
                <?php
                    echo CHtml::label('caption','caption');
                        echo CHtml::textField('caption',$CaptionMenu,array('style'=>'width:100%')).'<br />';
                    echo CHtml::label('controller','controllerid');
                        echo CHtml::dropDownList('controllerid','1',$datServControllers,array('style'=>'width:100%')).'<br />';
                    echo CHtml::label('action','actionid');
                        echo CHtml::dropDownList('actionid','1',$datServControllersAction,array('style'=>'width:100%')).'<br />';
                        echo CHtml::ajaxButton('Добавить пункт меню',
                                                CHtml::normalizeUrl(array('Administration/CatUpdate&action=addmenuitem')),
                                                array('type' => 'POST',
                                                      'update' => '#menulist',
                                                ),
                                                array('name'=>'addmenuitem','style'=>'width:100%')
                                            );
                ?>
                </td>
            </tr>
            <tr>
                <td>
                <?php
                    echo CHtml::ajaxButton('Переместить выбранный пункт меню выше',
                                            CHtml::normalizeUrl(array('Administration/CatUpdate&action=upmenuitem')),
                                            array('type' => 'POST',
                                                  'update' => '#menulist',
                                            ),
                                            array('name'=>'upmenuitem','style'=>'width:100%')
                                        );
                ?><br />
                <?php
                    echo CHtml::ajaxButton('Переместить выбранный пункт меню ниже',
                                            CHtml::normalizeUrl(array('Administration/CatUpdate&action=downmenuitem')),
                                            array('type' => 'POST',
                                                  'update' => '#menulist',
                                            ),
                                            array('name'=>'downmenuitem','style'=>'width:100%')
                                        );
                ?>
                </td>
            </tr>
            <tr>
                <td>
                <?php echo CHtml::dropDownList('nodeto','1',$data,array('style'=>'width:100%')); ?><br />
                <?php
                    echo CHtml::ajaxButton('Переместить пункт меню перед выбранном пунктом меню',
                                            CHtml::normalizeUrl(array('Administration/CatUpdate&action=beforemenuitem')),
                                            array('type' => 'POST',
                                                  'update' => '#menulist',
                                            ),
                                            array('name'=>'downmenuitem','style'=>'width:100%')
                                        );
                ?><br />
                <?php
                    echo CHtml::ajaxButton('Переместить пункт меню в выбранный пункт меню',
                                            CHtml::normalizeUrl(array('Administration/CatUpdate&action=belowmenuitem')),
                                            array('type' => 'POST',
                                                  'update' => '#menulist',
                                            ),
                                            array('name'=>'downmenuitem','style'=>'width:100%')
                                        );
                ?>
                </td>
            </tr>
        </table>
    </td><!--1.2-->
  </tr>
  <tr>
      <td><!--2.1-->
        <div id="data">
            <?php echo $this->renderPartial('_users_category', array('datuser'=>array(),'datcategory'=>array(),), false, true); ?><br />
        </div>
    </td><!--2.1-->
    <td><!--2.2-->
        <?php
            //echo CHtml::label('Категории','catid');
            echo CHtml::ajaxButton('Добавить категорию в меню',
                CHtml::normalizeUrl(array('Administration/CatUpdate&action=addcattomenu')),
                array('type' => 'POST',
                      'update' => '#data',
                ),
                array('name'=>'addcattomenu','style'=>'width:50%')
            );
            echo CHtml::dropDownList('catid','1',$datcategory,array('style'=>'width:100%;height=20%','size'=>4)).'<br />';
            echo '<br />';
            //echo CHtml::label('Пользователи','userid');
            echo CHtml::ajaxButton('Добавить пользователя в меню',
                CHtml::normalizeUrl(array('Administration/CatUpdate&action=addusertomenu')),
                array('type' => 'POST',
                      'update' => '#data',
                ),
                array('name'=>'addusertomenu','style'=>'width:50%')
            );                       
            echo CHtml::dropDownList('userid','1',$datuser,array('style'=>'width:100%;height=20%','size'=>4)).'<br />';
        ?>        
    </td><!--2.2-->
  </tr>
</table>
<?php echo CHtml::endForm(); ?>
</div>