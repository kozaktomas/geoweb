from django.contrib.gis import admin
from models import  *

class PointsAdmin(admin.OSMGeoAdmin):
     fieldsets = (
       ('Editable Map View', {'fields': ('point',)}),
     )


admin.site.register(Points, PointsAdmin)
 
