<?php

echo '<form action="?p=contest&a=edit&id='.$vars['id_contest'].'" method="post" name="contestEdit">
        <label for="date_start">Date de départ</label>
        <input type="text" name="date_start" value="'. $vars['date_start'] .'" />
        <label for="date_end">Date de fin</label>
        <input type="text" name="date_end" value="'. $vars['date_end'] .'" />
        <label for="picture">Chemin de l\'image</label>
        <input type="text" name="picture" value="'. $vars['picture'] .'" />
        <input type="submit" value="Mettre à jour" />
      </form>';

?>