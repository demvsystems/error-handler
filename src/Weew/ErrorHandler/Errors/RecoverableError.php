<?php

namespace Weew\ErrorHandler\Errors;

class RecoverableError implements IRecoverableError {
    /**
     * @var int
     */
    protected $number;

    /**
     * @var string
     */
    protected $string;

    /**
     * @var string
     */
    protected $file;

    /**
     * @var int
     */
    protected $line;

    /**
     * RecoverableError constructor.
     *
     * @param int $number
     * @param string $string
     * @param string $file
     * @param int $line
     */
    public function __construct($number, $string, $file, $line) {
        $this->number = $number;
        $this->string = $string;
        $this->file = $file;
        $this->line = $line;
    }

    /**
     * @return int
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * @return string
     */
    public function getString() {
        return $this->string;
    }

    /**
     * @return string
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * @return int
     */
    public function getLine() {
        return $this->line;
    }
}
