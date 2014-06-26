<?php
function db_query($column, $station, $table)
{
	return "select $column from $table where $station";
}