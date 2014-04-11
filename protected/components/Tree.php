<?php

class Tree extends CWidget {
    public function run() {
        $model = Categories::model()->with('ServControllers','ServControllersAction')->findByPK(1); // Здесь вместо Categories меняем на свою модель
        $tree = $model->getTreeViewData(false);
        $this->render('tree',array('tree'=>$tree,));
    }
}