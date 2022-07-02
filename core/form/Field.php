<?php

namespace Alireza\Untitled\core\form;

use Alireza\Untitled\core\Model;

class Field
{
    public Model $model;
    public string $attribute;
    private string $type;

    public function __construct(Model $model, string $attribute, string $type = "text")
    {
        $this->type = $type;
        $this->model = $model;
        $this->attribute = $attribute;
    }
    public function __toString()
    {
        return sprintf('
        <div class="form-group">
            <label>%s</label>
            <input type="%s" name="%s" value="%s" class="form-control%s">
            <div class="invalid-feedback">
                %s
            </div>
        </div>
        ',
            $this->model->label()[$this->attribute] ?? $this->attribute,
            $this->type,
            $this->attribute,
            $this->model->{$this->attribute},
            $this->model->hasError($this->attribute) ? ' is-invalid': '',
            $this->model->getFirstError($this->attribute)
        );
    }
}