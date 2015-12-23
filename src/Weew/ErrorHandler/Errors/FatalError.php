<?php

namespace Weew\ErrorHandler\Errors;

class FatalError implements IFatalError {
    /**
     * @var mixed
     */
    protected $type;

    /**
     * @var mixed
     */
    protected $message;

    /**
     * @var mixed
     */
    protected $file;

    /**
     * @var mixed
     */
    protected $line;

    /**
     * FatalError constructor.
     *
     * @param $type
     * @param $message
     * @param $file
     * @param $line
     */
    public function __construct($type, $message, $file, $line) {
        $this->type = $type;
        $this->message = $message;
        $this->file = $file;
        $this->line = $line;
    }

    /**
     * @return mixed
     */
    public function getType() {
        return $this->type;
    }

    /**
     * @return mixed
     */
    public function getMessage() {
        return $this->message;
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
