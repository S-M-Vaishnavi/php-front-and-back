<?php include 'superglobals.php';?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>System Info</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Server & File Info</h1>
        <?php if($server): ?>
            <ul class="list-group">
                <?php foreach($server as $key => $value):?>
                    <li class="list-group-item">
                        <strong><?php echo $key ?>:</strong>
                        <?php echo $value; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>

        <h1>Client Info</h1>
        <?php if($server): ?>
            <ul class="list-group">
                <?php foreach($client as $key => $value):?>
                    <li class="list-group-item">
                        <strong><?php echo $key ?>:</strong>
                        <?php echo $value; ?>
                    </li>
                <?php endforeach; ?>
            </ul>
        <?php endif; ?>
    </div>
</body>
</html>