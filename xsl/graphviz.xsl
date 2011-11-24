<?xml version="1.0" encoding="UTF-8"?> 
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">
	<xsl:output omit-xml-declaration="yes"/>
	<xsl:template match="/">
		<xsl:text>graph dblp {&#xa;</xsl:text>
		<xsl:variable name="autori" select="distinct-values(dblp/*/author)"/>
		<xsl:for-each select="$autori">
			<xsl:value-of select="translate(translate(translate(.,' ','_'),'.',''),&quot;'&quot;,' ')"/> [label = "<xsl:value-of select="translate(translate(translate(.,' ','_'),'.',''),&quot;'&quot;,' ')"/>"];<xsl:text>&#xa;</xsl:text>
		</xsl:for-each>
		<xsl:text>&#xa;</xsl:text>
		<xsl:for-each-group select="/*/*/author" group-by=".">
			<xsl:sort select="current-grouping-key()"/>
			<xsl:variable name="firstKey" select="current-grouping-key()"></xsl:variable>
			<xsl:for-each-group select="/*/*/author[compare(.,  current-grouping-key()) = 1][some $x in (current-group()) satisfies $x/parent::* intersect ./parent::*]" group-by=".">
				<xsl:value-of select="concat(translate(translate(translate($firstKey,' ','_'),'.',''),&quot;'&quot;,' '), '--',translate(translate(translate(current-grouping-key(),' ','_'),'.',''),&quot;'&quot;,' '))"></xsl:value-of><xsl:text>;</xsl:text><xsl:text>&#xa;</xsl:text>
			</xsl:for-each-group>    
		</xsl:for-each-group>
		<xsl:text>&#xa;</xsl:text>
		<xsl:text>overlap=false;</xsl:text><xsl:text>&#xa;</xsl:text>
		<xsl:text>label="Università degli studi di Udine";</xsl:text><xsl:text>&#xa;</xsl:text>
		<xsl:text>}</xsl:text>
	</xsl:template>
</xsl:stylesheet>