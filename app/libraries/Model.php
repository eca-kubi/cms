<?php
class Model 
{
  protected $lastInsertId;
  private static $table;
  protected $columns;
  private $db;
  public function __construct()
  {
    $this->db = Database::getDbh(); // MysqliDb
  }
  // Fetch a single record from db
  public function getSingle($id)
  {
      $this->db->where('id_', $id);
      return $this->db->ObjectBuilder()->getOne($this->table);
  }

  // Fetch a single record from db as array
  public function getSingleAsArray($id)
  {
      $this->db->where('id_', $id);
      return $this->db->ArrayBuilder()->getOne($this->table);
  }

  // Fetch multiple records from db
  public function getMultiple($order_by = 'id_')
  {
      $this->db->orderBy($order_by, 'asc');
      return $this->db->ObjectBuilder()->get($this->table);
  }

  
  /*public function add($params, $target_cols = null, $use_filter = true)
  {
      if (gettype($params == 'object')) {
          $params = objToArr($params);
      }
      if ($use_filter) {
          if (!$target_cols) {
              $target_cols = $this->getColumns();
          }
          $params = $this->filterCols($params, $target_cols);
      }
      $this->lastInsertId = $this->db->insert($this->table, $params);
      if ($this->lastInsertId > 0) {
          return $this->lastInsertId;
      }
      return -1;
  }*/

  // Update record
  public function update($id, $params, $target_cols = null, $use_filter = true)
  {
      if (gettype($params == 'object')) {
          $params = objToArr($params);
      }
      if ($use_filter) {
          if (!$target_cols) {
              $target_cols = $this->getColumns();
          }
          $params = $this->filterCols($params, $target_cols);
      }
      $this->db->where('user_id', $id);
      if ($this->db->update($this->table, $params)) {
          return true;
      }
      return false;
  }

  // get column names
  public function getColumns()
  {
      return $this->columns;
  }

    public function getColumnsWhere(string $table, string $columns, array $where)
    {
        $db = Database::getDbh()->objectBuilder();
        foreach ($where as $col => $value) {
            $db->where($col, $value);
        }
        return $db->get($table, $columns);
    }

  public function filterCols($params, $target_cols)
  {
      foreach ($params as $key => $value) {
          if (!in_array($key, $target_cols)) {
              unset($params[$key]);
          }
          if(empty($value)){
              unset($params[$key]);
          }
      }
      return $params;
  }

  public function getLastError()
  {
      return $this->db->getLastError();
  }

  public function getLastInsertId()
  {
      return $this->lastInsertId;
  }

  public function startTransaction()
  {
      $this->db->startTransaction();
  }

  public function rollBack()
  {
      $this->db->rollBack();
  }

  public function commit()
  {
      $this->db->commit();
  }
}

?>