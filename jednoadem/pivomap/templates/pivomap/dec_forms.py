from django import forms

class PointForm(forms.Form):
    lat = forms.CharField(
            max_length=100,
            help_text=u"latitude",
            )
    
    lon = forms.CharField(
            max_length=100,
            help_text=u"longitude",
            )

