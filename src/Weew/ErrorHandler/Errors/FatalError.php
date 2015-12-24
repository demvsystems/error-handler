<?php

namespace Weew\ErrorHandler\Errors;

class FatalError implements IFatalError {
    /**
     * @var mixed
     */
    protected $type;

    /**
     * @var string
     */
    protected $message;

    /**
     * @var string
     */
    protected $file;

    /**
     * @var int
     */
    protected $line;

    /**
     * FatalError constructor.
     *
     * @param mixed $type
     * @param string $message
     * @param string $file
     * @param int $line
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
     * @return string
     */
    public function getMessage() {
        return $this->message;
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
