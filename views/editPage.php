<?php
$this->title = "Edit";
use Alireza\Untitled\core\form\Form;
use Alireza\Untitled\models\EditModel;

/** @var EditModel $model */
?>
<h1>Edit inscription <?php echo $model->id ?> </h1>

<?php echo $form = Form::begin('', 'post') ?>

<?php echo $form->field($model, 'subject')?>

<?php echo $form->field($model, 'content')->renderInput()?>

<input type="hidden" name="id" value="<?= $model->id ?>">

<button type="submit" class="btn btn-primary">Submit</button>

<?php echo Form::end() ?>



