<?php
function selectAll($table,$addQuery = ""){
    global $conn;
    $query = "SELECT * FROM $table $addQuery";
    $result = $conn->query($query);
    return $result->fetchAll();
}

function selectProductSingle($productID){
    global $conn;
    $query = "
    SELECT p.*,c.name as color,b.name as brand, g.name as gender,ct.name as category
    FROM product p INNER JOIN brend b ON p.brend_id = b.brend_id INNER JOIN gender g ON p.gender_id = g.gender_id 
    INNER JOIN color c ON p.color_id = c.color_id INNER JOIN category ct ON p.category_id = ct.category_id
    WHERE p.product_id = $productID";
    $result = $conn->query($query);
    return $result->fetch();
}

define("perPage",9);
function selectProducts($limit = 0){
    global $conn;
    $limitTmp = $limit;
    $query = "SELECT * FROM product ORDER BY date DESC LIMIT :limit, :perPage";
    $select = $conn->prepare($query);

    $limit = (int)$limit * perPage;
    $select->bindParam(":limit",$limit,PDO::PARAM_INT);
    $perPage = perPage;
    $select->bindParam(":perPage",$perPage,PDO::PARAM_INT);
    $select->execute();
    $products = $select->fetchAll();
    $products = getLastTwoPrices($products);

     return $products;
}

function selectAllPrices($id){
    global $conn;
    $query = "SELECT price FROM price WHERE product_id = $id ORDER BY date DESC LIMIT 2";
    $result = $conn->query($query);
    return $result->fetchAll();
}

function countOfProducts($where=""){
    global $conn;
    $query = "SELECT COUNT(*) as number FROM product $where";
    $result = $conn->query($query);
    $count = $result->fetch();
    return $count->number;
}

function filterType($genderID,$categoryID,$colorID,$brendID,$sort,$maxPrice,$minPrice,$limit){
    global $conn;
    $addANDInQuery = false;
    $query = "SELECT DISTINCT p.* FROM product p INNER JOIN price ON p.product_id = price.product_id";

        if($genderID != null && $categoryID != null){
            $query .= " WHERE (p.gender_id = :gID AND p.category_id = :catID) ";
            $addANDInQuery = true;
        }

        if($colorID != null && $addANDInQuery){
            $query.= " AND p.color_id = :colorID ";

        }
        else if($colorID != null){
            $query.= " WHERE p.color_id = :colorID ";
            $addANDInQuery = true;

        }

        if($brendID != null && $addANDInQuery){
            $query .= " AND p.brend_id = :brendID ";

        }
        else if($brendID != null){
            $query .= " WHERE p.brend_id = :brendID ";
            $addANDInQuery = true;
        }
        if($addANDInQuery){
            $query .= " AND (price.price BETWEEN $minPrice and $maxPrice) ";
        }
        else {
            $query .= " WHERE price.price BETWEEN $minPrice and $maxPrice";
        }


        if($sort == 'new'){
            $query .= " ORDER BY p.date DESC ";
        }
        else if($sort == "old"){
            $query .= " ORDER BY p.date ASC";
        }
        else if($sort == "price-asc"){
            $query .= " ORDER BY price.price ASC";
        }
        else if ($sort == "price-desc"){
            $query .= " ORDER BY price.price DESC";
        }
        $limit = (int)$limit * perPage;
        $perPage = perPage;
        $query .= " LIMIT $limit, $perPage";


        $select = $conn->prepare($query);
    if($genderID != null && $categoryID != null){
        $select->bindParam(":gID",$genderID);
        $select->bindParam(":catID",$categoryID);
    }
    if($colorID != null){
        $select->bindParam(":colorID",$colorID);
    }

    if($brendID != null){
        $select->bindParam(":brendID",$brendID);
    }

    $select->execute();
    $products = $select->fetchAll();
    $tmp = [];

    if(!count($products)){
        return $products;
        die;
    }

    else {
        foreach ($products as $i => $p){
            if(!in_array($p,$tmp)){//$i > 0 &&
                $tmp[] = $p;
            }
        }
    }

    $products = $tmp;
    $products = getLastTwoPrices($products);
    return $products;

}

