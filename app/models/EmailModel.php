<?php
class EmailModel extends Model
{
    public static $table = 'emails';

    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Summary of getEmail
     * @param mixed $email_id
     * @return object|false
     */
    public function getEmail(int $email_id)
    {
        return (object)
            Database::getDbh()->where('email_id', $email_id)->
                        objectBuilder()->
                        getOne('emails');
    }

    // Verify existence of column value
    public static function has($column, $value )
    {
        $db = Database::getDbh();
        $db->where($column, $value);
        if ($db->has(self::$table)) {
            return 'true';
        }
        return false;
    }

    public function add($insertData): bool
    {
    	return Database::getDbh()->insert(self::$table, $insertData);
    }
}