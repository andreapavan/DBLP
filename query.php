<?php

if (isset($_POST["submit-search"])) {
	if ($_POST["input-author"]!="") {
		searchPubblication();
	}else{?>
		<div id="errore_ricerca">
    		<img id="error_img" src="img/button_delete.gif" width="50" height="50" alt="error"/>
    		<p>Errore!</p>
    		<p>Controlla i campi di ricerca</p>
    	</div>
	<?php
	}
}?>

<?php

function searchPubblication() {
$ricerca_autore=$_POST["input-author"];
	if (isset($_POST["exact_match"])) {
		$ricerca=$_POST["input-author"];
		if (strpos($ricerca," ")) {
			$nome_autore=strstr($ricerca," ",true);
			$cognome_autore=strstr($ricerca," ");
			$ricerca=$nome_autore."$".$cognome_autore."$";
		}else{
			$ricerca=$ricerca."$";
		}
	}else{
		$ricerca= $_POST["input-author"];
	}
	$lista_ricerca = new DOMDocument();
	$lista_ricerca -> load("http://dblp.uni-trier.de/search/author?xauthor=".$ricerca);
	$lista_ricerca -> saveXML();
	$xpath_urlpt = new DOMXPath($lista_ricerca);
    $entries = $xpath_urlpt -> query("//author/@urlpt");
    
    $pubblicazioni = new DOMDocument();
    $pubblicazioni_root = $pubblicazioni -> createElement("dblp");
    $pubblicazioni -> appendChild($pubblicazioni_root);
    
    foreach ($entries as $entry) {
    	$urlpt_autore = $entry -> nodeValue;
    	//echo $urlpt_autore;
    	$dblpkey_autori = new DOMDocument();
    	$dblpkey_autori -> load("http://dblp.uni-trier.de/rec/pers/".$urlpt_autore."/xk");
    	$dblpkey_autori -> saveXML();
    	$xpath_dblpkey = new DOMXPath($dblpkey_autori);
    	$dblpkey_nome_autore = $xpath_dblpkey -> query("/dblpperson/@name") -> item(0) -> nodeValue;
    	//echo $dblpkey_nome_autore;
        $dblpkey = $xpath_dblpkey -> query("/dblpperson/dblpkey[not(@type)]");
        foreach ($dblpkey as $key) {
        	$chiave = $key -> nodeValue;
        	//echo $chiave."</br>";
        	$doc = new DOMDocument();
        	$doc -> load("http://dblp.uni-trier.de/rec/bibtex/".$chiave.".xml");
        	$elements = $doc -> getElementsByTagName('dblp')->item(0)->childNodes;
        	foreach ($elements as $element) {
        		$key = $element -> nodeValue;
        		//echo $key."</br>";
        		$element = $pubblicazioni -> importNode($element, true);
                $pubblicazioni_root -> appendChild($element);
        	}
        }
    }
    
    $pubblicazioni-> saveXML();
    $count = $pubblicazioni -> childNodes -> item(0) -> childNodes -> length ;
       
    $queryFilter="";
    
    if ($count!=0) {
	    if (strlen($_POST["input-journal"])>0 && $_POST["input-journal"]!="") {
	    	$journal=$_POST["input-journal"];
	    	$queryFilter.="[contains(journal/.,\"".$journal."\")]";
	    }
	    if (strlen($_POST["input-title"])>0 && $_POST["input-title"]!="") {
	    	$title=$_POST["input-title"];
			$queryFilter.="[contains(title/.,\"".$title."\")]";
	    }
	    if (strlen($_POST["input-conference"])>0 && $_POST["input-conference"]!="") {
	    	$conference=$_POST["input-conference"];
	    	$queryFilter.="[contains(booktitle/.,\"".$conference."\")]";
	    }
	    if (strlen($_POST["minYear"])>0 && $_POST["minYear"]!="") {
	    	$minYear=$_POST["minYear"];
	    	$queryFilter.="[year>=$minYear]";
	    }
	    if (strlen($_POST["maxYear"])>0 && $_POST["maxYear"]!="") {
	    	$maxYear=$_POST["maxYear"];
	    	$queryFilter.="[year<=$maxYear]";
	    }
	    if (strlen($_POST["input-author1"])>0 && $_POST["input-author1"]!="") {
	    	$author1=$_POST["input-author1"];
	    	$queryFilter.="";
	    }
	    if (strlen($_POST["input-author2"])>0 && $_POST["input-author2"]!="") {
	    	$author2=$_POST["input-author2"];
	    	$queryFilter.="";
	    }
	    if (strlen($_POST["input-author3"])>0 && $_POST["input-author3"]!="") {
	    	$author3=$_POST["input-author3"];
	    	$queryFilter.="";
	    }
	    
    }else{
    	echo "Nessuna pubblicazione trovata per l'autore selezionato.";
    }
    
    echo $queryFilter;
    
    $pubblicazioniFiltrate = new DOMDocument();
    $root = $pubblicazioniFiltrate -> createElement("dblp");
    $pubblicazioniFiltrate -> appendChild($root);
    $xpath = new DOMXpath($pubblicazioni);
    $query="/dblp/*".$queryFilter;
    //echo $query;
    $values= $xpath->query($query);
    foreach ($values as $value) {
    	$value = $pubblicazioniFiltrate -> importNode($value , true);
        $root -> appendChild($value);
    }
    $pubblicazioniFiltrate -> saveXML();
    
    $count = $pubblicazioniFiltrate -> childNodes -> item(0) -> childNodes -> length ;
    echo $count;
    if ($count) {
	    date_default_timezone_set("Europe/Rome");
	 	$data = date("Y-m-d_H:i:s");
	 	$data_ymd = date("Ymd");
	 	$ora_ricerca = date("his");
	 	$URL_file = $data.$dblpkey_nome_autore;
	    
	    if (is_dir("tmp")) {
	 		$pubblicazioniFiltrate -> save("tmp/".$URL_file.".xml");
	 	}else{
	 		mkdir("tmp",0775);
	 		chmod("tmp",0775);
	 		$pubblicazioniFiltrate -> save("tmp/".$URL_file.".xml");
	 	}
	        
	    saveSearch($_SESSION["user"],$ricerca_autore, $data_ymd,$ora_ricerca);
	    if ($pubblicazioniFiltrate) {?>
	    <div id="conferma_ricerca">
	    	<img id="confirm_img" src="img/confirm.png" width="50" height="50" alt="confirm"/>
	    	<p>Ricerca effettuata correttamente.</p>
	    	<p>Data: <?php echo $data; ?></p>
	    </div>
	    
	    <?php
	    }
	  
	    //Conversione con XSLT Processor
	    
	    $XSLT = new XSLTProcessor();
	    $XSL_URL="";
	    $XSL_Extension="";
	
	    switch ($_POST["conversion"]){
		    case "html":
	            $XSL_URL = "xsl/html.xsl";
	            $XSL_Extension = ".html";
	            break;
	        case "bibtex":
	            $XSL_URL = "xsl/bibtex.xsl";
	            $XSL_Extension = "";
	            break;
	        case "graphml":
	            $XSL_URL ="xsl/graphml.xsl";
	            $XSL_Extension = ".xml";
	            break;
	        case "graphviz":
	            $XSL_URL = "xsl/graphviz.xsl";
	            $XSL_Extension = ".dot";
	            break;
		}
		
		$XSL = new DOMDocument();
		$XSL -> load($XSL_URL);
		$XSLT -> importStylesheet($XSL);
		$URL_origine = $URL_file.$XSL_Extension;
		if (is_dir("utenti/".$_SESSION["user"])) {
			$file= fopen("utenti/".$_SESSION["user"]."/".$URL_origine,"w");
	    	fwrite($file,$XSLT->transformToXML( $pubblicazioniFiltrate ));
	    	fclose($file);
	    	//echo "utenti/".$_SESSION["user"]."/".$URL_origine;
	    	chmod ("utenti/".$_SESSION["user"]."/".$URL_origine, 0775);
		}else{
			mkdir("utenti/".$_SESSION["user"],0775);
			chmod("utenti/".$_SESSION["user"],0775);
			$file= fopen("utenti/".$_SESSION["user"]."/".$URL_origine,"w");
	    	fwrite($file,$XSLT->transformToXML( $pubblicazioniFiltrate ));
	    	fclose($file);
	    	//echo "utenti/".$_SESSION["user"]."/".$URL_origine;
	    	chmod ("utenti/".$_SESSION["user"]."/".$URL_origine, 0775);
		}
	    
	    
	    }else{
	    	echo "Nessuna pubblicazione trovata con i seguenti campi di ricerca.";
	    }
}
?>