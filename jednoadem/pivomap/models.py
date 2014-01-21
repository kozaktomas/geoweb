from django.contrib.gis.db import models

class Points(models.Model):
	geom = models.PointField(srid=4326)
	objects = models.GeoManager()
	def __str__(self):
		return self.geom

class Line(models.Model):
	geom = models.LineStringField(srid=4326)
	objects = models.GeoManager()
	description = models.CharField(max_length=250)
	def __str__(self):
		return self.geom
