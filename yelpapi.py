#Yelp Api practice
import requests
import json


api_key='VdVN3yn1xIzK76vCCmL9ZLbRKyb37g8aH6RlYk6Gf2czn-DiXX61uCd7G_SqT8z83ZOteTYgUNIhefJ7mQlFCXJjfkdPyUngqjcwJuxZyySg80m-nZU5Ja70NktcX3Yx'
headers = {'Authorization': 'Bearer %s' % api_key}


# if we want to search for yelp businesses
url='https://api.yelp.com/v3/businesses/search'
 
# In the dictionary, term can take values like food, cafes or businesses like McDonalds
params = {'categories':'parks', 'latitude': ' 37.743830', 'longitude': '-121.915120'}



# Making a get request to the API
req=requests.get(url, params=params, headers=headers)

parsed = json.loads(req.text)

businesses = parsed["businesses"]
 
for business in businesses:
    print("Name:", business["name"])
    print("Rating:", business["rating"])
    print("Address:", " ".join(business["location"]["display_address"]))
    print("Phone:", business["phone"])
    print("URL:", business["url"])
    print("\n")