<?xml version="1.0" encoding="UTF-8"?>
<xsl:stylesheet version="1.0" xmlns:xsl="http://www.w3.org/1999/XSL/Transform">
<xsl:output omit-xml-declaration="yes" encoding="UTF-8" method="text"/>

<xsl:template match="/">
<xsl:for-each select="dblp/*">
@<xsl:value-of select="name(.)"/>{<xsl:value-of select="@key"/>,
author = {<xsl:apply-templates select="author"/>},
<xsl:for-each select="*[name(.) != 'author']">
<xsl:value-of select="name(.)"/> = {<xsl:value-of select="."/>}<xsl:if test="position()&lt;last()">,</xsl:if><xsl:text>&#xa;</xsl:text>
</xsl:for-each>
</xsl:for-each>
</xsl:template>

<xsl:template match="dblp/*/author[position() &lt; last()]"><xsl:value-of select="normalize-space(.)"/> and </xsl:template>
</xsl:stylesheet>