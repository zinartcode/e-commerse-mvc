<?php

class NewsController
{

  public function actionIndex() {
    echo 'News controller actionIndex';
    return true;
  }

  public function actionView($category, $id) {
    echo 'Hi';
    echo '<br>'.$category;
    echo '<br>'.$id;
    return true;
  }
}

  ?>
