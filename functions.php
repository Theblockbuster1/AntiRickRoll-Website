<?php
include 'inc/config.php';
?>
<?php

function navigation ($nb_total,
		$nb_affichage_par_page,
		$next,
		$nb_liens_dans_la_barre) {

	$barre = '';

	
	if ($_SERVER['QUERY_STRING'] == "") {
		$query = 'page';
	}
	else {
		$tableau = explode ("next=", $_SERVER['QUERY_STRING']);
		$nb_element = count ($tableau);
		if ($nb_element == 1) {
			$query = $_SERVER['PHP_SELF'].'?'.$_SERVER['QUERY_STRING'].'&next=';
		}
		else {
			if ($tableau[0] == "") {
				$query = 'page';
			}
			else {
				$query = $_SERVER['PHP_SELF'].'?'.$tableau[0].'next=';
			}
		}
	}


	$page_active = floor(($next/$nb_affichage_par_page)+1);

	$nb_pages_total = ceil($nb_total/$nb_affichage_par_page);


	if ($nb_liens_dans_la_barre%2==0) {
		$cpt_deb1 = $page_active - ($nb_liens_dans_la_barre/2)+1;
		$cpt_fin1 = $page_active + ($nb_liens_dans_la_barre/2);
	}
	else {
		$cpt_deb1 = $page_active - floor(($nb_liens_dans_la_barre/2));
		$cpt_fin1 = $page_active + floor(($nb_liens_dans_la_barre/2));
	}

	if ($cpt_deb1 <= 1) {
		$cpt_deb = 1;
		$cpt_fin = $nb_liens_dans_la_barre;
	}
	elseif ($cpt_deb1>1 && $cpt_fin1<$nb_pages_total) {
		$cpt_deb = $cpt_deb1;
		$cpt_fin = $cpt_fin1;
	}
	else {
		$cpt_deb = ($nb_pages_total-$nb_liens_dans_la_barre)+1;
		$cpt_fin = $nb_pages_total;
	}

	if ($nb_pages_total <= $nb_liens_dans_la_barre) {
		$cpt_deb=1;
		$cpt_fin=$nb_pages_total;
	}


	if ($cpt_deb != 1) {
		$cible = $query.(0);
		$lien = '<A HREF="'.$cible.'">&lt;&lt;</A>';
	}
	else {
		$lien='';
	}
	$barre .= $lien;


	for ($cpt = $cpt_deb; $cpt <= $cpt_fin; $cpt++) {
		if ($cpt == $page_active) {
			if ($cpt == $nb_pages_total) {
				$barre .= $cpt;
			}
			else {
				$barre .= $cpt.'';
			}
		}
		else {
			if ($cpt == $cpt_fin) {
				$barre .= "<A HREF='".$query.(($cpt-1)*$nb_affichage_par_page);
				$barre .= "'>".$cpt."</A>";
			}
			else {

				$barre .= "<A HREF='".$query.(($cpt-1)*$nb_affichage_par_page);
				$barre .= "'>".$cpt."</A>";
			}
		}
	}

	$fin = ($nb_total - ($nb_total % $nb_affichage_par_page));
	if (($nb_total % $nb_affichage_par_page) == 0) {
		$fin = $fin - $nb_affichage_par_page;
	}

		
	if ($cpt_fin != $nb_pages_total) {
		$cible = $query.$fin;
		$lien = '<A HREF="'.$cible.'">&gt;&gt;</A>';
	}
	else {
		$lien='';
	}
	$barre .= $lien;

	return $barre;
}

?>