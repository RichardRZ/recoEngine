import sys
import csv
import us
from pyzipcode import ZipCodeDatabase

zcdb = ZipCodeDatabase()

user_dict = {}

userscsv = csv.reader(open('users.csv'),delimiter=',')

for users in userscsv:
    try:
        zipc = zcdb[users[4]]
    except IndexError:
        continue

    user_dict[users[0]]=zipc.state.encode('utf8')

# user, movie, rating

ratings = csv.reader(open('ratings.dat'))

state_dict = {}

for rating in ratings:
    if rating[0] in user_dict:
        fipss = us.states.lookup(user_dict[rating[0]]).fips
        movieid = rating[1]
        rating = rating[2]
        #print rating[0]+','+rating[1]+','+rating[2]+','+fipss

