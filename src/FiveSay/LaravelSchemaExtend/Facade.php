<?php namespace FiveSay\LaravelSchemaExtend;

class Facade extends \Illuminate\Support\Facades\Facade
{

    /**
     * Get a schema builder instance for a connection.
     *
     * @param  string  $name
     * @return \Illuminate\Database\Schema\Builder
     */
    public static function connection($name)
    {
        $connection = static::$app['db']->connection($name);

        # 仅针对 MySqlGrammar
        if (
            get_class($connection) === 'Illuminate\Database\MySqlConnection'
            && is_null($connection->getSchemaGrammar())
        ) {
            $MySqlGrammar = $connection->withTablePrefix(new MySqlGrammar);
            $connection->setSchemaGrammar($MySqlGrammar);
        }
        
        return $connection->getSchemaBuilder();
    }

    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        $connection = static::$app['db']->connection();

        # 仅针对 MySqlGrammar
        if (
            get_class($connection) === 'Illuminate\Database\MySqlConnection'
            && is_null($connection->getSchemaGrammar())
        ) {
            $MySqlGrammar = $connection->withTablePrefix(new MySqlGrammar);
            $connection->setSchemaGrammar($MySqlGrammar);
        }
        
        return $connection->getSchemaBuilder();
    }

}
