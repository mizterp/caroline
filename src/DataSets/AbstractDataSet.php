<?php namespace CertifiedWebNinja\Caroline\DataSets;

abstract class AbstractDataSet
{
    protected $dataSet = [];

    public function getDataSet()
    {
        return $this->dataSet;
    }

    public function extend(array $extras = array())
    {
        $this->dataSet = array_merge($this->dataSet, $extras);
    }

    public function replace(array $replace = array())
    {
        $this->dataSet = array_replace($this->dataSet, $replace);
    }
}