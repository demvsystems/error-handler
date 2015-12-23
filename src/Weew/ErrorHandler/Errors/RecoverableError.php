<?php

namespace Weew\ErrorHandler\Errors;

class RecoverableError implements IRecoverableError {
    /**
     * @var mixed
     */
    protected $number;

    /**
     * @var mixed
     */
    protected $string;

    /**
     * @var mixed
     */
    protected $file;

    /**
     * @var mixed
     */
    protected $line;

    /**
     * RecoverableError constructor.
     *
     * @param $number
     * @param $string
     * @param $file
     * @param $line
     */
    public function __construct($number, $string, $file, $line) {
        $this->number = $number;
        $this->string = $string;
        $this->file = $file;
        $this->line = $line;
    }

    /**
     * @return mixed
     */
    public function getNumber() {
        return $this->number;
    }

    /**
     * @return mixed
     */
    public function getString() {
        return $this->string;
    }

    /**
     * @return mixed
     */
    public function getFile() {
        return $this->file;
    }

    /**
     * @return mixed
     */
    public function getLine() {
        return $this->line;
    }
}
