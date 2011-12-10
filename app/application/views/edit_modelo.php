<!DOCTYPE html>
<html>
<head>
    <title> Editar modelo </title>
</head>
<body>
    <script type="text/javascript" src="<?php echo base_url('script/jquery-1.7.min.js') ?>"></script>
    <script type="text/javascript" src="<?php echo base_url('script/dynaform.js') ?>"></script>


    <form action="<?php echo base_url('modelo/update') ?>" method="post" enctype="multipart/form-data">
    <h1>Editar modelo</h1>
    <input type="submit" name="edit" value="Editar">
    <input type="hidden" name="_id" value="<?php echo $modelo['_id']?>">
    <p>
        <label>
            nombre: <?php echo $modelo['nombre'] ?>
            <input type="hidden" name="nombre" required value="<?php echo $modelo['nombre']?>">

        </label>
    </p>
    <p>
        <label>
            admin
            <select name="circle[]" multiple required>
            <?php foreach($admin as $circle): ?>
                <option value="<?php echo $circle['_id']?>" <?php if(in_array($circle['_id'], $modelo['circles'])) { echo 'selected'; } ?> >
                <?php echo($circle['name']); ?></option>
            <?php endforeach; ?>
            </select>
        </label>
    </p>
    <hr >
    <h2>
        Contribuciones <a href="#" id="add_contrib">+</a> </h2>
    
    <script type="text/javascript">
        $('#add_contrib').click(add_contribfields);

        $(document).ready(function() {
            set_additems();
        }
        );
    </script>
    
    <div id="contrib">
        <?php foreach($modelo['tipoContrib'] as $key => $contrib): ?>
        <?php $id = 'contrib-'.$key; $field = 'contrib['.$key.']' ?>
        <fieldset class="contrib" id="<?php echo $id ?>" ><legend>contribución</legend><p>
            <label>nombre<input type="text" name="<?php echo $field.'[nombre]' ?>" required value="<?php echo $contrib['nombre'] ?>"/></label>

            <div><label>tipo contribucion
                <?php echo form_dropdown($field.'[content]', contrib_types(), $contrib['content']); ?>
            </label></div>

            <fieldset>
                <legend><label>widget (browsing) &emsp;
                    <input type="file" name="<?php echo $field.'[widget_browsing]' ?>"/>
                </label></legend>
            <pre class="."><?php echo htmlspecialchars($contrib['widget_browsing']->getBytes()) ?></pre>
                </fieldset>

            <fieldset>
                <legend><label>widget (display) &emsp;
                    <input type="file" name="<?php echo $field.'[widget_display]' ?>"/>
                </label></legend>
                <pre><?php echo htmlspecialchars($contrib['widget_display']->getBytes(), true) ?></pre>
                </fieldset>
            </p>

            <fieldset class="metalist" id="<?php echo $id.'-metadata'; ?>" >
                <legend>metadata <a class="add_meta" href="#">+</a></legend>
                <?php 
                    if(isset($contrib['metadata']))
                    foreach($contrib['metadata'] as $meta_key => $meta): 
                    $meta_id = $id.'-metadata-'.$meta_key;
                    $meta_field = $field.'[metadata]['.$meta_key.']';
                ?>

                <div class="metadata" id="<?php echo $meta_id ?>" >
                    <label>nombre<input type="text" name="<?php echo $meta_field.'[name]' ?>" required value="<?php echo $meta['name'] ?>"/></label>
                    <label>tipo
                    <?php  echo form_dropdown($meta_field.'[tipo]', metadata_types(), $meta['tipo']); ?>
                    </label>
                    <label class="widget"><input type="file" name="widget"></label>
                </div>        
                    
                <?php endforeach; ?>
            </fieldset>

            <fieldset class="ref" id="<?php echo $id.'-ref' ?>" >
                <legend>referencias <a class="add_ref" href="#">+</a></legend>
                <?php
                    if(isset($contrib['refs']))
                 foreach($contrib['refs'] as $ref_key => $ref): 
                    $ref_id = $id.'-ref-'.$ref_key;
                    $ref_field = $field.'[refs]['.$ref_key.']';
                ?>

                <fieldset class="reflist" id="<?php echo $ref_id ?>">
                    <label>nombre<input type="text" name="<?php echo $ref_field.'[name]' ?>" required value="<?php echo $ref['name'] ?>"/></label>
                    <label>tipo destino <input type="text" name="<?php echo $ref_field.'[target]' ?>" required value="<?php echo $ref['target'] ?>"></label>
                    <fieldset class="metareflist" id="<?php echo $ref_id.'-metadata' ?>" >
                        <legend>metadata <a class="add_metaref" href="#">+</a></legend>
                        <?php if(isset($ref['metadata']))
                            foreach($ref['metadata'] as $metaref_key => $metaref): 
                                $metaref_id = $ref_id.'-metadata-'.$metaref_key;
                                $metaref_field = $ref_field.'[metadata]['.$metaref_key.']';
                            ?>

                            <div class="metadata" id="<?php echo $metaref_id ?>" >
                                <label>nombre<input type="text" name="<?php echo $metaref_field.'[name]' ?>" required value="<?php echo $meta['name'] ?>"/></label>
                                <label>tipo
                                <?php  echo form_dropdown($metaref_field.'[tipo]', metadata_types(), $meta['tipo']); ?>
                                </label>
                                <label class="widget"><input type="file" name="widget"></label>
                            </div>        
                                
                        <?php endforeach; ?>

                    </fieldset>
                </fieldset>

                <div class="ref">

                    <label>tipo
                    <?php  echo form_dropdown('tipo', metadata_types(), $meta['tipo']); ?>
                    </label>
                    <label class="widget"><input type="file" name="widget"></label>
                </div>        
                    
                <?php endforeach; ?>

            </fieldset>
        </fieldset>

        <?php endforeach; ?>

        
    </div>
    
    </form>

    <div style="display: none" id="prototype">

        <fieldset class="contrib"><legend>contribución</legend><p>
            <label>nombre<input type="text" name="nombre" required /></label>
            <label>widget (browsing)<input type="file" name="widget_browsing" required/></label>
            <label>widget (display)<input type="file" name="widget_display" required/></label>
            <div><label>tipo contribucion
                <?php form_dropdown('content', contrib_types()); ?>
            </label></div>
            </p>

            <fieldset class="metalist">
                <legend>metadata <a class="add_meta" href="#">+</a></legend>

            </fieldset>

            <fieldset class="reflist">
                <legend>referencias <a class="add_ref" href="#">+</a></legend>
            </fieldset>
        </fieldset>


        <div class="metadata">
            <label>nombre<input type="text" name="name" required/></label>
            <label>tipo
                <?php echo form_dropdown('tipo', metadata_types()); ?>
            </label>
            <label class="widget"><input type="file" name="widget"></label>
        </div>

        <fieldset class="ref">
            <label>nombre <input type="text" name="name" required></label>
            <label>tipo destino <input type="text" name="target" required></label>
            <fieldset class="metareflist">
                <legend>metadata <a class="add_metaref" href="#">+</a></legend>
            </fieldset>
        </fieldset>
    </div>
</body>
</html>