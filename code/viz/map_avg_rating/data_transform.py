import sys
import csv
import us
from pyzipcode import ZipCodeDatabase
import operator

zcdb = ZipCodeDatabase()

user_dict = {}

userscsv = csv.reader(open('users.csv'),delimiter=',')

# change zip code to state code
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
# for i in range(1,58):
#     # [sum of ratings, number of ratings]
#     state_dict[i]= [0,0]

for rating in ratings:
    if rating[0] in user_dict:

        fipss = us.states.lookup(user_dict[rating[0]]).fips
        fipss_int = int(fipss)
        if fipss_int < 58:
            if fipss not in state_dict:
                state_dict[fipss]=[0,0]
            state_dict[fipss][0] += int(rating[2])
            state_dict[fipss][1] += 1
            #print rating[0]+','+rating[1]+','+rating[2]+','+fipss
max_min = []
print "id,rate,name"
for key,elem in state_dict.items():

    if elem[1]:
        print str(int(key))+','+str(float(elem[0])/elem[1])+','+us.states.lookup(key).name
        max_min.append(float(elem[0])/elem[1])

print max(max_min)
print min(max_min)
#max(alkaline_earth_values, key=lambda x: x[1])
# list.index(item)
#