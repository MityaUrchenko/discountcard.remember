<?
if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

//echo "<pre>"; print_r($arParams); echo "</pre>";

if(!$arParams["PROPERTY_NAME"])
	$arParams["PROPERTY_NAME"] = "UF_DSCARD";

$arResult = Array();

if(!$USER->IsAuthorized())
	return;

$arResult["ERROR_MESSAGE"] = Array();
$arResult["SUCCESS"] = false;

if($_REQUEST["action"]=="search_dscard") {

	if(!$_REQUEST["dscard_remember_name"])
		$arResult["ERROR_MESSAGE"][] = GetMessage("DISCOUNDCARD_EDIT_ERROR_ENTER_NAME");

	if(!$_REQUEST["dscard_remember_lastname"])
		$arResult["ERROR_MESSAGE"][] = GetMessage("DISCOUNDCARD_EDIT_ERROR_ENTER_LASTNAME");

	if(!$_REQUEST["dscard_remember_email"] && !$_REQUEST["dscard_remember_phone"])
		$arResult["ERROR_MESSAGE"][] = GetMessage("DISCOUNDCARD_EDIT_ERROR_ENTER_PHONE_OR_EMAIL");

	if(!$arResult["ERROR_MESSAGE"] && CModule::IncludeModule("iblock")) {
	
		$arFilter = Array();
	
		$arFilter["%NAME"] = $_REQUEST["dscard_remember_lastname"]." ".$_REQUEST["dscard_remember_name"];

		if($_REQUEST["dscard_remember_email"])
			$arFilter["PROPERTY_E_MAIL"] = $_REQUEST["dscard_remember_email"];

		if($_REQUEST["dscard_remember_phone"])
			$arFilter["PROPERTY_TELEFON"] = str_replace(Array("+"," "),Array("_","_"),$_REQUEST["dscard_remember_phone"]);
		
		$arFilter["IBLOCK_ID"]=DISCOUNDCARD_IBLOCK_ID;
		$arFilter["ACTIVE"]="Y";
			
		$rsElements = CIBlockElement::GetList(
			Array("SORT"=>"ASC","NAME"=>"ASC"),
			$arFilter,
			false,
			false,
			Array("ID","NAME","PROPERTY_CML2_ARTICLE")
		);
	
		if($arElement=$rsElements->GetNext()) {
			$arResult["SUCCESS"] = true;
			$arResult["DSCARD_NAME"] = $arElement["NAME"];
			$arResult["DSCARD_NUMBER"] = $arElement["PROPERTY_CML2_ARTICLE_VALUE"];
		} else {
			$arResult["ERROR_MESSAGE"][] = GetMessage("DISCOUNDCARD_EDIT_ERROR_DSCARD_NOT_FOUND");
		}
	
	}

} 

$arUser = CUser::GetByID($USER->GetID())->GetNext();
$arResult["USER_NAME"] = $arUser["NAME"];
$arResult["USER_LASTNAME"] = $arUser["LAST_NAME"];
$arResult["USER_EMAIL"] = $arUser["EMAIL"];
$arResult["USER_PHONE"] = $arUser["PERSONAL_PHONE"];

$this->IncludeComponentTemplate();
?>