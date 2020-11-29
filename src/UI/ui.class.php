<?php

namespace UI;


class UI
{
    private static ?UI $instance = null;
    private array $contents ;

    private function __construct()
    {
    }

    public static function getInstance(): UI
    {
        if (self::$instance == null)
            self::$instance = new self;
        return self::$instance;
    }

    /**
     * Set contents to the ui
     * 
     * @param array $contents
     */
    public function setContents(array $contents = []) : void
    {
        $this->contents=$contents;
    }

    /**
     * Creates HTML Body 
     */
    public  function create(): void
    {
        foreach ($this->contents as $content) {
            $content->create();
        }
    }

    /**
     * Shows HTML Body 
     */
    public function show(): void
    {
        foreach ($this->contents as $content) {
            $content->show();
        }
    }
}
