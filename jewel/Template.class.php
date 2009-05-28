<?php
class Template extends Context {

	public function show($name) {
        $path = DOCPATH . 'vw/' . $name . '.php';
        if (file_exists($path) == false) {
                throw new Exception('Template not found in '. $path);
                return false;
        }

        // Load variables
        foreach ($this->vars as $key => $value) {
                $$key = $value;
        }

        include ($path);
	}

}
?>