function getLastTwoPrices($products){
    global $conn;
    $productsID = [];
    foreach($products as $p){
        $productsID[] = $p->product_id;
    }
    $productsID = implode(",",$productsID);

    $queryPrice = "SELECT * FROM price WHERE product_id IN ($productsID) ORDER BY date DESC";
    $selectPrice = $conn->query($queryPrice);
    #$selectPrice->execute();
    $price = $selectPrice->fetchAll();
    foreach($products as $p){
        $newPrice = "";
        $oldPrice = null;
        $now = time();
        $date = 0;
        $lastDate = 0;
        foreach ($price as $pr){
            if($p->product_id == $pr->product_id){
                $curDate = strtotime($pr->date);
                if($curDate < $now && $curDate > $date){
                    $date = $curDate;
                    $newPrice = $pr->price;
                }
                else if($curDate < $date && $curDate < $lastDate){
                    $oldPrice = $pr->price;
                }
            }
            $lastDate = strtotime($pr->date);
        }
        $p->newPrice = $newPrice;
        $p->oldPrice = $oldPrice;
    }
    return $products;
}
function checkIfExist($table,$column,$value) {
    global $conn;
    $query = "SELECT * FROM $table WHERE $column = '$value'";
    $select = $conn->query($query);
    $result = $select->fetch();

     if($result){
        return true;
    }
    return false;


}

function loginUser($username,$hashPassword){
    global $conn;
    $query = "SELECT u.*,r.name AS role 
              FROM user u INNER JOIN role r ON u.role_id = r.role_id 
              WHERE username = :user AND password = :pass";
    $select = $conn->prepare($query);
    $select->bindParam(":user",$username);
    $select->bindParam(":pass",$hashPassword);
    $select->execute();
    return $select->fetch();
}

function registerUser($name,$lastname,$username,$phone,$email,$password){
    global $conn;
    $query = "INSERT INTO user(username,name,last_name,email,phone,password,role_id)
              VALUES(:username,:name,:lName,:email,:phone,:pass,1)";
    $insert = $conn->prepare($query);
    $insert->bindParam(":username",$username);
    $insert->bindParam(":name",$name);
    $insert->bindParam(":lName",$lastname);
    $insert->bindParam(":email",$email);
    $insert->bindParam(":phone",$phone);
    $insert->bindParam(":pass",$password);

    return $insert->execute();

}

function insertReview($message,$stars,$userID,$productID){
    global $conn;
    $query = "INSERT INTO rating(rating,description,user_id,product_id)
              VALUES(:rating,:msg,:user,:product)";
    $insert = $conn->prepare($query);
    $insert->bindParam(":rating",$stars);
    $insert->bindParam(":msg",$message);
    $insert->bindParam(":user",$userID);
    $insert->bindParam(":product",$productID);
    return $insert->execute();

}

function checkPurchased($userID,$productID){
    global $conn;
    $query = "SELECT * FROM cart c INNER JOIN cart_product cp ON c.cart_id = cp.cart_id WHERE c.user_id = :user AND cp.product_id = :product";
    $select = $conn->prepare($query);
    $select->bindParam(":user",$userID);
    $select->bindParam(":product",$productID);
    $select->execute();
    return $select->rowCount();
}

function checkIfExistReview($userID,$productID) {
    global $conn;
    $query = "SELECT * FROM rating WHERE user_id = :user AND product_id = :product";
    $select = $conn->prepare($query);
    $select->bindParam(":user",$userID);
    $select->bindParam(":product",$productID);
    $select->execute();
    return $select->rowCount();
}
function getNumberOfStars($number,$productID){
    global $conn;
    $query = "SELECT COUNT(*) as total FROM rating WHERE rating = $number AND product_id = $productID";
    $select = $conn->query($query);
    return $select->fetch()->total;
}
function insertComment($comment,$userID,$replayID,$productID){
    global $conn;
    if(!is_numeric($replayID)){
        $replayID = null;
    }
    $query = "INSERT INTO comment (comment,answer_id,product_id,user_id)
              VALUES (:comm,:answer,:product,:user)";
    $insert = $conn->prepare($query);
    $insert->bindParam(":answer",$replayID);
    $insert->bindParam(":comm",$comment);
    $insert->bindParam(":product",$productID);
    $insert->bindParam(":user",$userID);

    return $insert->execute();
    }
