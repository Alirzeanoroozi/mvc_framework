<h1>List</h1>

<?php
$this->title = "List";
use Alireza\Untitled\core\Application;
use Alireza\Untitled\models\User;
$statement = Application::$app->db->pdo->prepare("Select * from inscriptions");
$statement->execute();
$allQueries = $statement->fetchAll();
?>
<section>
    <table border=\'1\' cellpadding=\'15\'>
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
        <tbody>';
        <?php
            foreach (array_slice($allQueries, 5 * $page, 5) as $inscription){
                $author = (new User)->findOne([User::primaryKey()=>$inscription["author_id"]]);
                $id = $inscription["id"];
                $author_id = $inscription["author_id"];
                echo '<tr><th>'. $id. '</th><th>'. $inscription["subject"]. '</th><th><a href="/profile?=$author_id">'. $author->firstname. '</a></th><th>'. $inscription["content"]. '</th><th>'. "<a href=\"view?id=$id\"><span>&#9956;</span></a><a href=\"edit?id=$id\"><span>&#9999;</span></a><a href=\"delete?id=$id\"><span>&#9940;</span></a>". '</th></tr>';
            }
        ?>
        </tbody>
    </table>
    <div>
        <?php for($i=0; 5 * $i < count($allQueries); $i++) echo "<a href='/list?page=$i'>$i </a>"; ?>
    </div>
</section>