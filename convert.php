<?php

$data = file_get_contents("export.data"); // 1pux open with zip and export file (export.data) , then upload your export.data file to the directory where convert.php is.
$data = json_decode($data);
$vaults = $data->accounts[0]->vaults;

echo "<pre>";
foreach ($vaults as $key => $vault) {
    // echo "\n";
    // echo "=======================\n";
    // echo "Total vaults: " . count($vaults);
    // echo "\n";
    // echo "Vault name: " . $vault->attrs->name . " (" . count($vaults) . " in " . $key+1 . ")";
    // echo "\n=======================";
    // echo "\n\n";

    $items = $vault->items;

    foreach ($items as $key => $item) {

        $title = "";
        $url = "";
        $username = "";
        $password = "";

        $title = $item->overview->title ? $item->overview->title : "";
        $url = $item->overview->url ? $item->overview->url : "";
        $login_fields = $item->details->loginFields;

        foreach ($login_fields as $key => $field) {

            if(@$field->designation == 'username')
                $username = $field->value ? $field->value : "";
            
            if(@$field->designation == 'password')
                $password = $field->value ? $field->value : "";    
        }

        if($username != "" && $password != "")
            echo '"' . $title . '"' . "," . '"' . $url . '"' . "," . '"' . $username . '"' . "," . '"' . $password . '"' . "\n";

    }
}
echo "</pre>";
