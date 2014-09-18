<?php namespace CertifiedWebNinja\Caroline;

class Analysis
{
    const REGEX_SPECIAL_CHARS = '/[^a-zA-Z- ]+/';
    const REGEX_MULTIPLE_SPACES = '/ {2,}/';

    private $words = [];

    public function __construct()
    {
        $words = file_get_contents(__DIR__.'/afinn.json');
        $this->words = json_decode($words, true);
    }

    public function analyze($string = null)
    {
        $tokens = $this->tokenize($string);
        $length = count($tokens);
        $score = 0;
        $words = [];
        $positive = [];
        $negative = [];
        while ($length--) {
            $word = $tokens[$length];
            if (array_key_exists($word, $this->words)) {
                $item = $this->words[$word];
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