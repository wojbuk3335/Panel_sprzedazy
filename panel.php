<?php

	session_start();
	
	if (!isset($_SESSION['zalogowany']))
	{
		header('Location: index.php');
		exit();
	}
	
	if (isset($_SESSION['zalogowany'])&&$_SESSION['user']=="admin")
	{
		header('Location: admin.php');
		exit();
	}
	

	require_once 'database.php';
	
	function fill_unit_select_box($connect){ 
		$output = '';
		$query = "SELECT * FROM currency ";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row){
			//$output .= '<option value="'.$row["currencySymbol"].'">'.$row["currencySymbol"].'</option>';
			if($row["currencySymbol"]=="PLN") 
					$output .= '<option selected>'.$row["currencySymbol"].'</option>';
				else
					$output .= '<option  value="'.$row["currencySymbol"].'">'.$row["currencySymbol"].'</option>';
			}
		return $output;
	}
	
		function fill_sizes_box($connect){ 
		$output = '';
		$query = "SELECT * FROM sizes ";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row){
			$output .= '<option value="'.$row["size"].'">'.$row["size"].'</option>';
			}
		return $output;
	}
	
	function fill_from_box($connect){ 
		$output = '';
		$query = "SELECT * FROM users ";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row){
				if($row["abbr"]!="Admin")
				{
				if($_SESSION['user']==$row["user"]) 
					$output .= '<option selected>'.$row["abbr"].'</option>';
				else
					$output .= '<option  value="'.$row["abbr"].'">'.$row["abbr"].'</option>';
				}
			}
		return $output;
	}
	
		function fill_from_box2($connect){ 
		$output = '';
		$query = "SELECT * FROM operations ";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row){
					$output .= '<option  value="'.$row["operation"].'">'.$row["operation"].'</option>';
			}
		return $output;
	}
	
		function fill_from_box3($connect){ 
		$output = '';
		$query = "SELECT * FROM operations2 ";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row){
					$output .= '<option  value="'.$row["operation"].'">'.$row["operation"].'</option>';
			}
		return $output;
	}
	
	function fill_from_box4($connect){ 
		$output = '';
		$query = "SELECT * FROM operations3 ";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row){
					$output .= '<option  value="'.$row["operation"].'">'.$row["operation"].'</option>';
			}
		return $output;
	}
	
		function fill_from_box5($connect){ 
		$output = '';
		$query = "SELECT * FROM operations4 ";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row){
					$output .= '<option  value="'.$row["operation"].'">'.$row["operation"].'</option>';
			}
		return $output;
	}

		$query = "SELECT * FROM item_name ";
		$statement = $connect->prepare($query);
		$statement->execute();
		$result = $statement->fetchAll();
		foreach($result as $row){
				$rows[]=$row;
		}
		$array=array();
		 for($i=0;$i<count($rows);$i++){
			$array[$i] =$rows[$i]['item_name'];
		}
		
		$query2 = "SELECT * FROM currency ";
		$statement2 = $connect->prepare($query2);
		$statement2->execute();
		$result2 = $statement2->fetchAll();
		foreach($result2 as $row2){
				$rows2[]=$row2;
		}
		$array2=array();
		 for($i=0;$i<count($rows2);$i++){
			 $array2[]=$rows2[$i]['currencySymbol'];
		}
		
		$query3 = "SELECT * FROM item_name ";
		$statement3 = $connect->prepare($query3);
		$statement3->execute();
		$result3 = $statement3->fetchAll();
		foreach($result3 as $row){
			$rows3[]=$row;
		}
		$array3=array();
		 for($i=0;$i<count($rows3);$i++){
			$array3[$i] =$rows3[$i]['size_exist'];
		}
		
		?>
<!DOCTYPE HTML>
<html lang="pl">
	<head>
		<meta name="viewport" content="width=device-width, initial-scale=1 user-scalable=no">
		<meta charset="utf-8" />
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
		<title>Panel sprzeda??y</title>
		<script src="js/jquery-3.5.1.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery-1.12.4.min.js"></script>		
		<script src="js/jquery-ui.min.js"></script>	
		<script src="js/js2.js"></script>		
		<link rel="stylesheet" href="css/jquery-ui.min.css"/>	
		<link rel="stylesheet" href="css/bootstrap.min.css"/>
		<link rel="stylesheet" href="css/style.css"/>
		<link rel="shortcut icon" href="#">	
	</head>
