<?php namespace CertifiedWebNinja\Caroline;

use CertifiedWebNinja\Caroline\DataSets\AbstractDataSet;
use CertifiedWebNinja\Caroline\DataSets\AFINN;

class Analysis
{
    const REGEX_SPECIAL_CHARS = '/[^a-zA-Z- ]+/';
    const REGEX_MULTIPLE_SPACES = '/ {2,}/';

    private $dataSet = [];

    public function __construct(AbstractDataSet $dataSet = null)
    {
        $this->dataSet = $dataSet ?: new AFINN;
    }

    public function analyze($string = null)
    {
        $dataSet = $this->dataSet->getDataSet();
        $tokens = $this->tokenize($string);
        $length = count($tokens);
        $score = 0;
        $words = [];
        $positive = [];
        $negative = [];
        while ($length--) {
            $word = $tokens[$length];
            if (array_key_exists($word, $dataSet)) {
                $item = $dataSet[$word];
                array_push($words, $word);
                if ($item > 0) {
                    array_push($positive, $word);
                }
                if ($item < 0) {
                    array_push($negative, $word);
                }
                $score += $item;
            }
        }
        return new Result([
            'string' => $string,
            'score' => $score,
            'comparative' => ($score / $length),
            'tokens' => $tokens,
            'words' => $words,
            'positive' => $positive,
            'negative' => $negative
        ]);
    }

    private function tokenize($string)
    {
        $string = preg_replace(self::REGEX_SPECIAL_CHARS, '', $string);
        $string = preg_replace(self::REGEX_MULTIPLE_SPACES, ' ', $string);
        $string = strtolower($string);
        return explode(' ', $string);
    }
}