function printStar($number,$total){
    $string = "<p class='mb-0'>$number Star &nbsp;";
    for($i=1;$i<=5;$i++){
        if($i <= $number){
            $string .= ' <i class="fa fa-star"></i>';
        }
        else {
            $string .= ' <i class="fa fa-star" style="color: gray"></i>';
        }
    }
    $string .= "&nbsp;&nbsp;". $total . "</p>";
    echo $string;
}
function printReview($review){
    $string = '';
    global $conn;
    foreach($review as $r){
        $userID = $r->user_id;
        $query = "SELECT CONCAT(name, ' ' , last_name) as fullName FROM user WHERE user_id = :id";
        $select = $conn->prepare($query);
        $select->bindParam(":id",$userID);
        $select->execute();
        $full_name = $select->fetch()->fullName;
        $string .= "<div class='review_item  my-3 p-2'>
									<div class='media'>
										<div class='media-body'>
											<h4>$full_name</h4>";
        for($i=1;$i<=5;$i++){
            if($i <= $r->rating){
                $string .= ' <i class="fa fa-star"></i>';
            }
            else {
                $string .= ' <i class="fa fa-star" style="color: gray"></i>';
            }
        }
        $string .= "</div>
									    </div>
									        <p>$r->description</p>
								    </div>";

    }

    echo $string;
}
function printComments($comments,$userID){
    $string = "";
    global $conn;

    foreach ($comments as $comment) {
        $commentID = $comment->comment_id;
        $query = "SELECT CONCAT(name, ' ' , last_name) as fullName FROM user WHERE user_id = :id";
        $select = $conn->prepare($query);
        $select->bindParam(":id",$comment->user_id);
        $select->execute();
        $full_name = $select->fetch()->fullName;
        $dateFormat = date('F j, Y, g:i a',strtotime($comment->date));
        $string .= "<div class='review_item my-5' id='$comment->comment_id-comm'>
							<div class='media'>
								<div class='media-body'>
									<h4>$full_name</h4>
									<h5>$dateFormat</h5>";
                                if($userID){
                                    $queryUser = "SELECT CONCAT(name, ' ' , last_name) as fullName FROM user WHERE user_id = :id";
                                    $selectUser = $conn->prepare($queryUser);
                                    $selectUser->bindParam(":id", $userID);
                                    $selectUser->execute();
                                    $user = $selectUser->fetch();
                                    $userFullname = $user->fullName;
                                $string .= "<p class='reply_btn' data-fullname='$userFullname' data-id='$comment->comment_id'>Reply</p>";
                                }
                                $string .=
                                "</div>
							</div>
						<p class='pt-0'>$comment->comment</p>
					</div>";
       $string.=  printAnswers($commentID,$userID);
        }

    echo $string;
}
function printAnswers($commentID,$fullName){
    global $conn;
    $string = "";
    $query = "SELECT c.*,CONCAT(name, ' ' , last_name) as fullName 
              FROM comment c INNER JOIN user u ON c.user_id = u.user_id WHERE c.answer_id = $commentID ORDER BY date DESC";
    $select = $conn->query($query);
    $answers = $select->fetchAll();
    foreach ($answers as $a){
        $dateFormat = date('F j, Y, g:i a',strtotime($a->date));
        $string .= "<div class='review_item reply'>
									<div class='media'>
										<div class='media-body'>
											<h4>$a->fullName</h4>
											<h5>$dateFormat</h5>
										</div>
									</div>
									<p class='pt-0 pb-3'>$a->comment</p>
								</div>";
    }

    return $string;

}

