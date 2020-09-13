from flask import Flask, render_template, url_for, request, redirect
import requests
import json
from flask import jsonify
# from flask_sqlalchemy import SQLAlchemy


app = Flask(__name__)
# app.config['SQLALCHEMY_DATABASE_URI'] = 'sqlite:///test.db'
# db = SQLAlchemy(app)





@app.route('/')
def index():
    # api_key='VdVN3yn1xIzK76vCCmL9ZLbRKyb37g8aH6RlYk6Gf2czn-DiXX61uCd7G_SqT8z83ZOteTYgUNIhefJ7mQlFCXJjfkdPyUngqjcwJuxZyySg80m-nZU5Ja70NktcX3Yx'
    # headers = {'Authorization': 'Bearer %s' % api_key}
    # url='https://api.yelp.com/v3/businesses/search'
    # params = {'categories':'parks', 'latitude': ' 37.743830', 'longitude': '-121.915120'}

    # req=requests.get(url, params=params, headers=headers)

    # parsed = json.loads(req.text)

    # businesses = parsed["businesses"]


    return render_template('index.html')


@app.route('/api/airquality')
def aqi():
    url = 'https://api.waqi.info'

    latlngbox = "32,-121,49,-117" 
    # latlngbox = '37.639956,-100.761273,38.159944,-100.047797'

    r = requests.get(url + f"/map/bounds/?latlng={latlngbox}&token=b49a33f9e559aa5260b4423411c1b2b31e2eef56")
    data = r.json()['data']
    # print(data)

    cities_dict = {}

    for d in data:
        name = d['station']['name']
        lat = d['lat']
        lon = d['lon']
        center = {'center': {'lat': lat, 'lon': lon}}
        cities_dict[name] = center
        
    return cities_dict
    

# route for yelp recommendations
@app.route('/api/recs', )
def recs():
    # gets lat and long from ajax api call in index.html
    lat = request.args.get('lat')
    print("LAT:", lat)
    lon = request.args.get('long')

    api_key='VdVN3yn1xIzK76vCCmL9ZLbRKyb37g8aH6RlYk6Gf2czn-DiXX61uCd7G_SqT8z83ZOteTYgUNIhefJ7mQlFCXJjfkdPyUngqjcwJuxZyySg80m-nZU5Ja70NktcX3Yx'
    headers = {'Authorization': 'Bearer %s' % api_key}


    # if we want to search for yelp businesses
    url='https://api.yelp.com/v3/businesses/search'
    
    # In the dictionary, term can take values like food, cafes or businesses like McDonalds
    params = {'categories':'parks, lakes, beaches, bicyclepaths, hiking', 'latitude': lat, 'longitude': lon}

    # Making a get request to the API
    req = requests.get(url, params=params, headers=headers)

    parsed = json.loads(req.text)

    # print(parsed)
    # return jsonify([])
    businesses = parsed["businesses"]
    
    # returns a dictionary of businesses and their urls
    # parks_dict = {}

    # for business in businesses:
    #     name = business['name']
    #     center = {"URL": business['url']}
    #     parks_dict[name] = center
        
    return jsonify(businesses)
    



if __name__ == "__main__":
    app.run(debug=True)