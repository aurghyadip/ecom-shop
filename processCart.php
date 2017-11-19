<?php

require 'vendor/autoload.php';
session_start();
use Moltin\Cart\Cart;
use Moltin\Cart\Storage\Session;
use Moltin\Cart\Identifier\Cookie;

$_SESSION["cart"] = new Cart(new Session, new Cookie);
if(isset($_GET["delete"]))
{
	$item = $_GET["delete"];
	if($_SESSION["cart"]->has($item))
	{
		$_SESSION["cart"]->item($item)->remove();
	}
}

if(isset($_GET["quantity"]))
{
	if($_GET["quantity"] == "increase")
	{
		$_SESSION["cart"]->item($_GET['id'])->quantity += 1;
	}
	else if($_GET["quantity"] == "decrease")
	{
		$_SESSION["cart"]->item($_GET['id'])->quantity -= 1;
	}
}

if(isset($_GET["subs"]))
{
	if($_GET["subs"] == "increase")
	{
		$_SESSION["cart"]->item($_GET['id'])->rent += 3;
		$rent = $_SESSION["cart"]->item($_GET['id'])->rent;
		$basePrice = $_SESSION["cart"]->item($_GET['id'])->baseprice;
		$_SESSION["cart"]->item($_GET['id'])->price = $basePrice * ($rent - 2);
	}
	else if($_GET["subs"] == "decrease")
	{
		$_SESSION["cart"]->item($_GET['id'])->rent -= 3;
		$rent = $_SESSION["cart"]->item($_GET['id'])->rent;
		$basePrice = $_SESSION["cart"]->item($_GET['id'])->baseprice;
		if($rent == 3)
		{
			$_SESSION["cart"]->item($_GET['id'])->price = $basePrice;
		}
		else
		{
			$_SESSION["cart"]->item($_GET['id'])->price = $basePrice * ($rent - 2);
		}
	}
}
header("location:cart.php");