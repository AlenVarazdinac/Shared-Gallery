<?php

/**
 * Handles view related stuff
 */
class View
{
    private $_layout = 'layout';

    /**
     * Change layout
     *
     * @param string $name layout name
     *
     * @return $this
     */
    public function layout($name)
    {
        $this->_layout = basename($name);
        return $this;
    }

    /**
     * Render view file
     *
     * @param string $name view name
     * @param array  $args view arguments
     *
     * @return $this
     */
    public function render($name, $args = [])
    {
        // First we need to "render" {view}.php and capture its output
        ob_start();
        extract($args);
        include BASEPATH . "app/view/$name.php";
        $content = ob_get_clean();

        // Then we render {layout}.php and pass view output as $content
        if ($this->_layout) {
            include BASEPATH . "app/view/{$this->_layout}.php";
        } else {
            echo $content;
        }

        return $this;
    }
}