<body>
	<?php
		$_SESSION['$today'] = date("Y.m.d");  
		echo '<div class="logout_data">Zalogowany:
			<span class="logout_data_user">'.$_SESSION['user'].'</span>
			<span class="logout_data_date">'.$_SESSION['$today'] .'</span>
			<a class="logout_data_logout" href="logout.php">[ Wyloguj ]</a>
		</div>';
	?>
	<br />
	<form method="post" id="insert_form">
		<span id="error"></span>
		<div class="box">
			<ul>
				<li id="tab-one" class="active">
					<h4>SPRZEDA??</h4>
				</li>
				<li id="tab-two">
					<h4>DODAJ/ODPISZ PRODUKT</h4>
				</li>
				<li id="tab-three">
					<h4>DODAJ/ODPISZ KWOT??</h4>
				</li>
				<li id="tab-four">
					<h4>ZAM??WIENIA</h4>
				</li>
			</ul>
		</div>
		<div class="content">
			<div id="tab-one-content-box" class="hide active">

					<h3 align="center" class="head_panel_sprzeda??y">SPRZEDA??</h3>
						<div id="tab_one_hide" class="sprzedaz_content_hide">
						<div  class="info">*Pozosta??e zb??dne warto??ci w polach Kwota 1 lub Kwota 2 lub Kwota 3 lub Karta nale??y uzupe??ni?? warto??ci?? 0 </div >
							<table class="table table-bordered" id="item_table">
								<thead>
									<tr>
										<th style="width: 5%;">Lp.</th>
										<th style="width: 20%;">Nazwa produktu</th>
										<th style="width: 5%;">Od</th>
										<th style="width: 6%;">Rozmiar</th>
										<th style="width: 14%;">Kwota 1*</th>
										<th style="width: 14%;">Kwota 2*</th>
										<th style="width: 14%;">Kwota 3*</th>
										<th style="width: 10%;">Karta*</th>
										<th style="width: 10%;"><button type="button" name="add" class="btn btn-success btn-sm add btn_add_1" ><span>Dodaj</span></button></th>
									</tr>
								</thead>
							</table>
							<div class="sum_inscr"> SUMA (UWZGL??DNIONO SEKCJ?? dodaj/odpisz kwot??)</div>
							<div class="input_sum" ><input style="border: 1px solid #007bff;"type="text" class="form-control total center" readonly id="total"/></div>
							<div style="clear:both"></div>
				</div>
				<div class="button_hide"><button type="button" name="add" class="btn btn-success btn-sm add btn_add_1" ><span>Dodaj</span></button></div>
			</div>	

			<div id="tab-two-content-box" class="hide">
				<h3 align="center" class="head_operacje">DODAJ/ODPISZ PRODUKT</h3>
				<div id="tab_two_hide" class="sprzedaz_content_hide">
					<div class="info">*Wskazane pola musz?? zosta?? uzupe??nione</div >
					<div class="info">**W przypadku kiedy produkt posiada rozmiar nale??y wybra?? rozmiar z listy</div >
					<div class="info">**W przypadku wybrania wart??ci "Odpisa??" w polu Operacja nale??y nale??y uzupe??i?? pole Do/Na/Pod a w polu Od/Z/Spod wybrac warto???? "-", natomiast w przypadku wybrania wart??ci "Dopisa??" w polu Operacja nale??y nale??y uzupe??i?? pole Od/Z/Spod a w polu Do/Na/Pod wybrac warto???? "-"</div >
					<table class="table table-bordered" id="item_table2">
						<thead>
							<tr>
								<th style="width: 5%;">Lp.</th>
								<th style="width: 21%;">Nazwa produktu*</th>
								<th style="width: 16%;">Rozmiar**</th>
								<th style="width: 16%;">Operacja</th>
								<th style="width: 16%;">Do/Na/Pod***</th>
								<th style="width: 16%;">Od/Z/Spod***</th>
								<th style="width: 10%;"><button type="button" name="add" class="btn btn-success btn-sm add2 btn_add_1"><span>Dodaj</span></button></th>
							</tr>
						</thead>
						<tbody>
						</tbody>
					</table>
				</div>		
				<div class="button_hide"><button type="button" name="add" class="btn btn-success btn-sm add2 btn_add_1"><span>Dodaj</span></button></div>
			</div>
			
			<div id="tab-three-content-box" class="hide">				
				<h3 align="center" class="head_operacje">DODAJ/ODPISZ KWOT??</h3>
				<div id="tab_three_hide" class="sprzedaz_content_hide">
				<div class="info">*W przypadku odpisania kwoty warto???? nale??y poprzedzi?? znakiem minusa</div >
				<div class="info">**Nale??y wprowadzi?? warto??ci w conajmniej jednym z dw??ch oznaczonych p??l</div >
				<table class="table table-bordered" id="amount_table">
					<thead>
						<tr>
							<th style="width: 5%;">Lp.</th>
							<th style="width: 15%;">Kwota*</th>
							<th style="width: 15%;">Operacja 1**</th>
							<th style="width: 55%;">Operacja 2 / Dodatkowe informacje**</th>
							<th style="width: 10%;"><button type="button" name="add" class="btn btn-success btn-sm add3 btn_add_1"><span>Dodaj</span></button></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				</div>
				<div class="button_hide"><button type="button" name="add" class="btn btn-success btn-sm add3 btn_add_1"><span>Dodaj</span></button></div>				
			</div>
			
			<div id="tab-four-content-box" class="hide">
				<h3 align="center" class="head_operacje">ZAM??WIENIA</h3>
				<div id="tab_four_hide" class="sprzedaz_content_hide">
				<div class="info">*Pole wype??niane dowolnie</div >
				<div class="info">**Nale??y usupe??ni?? wszystkie pola, w przypadku braku potrzeby pole nale??y uzupe??ni?? warto??ci?? 0</div >
				<table class="table table-bordered" id="orders_table">
					<thead>
						<tr>
							<th style="width: 5%;">Lp.</th>
							<th style="width: 13%;">Nazwa produktu i kolor*</th>
							<th style="width: 5%;">Rozmiar</th>
							<th style="width: 5%;">Cena**</th>
							<th style="width: 5%;">Zaliczka**</th>
							<th style="width: 8%;">Dop??ata/pobranie**</th>
							<th style="width: 10%;">Odbi??r</th>
							<th style="width: 15%;">Szczeg????y</th>
							<th style="width: 17%;">Adres i telefon</th>
							<th style="width: 10%;">Data realizacji</th>
							<th style="width: 7%;"><button type="button" name="add" class="btn btn-success btn-sm add4 btn_add_1"><span>Dodaj</span></button></th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
				</div>
				<div class="button_hide"><button type="button" name="add" class="btn btn-success btn-sm add4 btn_add_1"><span>Dodaj</span></button></div>	
			</div>										
			<div align="center">
				<input type="submit" name="submit" class="btn btn-info" value="Wy??lij" />
			</div>										
		</div>							
	</form>
</body>
</html>

