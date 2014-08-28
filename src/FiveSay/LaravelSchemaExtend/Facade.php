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

        static::useCustomGrammar($connection);
        
        return $connection->getSchemaBuilder();
    }

    /**
     * Get a schema builder.
     *
     * @return \Illuminate\Database\Schema\Builder
     */
    protected static function getFacadeAccessor()
    {
        $connection = static::$app['db']->connection();

        static::useCustomGrammar($connection);
        
        return $connection->getSchemaBuilder();
    }

    /**
     * 引导系统调用我们自定义的 Grammar
     *
     * @param  object  $connection \Illuminate\Database\Connection
     * @return string
     */
    protected static function useCustomGrammar(&$connection)
    {
        # 仅针对 MySqlGrammar
        if (get_class($connection) === 'Illuminate\Database\MySqlConnection') {
            $MySqlGrammar = $connection->withTablePrefix(new MySqlGrammar);
            $connection->setSchemaGrammar($MySqlGrammar);
        }
    }

}
