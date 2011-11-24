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
		<xsl:variable name="papers" select="dblp/*"/> 
		<xsl:variable name="round1">
		        <xsl:for-each select="$papers"> 
		            <xsl:for-each select="author[position() != last()]"> 
		                <xsl:variable name="a1" select="."/> 
		                <xsl:for-each select="following-sibling::author"> 
		                    <xsl:element name="collab">
		                      <xsl:attribute name="pair"  select="concat(translate(translate(translate($a1,' ','_'),'.',''),&quot;'&quot;,' '), '--', translate(translate(translate(.,' ','_'),'.',''),&quot;'&quot;,' '), ';&#10;')"/> 
		                      <xsl:attribute name="cannonicalPair">
		                        <xsl:choose>
		                          <xsl:when test="$a1 lt ." >
		                            <xsl:sequence select="concat(translate(translate(translate($a1,' ','_'),'.',''),&quot;'&quot;,' '), '--', translate(translate(translate(.,' ','_'),'.',''),&quot;'&quot;,' '), ';&#10;')" />
		                          </xsl:when>
		                          <xsl:otherwise>
		                            <xsl:sequence select="concat(translate(translate(translate(.,' ','_'),'.',''),&quot;'&quot;,' '), '--', translate(translate(translate($a1,' ','_'),'.',''),&quot;'&quot;,' '), ';&#10;')" />
		                          </xsl:otherwise>
		                        </xsl:choose>
		                      </xsl:attribute>  
		                    </xsl:element>
		                </xsl:for-each> 
		            </xsl:for-each> 
		        </xsl:for-each> 
		</xsl:variable>
		
		<xsl:text>&#x0A;</xsl:text>
		
		<xsl:for-each-group select="$round1/collab" group-by="@cannonicalPair">
		  <xsl:value-of select="current-group()[1]/@pair" />
		</xsl:for-each-group>
		
		<xsl:text>---- listing seperator ----&#x0A;</xsl:text>
		
		<xsl:for-each-group select="$round1/collab" group-by="@cannonicalPair">
		  <xsl:value-of select="current-group()[last()]/@pair" />
		</xsl:for-each-group>
		
		<xsl:text>---- listing seperator ----&#x0A;</xsl:text>
		
		<xsl:for-each select="distinct-values($round1/collab/@cannonicalPair)">
		  <xsl:value-of select="." />
		</xsl:for-each>
		
		<xsl:text>---- listing seperator ----&#x0A;</xsl:text>
		
		<xsl:for-each select="distinct-values($round1/collab/@pair)">
		  <xsl:value-of select="." />
		</xsl:for-each>
		<xsl:text>&#xa;</xsl:text>
		<xsl:text>overlap=false;</xsl:text><xsl:text>&#xa;</xsl:text>
		<xsl:text>label="Università degli studi di Udine";</xsl:text><xsl:text>&#xa;</xsl:text>
		<xsl:text>}</xsl:text>
	</xsl:template>
</xsl:stylesheet>