function insertCart($userID,$productID,$quantity){
    global $conn;
    $cartID = getCartID($userID);
    if($cartID){
        #$cartID = $userOrder->cart_id;
       /*
         $query = "SELECT cart_id FROM cart WHERE user_id = $userID";
        $select = $conn->query($query);
        $res = $select->fetch();

        $cartID = $res->cart_id;
        */
        $queryCartProduct = "INSERT INTO cart_product (product_id,cart_id,quantity)
                            VALUES (:productID,:cartID,:quantity)";
        $insertCartProduct = $conn->prepare($queryCartProduct);
        $insertCartProduct->bindParam(":productID",$productID);
        $insertCartProduct->bindParam(":cartID",$cartID);
        $insertCartProduct->bindParam(":quantity",$quantity);
        $result = $insertCartProduct->execute();
        return $result;
        die;
    }
    else {
        return insertProductsCart($userID,$productID,$quantity);
    }

}

function getCartID($userID){
    global $conn;
    $tmp = [];
    $userOrder = null;
    $queryUserCart = "SELECT cart_id FROM cart WHERE user_id = $userID";
    $selectQueryCart = $conn->query($queryUserCart);
    $existsCart = $selectQueryCart->rowCount();

    if($existsCart) {

        $userCart = $selectQueryCart->fetchAll();//->cart_id;
        foreach ($userCart as $u) {
            $tmp[] = $u->cart_id;
        }
        $userCartID = implode(",", $tmp);
        $queryUserOrder = "SELECT cart_id FROM cart WHERE cart_id NOT IN 
                               (SELECT cart_id FROM product_order WHERE cart_id IN($userCartID))ORDER BY cart_id DESC";
        $selectUserOrder = $conn->query($queryUserOrder);
        #$alreadyInCart = $selectUserOrder->rowCount();//0-1
        $userOrder = $selectUserOrder->fetch(); // fetchAll
    }
    if($userOrder){
        return  $userOrder->cart_id;
    }
    return null;
}
function insertProductsCart($userID,$productID,$quantity){
    global $conn;
    $conn->beginTransaction();
    $queryNewCart = "INSERT INTO cart (user_id) VALUES (:userID)";
    $insertNewCart = $conn->prepare($queryNewCart);
    $insertNewCart->bindParam(":userID",$userID);
    $insertNewCart->execute();
    $cartID = $conn->lastInsertId();

    $queryCartProduct = "INSERT INTO cart_product (product_id,cart_id,quantity)
                            VALUES (:productID,:cartID,:quantity)";
    $insertCartProduct = $conn->prepare($queryCartProduct);
    $insertCartProduct->bindParam(":productID",$productID);
    $insertCartProduct->bindParam(":cartID",$cartID);
    $insertCartProduct->bindParam(":quantity",$quantity);
    $result = $insertCartProduct->execute();
    $conn->commit();
    return $result;
}


function insertOrder($firstName,$lastName,$companyName,$phone,$email,$address,$city,$postcode,$detailsMsg,$cartID){
    global $conn;
    $total = 0;
    $conn->beginTransaction();
    $queryTotal = "SELECT * FROM cart_product WHERE cart_id = $cartID";
    $selectTotal = $conn->query($queryTotal);
    $cartProduct = $selectTotal->fetchAll();
    foreach ($cartProduct as $c){
        $productID = $c->product_id;
        $queryProduct = "SELECT price FROM product p INNER JOIN price pp ON p.product_id = pp.product_id 
                         WHERE p.product_id = $productID ORDER by pp.date LIMIT 1";
        $selectPrice = $conn->query($queryProduct);
        $price = $selectPrice->fetch()->price;
        $total += $c->quantity * $price;
    }
    $query = "INSERT INTO product_order (cart_id, name,last_name, phone, address, city, postcode, email, company, description,total)
              VALUES (:id,:name,:lName,:phone,:address,:city,:postcode,:email,:comp,:desc,:total)";
    $insert = $conn->prepare($query);
    $insert->bindParam(":id",$cartID);
    $insert->bindParam(":name",$firstName);
    $insert->bindParam(":lName",$lastName);
    $insert->bindParam(":phone",$phone);
    $insert->bindParam(":address",$address);
    $insert->bindParam(":city",$city);
    $insert->bindParam(":postcode",$postcode);
    $insert->bindParam(":email",$email);
    $insert->bindParam(":comp",$companyName);
    $insert->bindParam(":desc",$detailsMsg);
    $insert->bindParam(":total",$total);
    $insert->execute();

    /*
     $queryDel = "DELETE FROM cart_product WHERE cart_id = $cartID";
        $conn->query($queryDel);
     */


    $conn->commit();

}


