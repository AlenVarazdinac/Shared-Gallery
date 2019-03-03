<?php

class View
{
    private $layout = 'layout';

    /**
     * Change layout
     *
     * @param $name
     * $return $this
     */
    public function layout($name){
        $this->layout = basename($name);
        return $this;
    }

    /**
     * Render view file
     * @param $name
     * @param array $args
     * @return $this
     */
    public function render($name, $args = []){
        // First we need to "render" {view}.php and capture its output
        ob_start();
        extract($args);
        include BASEPATH . "app/view/$name.php";
        $content = ob_get_clean();

        // Then we render {layout}.php and pass view output as $content
        if($this->layout){
            include BASEPATH . "app/view/{$this->layout}.php";
        }else{
            echo $content;
        }

        return $this;
    }
}