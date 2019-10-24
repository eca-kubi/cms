<?php
/**
 * Created by PhpStorm.
 * User: IT
 * Date: 2/15/2019
 * Time: 11:37 AM
 */

class CmsSettingsModel
{
    private static $table = 'settings';
    //private $prop;
    //private $value;
    private $db;

    public function __construct()
    {
        $this->db = Database::getDbh();
    }

    /**
     * @param $prop
     * @return mixed
     */
    public function getValue($prop)
    {
        $value = $this->db
            ->where('prop', $prop)
            ->getValue(self::$table, 'value');
        return $value;
    }

    /**
     * @param $prop
     * @param mixed $value
     * @return bool
     */
    public function setValue($prop, $value): bool
    {
        return $this->db
            ->where('prop', $prop)
            ->update(self::$table, array('value' => $value));
    }

    public function update($where, $col_val): bool
    {
        foreach ($where as $key => $value) {
            $this->db->where($key, $value);
        }
        return $this->db->update(self::$table, $col_val);
    }
}