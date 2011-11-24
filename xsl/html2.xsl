<?xml version="1.0"?> 
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

   <xsl:template match="/">
      <html>
         <head>
            <title>DBLP Bibliography HTML</title>
            <link href="html/style.css" rel="stylesheet" type="text/css"/>
         </head>
         <body>
            <h1>DBLP HTML</h1>
            <h2>Conference papers:</h2>
            <xsl:apply-templates select="dblp/inproceedings"/>
            <h2>Journal papers:</h2>
            <ol><xsl:apply-templates select="dblp/article"/></ol>
         </body>
      </html>
   </xsl:template>
   
   <xsl:template match="dblp/inproceedings">
	   		<table id="table_inproceedings">
	   		
	   			<tr>
	   				<td id="td_name">Author/s:</td>
	   				<td id="td_value">
	   					<xsl:for-each select="author">
						<p><xsl:value-of select="."/></p>
						</xsl:for-each>
					</td>
	   			</tr>
	   			<tr>
	   				<td id="td_name">Title:</td>
	   				<td id="td_value">
	   					<xsl:if test="title">
						<p><xsl:value-of select="title"/></p>
						</xsl:if>
	   				</td>
	   			</tr>
	   			<tr>
	   				<td id="td_name">BookTitle</td>
	   				<td id="td_value">
	   					<xsl:if test="booktitle">
						<p><xsl:value-of select="booktitle"/></p>
						</xsl:if>
	   				</td>
	   			</tr>
	   			<tr>
	   				<td id="td_name">Year:</td>
	   				<td id="td_value">
	   					<xsl:if test="year">
						<p><xsl:value-of select="year"/></p>
						</xsl:if>
	   				</td>
	   			</tr>
	   			<tr>
	   				<td id="td_name">Pages:</td>
	   				<td id="td_value">
	   					<xsl:if test="pages">
						<p><xsl:value-of select="pages"/></p>
						</xsl:if>
	   				</td>
	   			</tr>
				<tr>
					<td id="td_name">ee:</td>
					<td id="td_value">
						<xsl:if test="ee">
						<p><xsl:value-of select="ee"/></p>
						</xsl:if>
					</td>
				</tr>
				<tr>
					<td id="td_name">Crossref:</td>
					<td id="td_value">
						<xsl:if test="crossref">
						<p><xsl:value-of select="crossref"/></p>
						</xsl:if>
					</td>
				</tr>
				<tr>
					<td id="td_name">Url:</td>
					<td id="td_value">
						<xsl:if test="url">
						<p><xsl:value-of select="url"/></p>
						</xsl:if>
					</td>
				</tr>
	      </table>
   </xsl:template>
   
   <xsl:template match="dblp/article">
   <table id="table_article">
	   			<tr>
	   				<td id="td_name">Author/s:</td>
	   				<td id="td_value">
	   					<xsl:for-each select="author">
						<p><xsl:value-of select="."/></p>
						</xsl:for-each>
					</td>
	   			</tr>
	   			<tr>
	   				<td id="td_name">Title:</td>
	   				<td id="td_value">
	   					<xsl:if test="title">
						<p><xsl:value-of select="title"/></p>
						</xsl:if>
	   				</td>
	   			</tr>
	   			<tr>
	   				<td id="td_name">Year:</td>
	   				<td id="td_value">
	   					<xsl:if test="year">
						<p><xsl:value-of select="year"/></p>
						</xsl:if>
	   				</td>
	   			</tr>
	   			<tr>
	   				<td id="td_name">Pages:</td>
	   				<td id="td_value">
	   					<xsl:if test="pages">
						<p><xsl:value-of select="pages"/></p>
						</xsl:if>
	   				</td>
	   			</tr>
	   			<tr>
					<td id="td_name">Volume:</td>
					<td id="td_value">
						<xsl:if test="volume">
						<p><xsl:value-of select="volume"/></p>
						</xsl:if>
					</td>
				</tr>
	   			<tr>
	   				<td id="td_name">Journal:</td>
	   				<td id="td_value">
	   					<xsl:if test="journal">
						<p><xsl:value-of select="journal"/></p>
						</xsl:if>
	   				</td>
	   			</tr>
	   			<tr>
	   				<td id="td_name">Number:</td>
	   				<td id="td_value">
	   					<xsl:if test="number">
						<p><xsl:value-of select="number"/></p>
						</xsl:if>
	   				</td>
	   			</tr>
				<tr>
					<td id="td_name">ee:</td>
					<td id="td_value">
						<xsl:if test="ee">
						<p><xsl:value-of select="ee"/></p>
						</xsl:if>
					</td>
				</tr>
				<tr>
					<td id="td_name">Url:</td>
					<td id="td_value">
						<xsl:if test="url">
						<p><xsl:value-of select="url"/></p>
						</xsl:if>
					</td>
				</tr>
	      </table>
   </xsl:template>

</xsl:stylesheet>