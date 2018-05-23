<?php

/* @var $this yii\web\View */

use yii\helpers\Html;

$this->title = 'Pomoc';
$this->params['breadcrumbs'][] = $this->title;
?>
<div class="site-about" style="text-align:left;">
    <h1><?= Html::encode($this->title) ?></h1>
    <h2>Wstęp</h2>
    <p>Aplikacja służy do nauki języka dla uczniów szkoły podstawowej i gimnazjum. Aby nauczyć się zestawu słówek, 
    wybierz opcję <?= Html::a('nauka', ['site/index']);?> a następnie kategorię i podkategorię. Następnie możesz wybrać interesujący Cię zestaw i rozpocząć naukę w jednym z trzech wariantów.
    Wcześniej dobrze jest się zapoznać z zestawek słówek.</p>
    <p>Aby skorzystać z pełni możliwości aplikacji, należy się <?= Html::a('zarejestrować', ['site/signup']);?>. Można wtedy tworzyć prywatne zestawy słówek, oraz zapisywać swoje postępy nauki.</p>
    <p>Posiadając uprawnienia REDAKTORA lub SUPERREDAKTORA można tworzyć publiczne zestawy, w jednej lub kilku przydzielonych przez administratora podkategoriach.</p>
	<h2>Walidacja zestawów słówek</h2>
	<p>Do walidacji wprowadzanych zestawów słówek, stosowane jest poniższe wyrażenie regularne.</p>
	<?php 
	echo '<pre>';
	echo '^(([a-ząężźćłóśń]+,?)+[^,];([a-ząężźćłóśń]+,?)+[^,]\s)+$';
	echo '</pre>';
	?>
	<p>Zasady stosowane przy wprowadzaniu zestawów:</p>
	<ol>
	<li>Wszystkie wyrazy piszemy małymi literami dozwolone są polskie znaki</li>
	<li>Nie stosujemy cyfr, ani znaków specjalnych</li>
	<li>Tłumaczenie słówka rodzielamy znakiem ; (średnik)</li>
	<li>Grupy wyrazów rozdzielamy spacją</li>
	<li>Dopuszcza się stosowanie wariantów słówek, rozdzielając je przecinkami</li>
	<li>Słówka muszą mieć przynajmniej dwa znaki</li>
	<li>Aby skorzystać z wszystkich funkcji nauki, zestaw musi mieć minimum 4 grupy słówek</li>
	<li>Na końcu całego zestawu musi być jeden pusty znak</li>
	</ol>
	<p>Przykłady prawidłowych zestawów:</p>	
	<?php 
	echo '<pre>';
	echo 'one;jeden two;dwa <br>';
	echo 'set;zestaw,zbiór red;czerwony,czerwień <br>';
	echo 'set;zestaw,zbiór red;czerwony,czerwień <br>';
	echo '</pre>';
	?>
	<?php
	echo Html::a('Testowanie wyrażenia do walidacji zestawów słówek', 'https://regex101.com/r/BsJz7c/2', ['class' => 'btn btn-success'], ['target'=>'_blank']);	
	?> 
	<h2>Diagram ERD bazy danych</h2>
	
	<?= Html::img('@web/obrazy/diagramerd.jpg', ['alt' => 'diagramerd','width'=>'100%']) ?>
	
	<h2>Autorzy:</h2>
	<p>Piotr Góra i Wojciech Dunia</p>
	<p>System powstał na zaliczenie przedmiotu: Aplikacje internetowe na Uniwersytecie Gdańskim. Informatyka - 1 sem. studia magisterskie.</p>
    
    
    
</div>
