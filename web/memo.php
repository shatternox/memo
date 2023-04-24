<?php require "./includes/header.php" ?>

<body>

    <div class="container">
        <h1>Memo Storage Website</h1>
        <hr>
        <form>
            <div class="form-group">
                <label for="title">Title:</label>
                <input type="text" class="form-control" id="title" placeholder="Enter memo title">
            </div>
            <div class="form-group">
                <label for="content">Content:</label>
                <textarea class="form-control" id="content" rows="5"></textarea>
            </div>
            <button type="submit" class="btn btn-primary">Save Memo</button>
        </form>
        <hr>
        <h2>Saved Memos</h2>
        <ul class="list-group">
            <li class="list-group-item">Memo Title 1</li>
            <li class="list-group-item">Memo Title 2</li>
            <li class="list-group-item">Memo Title 3</li>
        </ul>
    </div>

</body>

<?php require "./includes/footer.php" ?>