<?php


namespace TgSdk\objects;


class BaseObject
{
    /**
     * BaseObject constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        try {
            foreach ($data as $field => $value) {
                if (property_exists($this, $field)) {
                    $this->$field = $this->getObject($field, $value) ?: $value;
                }
            }
            return $this;
        } catch (\Throwable $e) {
            return false;
        }
    }

    /**
     * Creating object by it's name and populate it with data
     * @param $name
     * @param $fields
     * @return false|mixed
     */
    public function getObject($name, $fields)
    {
        if ($name === 'from') {
            $class = 'TgSdk\objects\User';
        } else {
            $c = ucfirst(str_replace('_', '', ucwords($name, '_')));
            $class = 'TgSdk\objects\\' . ucfirst(str_replace('_', '', ucwords($name, '_')));
        }
        if (!class_exists($class)) {
            return false;
        }
        return new $class($fields);
    }
}