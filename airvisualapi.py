import requests
import json 


api_key = 'b49a33f9e559aa5260b4423411c1b2b31e2eef56'


url = 'https://api.waqi.info'

latlngbox = "32,-121,49,-117" 
# latlngbox = '37.639956,-100.761273,38.159944,-100.047797'

r = requests.get(url + f"/map/bounds/?latlng={latlngbox}&token=b49a33f9e559aa5260b4423411c1b2b31e2eef56")
data = r.json()['data']
# print(data)

for d in data:
    print("Name: ", d['station']['name'])
    print("Longitude: ", d['lon'])
    print("Latitude: ", d['lat'])
    print("AQI: ", d['aqi'])
    print('\n')



