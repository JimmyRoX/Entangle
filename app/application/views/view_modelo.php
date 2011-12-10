<!DOCTYPE html>
<html>
<head>
    <title>Untitled Page</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
</head>
<body>
    <script type="text/javascript" src="<?php echo base_url('script/jquery-1.7.min.js') ?>"></script>
    <h1>Modelo</h1>
    
    <p> nombre: <?php echo $modelo['nombre'] ?></p>
    <p> admin: <?php echo implode(', ', $admin); ?></p>
    
    <hr>
    <h2>Contribuciones</h2>
    <div id="contrib">
        <?php foreach($modelo['tipoContrib'] as $contrib): ?>
            <fieldset class="contrib"><legend>contribución</legend>
                <div>nombre: <?php echo $contrib['nombre']; ?> <p> tipo de contenido: <?php echo $contrib['content'] ?> </p></div>
                <fieldset>
                <legend>widget browsing</legend>
                <pre><?php echo htmlspecialchars($contrib['widget_browsing']->getBytes()) ?></pre>
                </fieldset>

                <fieldset>
                <legend>widget display</legend>
                <pre><?php echo htmlspecialchars($contrib['widget_display']->getBytes(), true) ?></pre>
                </fieldset>

                <fieldset>
                <legend>metadata</legend>

                <?php foreach($contrib['metadata'] as $meta): ?>
                    <div> <?php echo $meta['tipo']?> <em><?php echo $meta['name'] ?></em></div>
                <?php endforeach; ?>
                </fieldset>


                <?php if(isset($contrib['refs'])): ?>
                <fieldset>
                    <legend>referencias</legend>

                
                <?php foreach($contrib['refs'] as $ref): ?>
                    <div>  <?php echo $ref['name']?> &#x2192; <?php echo $ref['target']?></div>
                <?php endforeach; ?>

                    <fieldset>
                        <legend>metadata</legend>

                    <?php foreach($ref['metadata'] as $meta): ?>
                        <div> <?php echo $meta['tipo']?> <em><?php echo $meta['name'] ?></em></div>
                    <?php endforeach; ?>
                    </fieldset>

                </fieldset>
                <?php endif; ?>
            </fieldset>            
        <?php endforeach; ?>
    </div>
    </form>
    &#x2603;
</body>
</html>
