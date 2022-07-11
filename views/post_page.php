<?php
$this->title = "Post";
use Alireza\Untitled\core\form\Form;
use Alireza\Untitled\models\PostModel;

/** @var PostModel $model */
?>
<h1>Post</h1>
<?php echo $form = Form::begin('', 'post') ?>

<?php echo $form->field($model, 'subject')?>

<?php echo $form->field($model, 'content')->renderInput()?>

<button type="submit" class="btn btn-primary">Submit</button>

<?php echo Form::end() ?>



