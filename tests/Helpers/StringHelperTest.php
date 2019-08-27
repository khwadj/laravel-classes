<?php
declare(strict_types=1);

use Khwadj\Helpers\StringHelper;
use PHPUnit\Framework\TestCase;

final class StringHelperTest extends TestCase
{
  public function testEndsWith(): void
  {
    $this->assertTrue(StringHelper::endsWith('banana-orange', 'orange'));
    $this->assertFalse(StringHelper::endsWith('banana-orange', 'orang'));
  }
}

