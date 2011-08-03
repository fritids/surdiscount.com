<?php

echo '<a href="?p=contest&a=add"><img src="views/img/add.png" /> Créer un concours</a><br />';

echo '<table>
        <tr>
            <th>id</th>
            <th>lastname</th>
            <th>firstname</th>
            <th>email</th>
            <th>adress</th>
            <th>zip_code</th>
            <th>city</th>
            <th>phone</th>
            <th>year_of_birth</th>
            <th>newsletter</th>
            <th>sex</th>
            <th>edit</th>
            <th>delete</th>
        </tr>';


foreach($vars as $var) {
    
    echo '<tr>
            <td>'. $var['id_contest_customer'] .'</td>
            <td>'. $var['lastname'] .'</td>
            <td>'. $var['firstname'] .'</td>
            <td>'. $var['email'] .'</td>
            <td>'. $var['adress'] .'</td>
            <td>'. $var['zip_code'] .'</td>
            <td>'. $var['city'] .'</td>
            <td>'. $var['phone'] .'</td>
            <td>'. $var['year_of_birth'] .'</td>
            <td>'. $var['newsletter'] .'</td>
            <td>'. $var['sex'] .'</td>
            <td><a href="?p=customer&a=edit&id='. $var['id_contest_customer'] . '"><img src="views/img/edit.png" /></a></td>
            <td><a href="?p=customer&a=delete&id='. $var['id_contest_customer'] . '"><img src="views/img/delete.png" /></a></td>';
}

echo '</table>';


echo '<a href="../admin">Revenir au menu principal</a>';

?>