<script>
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
// Klasy funkcji add dodaj??cej wiersze w sekcji SPRZEDA??
// Klasa lp s??u??y do iteracji wierszy w funkcji dodaj add i funkcji dodaj add
// Klasa item_name opisuje wygl??d kontrolki input w kt??rej wprowadzamy nazw?? produktu
// Klasa item_name_section_1 s??u??y do walidacji wpisywanych produkt??w
// Klasa form-select opisuje wygl??d rozwijanego menu typu select
// Klasa amount opisuje wygl??d input??w typu text w polach Kwota 1 Kwota 2 Kwota 3 i jest uzwana przez funkcj?? sum do zliczania got??wki 
// Klasa amount_1_section_1 amount_2_section_1 amount_3_section_1 s??u???? do sprawdzania metod?? each czy zosta??y wprowadzone dane w pola Kwota 1 Kwota 2 Kwota 3
// Klasa amount_filter s??u??y do filtr??wania wprowadzanych danych w polach Kwota 1 Kwota 2 i Kwota 3. Dzi??ki niej mo??emy wprowadzi?? w wymienione pola tylko liczby i znak odejmowania "-"
// Klasa card_amount s??u??y opisuje wygl??d kontrolki do wprowadzania warto??ci liczbowych w polu Karta. Opisuje to co klasa amount w polach Kwota 1 Kwota 2 i Kwota 3 jednak zosta??a u??yta poniewa?? funkcja sum() dokonuje oblicze?? na podstawie klasy amount
// Klasa card_section_1 s??u??y s??u??y do sprawdzania metod?? each czy zosta??y wprowadzone dane w pole Karta
// Klasy remove jest u??ywana przez metod?? $(document).on('click', '.remove', remove) kt??ra uruchamia funkcj?? remove kt??ra z kolei s??u??y to usuwania wiersza w tabeli
// Klasy btn btn-danger btn-sm opisuj?? wygl??d przycisku s??u????cego do usuwania wiersza w tabeli 
// Klasa size1 ??u??y do sprawdzania metod?? each czy dany produkt posiada rozmiar, je??li posiada a nie zostanie wybrany wyrzuca b????d i je??li nie posiada a zosta?? wybrany r??wnie?? wyrzuca b????d
//zmienne ww,xx,yy,zz s??u???? do ob??s??ugi usuwania i dodawania klasy sprzedaz_content_hide kt??ra usuwa lub pewne elementy przy zmniejszaniu szeroko??ci ekranu

//Tablica item_name_section_1[] atrybutu name wysy??a dane do bazy danych z pola Nazwa produktu
//Tablica item_from[] atrybutu name wysy??a dane do bazy danych z pola Od
//Tablica size_section_1[] atrybutu name wysy??a dane do bazy danych z pola Rozmiar
//Tablica amount_1_section_1[] atrybutu name wysy??a dane do bazy danych z pola Kwota 1
//Tablica amount_2_section_1[] atrybutu name wysy??a dane do bazy danych z pola Kwota 2
//Tablica amount_3_section_1[] atrybutu name wysy??a dane do bazy danych z pola Kwota 3
//Tablica currency_1_section_1[] atrybutu name wysy??a jaka waluta zosta??a wybrana w polu Kwota 1
//Tablica currency_2_section_1[] atrybutu name wysy??a jaka waluta zosta??a wybrana w polu Kwota 2
//Tablica currency_3_section_1[] atrybutu name wysy??a jaka waluta zosta??a wybrana w polu Kwota 32
//Tablica card[] atrybutu name wysy??a do bazy danych warto???? z pola Karta

//Funckja dodaj??ca wiersz w sekcji SPRZEDA??




var ww;
var xx;
var yy;
var zz;
function add(){
ww=0;
	var html = '';
	html += '<tr>';
	html += '<td data-label="Lp." class="lp"></td>';
	html += '<td data-label="Nazwa produktu"><input type="text" class="item_name item_name_section_1" name="item_name_section_1[]" onfocusout="check_item()"></td>';
	html += '<td data-label="Od"><select class="form-select" name="item_from[]"><?php echo fill_from_box($connect); ?></select></td>';
	html += '<td data-label="Rozmiar"><select class="size1 form-select" name="size_section_1[]" ><option value="-">-</option><?php echo fill_sizes_box($connect); ?></select></td>';
	html += '<td data-label="Kwota 1*"><input type="text" class="amount amount_filter amount_1_section_1 " autocomplete="off" name="amount_1_section_1[]" onkeyup="sum();"/><select onmouseup=sum(); class="form-select currency" name="currency_1_section_1[]"><?php echo fill_unit_select_box($connect); ?></select></td>';
	html += '<td data-label="Kwota 2*"><input type="text" class="amount amount_filter amount_2_section_1 "autocomplete="off" name="amount_2_section_1[]"  onkeyup="sum();"/><select onmouseup=sum(); class="form-select currency" name="currency_2_section_1[]"><?php echo fill_unit_select_box($connect); ?></select></td>';
	html += '<td data-label="Kwota 3*"><input type="text" class="amount amount_filter amount_3_section_1 " autocomplete="off" name="amount_3_section_1[]"  onkeyup="sum();"/><select onmouseup=sum(); class="form-select currency" name="currency_3_section_1[]"><?php echo fill_unit_select_box($connect); ?></select></td>';
	html += '<td data-label="Karta"><input type="text" class="card_amount amount_filter card_section_1 " name="card[]" autocomplete="off"  onfocusout="check_item()"> PLN</td>';
	html += '<td data-label=""><button  type="button" class="btn btn-danger btn-sm remove" name="remove" ><span>Usu??</span></button></td></tr>';
	
	$('#item_table').append(html);
	$('.lp').each(function(){
		ww=ww+1;
		$(this).html(ww);
	});	
	var availableTags = <?php echo json_encode($array); ?>;   
	$(".item_name_section_1").autocomplete({
		source: function(request, response) {
		var results = $.ui.autocomplete.filter(availableTags, request.term);
		response(results.slice(0, 7));
		}
	});
	(function($) {
		$.fn.inputFilter = function(inputFilter) {
			return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
			if (inputFilter(this.value)) {
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
			} else if (this.hasOwnProperty("oldValue")) {
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			} else {
				this.value = "";
			}
			});
		};
	}(jQuery));
	$(".amount_filter").inputFilter(function(value) {
		return /^-?\d*[.,]?\d{0,2}$/.test(value);
	});
	if(ww!=0)
	{
		  var element = document.getElementById("tab_one_hide");
		  element.classList.remove("sprzedaz_content_hide");
	}else{
		  var element = document.getElementById("tab_one_hide");
		  element.classList.add("sprzedaz_content_hide");
	}
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
// Klasy funkcji add dodaj??cej wiersze w sekcji DODAJ/ODPISZ PRODUKT
// Klasa lp2 s??u??y do iteracji wierszy w funkcji dodaj add2 i funkcji dodaj add
// Klasa item_name opisuje wygl??d kontrolki input w kt??rej wprowadzamy nazw?? produktu
// Klasa item_name_section_2 s??u??y do walidacji wpisywanych produkt??w
// Klasa form-select opisuje wygl??d rozwijanego menu typu select
// Klasa size2 sprawdza czy zosta?? wprowadzony rozmiar produktu kt??ry ten rozmiar posiada np. Szanelka czerwona z przeszyciem posiada rozmair ale portfel rozmiaru nie posiada
// Klasy remove jest u??ywana przez metod?? $(document).on('click', '.remove', remove) kt??ra uruchamia funkcj?? remove kt??ra z kolei s??u??y to usuwania wiersza w tabeli
// Klasy btn btn-danger btn-sm opisuj?? wygl??d przycisku s??u????cego do usuwania wiersza w tabeli 

