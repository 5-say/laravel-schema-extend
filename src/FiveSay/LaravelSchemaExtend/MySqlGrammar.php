<?php namespace FiveSay\LaravelSchemaExtend;

use Illuminate\Support\Fluent;
use Illuminate\Database\Schema\Blueprint;

class MySqlGrammar extends \Illuminate\Database\Schema\Grammars\MySqlGrammar {

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

}
