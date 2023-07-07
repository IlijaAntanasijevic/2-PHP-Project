<?php
    $file = file("../data/activity.txt") or die("Error opening file");
?>

<div class="container">
    <div class="bg-secondary rounded h-100 p-4">
        <table class="table table-hover">
            <thead>
                <th>IP</th>
                <th>Country</th>
                <th>Date - Time</th>
                <th>Page</th>
            </thead>
            <tbody>
                <?php
                    foreach ($file as $f):
                    list($ip,$country,$date,$page,$product) = explode("__",$f);
                ?>
                    <tr>
                        <td><?= $ip ?></td>
                        <td><?= $country ?></td>
                        <td><?= $date ?></td>
                        <td>
                            <?php
                                $pageString = $page;
                                if($page == "singleProduct"){
                                    $pageString = "<a href='admin.php?page=updateProduct&id=$product'>Product</a>";
                                }
                                echo $pageString;
                            ?>

                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>
