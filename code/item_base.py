import csv
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
	
	
def topMatches(prefs,person,similarity=sim_pearson):
	scores = [(similarity(prefs,person,other),other) for other in prefs if other!=person]	
	scores.sort()
	scores.reverse()
	return scores
		
		
def calculateSimilarItems(prefs):
	# Create a dictionary of items showing which other items they
	# are most similar to.
	result={}
	c=0
	conn = projSql.get_sql_connection()
	data = conn.cursor()
	for movie_id1 in prefs:
		# Status updates for large datasets
		c+=1
		if c%100==0: print "%d / %d" % (c,len(prefs))
		# Find the most similar items to this one
		scores=topMatches(prefs,movie_id1,similarity=sim_distance)
		result[movie_id1]=scores
		for item in scores:
			movie_id2 = item[1]
			similarity = item[0]
			sql = "REPLACE INTO movie_similarities(movie_id1,movie_id2,similarity) VALUES (" + str(movie_id1) + "," + str(movie_id2) + "," + str(similarity) + ")"	
			data.execute(sql)
	
	
def loadMoviesFromServer(genre=None):
	conn = projSql.get_sql_connection()
	data = conn.cursor()
	# if genre == None:
	# 	sql = "SELECT m.id,r.userid,r.rating FROM movies AS m JOIN ((SELECT * FROM reviewsdata) UNION (SELECT * FROM user_reviews)) AS r ON m.id = r.movieid"
	# else:
	# 	sql = "SELECT m.id,r.userid,r.rating FROM movies AS m JOIN ((SELECT * FROM reviewsdata) UNION (SELECT * FROM user_reviews)) AS r ON m.id = r.movieid WHERE " + genre + " = 1"
	if genre == None:
		sql = "SELECT m.id,r.userid,r.rating FROM movies AS m JOIN reviewsdata AS r ON m.id = r.movieid"
	else:
		sql = "SELECT m.id,r.userid,r.rating FROM movies AS m JOIN reviewsdata AS r ON m.id = r.movieid WHERE " + genre + " = 1"
	data.execute(sql)
	prefs = {}
	for row in data:
		(movieid, userid, rating) = row
		prefs.setdefault(movieid,{})
		prefs[movieid][userid]=float(rating)
	return prefs
		
					
def main():
	start_time = time.clock()
	#user-based dictionary
	#user_critics = loadMovieLens(opts.path,opts.genre)
	user_critics = loadMoviesFromServer()
	#item-based
	moviesim = calculateSimilarItems(user_critics)
	end_time = time.clock()
	print("Time taken: "+str(end_time - start_time)+" seconds.\n")

if __name__ == '__main__':
	main()		
				

