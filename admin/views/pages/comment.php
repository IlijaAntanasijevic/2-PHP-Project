<?php
    global $conn;
    $mainQuery = "SELECT c.*,p.name as product,u.username as username 
              FROM comment c INNER JOIN product p ON c.product_id = p.product_id 
              INNER JOIN user u ON c.user_id = u.user_id";
    $query = $mainQuery . " WHERE c.answer_id IS NULL";
    $select = $conn->query($query);
    $comments = $select->fetchAll();

?>
<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
        <div class="bg-secondary rounded p-4">
            <h6 class="mb-4">Comments</h6>
            <h6 class="alert-danger w-50 mx-auto text-center py-2 ia-error" id="limit">You can display at least 3 comments</h6>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Username</th>
                    <th scope="col">Product</th>
                    <th scope="col">Comment</th>
                    <th scope="col">#</th>

                </tr>
                </thead>
                <tbody>
                <?php  foreach ($comments as $index => $c): ?>

                    <?php
                        $queryAnswers = $mainQuery . " WHERE answer_id = $c->comment_id";
                        $selectAnswers = $conn->query($queryAnswers);
                        $answers = $selectAnswers->fetchAll();

                    ?>
                    <tr class="my-5 border-3 border-light">
                        <th scope="row"><?= $index + 1 ?></th>
                        <td><?= $c->username ?></td>
                        <td class="text-white"><?=$c->product ?></td>
                        <td><?= $c->comment ?></td>
                        <td class="text-white"></td>
                            <?php if(count($answers)): ?>
                                <tr class="border-0">
                                    <th class="border-0">Answers: </th>
                                </tr>
                                <tr>
                                    <th></th>
                                    <th></th>
                                    <th scope="col">Username</th>
                                    <th scope="col">Product</th>
                                    <th scope="col">Replay</th>
                                </tr>
                            <?php endif; ?>

                            <?php foreach ($answers as $a):?>
                            <tr>
                                <td class="border-0"></td>
                                <td class="border-0"></td>
                                <td class="border-0"><?= $a->username ?></td>
                                <td class="border-0"><?= $a->product ?></td>
                                <td class="border-0"><?= $a->comment ?></td>
                            </tr>
                            <?php endforeach; ?>
                    </tr>
                    <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

