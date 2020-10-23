<?php declare(strict_types=1);
use PHPUnit\Framework\TestCase;
require_once( __DIR__ . '/easy-boolean-query-for-elasticsearch.php');

final class EasyBooleanQueryForElasticsearchTest extends TestCase
{
    public function testCanParseSingleQuery(): void
    {
        $query = new Kamataryo\EasyBooleanQueryForElasticsearch('Hello');
        $this->assertEquals(
          $query->parse(),
          'Hello'
        );
    }

    public function testCanNormalizeQuery(): void
    {
        $query = new Kamataryo\EasyBooleanQueryForElasticsearch('　　　（　（　Hello　｜　Bye　)　　　　World　）　　　　　　');
        $this->assertEquals(
          $query->dslQuery,
          '((Hello|Bye) World)'
        );
    }
}
