<?php

if (isset($_POST["submit-search"])) {
	if ($_POST["input-author"]!="") {
		searchPubblication();
		//echo "Submit premuto";
	}else{?>
		<div id="errore_ricerca">
    		<img id="error_img" src="img/button_delete.gif" width="50" height="50" alt="error"/>
    		<p>Errore!</p>
    		<p>Controlla i campi di ricerca</p>
    	</div>
	<?php
	echo "Errore";
	}
}?>

<?php

function searchPubblication() {
$ricerca_autore=$_POST["input-author"];
	if (isset($_POST["exact_match"])) {
		$author0=$_POST["input-author"];
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
     
    if ($count!=0) {

    	$author0=ucwords($_POST["input-author"]);

    	// ***************** TITLE ********************

	    if (strlen($_POST["input-title"])>0 && $_POST["input-title"]!="") {
	    	$title=$_POST["input-title"];
			$queryTitle="[contains(title/.,\"".$title."\")]";
	    }
	     if (strlen($_POST["input-title1"])>0 && $_POST["input-title1"]!="") {
	    	$title1=$_POST["input-title"];
			$queryTitle="[contains(title/.,\"".$title1."\") or contains(title/.,\"".$title."\")]";
	    }
	     if (strlen($_POST["input-title2"])>0 && $_POST["input-title2"]!="") {
	    	$title2=$_POST["input-title"];
			$queryTitle="[contains(title/.,\"".$title2."\") or contains(title/.,\"".$title1."\") or contains(title/.,\"".$title."\")]";
	    }
	     if (strlen($_POST["input-title3"])>0 && $_POST["input-title3"]!="") {
	    	$title3=$_POST["input-title"];
			$queryTitle="[contains(title/.,\"".$title2."\") or contains(title/.,\"".$title1."\") or contains(title/.,\"".$title."\")]";
	    }
	    if ($_POST["filtro_title"]=="and") {
			$queryTitle=str_replace(" or "," and ",$queryTitle);
	    }

	    // ***************** JOURNAL ********************

	    if (strlen($_POST["input-journal"])>0 && $_POST["input-journal"]!="") {
	    	$journal=$_POST["input-journal"];
	    	$queryJournal="[contains(journal/.,\"".$journal."\")]";
	    }
	    if (strlen($_POST["input-journal1"])>0 && $_POST["input-journal1"]!="") {
	    	$journal1=$_POST["input-journal1"];
	    	$queryJournal="[contains(journal/.,\"".$journal1."\") or contains(journal/.,\"".$journal."\")]";
	    }
	    if (strlen($_POST["input-journal2"])>0 && $_POST["input-journal2"]!="") {
	    	$journal2=$_POST["input-journal2"];
	    	$queryJournal="[contains(journal/.,\"".$journal2."\") or contains(journal/.,\"".$journal1."\") or contains(journal/.,\"".$journal."\")]";
	    }
	    if (strlen($_POST["input-journal3"])>0 && $_POST["input-journal3"]!="") {
	    	$journal3=$_POST["input-journal3"];
	    	$queryJournal="[contains(journal/.,\"".$journal3."\") or contains(journal/.,\"".$journal2."\") or contains(journal/.,\"".$journal1."\") or contains(journal/.,\"".$journal."\")]";
	    }

	    // ***************** CONFERENCE ********************

	    if (strlen($_POST["input-conference"])>0 && $_POST["input-conference"]!="") {
	    	$booktitle=$_POST["input-conference"];
	    	$queryConference="[contains(booktitle/.,\"".$booktitle."\")]";
	    }
	    if (strlen($_POST["input-conference1"])>0 && $_POST["input-conference1"]!="") {
	    	$booktitle1=$_POST["input-conference1"];
	    	$queryConference="[contains(booktitle/.,\"".$booktitle1."\") or contains(booktitle/.,\"".$booktitle."\")]";
	    }
	    if (strlen($_POST["input-conference2"])>0 && $_POST["input-conference2"]!="") {
	    	$booktitle2=$_POST["input-conference2"];
	    	$queryConference="[contains(booktitle/.,\"".$booktitle2."\") or contains(booktitle/.,\"".$booktitle1."\") or contains(booktitle/.,\"".$booktitle."\")]";
	    }
	    if (strlen($_POST["input-conference3"])>0 && $_POST["input-conference3"]!="") {
	    	$booktitle3=$_POST["input-conference3"];
	    	$queryConference="[contains(booktitle/.,\"".$booktitle3."\") or contains(booktitle/.,\"".$booktitle2."\") or contains(booktitle/.,\"".$booktitle1."\") or contains(booktitle/.,\"".$booktitle."\")]";
	    }

	    // ***************** YEAR ********************

	    if (strlen($_POST["minYear"])>0 && $_POST["minYear"]!="") {
	    	$minYear=$_POST["minYear"];
	    	$queryYear="[year>=$minYear]";
	    }
	    if (strlen($_POST["maxYear"])>0 && $_POST["maxYear"]!="") {
	    	$maxYear=$_POST["maxYear"];
	    	$queryYear="[year<=$maxYear]";
	    }

	    // ***************** AUTHOR ********************

	    if (strlen($_POST["input-author1"])>0 && $_POST["input-author1"]!="") {
	    	$exactNumberOfAuthors=2;
	    	//echo "Settato Author 2, numero autori:".$exactNumberOfAuthors;
	    	$author1=ucwords($_POST["input-author1"]);
	    	$queryAuthor="[author/.=\"$author0\" or author/.=\"$author1\"]";
	    }
	    if (strlen($_POST["input-author2"])>0 && $_POST["input-author2"]!="") {
	    	$exactNumberOfAuthors=3;
	    	//echo "Settato Author 3, numero autori:".$exactNumberOfAuthors;
	    	$author2=ucwords($_POST["input-author2"]);
	    	$queryAuthor="[author/.=\"$author0\" or author/.=\"$author1\" or author/.=\"$author2\"]";
	    }
	    if (strlen($_POST["input-author3"])>0 && $_POST["input-author3"]!="") {
	    	$exactNumberOfAuthors=4;
	    	//echo "Settato Author 4, numero autori:".$exactNumberOfAuthors;
	    	$author3=ucwords($_POST["input-author3"]);
	    	$queryAuthor="[author/.=\"$author0\" or author/.=\"$author1\" or author/.=\"$author2\" or author/.=\"$author3\"]";
	    }
	    if (($_POST["primo_filtro"])=="solo") {
	    	$queryAuthor=str_replace("]"," and count(author) = ".$exactNumberOfAuthors."]",$queryAuthor);
		}
		if (($_POST["secondo_filtro"])=="and") {
			$queryAuthor=str_replace(" or "," and ",$queryAuthor);
		}

	}

    //echo $queryFilter."--".$queryAuthor;
    $pubblicazioniFiltrate = new DOMDocument();
    $root = $pubblicazioniFiltrate -> createElement("dblp");
    $pubblicazioniFiltrate -> appendChild($root);
    $xpath = new DOMXpath($pubblicazioni);
    $query="/dblp/*".$queryAuthor.$queryTitle.$queryConference.$queryYear.$queryJournal;
    $values= $xpath->query($query);
    foreach ($values as $value) {
    	$value = $pubblicazioniFiltrate -> importNode($value , true);
        $root -> appendChild($value);
    }
    $pubblicazioniFiltrate -> saveXML();
    $count = $pubblicazioniFiltrate -> childNodes -> item(0) -> childNodes -> length ;
    
    if ($count) {
	    date_default_timezone_set("Europe/Rome");
	 	$data = date("Ymd_His_");
	 	$data_ymd = date("Ymd");
	 	$ora_ricerca = date("His");
	 	$URL_file = $data.str_replace(' ','_',strtolower($dblpkey_nome_autore));    
	 	if (!is_dir("tmp")) {
	 		mkdir("tmp",0775);
	 		chmod("tmp",0775);
	 	}
	 	$pubblicazioniFiltrate -> save("tmp/".$URL_file.".xml");

	 	if (!is_dir("utenti")) {
	 		mkdir("utenti",0775);
	 		chmod("utenti",0775);
	 	}

	 	chmod("tmp/".$URL_file.".xml",0775);
	    saveSearch($_SESSION["user"],$ricerca_autore, $data_ymd,$ora_ricerca);
	    if ($pubblicazioniFiltrate) {?>
	    	<div id="conferma_ricerca">
	    		<img id="confirm_img" src="img/confirm.png" width="50" height="50" alt="confirm"/>
	    		<p>Ricerca effettuata correttamente.</p>
	    		<p>Data: <?php echo $data; ?></p>
	    	</div>
	    <?php
	    }
	  
	    //Conversione con XSLT Processor Saxon 9.3 Java
	    
	    $XSL_URL="";
	    $estensioneFileOutput="";
	    
	    if (!is_dir("utenti/".$_SESSION["user"])) {
			mkdir("utenti/".$_SESSION["user"],0775);
			chmod("utenti/".$_SESSION["user"],0775);
		}
	
	    switch ($_POST["conversion"]){
		    case "html":
	            $XSL_URL = "xsl/html.xsl";
	            $estensioneFileOutput = ".html";
	            shell_exec('java -jar saxon9ee.jar tmp/'.$URL_file.'.xml '.$XSL_URL.' > utenti/'.$_SESSION["user"].'/'.$URL_file.$estensioneFileOutput);
	            chmod('utenti/'.$_SESSION["user"].'/'.$URL_file.$estensioneFileOutput,0775);
	            break;
	        case "bibtex":
	            $XSL_URL = "xsl/bibtex.xsl";
	            $estensioneFileOutput = "";
	            shell_exec('java -jar saxon9ee.jar tmp/'.$URL_file.'.xml '.$XSL_URL.' > utenti/'.$_SESSION["user"].'/'.$URL_file.$estensioneFileOutput);
	            chmod('utenti/'.$_SESSION["user"].'/'.$URL_file.$estensioneFileOutput,0775);
	            break;
	        case "graphml":
	            $XSL_URL ="xsl/graphml.xsl";
	            $estensioneFileOutput = ".xml";
	            shell_exec('java -jar saxon9ee.jar tmp/'.$URL_file.'.xml '.$XSL_URL.' > utenti/'.$_SESSION["user"].'/'.$URL_file.$estensioneFileOutput);
	            chmod('utenti/'.$_SESSION["user"].'/'.$URL_file.$estensioneFileOutput,0775);
	            break;
	        case "graphviz":
	            $XSL_URL = "xsl/graphviz.xsl";
	            $estensioneFileOutput = ".dot";
	            shell_exec('java -jar saxon9ee.jar tmp/'.$URL_file.'.xml '.$XSL_URL.' > utenti/'.$_SESSION["user"].'/'.$URL_file.$estensioneFileOutput);
	            chmod('utenti/'.$_SESSION["user"].'/'.$URL_file.$estensioneFileOutput,0775);
	    		shell_exec('neato -Tpng utenti/'.$_SESSION["user"].'/'.$URL_file.'.dot > utenti/'.$_SESSION["user"].'/'.$URL_file.'.png');
	    		chmod('utenti/'.$_SESSION["user"].'/'.$URL_file.'.png',0775);
	            break;
	    }


    }else{?>
    	<div id="errore_ricerca">
    		<img id="error_img" src="img/button_delete.gif" width="50" height="50" alt="error"/>
    		<p>Nessun risultato trovato.</p>
    	</div>
    <?php
    }
}
?>