<?php

class FormulaireBuilder
{
    private $fields = [];
    private $action;
    private $method;
    private $name;

    public function __construct($action, $method, $name)
    {
        $this->action = $action;
        $this->method = $method;
        $this->name = $name;

        $this->fields[] = "<form action='{$this->action}' method='{$this->method}' name='{$this->name}' >";
    }

    public function addTextField($name, $type = 'text', $placeholder = '')
    {
        $this->fields[] = "<label for='{$name}' class='label'>{$name} :</label>";
        $this->fields[] = "<input type='{$type}' name='{$name}' placeholder='{$placeholder}' class='input' />";
        $this->fields[] = "<br>";
    }

    public function addLink($url, $text, $target = '_self')
    {
        $this->fields[] = "<a href='{$url}' target='{$target}' class='link'>{$text}</a> <br>";
    }

    public function addSelect($name, $options)
    {
        $selectField = "<label for='{$name}' class='label'>{$name} :</label>";
        $selectField .= "<select name='{$name}' class='select'>";

        foreach ($options as $value => $label) {
            $selectField .= "<option value='{$value}'>{$label}</option>";
        }

        $selectField .= "</select>";

        $this->fields[] = $selectField;
    }

    public function addResultField($name, $value = '')
    {
        $this->fields[] = "<label for='{$name}' class='label'>{$name} :</label>";
        $this->fields[] = "<input type='text' name='{$name}' value='{$value}' readonly class='input' />";
    }

    public function addButton($name, $text)
    {
        $this->fields[] = "<button type='submit' name='{$name}' class='button'>{$text}</button>";
    }

    public function addTextarea($name, $placeholder = '')
    {
        $this->fields[] = "<label for='{$name}' class='label'>{$name} :</label>";
        $this->fields[] = "<textarea name='{$name}' placeholder='{$placeholder}' class='textarea'></textarea>";
    }

    public function generateForm()
    {
        $form = ""; // Initialisez la variable $form ici

        foreach ($this->fields as $field) {
            $form .= $field;
        }

        return $form;
    }

    public function __destruct()
    {
        // Le destructeur peut être utilisé pour nettoyer les ressources ou effectuer d'autres tâches de fin
    }
}

?>