//Tablica item_name_section_2[] atrybutu name wysy??a dane do bazy danych z pola Nazwa produktu
//Tablica size2[] atrybutu name wysy??a dane do bazy danych z pola Rozmiar
//Tablica operation[] atrybutu name wysy??a dane do bazy danych z pola Operacja

//Funckja dodaj??ca wiersz w sekcji DODAJ/ODPISZ PRODUKT
function add2(){
xx=0;
	var html = '';
	html += '<tr>';
	html += '<td data-label="Lp." class="lp2"></td>';
	html += '<td data-label="Nazwa produktu*"><input type="text" class="item_name item_name_section_2 " name="item_name_section_2[]" onfocusout="check_item()"></td>';
	html += '<td data-label="Rozmiar**"><select " class="form-select size2" name="size2[]" ><option value="-">-</option><?php echo fill_sizes_box($connect); ?></select></td>';
	html += '<td data-label="Operacja"><select  " class="form-select operationn" name="operation[]"></option><?php echo fill_from_box2($connect); ?></select></td>';
	html += '<td data-label="Do"><select  " class="form-select  _to" name="_to[]"><option value="-">-</option><?php echo fill_from_box4($connect); ?></select></td>';
	html += '<td data-label="Od"><select  " class="form-select  _from" name="_from[]"><option value="-">-</option><?php echo fill_from_box5($connect); ?></select></td>';
	html += '<td data-label="Dodaj\Usu??"><button type="button" class="btn btn-danger btn-sm remove"><span>Usu??</span></button></td></tr>';
	$('#item_table2').append(html);
	$('.lp2').each(function(){
		xx=xx+1;
		$(this).html(xx);
	});	
	
	var availableTags = <?php echo json_encode($array); ?>;   // Tablica produkt??w wyci??gni??ta z bazy danych


	$(".item_name_section_2").autocomplete({
		source: function(request, response) {
		var results = $.ui.autocomplete.filter(availableTags, request.term);
		response(results.slice(0, 7));
		}
	});
	
		if(xx!=0)
	{
		  var element = document.getElementById("tab_two_hide");
		  element.classList.remove("sprzedaz_content_hide");
	}else{
		  var element = document.getElementById("tab_two_hide");
		  element.classList.add("sprzedaz_content_hide");
	}
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
// Klasy funkcji add dodaj??cej wiersze w sekcji DODAJ/ODPISZ KWOT??
// Klasa lp3 s??u??y do iteracji wierszy w funkcji dodaj add3 i funkcji dodaj add
// Klasa amount opisuje wygl??d input??w typu text w polu Kwota i jest uzwana przez funkcj?? sum do zliczania got??wki 
// Klasa amount_filter s??u??y do filtr??wania wprowadzanych danych w polach Kwota 1 Kwota 2 i Kwota 3. Dzi??ki niej mo??emy wprowadzi?? w wymienione pola tylko liczby i znak odejmowania "-"
// Klasa amount_1_section_3 s??u??y do sprawdzania metod?? each czy zosta??y wprowadzone dane w pola Kwota
// Klasa form-select opisuje wygl??d rozwijanego menu typu select
// Klasy remove jest u??ywana przez metod?? $(document).on('click', '.remove', remove) kt??ra uruchamia funkcj?? remove kt??ra z kolei s??u??y to usuwania wiersza w tabeli
// Klasy btn btn-danger btn-sm opisuj?? wygl??d przycisku s??u????cego do usuwania wiersza w tabeli 
// Klasa operation_1_section_3 jest u??ywana przez metod?? each do sprawdzeia czy zosta??y wprowadzone jakie?? dane w polu Operacja 1
// Klasa operation_2_section_3 jest u??ywana przez metod?? each do sprawdzeia czy zosta??y wprowadzone jakie?? dane w polu Operacja 2

//Tablica amount_1_section_3[] atrybutu name wysy??a warto???? kwoty w prowadzonej w inpcie z pola Kwota do bazy danych 
//Tablica curency_1_section3[] atrybutu name wysy??a rodzaj waluty wybranej z pola select w polu Kwota
//Tablica operation_1_section_3[] atrybutu name wysy??a dane do bazy danych wprowadzone w polu Operacja 1 
//Tablica operation_2_section_3[] atrybutu name wysy??a dane do bazy danych wprowadzone w polu Operacja 2
function add3(){
	yy=0;
	var html = '';
	html += '<tr>';
	html += '<td data-label="Lp." class="lp3"></td>';
	html += '<td data-label="Kwota 1"><input type="text" class="amount amount_filter amount_1_section_3 " autocomplete="off" name="amount_1_section_3[]" onkeyup="sum();"/><select name="curency_1_section3[]" onmouseup=sum(); class="form-select currency "><?php echo fill_unit_select_box($connect); ?></select></td>';
	html += '<td data-label="Operacja 1"><select  " class="form-select  operation_1_section_3" name="operation_1_section_3[]"><option value=""></option><?php echo fill_from_box3($connect); ?></select></td>';
	html += '<td data-label="Operacja 2"><textarea maxlength="350" class="operation_2_section_3" name="operation_2_section_3[] "oninput="auto_grow(this)"></textarea></td>';
	html += '<td data-label="Dodaj\Usu??"><button type="button" class="btn btn-danger btn-sm remove"><span>Usu??</span></button></td></tr>';
	$('#amount_table').append(html);
	$('.lp3').each(function(){
		yy=yy+1;
		$(this).html(yy);
	});	
	
		(function($) {
		$.fn.inputFilter = function(inputFilter) {
			return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
			if (inputFilter(this.value)) {
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
			} else if (this.hasOwnProperty("oldValue")) {
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			} else {
				this.value = "";
			}
			});
		};
	}(jQuery));

	$(".amount_filter").inputFilter(function(value) {
		return /^-?\d*[.,]?\d{0,2}$/.test(value);
	});
		if(yy!=0)
	{
		  var element = document.getElementById("tab_three_hide");
		  element.classList.remove("sprzedaz_content_hide");
	}else{
		  var element = document.getElementById("tab_three_hide");
		  element.classList.add("sprzedaz_content_hide");
	}
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//
// Klasy funkcji add dodaj??cej wiersze w sekcji ZAM??WIENIA
// Klasa lp4 s??u??y do iteracji wierszy w funkcji dodaj add4 i funkcji dodaj add
// Klasa form-select opisuje wygl??d rozwijanego menu typu select
// Klasa size_1_section_1 
// Klasa amount_no_sum  opisuje wygl??d input??w do kt??ych wpisujemy kwoty... Jest to ta sama klasa co amount ale nie uczestniczy w og??lnym sumowaniu poniewa?? opisuje cene kurtki oraz dop??at?? w p????niejszym terminie
// Klasa price_1_section_4 zosta??a u??yta do sprawdzania metod?? each czy wszystkie warto??ci inputa Cena zosta??y uzupe??nione
// Klasa amount_filter s??u??y do filtr??wania wprowadzanych danych w polach Kwota 1 Kwota 2 i Kwota 3. Dzi??ki niej mo??emy wprowadzi?? w wymienione pola tylko liczby i znak odejmowania "-"
// Klasa amount opisuje wygl??d input??w typu text w polu Kwota i jest uzwana przez funkcj?? sum do zliczania got??wki 
// Klasa advance_payment_section_4 sprawdza za pomoc?? metody each czy zosta??y wprowadzone wszystkie dane w polu Zaliczka
// Klasa last_pay_section_4 sprawdza za pomoc?? metody each czy zosta??y wprowadzone wszystkie dane w polu Dop??ata/pobranie
// Klasa pick_up_from_section_4 sprawdza za pomoc?? metody each czy zosta??y wprowadzone wszystkie dane w Odbi??r	
// Klasa adress_telefon sprawdza za pomoc?? metody each czy zosta??y wprowadzone wszystkie dane w polu Adres i telefon
// Klasy remove jest u??ywana przez metod?? $(document).on('click', '.remove', remove) kt??ra uruchamia funkcj?? remove kt??ra z kolei s??u??y to usuwania wiersza w tabeli
// Klasy btn btn-danger btn-sm opisuj?? wygl??d przycisku s??u????cego do usuwania wiersza w tabeli 

