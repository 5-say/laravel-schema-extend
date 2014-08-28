<?php namespace FiveSay\LaravelSchemaExtend;

use Illuminate\Support\Fluent;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Connection;

class MySqlGrammar extends \Illuminate\Database\Schema\Grammars\MySqlGrammar
{
    /**
     * 初始化
     * @return void
     */
    public function __construct()
    {
        if (! in_array('Comment', $this->modifiers)) {
            array_push($this->modifiers, 'Comment');
        }
    }

    /**
     * Get the SQL for a "comment" column modifier.
     *
     * @param \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param \Illuminate\Support\Fluent             $column
     * @return string|null
     */
    protected function modifyComment(Blueprint $blueprint, Fluent $column)
    {
        if ( ! is_null($column->comment))
        {
            $comment = str_replace("'", "\'", $column->comment);
            return " comment '".$comment."'";
        }
    }

    /**
     * Compile a create table command.
     *
     * @param  \Illuminate\Database\Schema\Blueprint  $blueprint
     * @param  \Illuminate\Support\Fluent  $command
     * @param  \Illuminate\Database\Connection  $connection
     * @return string
     */
    public function compileCreate(Blueprint $blueprint, Fluent $command, Connection $connection)
    {
        $columns = implode(', ', $this->getColumns($blueprint));

        $sql = 'create table '.$this->wrapTable($blueprint)." ($columns)";

        // Once we have the primary SQL, we can add the encoding option to the SQL for
        // the table.  Then, we can check if a storage engine has been supplied for
        // the table. If so, we will add the engine declaration to the SQL query.
        $sql = $this->compileCreateEncoding($sql, $connection);

        # 表注释支持
        if (isset($blueprint->comment))
        {
            $comment = str_replace("'", "\'", $blueprint->comment);
            $sql .= " comment = '".$comment."'";
        }

        if (isset($blueprint->engine))
        {
            $sql .= ' engine = '.$blueprint->engine;
        }

        return $sql;
    }

}
