import json
import numpy as np
import argparse
import time
import operator
import math
import projSql

#prefs is the dictionary we need to store every user's rating for each movie
def sim_distance(prefs, p1,p2):
	# Get the list of shared_items
	si = {}
	sum_of_squares = 0
	for item in prefs[p1]:
		if item in prefs[p2]:
			si[item] = pow(prefs[p1][item]-prefs[p2][item],2)
			sum_of_squares += si[item]
			
	# if they have no ratings in common, return 0
	if len(si)==0: return 0
	
	return 1/(1+sum_of_squares)
	
def sim_pearson(prefs,p1,p2):
	# Get the list of mutually rated items
	si={}
	for item in prefs[p1]:
		if item in prefs[p2]: si[item]=1
		
	# Find the number of elements
	n = len(si)
	
	# if they are no ratings in common, return 0
	if n==0: return 0
	
	# Add up all the preferences
	sum1 = sum([prefs[p1][it] for it in si])
	sum2 = sum([prefs[p2][it] for it in si])
	
	# Sum up the squares
	sum1Sq=sum([pow(prefs[p1][it],2) for it in si])
	sum2Sq=sum([pow(prefs[p2][it],2) for it in si])
	
	# Sum up the products
	pSum=sum([prefs[p1][it]*prefs[p2][it] for it in si])
	
	# Calculate Pearson score
	num=pSum-(sum1*sum2/n)
	den=np.sqrt((sum1Sq-pow(sum1,2)/n)*(sum2Sq-pow(sum2,2)/n))
	if den==0: return 0
	
	r=num/den
	
	return r
	
	
def getRecommendations(prefs,person,n=50,similarity=sim_pearson):
	totals = {}
	simSums = {}
	for other in prefs:
		if other==person: continue
		sim = similarity(prefs, person, other)
		
		#ingore scores of zeros or lower
		if sim <= 0: continue
		
		for item in prefs[other]:
			if item not in prefs[person] or prefs[person][item]==0:
				# Similarity * score
				totals.setdefault(item,0)
				totals[item] += prefs[other][item]*sim
				#Sum of similarities
				simSums.setdefault(item,0)
				simSums[item] += sim
		
		# Create the normalized list
	rankings = [(total/simSums[item], item) for item, total in totals.items()]
		
	# Return the sorted list
	rankings.sort()
	rankings.reverse()
	l = len(rankings)
	m = n if n>=l else l
	recommend = [str(item) for (score,item) in rankings[0:m]]
	return recommend


	
def loadMoviesFromServer(genre=None):
	conn = projSql.get_sql_connection()
	data = conn.cursor()
	if genre == None:
		sql = "SELECT m.id,r.userid,r.rating FROM movies AS m JOIN ((SELECT * FROM reviewsdata) UNION (SELECT * FROM user_reviews)) AS r ON m.id = r.movieid"
	else:
		sql = "SELECT m.id,r.userid,r.rating FROM movies AS m JOIN ((SELECT * FROM reviewsdata) UNION (SELECT * FROM user_reviews)) AS r ON m.id = r.movieid WHERE " + genre + " = 1"
	data.execute(sql)
	prefs = {}
	for row in data:
		(movieid, userid, rating) = row
		prefs.setdefault(userid,{})
		prefs[userid][movieid]=float(rating)
	return prefs
						
def main():
	parser = argparse.ArgumentParser()
	parser.add_argument('-genre', required=False, help='Movie genre')
	parser.add_argument('-userId',required=True, help='recommend movies to the person with userId')
	opts = parser.parse_args()
	
	start_time = time.clock()
	#user-based dictionary
	if opts.genre!=None:
		user_critics = loadMoviesFromServer(opts.genre)
		user = int(float(opts.userId))
	else:
		input_filename = open("user_ratings.json",'r')
		line = input_filename.next()
		user_critics = json.loads(line)
		user = opts.userId
	print("Time taken: "+str(time.clock() - start_time)+" seconds.\n")
	if user in user_critics:
		recommend = getRecommendations(user_critics, user)
		print ",".join(recommend)
	
	end_time = time.clock()
	print("Time taken: "+str(end_time - start_time)+" seconds.\n")

if __name__ == '__main__':
	main()		
				

