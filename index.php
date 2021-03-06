<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <title>Sql to JSON</title>
</head>

<body>
    <div class="container mt-3">
        <h1 class="text-center">SQL to JSON</h1>
        <form>
            <div class="row justify-content-center">
                <div class="col-5">
                    <textarea class="form-control sql" style="height: 600px;"></textarea>
                </div>
        
                <div class="col-1 text-center">
                    <button class="btn btn-secondary convert-button">Convert</button>
                </div>

                <div class="col-5">
                    <textarea class="form-control json-php" style="height: 600px;"></textarea>
                </div>
            </div>
        </form>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p"
        crossorigin="anonymous"></script>
</body>

</html>

<script>
    $('.convert-button').click(function (e) {
        e.preventDefault();

        if ($('.sql').val() == '') {
            alert('Preencha o campo SQL');
            return false;
        }

        $.ajax({
            type: "POST",
            url: "./convert.php",
            data: { sql: $('.sql').val() },
            dataType: "JSON",
            success: function (data) {
                pretty = JSON.stringify(data, undefined, 4);

                $('.json-php').val(pretty);
            }
        });
    });
</script>
