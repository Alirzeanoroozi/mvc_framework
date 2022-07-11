<?php
$this->title = "Login";
use Alireza\Untitled\core\form\Form;
use Alireza\Untitled\models\LoginModel;

/** @var LoginModel $model */
?>

<h1>login</h1>
<br>
<?php echo $form = Form::begin('', 'post') ?>

<?php echo $form->field($model, 'email')?>

<?php echo $form->field($model, 'password', "password")?>

<button type="submit" class="btn btn-primary">Submit</button>

<?php echo Form::end() ?>



