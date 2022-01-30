<?php
namespace App\Extensions;

use Illuminate\Database\Eloquent\Builder;
use DB;
class Kendo2QueryBuilder
{
    
    const K_EQ = 'eq';
    const K_NEQ = 'neq';
    const K_STARTSWITH = 'startswith';
    const K_CONTAINS = 'contains';
    const K_ENDSWITH = 'endswith';
    const K_GTE = 'gte';
    const K_LT = 'lt';
    const K_LTE = 'lte';
    const K_GT = 'gt';
    
    const K_AND = 'and';
    const K_OR = 'or';
    
    private $builder;
    
    private $namespaces = [];
    private $aliases = [];
    private $enum = [];
    
    public function __construct(Builder $builder) {
        
        $this->builder = $builder;
        
    }
    
    public  function buildQueryFromKendoFilter($filter = []) {
         $filter = is_array($filter)?$filter:[];
        if (!isset($filter['logic'], $filter['filters'])) {
            return $this->builder;
        }
        
        $logic = $filter['logic'];
        $filters = $filter['filters'];
        $queries = [];
        
        foreach($filters as $filterParams) {
            
            if (!is_array($filterParams)) {
                continue;
            }
            if (isset($filterParams['filters'])) {
                $this->buildQueryfromKendoFilter($filterParams);
                continue;
            }
            //~ dd($filterParams);
            list($field, $operator, $value) = array_values($filterParams);
            list($field, $operator, $value) = $this->parseEnum($field, $operator, $value);    
            $queries_tmp = $this->parseWithOperator($field, $operator, $value);         
            if (!empty($queries_tmp))
				$queries[] = $queries_tmp;
			
        }        
        
        $this->buildCondition(current($queries));
        $queries = array_slice($queries, 1);
        
        foreach ($queries as $where) {            
            $this->buildCondition($where, $logic);
        }
        
        return $this->builder;
    }
    
    private function parseWithOperator($field, $operator, $value) {
        
        switch ($operator) {
            case Kendo2QueryBuilder::K_EQ :                
                return [$field, '=', $value];
                break;
            case Kendo2QueryBuilder::K_NEQ :
                return [$field, '<>', $value];
                break;
            case Kendo2QueryBuilder::K_ENDSWITH :
                return [$field, 'like', '%' . $value];
                break;
            case Kendo2QueryBuilder::K_STARTSWITH :
                return [$field, 'like', $value . '%'];
                break;
            case Kendo2QueryBuilder::K_CONTAINS :
                return [$field, 'like', '%' . $value . '%'];
                break;
            case Kendo2QueryBuilder::K_GTE :
                /*return [$field, '>=', DB::raw("STR_TO_DATE('$value','dd/mm/yyyy hh24:mi:ss')")];*/
                if ($value)
					return [$field, '>=', DB::raw("STR_TO_DATE('$value','%d/%m/%Y %H:%i:%S')")];
				else
					return [];
                break;
            case Kendo2QueryBuilder::K_LT :
                return [$field, '<',$value];
                break;
            case Kendo2QueryBuilder::K_LTE:
               /* return [$field, '<=', DB::raw("STR_TO_DATE('$value','dd/mm/yyyy hh24:mi:ss')")];*/
				if ($value)
					return [$field, '<=', DB::raw("STR_TO_DATE('$value','%d/%m/%Y %H:%i:%S')")];
				else
					return [];
                break;
            case Kendo2QueryBuilder::K_GT:
                return [$field, '>', $value];
                break;
        }        
    }
    
    protected function buildCondition(array $params, $logic = 'and') {
        
        list ($whereField, $whereOperator, $whereValue) = $params;
        $whereField = $this->parseField($whereField);
        if ($logic == Kendo2QueryBuilder::K_OR) {
            if (false === strpos($whereValue, '/') || false === (boolean) \DateTime::createFromFormat('d/m/Y', $whereValue))
                $this->builder->orWhere($whereField, $whereOperator, $whereValue);
                else {
                $this->builder->orWhereRaw('to_date(to_char(' . $whereField . ',\'dd/mm/yyyy\'),\'dd/mm/yyyy\') ' . $whereOperator .' to_date(\''. $whereValue .'\',\'DD/MM/YYYY\') ');
                }
        } else {
            if (false === strpos($whereValue, '/') || false === (boolean) \DateTime::createFromFormat('d/m/Y', $whereValue))
                $this->builder->where($whereField, $whereOperator, $whereValue);
                else {
                $this->builder->whereRaw('to_date(to_char(' . $whereField . ',\'dd/mm/yyyy\'),\'dd/mm/yyyy\') ' . $whereOperator .' to_date(\''. $whereValue .'\',\'DD/MM/YYYY\') ');
                }
        }
    }
    
    public function setNamespace($namespace, array $attr = []) {
        $this->namespaces[$namespace] = $attr;
    }
    
    protected function parseField($field) {
        foreach ($this->namespaces as $_namespace => $attrs) {
            if (in_array($field, $attrs)) {
                return $_namespace . '.' . $field;
            }
        }
        
        return $this->parseAlias($field);
    }
    
    /**
     * $name => $alias
     * @param array $aliases
     */
    public function setAliases(array $aliases = []) {
        $this->aliases = $aliases;
    }
    
    private  function parseAlias($alias) {
        foreach ($this->aliases as $name => $alias_) {
            if ($alias === $alias_) {
                return  $name;
            }
        }
        
        return $alias;
    }
    
    public function enum($field, array $values = []) {
        $this->enum[$field] = $values;
        
    }
    
    public function isEnum($field) {
        return isset($this->enum[$field]);
    }
    public function parseEnum($field, $operator, $value) {
        
        if ($this->isEnum($field) && isset($this->enum[$field][$value])) {
            return [$field, $operator, $this->enum[$field][$value]];
        }
        
        return [$field, $operator, $value];
    }
}

