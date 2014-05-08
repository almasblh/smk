
<div class="view" id="<?php

                    $c=explode('-',$data['nextpoverdate']);
                    $d=mktime(0,0,0,$c[1],$c[2],$c[0])-time();
                    if ($d<0)//если поверка просрочена - фон красный
                        echo 'backcolor_red';
                    elseif($d>1296000)//если поверка на подходе (меньше 15 дней или 1296000 сек) - фон желтый
                        echo 'backcolor_green';
                    else//иначе фон зеленый
                        echo 'backcolor_yellow';
                ?>">
    <div class="oimpribors" id="<?php
                            if($data['wherenow']=='0')
                                echo 'delete';
                            else
                                echo 'active';
                            ?>">
        <table>
        <tr>
            <?php echo CHtml::encode($data['descr'])." - (".CHtml::encode($data['name']).")"; ?>
        </tr>
        <tr>
        <table>
                <tr>
                    <td width="20%">
                        Паспорт прибора
                    </td>
                    <td width="80%">
                        <table>
                            <tr>
                                <td width="90%">
                                    <table>
                                        <tr>
                                            <td width="35%">
                                                заводской №
                                            </td>
                                            <td width="65%">
                                                <?php echo CHtml::encode($data['zavn']); ?>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                № паспорта
                                            </td>
                                            <td>
                                                <?php echo CHtml::encode($data['passnom']); ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td id="picture" width="10%">
                                    <?php
                                        if ($data['passpath']){
                                            echo '<b>'.CHtml::link(CHtml::image('./images/'.'document-preview4848.png','file'),
                                                    array('/Viewfiles',
                                                      'path' => $data['passpath']
                                                    ),
                                                    array('target'=>'_blank')
                                                    ).'</b>';
                                        }
                                    ?>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
                <tr>
                    <td width="30%">
                        Где сейчас прибор находится
                    </td>
                    <td width="70%">
                      <?php 
                          $a[0]='Списан';
                          $a[1]='На складе';
                          $a[2]='В поверке';
                          $a[3]='На руках';
                          echo CHtml::encode($a[$data['wherenow']]).'&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;';
                          echo CHtml::link('Переместить прибор', array('submit' => array('OimPribors/gotoenatherplace','id'=>$data['id'])))
                      ?>
                    </td>
                </tr>
            </table>
        </tr>
        <tr>
            Сведения о поверках:
        </tr>
        <tr>
        <table>
            <td width="14%">
                Дата последней поверки
            </td>
            <td width="12%">
                <?php
                    $c=explode('-',$data['lastpoverdate']);
                    $d=mktime(0,0,0,$c[1],$c[2],$c[0]);
                    echo date('d F Y',$d);
                ?>
            </td>
            <td width="14%">
                Дата следующей поверки
            </td>
            <td width="12%">
                <?php
                    $c=explode('-',$data['nextpoverdate']);
                    $d=mktime(0,0,0,$c[1],$c[2],$c[0]);
                    echo date('d F Y',$d);
                ?>
            </td>
            <td width="15%">
                Поверку произвел
            </td>
            <td width="23%">
                <?php
                if(isset($data['poverer']))   echo $data['poverer'];
                ?>
            </td>
            <td id="picture" width="10%">
                <?php
                    if ($data['svidpath']<>""){
                    echo '<b>'.CHtml::link(CHtml::image('./images/'.'document6464','file'),
                            array('/Viewfiles',
                              'path' => $data['svidpath']
                            ),
                            array('target'=>'_blank')
                            ).'</b>';
                    }
                ?>
            </td>
        </table>
        </tr>
        <tr>
            <?php echo CHtml::button('Новая поверка', array('submit' => array('OimPriborsPoverka/index','id'=>$data['id']))); ?>
        </tr>
        </table>
    </div>

</div>