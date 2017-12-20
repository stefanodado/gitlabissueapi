<?php 
$ch_git = curl_init(); 
curl_setopt($ch_git, CURLOPT_RETURNTRANSFER, 1); 
// Replace with Token generated from your Gitlab Account
curl_setopt($ch_git, CURLOPT_HTTPHEADER, array('PRIVATE-TOKEN: XXXXXXXXXXXXXX'));
// Replace with you URL ENCODED project (example: main/project -> main%2Fproject) 
curl_setopt($ch_git, CURLOPT_URL, 'https://www.example.com/api/v4/projects/main%2Fproject/issues?per_page=500'); 
//*** IF INSECURE CURL
curl_setopt($ch_git, CURLOPT_SSL_VERIFYPEER , FALSE);
//*** ELSE SECURE
curl_setopt($ch_git, CURLOPT_SSL_VERIFYPEER , TRUE);
curl_setopt($ch_git, CURLOPT_CAINFO , '/path/to/my/certnew.cer');
//*** END
$output = curl_exec($ch_git); 
curl_close($ch_git);
$res =json_decode($output);
//Replace with your filename
$filename="filname.xls";
$xls="";
header ("Content-Type: application/vnd.ms-excel");
header ("Content-Disposition: inline; filename=$filename");
$xls.=("<table>");
$xls.=("<tr>");
$xls.=("<td>Issue</td>");
$xls.=("<td>Description</td>");
$xls.=("<td>Label</td>");
$xls.=("<td>State</td>");
$xls.=("</tr>");
foreach($result as $item) {
    $xls.=("<tr>");
    $xls.=("<td>".$item->title."</td>");
    $xls.=("<td>".$item->description."</td>");
    $labels="";
    foreach ($item->labels as $single_label) {
        $labels.="-".$single_label;
    }
    $xls.=("<td>".$labels."</td>");
    $xls.=("<td>".$item->state."</td>");
    $xls.=("</tr>");
} 
$xls.=("</table>");
$xls=utf8_decode($xls);
echo $xls;
?>
