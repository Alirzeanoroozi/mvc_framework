<h1>List</h1>
<?php
$this->title = "List";

use Alireza\Untitled\core\form\Form;
use Alireza\Untitled\models\ListModel;
use Alireza\Untitled\models\User;

/** @var ListModel $model **/

echo $form = Form::begin('', 'get') ?>

<?php echo $form->field($model, 'searchInput')?>

<button type="submit" class="btn btn-primary">Submit</button>

<?php echo Form::end() ?>

<br><br>

<table border='1' cellpadding='15'>
    <thead>
    <tr>
        <th>
            <h1>id</h1>
        </th>
        <th>
            <h1>Subject</h1>
        </th>
        <th>
            <h1>Author</h1>
        </th>
        <th>
            <h1>Content</h1>
        </th>
        <th>
            <h1>Actions</h1>
        </th>
    </tr>
    </thead>
    <tbody>
    <?php
        foreach (array_slice($inscriptions, 5 * $page, 5) as $inscription){
            $author = (new User)->findOne([User::primaryKey()=>$inscription["author_id"]]);
            $id = $inscription[0];
            $author_id = $inscription["author_id"];
            echo '<tr>'.
                    '<th>'.
                        $id.
                    '</th>'.
                    '<th>'.
                        $inscription["subject"].
                    '</th>'.
                    '<th>'.
                        "<a href=\"profile?id=$author_id\">".
                            $author->firstname.
                        '</a>'.
                    '</th>'.
                    '<th>'.
                        $inscription["content"].
                    '</th>'.
                    '<th>'.
                        "<a href=\"view?id=$id\">
                            <span>
                                &#9956;
                            </span>
                         </a>
                         <a href=\"edit?id=$id\">
                            <span>
                                &#9999;
                            </span>
                         </a>
                         <a href=\"delete?id=$id\">
                            <span>
                                &#9940;
                            </span>
                         </a>".
                    '</th>'.
                '</tr>';
        }
    ?>
    </tbody>
</table>
<div>
    <?php for($i=0; 5 * $i < count($inscriptions); $i++)
        echo "<a href='/list?page=$i&searchInput=$searchInput'> $i </a>"; ?>
</div>
