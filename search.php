<h2>Ricerca Autore</h2>
<form id="search-form" method="post" action="cerca.php">
	<table>
		<tr>
			<td>Autore</td>
			<td><input class="inputtextform" id="input-author" name="input-author" type="text" placeholder="Inserisci autore"/></td>
		</tr>
		<tr>
			<td>Title</td>
			<td><input class="inputtextform" id="input-title" name="input-title" type="text" placeholder="Inserisci titolo"/></td>
		</tr>
		<tr>
			<td>Journal</td>
			<td><input class="inputtextform" id="input-journal" name="input-journal" type="text" placeholder="Inserisci journal"/></td>
		</tr>
		<tr>
			<td>Conference</td>
			<td><input class="inputtextform" id="input-conference" name="input-conference" type="text" placeholder="Inserisci conference"/></td>
		</tr>
		<tr>
			<td>Min Year</td>
			<td><input class="inputtextform" id="minYear" name="minYear" type="text"/></td>
		</tr>
		<tr>
			<td>Max Year</td>
			<td><input class="inputtextform" id="maxYear" name="maxYear" type="text"/></td>
		</tr>
	</table>
		
	<div class="select-conversion">
	<label for="conversion">Bibliography conversion</label>
		<select id="conversion" name="conversion">
			<option value="html">html</option>
			<option value="bibtex">BibTex</option>
			<option value="graphml">graphml</option>
			<option value="graphviz">graphviz</option>
	    </select>
	</div>
	<input type="submit" value="Search" name="submit-search" value="true"/>
</form>

<?php
if (isset($_POST["submit-search"])) {
	$ricerca_autore = $_POST["input-author"];
	$lista_ricerca = new DOMDocument();
	$lista_ricerca -> load("http://dblp.uni-trier.de/search/author?xauthor=".$ricerca_autore);
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
    date_default_timezone_set("Europe/Rome");
 	$data = date("Y-m-d_h:i:s");
 	$data_ymd = date("Ymd");
 	$ora_ricerca = date("his");
 	$URL_file = $data.$dblpkey_nome_autore;
    $pubblicazioni -> save($URL_file.".xml");
    saveSearch($_SESSION["user"],$ricerca_autore, $data_ymd,$ora_ricerca);
    $pubblicazioni->saveXML();
    if ($pubblicazioni) {
    	echo "<h2>OK file salvato".$data."</h2>";
    }
  
    //Conversione con XSLT Processor
    
    $XSLT = new XSLTProcessor();
    $XSL_URL="";
    $XSL_Extension="";

    switch ($_POST["conversion"]){
	    case "html":
            $XSL_URL = "html.xsl";
            $XSL_Extension = ".html";
            echo "html";
            break;
        case "bibtex":
            $XSL_URL = "bibtex.xsl";
            $XSL_Extension = "";
            echo "bibtex";
            break;
        case "graphml":
            $XSL_URL ="graphml.xsl";
            $XSL_Extension = ".xml";
            echo "graphml";
            break;
        case "graphviz":
            $XSL_URL = "graphviz.xsl";
            $XSL_Extension = ".dot";
            echo "graphviz";
            break;
	}
	
	$XSL = new DOMDocument();
	$XSL -> load($XSL_URL);
	$XSLT -> importStylesheet($XSL);
	
	$URL_origine = $URL_file.$XSL_Extension;
	$file= fopen($URL_origine,"w");
    fwrite($file,$XSLT->transformToXML( $pubblicazioni ));
    fclose($file);
}
?>
</div>