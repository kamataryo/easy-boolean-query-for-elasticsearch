<?php
namespace Kamataryo;


class EasyBooleanQueryForElasticsearch {
  public $dlsQuery;
  public $operatorMap = [
    '（' => '(',
    '）' => ')',
    '　' => ' ',
    '｜' => '|',
    'ー' => '-',
  ];

  function __construct($dslQuery) {
     $this->dslQuery = $this->normalize($dslQuery);
  }

  private function normalize($query) {
    // canonicalize
    foreach ($this->operatorMap as $key => $value) {
      $query = str_replace($key, $value, $query);
    }

    // remove duplicaition
    $operators = array_values($this->operatorMap);
    foreach ($operators as $operator) {
      $query = str_replace(' ' . $operator, $operator, $query);
      $query = str_replace($operator . ' ', $operator, $query);
    }
    return $query;
  }

  public function parse() {
    return $this->dslQuery;
  }
}
