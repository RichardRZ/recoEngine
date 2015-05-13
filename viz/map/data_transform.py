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
# for i in range(1,58):
#     # [sum of ratings, number of ratings]

#     state_dict[i]=[[0,0]]*3953



for rating in ratings:
    if rating[0] in user_dict:

        fipss = int(us.states.lookup(user_dict[rating[0]]).fips)
        if int(fipss) > 56:
            continue
        if fipss not in state_dict:
            state_dict[fipss]=[[0,0] for _ in xrange(3954)]
        movieid = rating[1]
        user_rating = rating[2]
        # print state_dict[fipss]
        state_dict[fipss][int(movieid)][0] += int(user_rating)
        state_dict[fipss][int(movieid)][1] += 1
        #print rating[0]+','+rating[1]+','+rating[2]+','+fipss
avg_reviews = {}
most_watched = {}

for key, state in state_dict.iteritems():
    num_reviews = max(state,key=lambda x: x[1])

    num_reviews_id = state.index(num_reviews)
    
    avg_list = [float(x[0])/float(x[1]) for x in state if x[1]>0]
    best_reviewed=max(avg_list)
    best_reviewed_id = avg_list.index(best_reviewed)
    if key < 10:
        key= '0'+str(key)
    print "State: "+us.states.lookup(str(key)).name
    print "Best Reviewed: "+str(best_reviewed_id)+" with score: "+str(best_reviewed)
    print "Most Reviewed: "+str(num_reviews_id)+" with "+str(num_reviews)+" reviews."
# item = max(list,key=lambda item:item[1])
#max(alkaline_earth_values, key=lambda x: x[1])
# list.index(item)
#