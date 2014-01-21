from django.shortcuts import render, get_object_or_404
from pivomap.form import PointForm,LineForm
from pivomap.models import Points,Line
from django.contrib.gis.gdal import SpatialReference, CoordTransform
from django.contrib.gis.geos import Point
from django.contrib.gis.geos import LineString 
from django.contrib.gis.gdal import OGRGeometry
from django.contrib.gis.geos import GEOSGeometry
from django.contrib.gis.geos import *
from djgeojson.views import GeoJSONLayerView

def index(request):
    points = Points.objects.all()
    q_lines = Line.objects.all()
    lines = [];
    for li in q_lines:
        line = GEOSGeometry(li.geom.wkt)
        po=[]
        for co in line:
            po.append(list(co))
        lines.append(po)
    return render(request, 'pivomap/index.html', {'points':points,'lines':lines}) 


def point(request):
    if request.method == 'POST':
        form = PointForm(request.POST) 
        if form.is_valid():
            p_lat=form.cleaned_data['lat']
            p_lon=form.cleaned_data['lon']
            p = Points(geom='POINT({0} {1})'.format(float(p_lat),float(p_lon)))
            p.save()
            form = PointForm()
            return render(request, 'pivomap/coor.html', {'form':form})
    else:
        form = PointForm() 
    
    return render(request, 'pivomap/coor.html', {'form':form}) 

def line(request):
    if request.method == 'POST':
            points = request.POST.getlist('points')
            for i in range(0,len(points)):
                points[i] = float(points[i])
            p_line = [];
            pom=[]
            for let in range(1,len(points)+1):     
                pom.append(points[let-1])
                if let%2 == 0:
                    p_line.append(pom)  
                    pom=[]
            #return render(request,'pivomap/debug.html',{'p_line':p_line})
            li = LineString(p_line)
            p = Line(geom=li.ewkt)
            p.save()
            form = LineForm()
            return render(request, 'pivomap/line.html', {})#{'form':form})

    
    return render(request, 'pivomap/line.html', {})#{'form':form}) 


class MapLayer(GeoJSONLayerView):
    # Options
    srid = 4326   # float




