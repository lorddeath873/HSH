<?
header("Content-type:text/html; charset=utf-8");  
include_once ('inc/data.inc.php');

$stmt = $mysqli->prepare("SELECT objectid FROM state");
$stmt->execute();
$result = $stmt->get_result();

while($drop_3 = $result->fetch_object())
{
	$id = $drop_3->objectid;
	$readclient = new SoapClient('http://gov.genealogy.net/services/SimpleService?wsdl');
$checkedId =$readclient->checkObjectId($id);
 
if( $id == $checkedId ) {
        echo "$id is valid.\n";
} else if( $checkedId == '' ) {
        echo "$id is invalid.\n";
} else {
        echo "$id has been replaced with $checkedId.\n";
}
}
