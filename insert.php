<?php
//insert.php;
session_start();

if(isset($_POST["item_name_section_1"])||isset($_POST["item_name_section_2"])||isset($_POST["product_and_color_1_section_4"])||isset($_POST["amount_1_section_3"]))
{
	require_once 'database.php';

	if(isset($_POST["item_name_section_1"])){
		for($count = 0; $count < count($_POST["item_name_section_1"]); $count++)
		{  
			$query = "INSERT INTO sales_table
			(item_name,where_sold,item_from ,size,amount_1,currency_1,amount_2,currency_2,amount_3,currency_3,card,date) 
			VALUES (:item_name,:where_sold,:item_from ,:size,:amount_1,:currency_1,:amount_2,:currency_2,:amount_3,:currency_3,:card,:date)
			";
			$statement = $connect->prepare($query);
			$statement->execute(
				array(
					':item_name'   => $_POST["item_name_section_1"][$count],
					':where_sold'   => $_SESSION['abbr'],
					':item_from'   => $_POST["item_from"][$count],
					':size'   => $_POST["size_section_1"][$count],
					':amount_1'   => $_POST["amount_1_section_1"][$count],
					':currency_1'   => $_POST["currency_1_section_1"][$count],
					':amount_2'   => $_POST["amount_2_section_1"][$count],
					':currency_2'   => $_POST["currency_2_section_1"][$count],
					':amount_3'   => $_POST["amount_3_section_1"][$count],
					':currency_3'   => $_POST["currency_3_section_1"][$count],
					':card'   => $_POST["card"][$count],
					 ':date'   => $_SESSION['$today']
				)
			);
		}
	}
	
	if(isset($_POST["item_name_section_2"])){
			for($count = 0; $count < count($_POST["item_name_section_2"]); $count++)
		{  
			$query2 = "INSERT INTO add_subtract_item_table
			(item_name,_where,size,operation,_to,_from,date) 
			VALUES (:item_name,:_where,:size,:operation,:_to,:_from,:date)
			";
			$statement2 = $connect->prepare($query2);
			$statement2->execute(
				array(
					':item_name'   => $_POST["item_name_section_2"][$count],
					':_where'   => $_SESSION['abbr'],
					':size'   => $_POST["size2"][$count],
					':operation'   => $_POST["operation"][$count],
					':_to'   => $_POST["_to"][$count],
					':_from'   => $_POST["_from"][$count],
					 ':date'   => $_SESSION['$today']
				)
			);
		}
	}
	
		if(isset($_POST["amount_1_section_3"])){
		for($count = 0; $count < count($_POST["amount_1_section_3"]); $count++)
		{  
			$query = "INSERT INTO add_subtract_amount
			(amount,_where,currency,operation_1,operation_2,date) 
			VALUES (:amount,:_where,:currency,:operation_1,:operation_2,:date)
			";
			$statement = $connect->prepare($query);
			$statement->execute(
				array(
					':amount'   => $_POST["amount_1_section_3"][$count],
					':_where'   => $_SESSION['abbr'],
					':currency'   => $_POST["curency_1_section3"][$count],
					':operation_1'   => $_POST["operation_1_section_3"][$count],
					':operation_2'   => $_POST["operation_2_section_3"][$count],
					':date'   => $_SESSION['$today']
				)
			);
		}
	}


		if(isset($_POST["product_and_color_1_section_4"])){
		for($count = 0; $count < count($_POST["product_and_color_1_section_4"]); $count++)
		{  
			$query = "INSERT INTO orders
			(name_of_prudut_and_color,size,price,price_currency,advance_payment,advance_payment_currency,last_pay,last_pay_currency,pick_up_from,details,adress_and_telefon,date_of_taken,date_of_achievment,status) 
			VALUES (:name_of_prudut_and_color,:size,:price,:price_currency,:advance_payment,:advance_payment_currency,:last_pay,:last_pay_currency,:pick_up_from,:details,:adress_and_telefon,:date_of_taken,:date_of_achievment,:status)
			";
			$statement = $connect->prepare($query);
			$statement->execute(
				array(
					':name_of_prudut_and_color'   => $_POST["product_and_color_1_section_4"][$count],
					':size'   => $_POST["size_1_section_1"][$count],
					':price'   => $_POST["amount_1_section_4"][$count],
					':price_currency'   => $_POST["currency4_1_currency"][$count],
					':advance_payment'   => $_POST["amount_2_section_4"][$count],
					':advance_payment_currency'   => $_POST["amount_4_2_currency"][$count],
					':last_pay'   => $_POST["amount_3_section_1"][$count],
					':last_pay_currency'   => $_POST["currency4_3_currency"][$count],
					':pick_up_from'   => $_POST["pick_up_from_section_4"][$count],
					':details'   => $_POST["details_section_4"][$count],
					':adress_and_telefon'   => $_POST["adress_telefon_section_4"][$count],
					':date_of_taken'   => $_SESSION['$today'],
					':date_of_achievment'   => $_POST["date_of_achievment_4"][$count],
					':status'   => "oczekiwanie"

				)
			);
		}
	}
}
?>
