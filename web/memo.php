<?php require "./includes/header.php"; ?>

<body>

    <div class="container">
        <h1>Hello <?= $_SESSION['username']; ?></h1>
        <h2>Memo Storage Website</h2>
        <hr>
        <form action="./controller/memoController.php" method="POST">
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" placeholder="Enter memo title" name="title">
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" id="content" rows="5" name="content"></textarea>
            </div>
            <button type="submit" class="btn btn-success" name="insert">Save Memo</button>
        </form>
        <hr>
        <h2>Saved Memos</h2>
        <ul class="list-group">
        <?php
            require "./config/db.php";

            
            $q = "SELECT * FROM memos WHERE user_id = ?";

            $stmt = $conn->prepare($q);
            $stmt->bind_param("i", $_SESSION['user_id']);
            $stmt->execute();

            $result = $stmt->get_result();

            while ($row = $result->fetch_assoc()){
                ?>
                    <li class="list-group-item"><?= htmlspecialchars($row['title']); ?></li>
                    <div><?= htmlspecialchars($row['content']); ?></div>
                <?php
            }

        ?>
        </ul>
    </div>

</body>

<?php require "./includes/footer.php" ?>