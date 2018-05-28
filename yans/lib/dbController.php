<?php


class yansDatabase {
    private $PDO;
    static private $instance;
    public function __construct($config = array()) {
        try {
            $dsn = 'mysql:host='.$config['host'].';dbname='.$config['db'].';charset='.$config['charset'];
            $options = array(
                PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_EMULATE_PREPARES   => false,
            );
            $this->PDO = new PDO($dsn, $config['user'], $config['passwd'], $options);
        } catch (PDOException $e) {
            print_r($e);
            //TODO: error handling
        }
    }
    public static function getInstance($config = null) {
      if(self::$instance === null) {
        if($config) {
          self::$instance = new yansDatabase($config);
        }
      }
      return self::$instance;
    }
    public function query($query = '') {
        return $this->PDO->query($query);
    }

    public function queryAndFetch($query = '') {
        return $this->query($query)->fetchAll();
    }

    public function prepareAndExecute($query, $params = array()) {
        try {
            if (count($params)) {
                $stmt = $this->PDO->prepare($query);
                $stmt->execute($params);
            } else {
                $stmt = $this->PDO->query($query);
            }
            return $stmt;
        } catch (PDOException $e) {
            return false;
        }
    }
    protected function completeQuery($options, $queryCompletions) {
        $query = '';
        foreach ($queryCompletions as $queryCompletion => $q) {
            if (isset($options[$queryCompletion])) {
                $query.=$q.$options[$queryCompletion];
            }
        }
        return $query;
    }
    public function select($options, $params = array()) {
        $query = 'SELECT '.$options['select'].' FROM '.$options['from'];
        $queryCompletions = array(
            'join' => ' JOIN ',
            'on'=> ' ON ',
            'where'=> ' WHERE ',
            'group'=> ' GROUP BY ',
            'having'=> ' HAVING ',
            'order'=> ' ORDER BY ',
            'limit'=> ' LIMIT '
        );
        $query .= $this->completeQuery($options, $queryCompletions);
        $result = $this->prepareAndExecute($query, $params);
        if($result) {
          return $result->fetchAll();
        } else {
          return [];
        }
    }
    public function update($options, $params = array()) {
        $query = 'UPDATE '.$options['update'].' SET ';
        $query .= implode(', ', array_map(function ($key) {
            return "`$key`=?";
        }, array_keys($options['set'])));
        $queryCompletions = array(
            'where'=> ' WHERE ',
            'order'=> ' ORDER BY ',
            'limit'=> ' LIMIT '
        );
        $query .= $this->completeQuery($options, $queryCompletions);
        $params = array_merge(array_values($options['set']), $params);
        return $this->prepareAndExecute($query, $params);
    }
    public function delete($options, $params = array()) {
        $query = 'DELETE FROM '.$options['from'];
        $queryCompletions = array(
            'where'=> ' WHERE ',
            'order'=> ' ORDER BY ',
            'limit'=> ' LIMIT '
        );
        $query .= $this->completeQuery($options, $queryCompletions);
        return $this->prepareAndExecute($query, $params);
    }
    public function insert($options) {
        $query = 'INSERT INTO '.$options['into'];
        $query .= '('.implode(', ', array_map(function ($key) {
            return "`$key`";
        }, array_keys($options['values']))).')';
        $query.= 'VALUES ('.implode(', ', array_map(function ($key) {
            return '?';
        }, array_values($options['values']))).')';
        return $this->prepareAndExecute($query, array_values($options['values']));
    }
}
