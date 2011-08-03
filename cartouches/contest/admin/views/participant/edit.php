<?php

echo '<form action="?p=participants&a=edit&id='.$vars['id_contest_participant'].'" method="post" name="contestEdit">
        <label for="id_contest">id concours</label>
        <input type="text" name="id_contest" value="'. $vars['id_contest'] .'" />
        <label for="id_contest_customer">id client</label>
        <input type="text" name="id_contest_customer" value="'. $vars['id_contest_customer'] .'" />
        <label for="date_added">date ajout</label>
        <input type="text" name="date_added" value="'. $vars['date_added'] .'" />
        <input type="submit" value="Mettre à jour" />
      </form>';

?>