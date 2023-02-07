<?php

declare(strict_types=1);

namespace Yii\FilePond\Concern;

/**
 * HasPluginFileValidateSize provides methods for managing the file validate size plugin.
 */
trait HasPluginFileValidateSize
{
    /**
     * Return new instance with enable or disable file size validation.
     *
     * @param bool $value Enable or disable file size validation. Default: `true`.
     */
    public function allowFileSizeValidation(bool $value): self
    {
        $new = clone $this;
        $new->options['allowFileSizeValidation'] = $value;

        return $new;
    }

    /**
     * Return new instance with a new label for max files size.
     *
     * @param string $value The label for max files size. Default: `'Maximum file size is {filesize}'`.
     */
    public function labelMaxFileSize(string $value): self
    {
        $new = clone $this;
        $new->options['labelMaxFileSize'] = $value;

        return $new;
    }

    /**
     * Return new instance with a new label for max file size exceeded.
     *
     * @param string $value The label for max file size exceeded. Default: `'File is too large'`.
     */
    public function labelMaxFileSizeExceeded(string $value): self
    {
        $new = clone $this;
        $new->options['labelMaxFileSizeExceeded'] = $value;

        return $new;
    }

    /**
     * Return new instance with a new label for max total file size.
     *
     * @param string $value The label for max total file size. Default: `'Maximum total file size is {filesize}'`.
     */
    public function labelMaxTotalFileSize(string $value): self
    {
        $new = clone $this;
        $new->options['labelMaxTotalFileSize'] = $value;

        return $new;
    }

    /**
     * Return new instance with a new label for max total file size exceeded.
     *
     * @param string $value The label for max total file size exceeded. Default: `'Maximum total size exceeded'`.
     */
    public function labelMaxTotalFileSizeExceeded(string $value): self
    {
        $new = clone $this;
        $new->options['labelMaxTotalFileSizeExceeded'] = $value;

        return $new;
    }

    /**
     * Return new instance with a new max file size.
     *
     * @param string $value The max file size. Example: '3MB'. Default: `null`.
     */
    public function maxFileSize(string $value): self
    {
        $new = clone $this;
        $new->options['maxFileSize'] = $value;

        return $new;
    }

    /**
     * Return new instance with maximum size of all files.
     *
     * @param string $value The max total file size. Example: '3MB'. Default: `null`.
     */
    public function maxTotalFileSize(string $value): self
    {
        $new = clone $this;
        $new->options['maxTotalFileSize'] = $value;

        return $new;
    }

    /**
     * Return new instance with a new min files size.
     *
     * @param int $value The min files size. Example: '1MB'. Default: `null`.
     */
    public function minFileSize(int $value): self
    {
        $new = clone $this;
        $new->options['minFileSize'] = $value;

        return $new;
    }
}
