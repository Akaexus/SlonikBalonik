<?php

class news extends yansApp {
  function execute() {
    $coreSkin = $this->registry->loadTemplate('core');
    $this->skin = $this->registry->loadTemplate('news');
    $coreSkin->loadAndRender('header', 'Aktualności', ['public/mdrnze/news.css']);
    $coreSkin->loadAndRender('headerBar');
    $coreSkin->loadAndRender('branding');
    if(isset($this->registry->request['id'])) {
      if(ctype_digit($this->registry->request['id']) && $this->registry->request['id']>0) {
        $id = (int)$this->registry->request['id'];
        $news = $this->DB->select([
          'select'=> 'n.*',
          'from'=> 'news n',
          'join'=> 'categories c',
          'on'=> 'n.category = c.id',
          'where'=> 'n.id=?'
        ], [$id]);
        if(count($news)) {
          if(isset($this->registry->request['do'])) {
            if($this->registry->request['do'] =='delete') {
              $this->DB->delete([
                'from'=> 'news',
                'where'=> "id='?'"
              ], [$id]);
              $this->newsList();
            } else if($this->registry->request['do'] == 'edit') {
              $this->skin->loadAndRender('newsCreateOrEdit');
            }
          } else {
          $news = $news[0];
          $author = yansMember::load($news['author_id']);
          $this->skin->loadAndRender('newsCard', $news, $author, $this->loadNewsComments($news['id']));
          }
        } else {
          $this->skin->loadAndRender('newsNotFound');
        }
      }
    } else {
      $this->newsList();
    }
    $coreSkin->loadAndRender('footer');
  }

  function newsList() {
    $newsArray = $this->DB->select([
      'select'=> '*',
      'from'=> 'news',
      'order'=> 'date',
      'limit'=> 20
    ]);
    $newsArray = array_map(function($news){
      $news['author'] = yansMember::load($news['author_id']);
      //TODO: napisac klase na obsluge czasu
      $date = new DateTime('@'.$news['date']);
      $news['date'] = $date->format('d-m-Y H:i');
      return $news;
    }, $newsArray);
    $this->skin->loadAndRender('smallNewsCard', $newsArray);
  }

  function loadNewsComments($newsID) {
    $comments = $this->DB->select([
      'select'=> '*',
      'from'=> 'comments',
      'where'=> 'news_id=? and parent_comment is null'
    ], [$newsID]);
    foreach($comments as $index=>$comment) {
      $comments[$index]['member'] = yansMember::load($comments[$index]['member_id']);
      $comments[$index]['subcomments'] = $this->loadSubcomments($comment['id']);
    }
    return $comments;
  }
  function loadSubcomments($id) {
    $comments = $this->DB->select([
      'select'=> '*',
      'from'=> 'comments',
      'where'=> 'parent_comment=?'
    ], [$id]);
    foreach($comments as $index=>$comment) {
      $comments[$index]['member'] = yansMember::load($comments[$index]['member_id']);
      $comments[$index]['subcomments'] = $this->loadSubcomments($comments[$index]['id']);
    }
    return $comments;
  }
}
