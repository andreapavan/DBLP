<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet xmlns:xsl="http://www.w3.org/1999/XSL/Transform" version="2.0">
	<xsl:template match="/">
		<xsl:text>&#xa;</xsl:text>
		<graphml xmlns="http://graphml.graphdrawing.org/xmlns" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xsi:schemaLocation="http://graphml.graphdrawing.org/xmlns http://graphml.graphdrawing.org/xmlns/1.0/graphml.xsd"><xsl:text>&#xa;</xsl:text>
			<key id="author_string" for="node" attr.name="Autore" attr.type="string"/><xsl:text>&#xa;</xsl:text>
			<graph id="dblp" edgedefault="undirected"><xsl:text>&#xa;</xsl:text>
				
			<xsl:variable name="autori" select="distinct-values(dblp/*/author)"/>
			<xsl:for-each select="$autori">
				<node>
					<xsl:attribute name="id"><xsl:value-of select="translate(translate(translate(.,' ','_'),'.',''),&quot;'&quot;,' ')"/></xsl:attribute><xsl:text>&#xa;</xsl:text>
					<data key="author_string"><xsl:value-of select="translate(translate(translate(.,' ','_'),'.',''),&quot;'&quot;,' ')"/></data><xsl:text>&#xa;</xsl:text>
				</node><xsl:text>&#xa;</xsl:text>
			</xsl:for-each>
			<xsl:text>&#xa;</xsl:text>
			
			
			<xsl:for-each-group select="/*/*/author" group-by=".">
				<xsl:sort select="current-grouping-key()"/>
				<xsl:variable name="firstKey" select="current-grouping-key()"></xsl:variable>
				<xsl:for-each-group select="/*/*/author[compare(.,  current-grouping-key()) = 1][some $x in (current-group()) satisfies $x/parent::* intersect ./parent::*]" group-by=".">
					<edge> source="<xsl:value-of select="translate(translate(translate($firstKey,' ','_'),'.',''),&quot;'&quot;,' ')"/>" target="<xsl:value-of select="translate(translate(translate(current-grouping-key(),' ','_'),'.',''),&quot;'&quot;,' ')"/>"</edge><xsl:text>&#xa;</xsl:text>
				</xsl:for-each-group>    
			</xsl:for-each-group>
			</graph><xsl:text>&#xa;</xsl:text>
		</graphml>
	</xsl:template>
</xsl:stylesheet>