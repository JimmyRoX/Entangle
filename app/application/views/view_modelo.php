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
                <div>nombre: <?php echo $contrib['nombre']; ?> &nbsp; template: <?php echo $contrib['template'] ?></div>
                <fieldset>
                <legend>metadata</legend>

                <?php foreach($contrib['metadata'] as $meta): ?>
                    <div> <?php echo $meta['tipo']?> <em><?php echo $meta['nombre'] ?></em></div>
                <?php endforeach; ?>
                </fieldset>

                <fieldset>
                    <legend>referencias</legend>


                <?php foreach($contrib['ref'] as $ref): ?>
                    <div>  <?php echo $ref['nombre']?> &#x2192; <?php echo $ref['tipo_dest']?> [<?php echo $ref['template'] ?>]</div>
                <?php endforeach; ?>

                    <fieldset>
                        <legend>metadata</legend>

                    <?php foreach($ref['metadata'] as $meta): ?>
                        <div> <?php echo $meta['tipo']?> <em><?php echo $meta['nombre'] ?></em></div>
                    <?php endforeach; ?>
                    </fieldset>

                </fieldset>
            </fieldset>            
        <?php endforeach; ?>
    </div>
    </form>
    &#x2603;
</body>
</html>
