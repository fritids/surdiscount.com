<?php

echo '<a href="?p=contest&a=add"><img src="views/img/add.png" /> Créer un concours</a><br />';

echo '<table>
        <tr>
            <th>id</th>
            <th>date start</th>
            <th>date end</th>
            <th>picture</th>
            <th>edit</th>
            <th>delete</th>
        </tr>';


foreach($vars as $var) {
    
    echo '<tr>
            <td>'. $var['id_contest'] .'</td>
            <td>'. $var['date_start'] .'</td>
            <td>'. $var['date_end'] .'</td>
            <td><a href="views/contest/'. $var['picture'] .'"><img src="views/contest/'. $var['picture'] .'" heigth="50px" width="50px" /></a></td>
            <td><a href="?p=contest&a=edit&id='. $var['id_contest'] . '"><img src="views/img/edit.png" /></a></td>
            <td><a href="?p=contest&a=delete&id='. $var['id_contest'] . '"><img src="views/img/delete.png" /></a></td>';
}

echo '</table>';

echo '<a href="../admin">Revenir au menu principal</a>';

?>