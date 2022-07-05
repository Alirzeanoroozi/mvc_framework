<?php
$this->title = "Write";
use Alireza\Untitled\core\form\Form;

echo $form = Form::begin('', 'post') ?>

<?php echo $form->field($model, 'subject')?>

<?php echo $form->field($model, 'content')->renderInput()?>
<button type="submit" class="btn btn-primary">Submit</button>

<?php echo Form::end() ?>



