<?xml version="1.0"?> 
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

   <xsl:template match="/">
      <html>
         <head>
            <title>DBLP Bibliography</title>
         </head>
         <body>
            <h1>DBLP</h1>
            <h2>Conference papers:</h2>
            <ol><xsl:apply-templates select="dblp/inproceedings"/></ol>
            <h2>Journal papers:</h2>
            <ol><xsl:apply-templates select="dblp/article"/></ol>
         </body>
      </html>
   </xsl:template>
   
   <xsl:template match="dblp/inproceedings">
      <xsl:for-each select="author">
      	<li><xsl:value-of select="."/></li>
      </xsl:for-each>
   </xsl:template>
   
   <xsl:template match="dblp/article">
      <li><xsl:apply-templates/></li>
   </xsl:template>

</xsl:stylesheet>