//Tablica product_and_color_1_section_4[] atrybutu name wysy??a dane z pola Nazwa produktu i kolor do bazy danych
//Tablica size_1_section_1[] atrybutu name wysy??a dane z pola Rozmiar do bazy danych
//Tablica amount_1_section_4[] atrybutu name wysy??a dane z pola Cena do bazy danych
//Tablica amount_2_section_4[] atrybutu name wysy??a dane z pola Zaliczka do bazy danych
//Tablica amount_2_section_4[] atrybutu name wysy??a dane z pola Dop??ata/pobranie do bazy danych
//Tablica pick_up_from_section_4[] atrybutu name wysy??a dane z pola Odbi??r do bazy danych
//Tablica details_section_4[] atrybutu name wysy??a dane z pola Szczeg????y do bazy danych
//Tablica adress_telefon_section_4[] atrybutu name wysy??a dane z pola Adres i telefon do bazy danych
function add4(){
zz=0;
	var html = '';
	html += '<tr>';
	html += '<td data-label="Lp." class="lp4"></td>';
	html += '<td data-label="Nazwa produktu i kolor"><input type="text" class="product_and_color_1_section_4" autocomplete="off" name="product_and_color_1_section_4[]"/></td>';
	html += '<td data-label="Rozmiar"><select " class="form-select" name="size_1_section_1[]" ><option value="-">-</option><?php echo fill_sizes_box($connect); ?></select></td>';
	html += '<td data-label="Cena"><input type="text" class=" amount_no_sum price_1_section_4 amount_filter" autocomplete="off" name="amount_1_section_4[]"/><select class="form-select currency4" name="currency4_1_currency[]"><?php echo fill_unit_select_box($connect); ?></select></td>';
	html += '<td data-label="Zaliczka"><input type="text" class=" amount advance_payment_section_4 amount_filter" autocomplete="off" name="amount_2_section_4[]" onkeyup="sum();"/><select onmouseup=sum(); class="form-select currency " name="amount_4_2_currency[]"><?php echo fill_unit_select_box($connect); ?></select></td>';
	html += '<td data-label="Dop??ata/pobranie"><input type="text" class="amount_no_sum last_pay_section_4 amount_filter" autocomplete="off" name="amount_3_section_1[]"/><select class="form-select currency4 " name="currency4_3_currency[]"><?php echo fill_unit_select_box($connect); ?></select></td>';
	html += '<td data-label="Odbi??r"><select class="form-select pick_up_from_section_4" name="pick_up_from_section_4[]" ><option value=""></option><?php echo fill_from_box4($connect); ?></select></td>';
	html += '<td data-label="Szczeg????y"><textarea name="details_section_4" oninput="auto_grow(this)"></textarea></td>';
	html += '<td data-label="Adres i telefon"><textarea class=" adress_telefon" name="adress_telefon_section_4[]" oninput="auto_grow(this)"></textarea></td>';
	html += '<td data-label="Data realizacji"><input class="datepicker product_and_color_1_section_4" name="date_of_achievment_4[]" type="text" onclick="myFunction()"></td>';
	html += '<td data-label="Dodaj\Usu??"><button type="button" class="btn btn-danger btn-sm remove"><span>Usu??</span></button></td></tr>';
	$('#orders_table').append(html);
	$('.lp4').each(function(){
		zz=zz+1;
		$(this).html(zz);
	});


	
	(function($) {
		$.fn.inputFilter = function(inputFilter) {
			return this.on("input keydown keyup mousedown mouseup select contextmenu drop", function() {
			if (inputFilter(this.value)) {
				this.oldValue = this.value;
				this.oldSelectionStart = this.selectionStart;
				this.oldSelectionEnd = this.selectionEnd;
			} else if (this.hasOwnProperty("oldValue")) {
				this.value = this.oldValue;
				this.setSelectionRange(this.oldSelectionStart, this.oldSelectionEnd);
			} else {
				this.value = "";
			}
			});
		};
	}(jQuery));

	$(".amount_filter").inputFilter(function(value) {
		return /^-?\d*[.,]?\d{0,2}$/.test(value);
	});
	
			if(zz!=0)
	{
		  var element = document.getElementById("tab_four_hide");
		  element.classList.remove("sprzedaz_content_hide");
	}else{
		  var element = document.getElementById("tab_four_hide");
		  element.classList.add("sprzedaz_content_hide");
	}
		
    $( ".datepicker" ).datepicker({
	  dateFormat: "yy-mm-dd"
	});
}