function totalSales($where=""){
    global $conn;
    $query = "SELECT SUM(total) as sum FROM product_order WHERE $where";
    $select = $conn->query($query);
    $total = $select->fetch()->sum;
    return $total;
}

function checkImage($image,$imgLocation){
    $fileType = $image["type"];
    $fileSize = $image["size"];
    $extension = explode(".",$image["name"])[1];
    $fileName = uniqid() . "." . $extension;
    $folder = $imgLocation . $fileName;
    $tmpPath = $image["tmp_name"];
    $err = "";

    if($fileType != "image/jpeg" && $fileType != "image/png"){
        $err  = "Invalid file type. Only .jpg/.jpeg/.png";
    }
    else if($fileSize > 1024*1024*2){
        $err = "Image must be at most 2mb!";
    }
    else if(!move_uploaded_file($tmpPath,$folder)){
        $err = "Upload error";
    }

    return ["err" => $err,"fileName" => $fileName];
}

function insertProduct($name,$genderID,$quantity,$price,$description,$brendID,$categoryID,$colorID,$mainImg){
    global $conn;
    $conn->beginTransaction();

    $query = "INSERT INTO product(name,description, quantity, brend_id, color_id, category_id, gender_id, main_img)
              VALUES (:name,:desc,:qnty,:brendID,:colorID,:catID,:genderID,:img)";
    $insert = $conn->prepare($query);
    $insert->bindParam(":name",$name);
    $insert->bindParam(":desc",$description);
    $insert->bindParam(":qnty",$quantity);
    $insert->bindParam(":brendID",$brendID);
    $insert->bindParam(":colorID",$colorID);
    $insert->bindParam(":catID",$categoryID);
    $insert->bindParam(":genderID",$genderID);
    $insert->bindParam(":img",$mainImg);
    $insert->execute();

    $productID = $conn->lastInsertId();

    $queryPrice = "INSERT INTO price(price,product_id) VALUES(:price,:id)";
    $insertPrice = $conn->prepare($queryPrice);
    $insertPrice->bindParam(":price",$price);
    $insertPrice->bindParam(":id",$productID);
    $insertPrice->execute();



   if( $conn->commit()){
       return true;
   }
   return false;
}


function getAllProducts(){
    global $conn;
    $query = "SELECT b.name as brend,p.* FROM product p INNER JOIN brend b ON p.brend_id = b.brend_id";
    $select = $conn->query($query);
    $products = $select->fetchAll();
    $products = getLastTwoPrices($products);

    return $products;
}

function printDropDownList($label,$ddlName,$options,$itemToPreselect="",$propertyToCheck=""){
    $string = "<label for='' class='form-label'>$label</label>
               <select class='form-control' id='$ddlName' name='$ddlName'>";
                foreach ($options as $o):
                                        $selected = "";
                                        if($o->$propertyToCheck == $itemToPreselect->$propertyToCheck){
                                            $selected = "selected";
                                        }


                               $string .= "<option $selected value=".$o->$propertyToCheck.">$o->name</option>";
                endforeach;
                $string .= "</select>";
                echo $string;
}

