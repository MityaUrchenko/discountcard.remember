<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

$arComponentParameters = array(
	"GROUPS" => array(),
	"PARAMETERS" => array(
		"FIELD_ID" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("DISCOUNDCARD_REMEMBER_PARAMETERS_FIELD_ID"),
			"TYPE"=>"STRING",
			"DEFAULT"=>'dscard_number',
		),
		"SUCCESS_JS" => Array(
			"PARENT" => "BASE",
			"NAME"=>GetMessage("DISCOUNDCARD_REMEMBER_PARAMETERS_SUCCESS_JS"),
			"TYPE"=>"STRING",
			"DEFAULT"=>'',
		),
	),
);

?>
