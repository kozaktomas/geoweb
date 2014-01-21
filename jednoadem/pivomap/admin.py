from django.contrib.gis import admin
from models import  *

class PointsAdmin(admin.OSMGeoAdmin):
     scrollable = False
     map_width = 700
     map_height = 325


admin.site.register(Points,PointsAdmin)
 
