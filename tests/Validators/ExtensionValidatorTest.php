<?php

namespace Tests\Validators;

use Tests\BaseTestCase;

/**
 * Class ExtensionValidatorTest
 *
 * @package Tests
 */
class ExtensionValidatorTest extends BaseTestCase
{
    public const RULE = 'extension,png;jpg;gif';

    public function testItSucceedsWhenThereIsNoInputFile()
    {
        $result = $this->gump->validate([], [
            'test' => self::RULE,
        ]);

        $this->assertTrue($result);
    }

    public function testItSucceedsWhenThereIsNoInputFileSubmittedFromBrowser()
    {
        $input = [
            'name' => '',
            'full_path' => '',
            'type' => '',
            'error' => 4,
            'size' => 0,
        ];

        $this->assertTrue($this->validate(self::RULE, $input));
    }

    public function testItSuccessesWhenExtensionMatches()
    {
        $input = [
            'name' => 'screenshot.png',
            'type' => 'image/png',
            'tmp_name' => '/tmp/phphjatI9',
            'error' => 0,
            'size' => 22068,
        ];

        $this->assertTrue($this->validate(self::RULE, $input));
    }

    public function testItFailsWhenExtensionDoesntMatch()
    {
        $input = [
            'name' => 'document.pdf',
            'type' => 'application/pdf',
            'tmp_name' => '/tmp/phphjatI9',
            'error' => 0,
            'size' => 22068,
        ];

        $this->assertNotTrue($this->validate(self::RULE, $input));
    }

    public function testItFailsWhenFileWasNotSuccessfullyUploaded()
    {
        $input = [
            'name' => 'screenshot.png',
            'type' => 'image/png',
            'tmp_name' => '/tmp/phphjatI9',
            'error' => 4,
            'size' => 22068,
        ];

        $this->assertNotTrue($this->validate(self::RULE, $input));
    }

    public function testItFailsWhenUploadErrorOccurred()
    {
        // Error code 1 = UPLOAD_ERR_INI_SIZE (file exceeds upload_max_filesize)
        $input = [
            'name' => 'screenshot.png',
            'type' => 'image/png',
            'tmp_name' => '/tmp/phphjatI9',
            'error' => 1,
            'size' => 0,
        ];

        $this->assertNotTrue($this->validate(self::RULE, $input));
    }

    public function testItFailsWhenPartialUploadErrorOccurred()
    {
        // Error code 3 = UPLOAD_ERR_PARTIAL (file was only partially uploaded)
        $input = [
            'name' => 'screenshot.png',
            'type' => 'image/png',
            'tmp_name' => '/tmp/phphjatI9',
            'error' => 3,
            'size' => 1000,
        ];

        $this->assertNotTrue($this->validate(self::RULE, $input));
    }

    public function testItFailsWhenInputIsNotArray()
    {
        $result = $this->gump->validate([
            'test' => 'not-an-array',
        ], [
            'test' => self::RULE,
        ]);

        $this->assertNotTrue($result);
    }
}
