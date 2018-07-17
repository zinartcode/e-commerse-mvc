<?php


class News
{
  /**
  * RETURNS SINGLE NEWS ITEM WITH SPECIFIED ID @param integer $id
  */
  public static function getNewsItemById($id)
  {
    $id = intval($id);

    if ($id) {
      // $host = 'localhost';
      // $dbname = 'mvc_site';
      // $user = 'root';
      // $password = '';
      // $db = new PDO("mysql:host=$host;dbname=$dbname", $user, $password);

      $db = Db::getConnection();

      $result = $db->query('SELECT * from news WHERE id=' . $id);

      $newsItem = $result->fetch();

           return $newsItem;
         }
  }

  /**
  * RETURNS AN ARRAY OF NEWS ITEMS
  */
  public static function getNewsList()
  {
     $db = Db::getConnection();

     $newsList = array();

     $result = $db->query('SELECT id, title, date, short_content '
            . 'FROM news'
            . 'ORDER BY date DESC'
            . 'LIMIT 10');

            $i = 0;
            while ($row = $result->fetch()) {
              $newsList[$i]['id'] = $row['id'];
              $newsList[$i]['title'] = $row['title'];
              $newsList[$i]['date'] = $row['date'];
              $newsList[$i]['short_content'] = $row['short_content'];
              $i++;
            }
            return $newsList;
  }
}
 ?>
