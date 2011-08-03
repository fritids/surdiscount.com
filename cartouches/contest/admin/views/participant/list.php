<?php

echo '<a href="?p=participants&a=add">Faire participer un client à un concours manuellement</a><br />';

echo '<table>
        <tr>
            <th>id_contest_participant</th>
            <th>id_contest</th>
            <th>id_customer</th>
            <th>date_added</th>
            <th>edit</th>
            <th>delete</th>
        </tr>';


foreach($vars as $var) {
    
    echo '<tr>
            <td>'. $var['id_contest_participant'] .'</td>
            <td>'. $var['id_contest'] .'</td>
            <td>'. $var['id_contest_customer'] .'</td>
            <td>'. $var['date_added'] .'</td>
            <td><a href="?p=participants&a=edit&id='. $var['id_contest_participant'] . '"><img src="views/img/edit.png" /></a></td>
            <td><a href="?p=participants&a=delete&id='. $var['id_contest_participant'] . '"><img src="views/img/delete.png" /></a></td>';
}

echo '</table>';

echo '<a href="../admin">Revenir au menu principal</a>';

?>