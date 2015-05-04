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
for i in range(1,58):
    # [sum of ratings, number of ratings]
    state_dict[i]=[0,0]*3953



for rating in ratings:
    if rating[0] in user_dict:

        fipss = int(us.states.lookup(user_dict[rating[0]]).fips)
        movieid = rating[1]
        user_rating = rating[2]
        state_dict[fipps][movieid][0] += user_rating
        state_dict[fipps][movieid][1] += 1
        #print rating[0]+','+rating[1]+','+rating[2]+','+fipss

# item = max(list,key=lambda item:item[1])
#max(alkaline_earth_values, key=lambda x: x[1])
# list.index(item)
#