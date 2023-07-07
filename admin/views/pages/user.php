
<?php
    global $conn;
    $blockedUsersPath = "../data/blocked.txt";
    $allUsers = selectAll("user");
    $file = file($blockedUsersPath);

    $blockedUsersId = [];
    foreach ($file as $f){
        $blockedUsersId[] = (int)explode("__",$f)[0];
    }



?>



<div class="container-fluid pt-4 px-4">
    <div class="row vh-100 bg-secondary rounded align-items-center justify-content-center mx-0">
        <div class="bg-secondary rounded h-100 p-4">
            <h6 class="mb-4">Users</h6>
            <p class="alert alert-danger ia-error" id="usersErrorMessage"></p>
            <table class="table table-bordered border-dark align-middle text-center">
                <thead>
                <tr>
                    <th scope="col" class="text-white">Name</th>
                    <th scope="col" class="text-white">Email</th>
                    <th scope="col" class="text-white">Phone</th>
                    <th scope="col" class="text-white">Role</th>
                    <th scope="col" class="text-white">Action</th>

                </tr>
                </thead>
                <tbody>
                <?php
                foreach($allUsers as $user):
                    $id = $user->user_id;
                    $query = "SELECT name as role FROM role WHERE $user->role_id = role_id";
                    $select = $conn->query($query);
                    $role = $select->fetch()->role;
                    ?>
                    <tr>
                        <td class="text-white"><?= $user->name . " " . $user->last_name?></td>
                        <td class="text-white"><?= $user->email ?></td>
                        <td class="text-white"><?= $user->phone ?></td>
                        <td class="text-white"><?= $role ?></td>
                        <?php
                            if(!in_array($id,$blockedUsersId)):
                        ?>
                            <td><p class="btn btn-danger m-0 blockUser" id= "<?= $id ?>">Block</p></td>
                        <?php
                                else:
                        ?>
                            <td><p class="btn btn-success m-0 unblockUser" id= "<?= $id ?>">Unblock</p></td>
                        <?php endif; ?>

                    </tr>
                <?php endforeach; ?>

                </tbody>
            </table>
        </div>
    </div>
</div>