function updateProduct($productID,$name,$genderID,$price,$description,$brendID,$categoryID,$colorID,$fileName){
    global $conn;
    $conn->beginTransaction();
    $query = "UPDATE product
             SET name = :name, gender_id = :genderID, description = :desc,brend_id = :brendID, category_id = :catID,color_id = :colorID,main_img = :img
             WHERE product_id = $productID";
    $update = $conn->prepare($query);
    $update->bindParam(":name",$name);
    $update->bindParam(":genderID",$genderID);
    $update->bindParam(":desc",$description);
    $update->bindParam(":brendID",$brendID);
    $update->bindParam(":catID",$categoryID);
    $update->bindParam(":colorID",$colorID);
    $update->bindParam(":img",$fileName);
    $update->execute();

    $QueryCheckPrice = "SELECT price FROM price WHERE product_id = $productID ORDER BY date DESC LIMIT 1";
    $checkPrice = $conn->query($QueryCheckPrice);
    $lastPrice = $checkPrice->fetch()->price;
    if($lastPrice != $price){
        $queryInsertPrice = "INSERT INTO price (price,product_id) VALUES(:price,:productID)";
        $insertPrice = $conn->prepare($queryInsertPrice);
        $insertPrice->bindParam(":price",$price);
        $insertPrice->bindParam(":productID",$productID);
        $insertPrice->execute();
    }
    if($conn->commit()){
        return true;
    }
    return false;
}

function insertSpecification($name,$type){
    global $conn;
    $query = "INSERT INTO $type(name) VALUES ('$name')";
    $insert = $conn->query($query);
    return $insert;
}
function checkSpecification($id,$type) {
    global $conn;
    $query = "SELECT * FROM product WHERE ";
    if($type == "brend"){
        $query .= "brend_id = $id";
    }
    else if ($type == "color"){
        $query .= "color_id = $id";
    }
    else if ($type == "category"){
        $query .= "category_id = $id";
    }
    $select = $conn->query($query);
    return $select->rowCount();

}

function deleteSpecification($id,$type){
    global $conn;
    $query = "DELETE FROM";
    if($type == "brend"){
        $query .= " brend WHERE brend_id = $id";
    }
    else if ($type == "color"){
        $query .= " color WHERE color_id = $id";
    }
    else if ($type == "category"){
        $query .= " category WHERE category_id = $id";
    }
    $select = $conn->query($query);
    return $select;
}

function trackVisitors($ip,$date,$page,$id){
    $file = fopen("data/activity.txt","a");
    $id = $id == null ? "/" : $id;
    $country = @unserialize(file_get_contents('http://ip-api.com/php/'.$ip));
    if($country && $country['status'] == 'success'){
        $country = $country['city'];
    }
    else{
        $country = "/";
    }
    $string = $ip . "__" .$country."__" .$date . "__" . $page . "__" . $id ."\n";
    fwrite($file,$string);
    fclose($file);
}

function blockUserAndSendEmail($username){
    global $conn;
    $file = fopen("../data/blocked.txt","a");
    $query = "SELECT * FROM user WHERE username = '$username'";
    $select = $conn->query($query);
    $user = $select->fetch();
    $userID = $user->user_id;
    $userEmail = $user->email;
    $userPhone = $user->phone;
    $string = $userID . "__" . $username . "__" . $userEmail . "__" . $userPhone . "\n";
    fwrite($file,$string);
    fclose($file);

    sendEmail($userEmail,"Sneakz","Your account on Sneakz is blocked. Please contact administrator");
}

function userIsBlocked($id,$arrayToCheck){
    $isBlocked = false;
    if(in_array($id,$arrayToCheck)){
        $isBlocked = true;
    }
    return $isBlocked;
}
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
function sendEmail($to, $subject, $message) {
    require '../vendor/autoload.php';
    $mail = new PHPMailer();

    try {
        $to = "ilija0125@gmail.com";
        $mail->isSMTP();
        $mail->Host = 'smtp.gmail.com';
        $mail->SMTPAuth = true;
        $mail->Username = 'ilija0125@gmail.com';
        $mail->Password = 'ktssrqvbetjcmvdj';
        $mail->SMTPSecure = 'ssl';
        $mail->Port = 465;

        $mail->setFrom('ilija0125@gmail.com', 'Sneakz | Administrastor'); // Sender's email and name
        $mail->addAddress($to); // Recipient's email

        $mail->Subject = $subject;
        $mail->Body = $message;

        $mail->send();

    } catch (Exception $e) {
        //log fail: 'Message could not be sent. Error: ', $mail->ErrorInfo;
    }
}
