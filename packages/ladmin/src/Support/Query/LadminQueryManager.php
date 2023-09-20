<?php

namespace LowB\Ladmin\Support\Query;

use Exception;

class LadminQueryManager
{
    protected array $queries = [];

    public function remember(LadminQuery $query)
    {
        $this->queries[] = $query;
    }

    public function getQuery(string $tableName): LadminQuery
    {
        foreach ($this->queries as $query) {
            if ($query->getTableName() === $tableName) {
                return $query;
            }
        }
        throw new Exception("Unregistered query or table not found: $tableName");
    }
}
