<html>
	<title>Prova XSL</title>
	<body>
		<form method="post" action="">
		<label for="conversion">Bibliography conversion</label>
		<select id="conversion" name="conversion">
			<option value="html">html</option>
			<option value="bibtex">BibTex</option>
			<option value="graphml">graphml</option>
			<option value="graphviz">graphviz</option>
	    </select>
		<input type="submit" value="Search" name="submit-search" value="true"/>
		</form>
	</body>
</html>

<?php
ini_set('display_errors', 'On');
if (isset($_POST["submit-search"])) {
	$XSLT = new XSLTProcessor();
	$XML = new DOMDocument();
	$XML -> load("test.xml");
	$XML -> saveXML();
	
	$XSL_URL="";
	$XSL_Extension="";
	
	switch ($_POST["conversion"]){
	    case "html":
	        $XSL_URL = "html.xsl";
	        $XSL_Extension = ".html";
	        echo "html</br>";
	        break;
	    case "bibtex":
	        $XSL_URL = "bibtex.xsl";
	        $XSL_Extension = "";
	        echo "bibtex</br>";
	        break;
	    case "graphml":
	        $XSL_URL ="graphml.xsl";
	        $XSL_Extension = ".xml";
	        echo "graphml</br>";
	        break;
	    case "graphviz":
	        $XSL_URL = "graphviz.xsl";
	        $XSL_Extension = ".dot";
	        echo "graphviz</br>";
	        break;
	}
	
	$XSL = new DOMDocument();
	$XSL -> load($XSL_URL);
	$XSLT -> importStylesheet($XSL);
	//mkdir("utenti/user",0775);
	$URL="test".$XSL_Extension;
	$file= fopen($URL,"w");
	fwrite($file,$XSLT->transformToXML( $XML ));
	fclose($file);
	
}

?>