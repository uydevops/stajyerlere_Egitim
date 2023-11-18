<?php

$db = new PDO('mysql:host=localhost;dbname=testserver', 'root', '');
$users = $db->query("SELECT * FROM users")->fetchAll(PDO::FETCH_OBJ);

require '../vendor/autoload.php';

use Dompdf\Dompdf;
use Dompdf\Options;

$options = new Options();
$options->set('isHtml5ParserEnabled', true);
$options->set('isPhpEnabled', true);
$options->set('defaultFont', 'Courier');
$options->set('isHtml5ParserEnabled', true);

$dompdf = new Dompdf($options);

if (isset($_POST["pdf"])) {
    $html = generateHtmlTable($_POST["id"], $db);

    $dompdf->loadHtml($html);

    $dompdf->setPaper('A4', 'portrait');

    $dompdf->render();

    $dompdf->stream();
}

function generateHtmlTable($selectedIds, $db)
{
    $html = '<table class="table table-bordered" border="1" cellpadding="5" cellspacing="0">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Password</th>
                    </tr>
                </thead>
                <tbody>';

    foreach ($selectedIds as $id) {
        $user = $db->query("SELECT * FROM users WHERE id = $id")->fetch(PDO::FETCH_OBJ);

        if ($user) {
            $html .= '<tr>
                        <td>' . $user->name . '</td>
                        <td>' . $user->email . '</td>
                        <td>' . $user->password . '</td>
                    </tr>';
        }
    }

    $html .= '</tbody>
            </table>';

    return $html;
}
