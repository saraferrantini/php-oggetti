<?php
class FormCreator {
    private $action;
    private $method;
    private $fields = [];

    public function __construct($action = '#', $method = 'POST') {
        $this->action = $action;
        $this->method = $method;
    }

    public function addField($name, $type = 'text', $label = '', $value = '', $attributes = []) {
        $this->fields[$name] = [
            'type' => $type,
            'label' => $label,
            'value' => $value,
            'attributes' => $attributes
        ];
    }

    public function generateForm() {
        $formHTML = '<form action="' . $this->action . '" method="' . $this->method . '" class="form-horizontal">';

        foreach ($this->fields as $name => $field) {
            $formHTML .= '<div class="form-group">';
            if (!empty($field['label'])) {
                $formHTML .= '<label for="' . $name . '" class="control-label col-sm-2">' . $field['label'] . '</label>';
            }
            $formHTML .= '<div class="col-sm-10">';
            $formHTML .= '<input type="' . $field['type'] . '" name="' . $name . '" id="' . $name . '" value="' . $field['value'] . '" class="form-control"';
            foreach ($field['attributes'] as $attribute => $attrValue) {
                $formHTML .= ' ' . $attribute . '="' . $attrValue . '"';
            }
            $formHTML .= '>';
            $formHTML .= '</div>';
            $formHTML .= '</div>';
        }

        $formHTML .= '<div class="form-group">';
        $formHTML .= '<div class="col-sm-offset-2 col-sm-10">';
        $formHTML .= '<button type="submit" class="btn btn-primary">Submit</button>';
        $formHTML .= '</div>';
        $formHTML .= '</div>';

        $formHTML .= '</form>';

        return $formHTML;
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bootstrap Form Example</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>

<div class="container">
    <h2>Bootstrap Form Example</h2>
    <?php
 
    $form = new FormCreator('/process.php', 'POST');
    $form->addField('name', 'text', 'Name', '', ['placeholder' => 'Enter your name']);
    $form->addField('email', 'email', 'Email', '', ['placeholder' => 'Enter your email']);
    $form->addField('message', 'textarea', 'Message', '', ['placeholder' => 'Enter your message', 'rows' => 4]);
    $formHTML = $form->generateForm();
    echo $formHTML;
    ?>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
