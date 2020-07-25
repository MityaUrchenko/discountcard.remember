<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();
$arComponentDescription = array(
	"NAME" => GetMessage("DISCOUNDCARD_REMEMBER_COMPONENT_NAME"),
	"DESCRIPTION" => GetMessage("DISCOUNDCARD_REMEMBER_COMPONENT_DESCRIPTION"),
	"ICON" => "/images/icon.png",
	"SORT" => 110,
	"COMPLEX" => "N",
	"PATH" => array(
		"ID" => "e-store",
		"CHILD" => array(
			"ID" => "sale_basket",
			"NAME" => GetMessage("DISCOUNDCARD_REMEMBER_COMPONENT_CATEGORY")
		)
	),
);
?>