from flask import Flask, render_template, url_for, request, redirect
import requests
import json
from flask import jsonify

app = Flask(__name__)

@app.route('/')
def index():
    return render_template('index.html') 

# route for yelp recommendations
@app.route('/api/recs', )
def recs():
    # gets lat and long from ajax api call in index.html
    lat = request.args.get('lat')
    lon = request.args.get('long')

    api_key='VdVN3yn1xIzK76vCCmL9ZLbRKyb37g8aH6RlYk6Gf2czn-DiXX61uCd7G_SqT8z83ZOteTYgUNIhefJ7mQlFCXJjfkdPyUngqjcwJuxZyySg80m-nZU5Ja70NktcX3Yx'
    headers = {'Authorization': 'Bearer %s' % api_key}

    # if we want to search for yelp businesses
    url='https://api.yelp.com/v3/businesses/search'
    
    # define query parameters
    params = {'categories':'parks, lakes, beaches, bicyclepaths, hiking', 'latitude': lat, 'longitude': lon, 'is_open_now': 'true'}

    # Making a get request to the API
    req = requests.get(url, params=params, headers=headers)

    parsed = json.loads(req.text)

    businesses = parsed["businesses"]
    
    return jsonify(businesses)
    
if __name__ == "__main__":
    app.run(debug=True)