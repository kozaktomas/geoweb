from django.conf.urls import patterns,url
from pivomap import views
from djgeojson.views import GeoJSONLayerView
from pivomap.models import Points
from pivomap.views import MapLayer


urlpatterns = patterns('',
	url(r'^$', views.index, name='index'),
	url(r'^point$', views.point, name='point'),
	url(r'^line$', views.line, name='line'),
)