function check_item(){
	var availableTags = <?php echo json_encode($array); ?>; 
	
}

function auto_grow(element) {
    element.style.height = "5px";
    element.style.height = (element.scrollHeight)+"px";
}

function remove(){
	
	 ww=0;
	 xx=0;
	 yy=0;
	 zz=0;
	$(this).closest('tr').remove();
	$('.lp').each(function(){
		ww=ww+1;
		$(this).html(ww);
	});
	$('.lp2').each(function(){
		xx=xx+1;
		$(this).html(xx);
	});
	$('.lp3').each(function(){
		yy=yy+1;
		$(this).html(yy);
	});
		$('.lp4').each(function(){
		zz=zz+1;
		$(this).html(zz);
	});
	sum();
	
	if(ww!=0)
	{
		  var element = document.getElementById("tab_one_hide");
		  element.classList.remove("sprzedaz_content_hide");
	}else{
		  var element = document.getElementById("tab_one_hide");
		  element.classList.add("sprzedaz_content_hide");
	}
		if(xx!=0)
	{
		  var element = document.getElementById("tab_two_hide");
		  element.classList.remove("sprzedaz_content_hide");
	}else{
		  var element = document.getElementById("tab_two_hide");
		  element.classList.add("sprzedaz_content_hide");
	}
			if(yy!=0)
	{
		  var element = document.getElementById("tab_three_hide");
		  element.classList.remove("sprzedaz_content_hide");
	}else{
		  var element = document.getElementById("tab_three_hide");
		  element.classList.add("sprzedaz_content_hide");
	}
			if(zz!=0)
	{
		  var element = document.getElementById("tab_four_hide");
		  element.classList.remove("sprzedaz_content_hide");
	}else{
		  var element = document.getElementById("tab_four_hide");
		  element.classList.add("sprzedaz_content_hide");
	}
}

function sum(){
	var suma=new Array();
	var out_arr=new Array();
	var suma_t=0;
	var x = document.querySelectorAll(".amount"); 
	var y= document.querySelectorAll(".currency"); 
	var currencyTable = <?php echo json_encode($array2); ?>; 
	var output="";
	
	for(var i=0;i<currencyTable.length;i++)
	{
			for(var j=0;j<x.length;j++)
			{
				if(currencyTable[i]==y[j].value && x[j].value!="-") 
					suma_t=suma_t+Number(x[j].value);
			}
	suma[i]=suma_t;	
	if(Number(suma[i])===suma[i]&&suma[i]%1!==0)
		suma[i]=suma[i].toFixed(2);
	suma_t=0;
	}

	for(var i=0;i<currencyTable.length;i++)
	{
		if(suma[i]!=0)
			output+=suma[i]+currencyTable[i];
		if(suma[i+1]>0 && output!="")
			output+="+";
	}
	Array.prototype.except = function(val) {
    return this.filter(function(x) { return x !== val; });        
	}; 
	$("#total").val(output);
};

