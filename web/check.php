<?php require "./includes/header.php" ?>


<div class="container">
        <span style="color: green;">Admin will visit check your memo but not his haha. Just enter the URL!</span>
</div>
<form action="check.php" method="POST">
    <div class="container d-flex align-items-center mt-3">
        <label for="" class="m-0 mr-2">Check Memo: </label>
        <input type="text" class="form-control d-inline-block w-50 mr-2" placeholder="http://165.22.245.125:11111/memo.php" id="checkMemoInput" name="checkMemoInput">
        <button type="submit" class="btn btn-success" id="checkMemoSubmitBtn">Check</button>
    </div>
</form>

<?php
    if(isset($_POST['checkMemoInput'])){
        $ch = curl_init();
        // echo "MASUK";
        // echo 'http://admin:3000/admin_check?url='.$_POST['checkMemoInput'];
        curl_setopt($ch, CURLOPT_URL, 'http://admin:3000/admin_check?url='.$_POST['checkMemoInput']);
        curl_exec($ch);
    }
    
?>



<?php require "./includes/footer.php" ?>