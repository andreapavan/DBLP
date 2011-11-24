<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">

<xsl:template match="/">
	<html>
		<head>
			<title>DBLP Bibliography HTML</title>
			<link href="../../style.css" rel="stylesheet" type="text/css"/>
		</head>
		<body>
			<div id="intestazione">
				<div id="titolo">
					<div id="dblp_logo">
						<p>DBLP</p>
					</div>
					<p>Computer Science Bibliography</p>
				</div>
				<div id="logo_uniud">
					<a href="http://www.uniud.it"><img src="/img/logo_uniud.gif" alt="UNIUD"/></a>
				</div>
			</div>
			<table id="table_pubblications">
				<thead>
					<tr><th>Author/s</th><th>Title</th><th>BookTitle</th><th>Year</th><th>Pages</th><th>ee</th><th>Crossref</th><th>Url</th></tr>
				</thead>
				
				<tbody>
					<xsl:for-each select="dblp/*">
						<tr>
							<td id="td_author">
								<xsl:for-each select="author">
									<p><xsl:value-of select="."/></p>
								</xsl:for-each>
							</td>
							<td>
								<xsl:if test="title">
									<xsl:value-of select="title"/>
								</xsl:if>
							</td>
							<td id="td_booktitle">
								<xsl:if test="booktitle">
									<xsl:value-of select="booktitle"/>
								</xsl:if>
							</td>
							<td id="td_year">
								<xsl:if test="year">
									<xsl:value-of select="year"/>
								</xsl:if>
							</td>
							<td id="td_pages">
								<xsl:if test="pages">
									<xsl:value-of select="pages"/>
								</xsl:if>
							</td>
							<td id="td_ee">
								<xsl:if test="ee">
									<a><xsl:attribute name="href"><xsl:value-of select="ee"/></xsl:attribute>Link</a>
								</xsl:if>
							</td>
							<td id="td_crossref">
								<xsl:if test="crossref">
									<xsl:value-of select="crossref"/>
								</xsl:if>
							</td>
							<td>
								<xsl:if test="url">
									<xsl:value-of select="url"/>
								</xsl:if>
							</td>
						</tr>
					</xsl:for-each>
				</tbody>
			</table>
		</body>
	</html>
	</xsl:template>
</xsl:stylesheet>