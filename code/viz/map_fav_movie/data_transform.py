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

# State dict is a dictionary with keys of state FIPS and the value is a 3953 length
# array representing each movie (index is movie id) with each element of the array 
# a list of [sum of rating values, number of ratings] 
state_dict = {}
for i in range(1,58):
    # [sum of ratings, number of ratings]
    state_dict[i]= [[0,0] for x in xrange(3954)]

for rating in ratings:
    if rating[0] in user_dict:

        fipss = int(us.states.lookup(user_dict[rating[0]]).fips)
        if fipss < 58:
            movieid = int(rating[1])
            user_rating = int(rating[2])
            state_dict[fipss][movieid][0] += user_rating
            state_dict[fipss][movieid][1] += 1
            #print rating[0]+','+rating[1]+','+rating[2]+','+fipss

moviesscv = csv.reader(open('movies.dat'),delimiter='@')

title_dict={}
for mov in moviesscv:
    title_dict[int(mov[0])]=mov[1]

final_list = [None]*60
for state in state_dict:

    rating = max(state_dict[state],key=lambda item:item[1])
    if rating[1] == 0:
        continue
    movieid=state_dict[state].index(rating)
    final_list[state]=((title_dict[movieid],float(rating[0])/rating[1]))
for x in final_list:
    if x:
        print str(final_list.index(x))+','+str(x[0])+','+str(x[1])

# item = max(list,key=lambda item:item[1])
#max(alkaline_earth_values, key=lambda x: x[1])
# list.index(item)
#