<!DOCTYPE html>
<html>
<head>
    <title>Untitled Page</title>
</head>
<body>
    <script type="text/javascript" src="http://s2173-4.ing.puc.cl/script/jquery-1.7.min.js"></script>
    <script type="text/javascript" src="dynaform.js">

    </script>
    <form action="../modelo" method="get">
    <h1>
        Agregar Modelo</h1>
    <input type="submit" title="hai" >
    <p>
        <label>
            nombre
            <input type="text" name="nombre" >
        </label>
    </p>
    <p>
        <label>
            admin
            <select name="admin[]" multiple>
            <?php foreach($admin as $name): ?>
                <option><?php echo($name); ?></option>
            <?php endforeach; ?>
            </select>
        </label>
    </p>
    <hr >
    <h2>
        Contribuciones <a href="#" id="add_contrib">+</a> </h2>
    
    <script type="text/javascript">

        
        $('#add_contrib').click(function (ev) {
            var count = $('#contrib .contrib').length;
            
            $('#contrib').append(gen_contribfields(count));
        });

    </script>
    <div id="contrib">
        
    </div>
    </form>
</body>
</html>
