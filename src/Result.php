<?php namespace CertifiedWebNinja\Caroline;

class Result
{
    private $data = [];

    public function __construct(array $data = array())
    {
        $this->data = $data;
    }

    public function __call($method, $args)
    {
        if (substr($method, 0, 3) === 'get') {
            $attribute = strtolower(substr($method, 3));
            if (array_key_exists($attribute, $this->data)) {
                return $this->data[$attribute];
            }
        }
    }
}