function submit(event){
	event.preventDefault();
	var error = '';
	var a=1,b=1,c=1,d=1,e=1,f=1,g=1,h=1,i=1,j=1,k=1,l=1,m=1,n=1,o=1,p=1,q=1,r=1,s=1,t=1,u=1,wwww=1,xxxx=1,yyyy=1,dat=1;
	
	
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	
// Kontrola wype??nienia kom??rek w sekcji SPZEDA??	
	$('.item_name_section_1').each(function(){
		var nr_of_item=null;
		var size_exist=null;
		if($(this).val() == ''){
			error += "<p>Wprowad?? nazw?? produktu nr "+a+" w sekcji SPZEDA??</p>";
		}else {
			var bool=false;
			var availableTags = <?php echo json_encode($array); ?>;		// Tablica produkt??w wyci??gni??ta z bazy danych
			var bool_size_exist = <?php echo json_encode($array3); ?>;   // Tablica warto??ci true lub false w zale??no??ci od tego czy dany produkt b??dzie posiada?? rozmiar czy nie
			for(var i=0;i<availableTags.length;i++){
				if(availableTags[i]==$(this).val())
				{
					nr_of_item=i;
					size_exist=bool_size_exist[nr_of_item];		
					bool=true;
					$('.size1').each(function(){
						if((size_exist==1) && ($(this).val() == '-') && (t==b)){
							error += "<p>Nazwa produktu nr "+a+" posiada rozmiar kt??ry nale??y uzupe??ni?? w polu rozmiar w sekcji SPZEDA??</p>";
						}
						
						if((size_exist==0) && ($(this).val() != '-') && (t==b)){
							error += "<p>Nazwa produktu nr "+a+" nie posiada rozmiaru, zmie?? rozmiar w rz??dzie nr "+b+" na '-' w sekcji SPZEDA??</p>";
						}
						t++;
					});
				}
			}
			if(bool==false){
				error += "<p>Nazwa produktu nr "+a+" nie znajduje si?? w bazie danych produkt??w. Wprowad?? poprawn?? nazw?? w sekcji SPZEDA??</p>";
			}
		}	
		a++;
		t=1;
	});
	
	$('.amount_1_section_1').each(function(){
		if($(this).val() == '' || $(this).val() == '-'){
			error += "<p>Wprowad?? kwot?? 1 w rz??dzie nr "+i+" w sekcji SPRZEDA??</p>";
		}
		i++;
	});
	
	$('.amount_2_section_1').each(function(){
		if($(this).val() == '' || $(this).val() == '-'){
			error += "<p>Wprowad?? kwot?? 2 w rz??dzie nr  "+j+" w sekcji SPRZEDA??</p>";
		}
		j++;
	});
	
	$('.amount_3_section_1').each(function(){
		if($(this).val() == '' || $(this).val() == '-'){
			error += "<p>Wprowad?? kwot?? 3 w rz??dzie nr  "+k+" w sekcji SPRZEDA??</p>";
		}
		k++;
	});
	
	$('.card_section_1').each(function(){
		if($(this).val() == '' || $(this).val() == '-'){
			error += "<p>Wprowad?? p??atno???? kart?? w rz??dzie nr "+l+" w sekcji SPRZEDA??</p>";
		}
		l++;
	});
	
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	
// Kontrola wype??nienia kom??rek w sekcji DODAJ/OPDISZ PRODUKT
	$('.item_name_section_2').each(function(){
		var nr_of_item=null;
		var size_exist=null;
		if($(this).val() == ''){
			error += "<p>Wprowad?? nazw?? produktu nr "+b+" w sekcji DODAJ/OPDISZ PRODUKT</p>";
		}else {
			var bool=false;
			var availableTags = <?php echo json_encode($array); ?>;		// Tablica produkt??w wyci??gni??ta z bazy danych
			var bool_size_exist = <?php echo json_encode($array3); ?>;   // Tablica warto??ci true lub false w zale??no??ci od tego czy dany produkt b??dzie posiada?? rozmiar czy nie
			for(var i=0;i<availableTags.length;i++){
				if(availableTags[i]==$(this).val())
				{
					nr_of_item=i;
					size_exist=bool_size_exist[nr_of_item];		
					bool=true;
					$('.size2').each(function(){
						if((size_exist==1) && ($(this).val() == '-') && (u==b)){
							error += "<p>Nazwa produktu nr "+b+" posiada rozmiar kt??ry nale??y uzupe??ni?? w polu rozmiar w sekcji DODAJ/OPDISZ PRODUKT</p>";
						}
						
						if((size_exist==0) && ($(this).val() != '-') && (u==b)){
							error += "<p>Nazwa produktu nr "+b+" nie posiada rozmiaru, zmie?? rozmiar w rz??dzie nr "+b+" na '-' w sekcji DODAJ/OPDISZ PRODUKT</p>";
						}
						t++;
					});
				}
			}
			if(bool==false){
				error += "<p>Nazwa produktu nr "+b+" nie znajduje si?? w bazie danych produkt??w. Wprowad?? poprawn?? nazw?? w sekcji DODAJ/OPDISZ PRODUKT</p>";
			}
		}	
		b++;
		u=1;
	});
	
	$('.operationn').each(function(){
		if($(this).val() == 'Odpisa??'){
			
			
			
				$('._to').each(function(){
					if($(this).val() == '-' && wwww==xxxx){	
						error += "<p>Warto??c w polu Do/Na/Pod w wierszu nr "+xxxx+" powinna by?? r????na od '-'</p>";
					}
					xxxx++;
				});
				xxxx=1;
				
				$('._from').each(function(){
					if($(this).val() != '-' && wwww==yyyy){	
						error += "<p>Warto???? w polu Od/Z/Spod w wierszu nr "+yyyy+" powinna by?? r??wna '-'</p>";
					}
					yyyy++;
				});
				yyyy=1;
			
			
		}else{
			
				$('._to').each(function(){
					if($(this).val() != '-' && wwww==xxxx){	
						error += "<p>Warto??c w polu Do/Na/Pod w wierszu nr "+xxxx+" powinna by?? r??wna '-'</p>";
					}
					xxxx++;
				});
				xxxx=1;
				
				$('._from').each(function(){
					if($(this).val() == '-' && wwww==yyyy){	
						error += "<p>Warto???? w polu Od/Z/Spod w wierszu nr "+yyyy+" powinna by?? r????na od '-'</p>";
					}
					yyyy++;
				});
				yyyy=1;
		}
		wwww++;
	});
	
	
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	
// Kontrola wype??nienia kom??rek w sekcji DODAJ/ODPISZ KWOT??

	$('.amount_1_section_3').each(function(){
		if($(this).val() == ''){
			error += "<p>Wprowad?? kwot?? nr "+e+" w sekcji DODAJ/ODPISZ KWOT??</p>";
		}
		e++;
	});
	
	$('.operation_1_section_3').each(function(){
		if($(this).val() == ''){
			$('.operation_2_section_3').each(function(){
				if($(this).val() == '' && g==h)	
					error += "<p>Wprowad?? operacje1 lub operacje2 w rz??dzie "+g+"  w sekcji DODAJ/ODPISZ KWOT?? </p>";
				s++;
			});
		}
		g++;
		h=1;
	});
	
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	
// Kontrola wype??nienia kom??rek w sekcji ZAM??WIENIA

	$('.product_and_color_1_section_4').each(function(){
		if($(this).val() == ''){
			error += "<p>Wprowad?? nazw?? produktu i kolor nr "+m+" w sekcji ZAM??WIENIA</p>";
		}
		m++;
	});

	$('.price_1_section_4').each(function(){
		if($(this).val() == ''){
			error += "<p>Wprowad?? cen?? nr "+o+" w sekcji ZAM??WIENIA</p>";
		}
		o++;
	});
	
	$('.advance_payment_section_4').each(function(){
		if($(this).val() == ''){
			error += "<p>Wprowad?? zaliczk?? nr "+p+" w sekcji ZAM??WIENIA</p>";
		}
		p++;
	});
	
	$('.last_pay_section_4').each(function(){
		if($(this).val() == ''){
			error += "<p>Wprowad?? dop??at??/pobranie nr "+q+" w sekcji ZAM??WIENIA</p>";
		}
		q++;
	});
	
	$('.pick_up_from_section_4').each(function(){
		if($(this).val() == ''){
			error += "<p>Wprowad?? odbi??r nr "+r+" w sekcji ZAM??WIENIA</p>";
		}
		r++;
	});
	
	$('.adress_telefon').each(function(){
		if($(this).val() == ''){
			error += "<p>Wprowad?? adres i telefon nr "+s+" w sekcji ZAM??WIENIA</p>";
		}
		s++;
	});
	
	var get_date;
	
function isValidDate(dateString) {
  var regEx = /^\d{4}-\d{2}-\d{2}$/;
  if(!dateString.match(regEx)) return false;  // Invalid format
  var d = new Date(dateString);
  var dNum = d.getTime();
  if(!dNum && dNum !== 0) return false; // NaN value, Invalid date
  return d.toISOString().slice(0,10) === dateString;
}
	
	
function get_today(){
	var _today = new Date();
	var _day=_today.getDate();
	if(_day<10)_day="0"+_day;
	var _month=_today.getMonth()+1;
	if(_month<10)_month="0"+_month;
	var year =_today.getFullYear();
	var full_date=year+"-"+_month+"-"+_day;
	return full_date;
}

	var _today_=get_today();
	$('.datepicker').each(function(){
		get_date=$(this).val();
		if(!isValidDate(get_date) || get_date==""){
			error += "<p>Wprowad?? poprawn?? dat?? nr "+dat+" w sekcji ZAM??WIENIA</p>";
		} else if(get_date<=_today_){
			error += "<p>Data realizacji zam??wienia nie mo??e by?? mniejsza lub r??wna od aktualnej daty w wierszu nr "+dat+" w sekcji ZAM??WIENIA</p>";
		}
			dat++
	});
	
	
//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	
// Wysy??anie formularza do BAZY DANYCH
	
	var form_data = $(this).serialize();
	if(error == '')
	{
		$.ajax({
			url:"insert.php",
			method:"POST",
			data:form_data,
			success:function(data){
				$('#item_table').find("tr:gt(0)").remove();
				$('#item_table2').find("tr:gt(0)").remove();
				$('#amount_table').find("tr:gt(0)").remove();
				$('#orders_table').find("tr:gt(0)").remove();
				$('#error').html('<div class="alert alert-success">Dane zosta??y wys??ane pomy??lnie...</div>');
				document.getElementById("total").value="";
			}
		});
	}
	else
	{
		$('#error').html('<div class="alert alert-danger">'+error+'</div>');
	}
}

//--------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------//	
// Ob??uga przyisk??w add i remove i wy??lij

$(document).ready(function(){	
	$(document).on('click', '.add', add);
	$(document).on('click', '.add2', add2);
	$(document).on('click', '.add3', add3);
	$(document).on('click', '.add4', add4);
	$(document).on('click', '.remove', remove);
	$('#insert_form').on('submit', submit);
	
	
	$(".box").on("click","li",function(){
			var tabsId=$(this).attr("id");
			$(this).addClass("active").siblings().removeClass("active");
			$("#"+tabsId+"-content-box").addClass("active").siblings().removeClass("active");
	});

	
});
</script>