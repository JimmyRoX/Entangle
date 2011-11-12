<!DOCTYPE html>
<html>
<head>
    <title>Untitled Page</title>
</head>
<body>
    <script type="text/javascript" src="<?php echo base_url('script/jquery-1.7.min.js') ?>"></script>
    <h1>Modelo</h1>
    
    <p> nombre: <?php echo $modelo['nombre'] ?></p>
    <p> admin: <?php echo implode(', ', $modelo['admin']); ?></p>
    <hr>
    <h2>Contribuciones</h2>
    <div id="contrib">
        <?php foreach($modelo['contrib'] as $contrib): ?>
            <fieldset class="contrib"><legend>contribución</legend>
                <div>nombre: <?php echo $contrib['name']; ?> &nbsp; template: <?php echo $contrib['template'] ?></div>
                <fieldset>
                <label>metadata <a href="#"></label>

                <?php foreach($contrib['metadata'] as $meta): ?>
                    <div> <?php echo $meta['type']?> <?php echo $meta['name'] ?></div>
                <?php endforeach; ?>
                </fieldset>
            </fieldset>            
        <?php endforeach; ?>
    </div>
    </form>
</body>
</html>
