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


class LineForm(forms.Form):
    des = forms.CharField(
    		max_length=250,
    		help_text=u'popis'
    		)
    a = forms.CharField(
            max_length=250,
            help_text=u"lon,lat",
            )
    
    b = forms.CharField(
            max_length=250,
            help_text=u"lon,lat",
            )

    c = forms.CharField(
            max_length=250,
            help_text=u"lon,lat",
            )

    d = forms.CharField(
            max_length=250,
            help_text=u"lon,lat",
            )

    def cleaned_data(self):
        """Split the tags string on whitespace and return a list"""
        self.cleaned_data=[]
        self.cleaned_data.append(self.a.split(', '))
        self.cleaned_data.append(self.b.split(', '))
        self.cleaned_data.append(self.c.split(', '))
        self.cleaned_data.append(self.d.split(', '))
        return self.cleaned_data

