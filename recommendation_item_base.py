import csv
import numpy as np
import argparse
import time
import operator
import math
import projSql

def getMovieSimilarities(movieid,genre=None):
	conn = projSql.get_sql_connection()
	data = conn.cursor()
	if genre==None:
		sql = "SELECT movie_id2, similarity FROM movie_similarities WHERE movie_id1 = " + str(movieid)
	else:
		sql = "SELECT movie_id2, similarity FROM movie_similarities as s JOIN movies as m on s.movie_id2 = m.id WHERE movie_id1 = " + str(movieid) + ' AND ' + genre + "=1"
	data.execute(sql)
	movie_sim = {}
	for (movie_id2, similarity) in data:
		movie_sim[movie_id2] = similarity
	return movie_sim	
	

def getRecommendedItems(user,genre=None):
	conn = projSql.get_sql_connection()
	data = conn.cursor()
	sql = "SELECT r.movieid, r.rating FROM ((SELECT * FROM reviewsdata) UNION (SELECT * FROM user_reviews)) AS r WHERE r.userid =" + str(user)
	data.execute(sql)
	scores={}
	totalSim={}
	userRatings = {}
	# Loop over items rated by this user
	for (movie,rating) in data:
		userRatings[movie] = rating
	for (movie,rating) in userRatings.items():
		# Loop over items similar to this one
		movie_sim = getMovieSimilarities(movie,genre)
		for (movie2, similarity) in movie_sim.items():
			# Ignore if this user has already rated this item
			if movie2 in userRatings: continue
			# Weighted sum of rating times similarity
			scores.setdefault(movie2,0)
			scores[movie2]+=similarity*rating
			# Sum of all the similarities
			totalSim.setdefault(movie2,0)
			totalSim[movie2]+=similarity
		
	# Divide each total score by total weighting to get an average 
	rankings=[(score/totalSim[movie],movie) for movie,score in scores.items() if score!=0]
	# Return the rankings from highest to lowest 
	rankings.sort()
	rankings.reverse()
	recommend = [str(movie) for (score,movie) in rankings]
	return recommend
							
def main():	
	parser = argparse.ArgumentParser()
	parser.add_argument('-genre', required=False, help='Movie genre')
	parser.add_argument('-userId',required=True, help='recommend movies to the person with userId')
	opts = parser.parse_args()
	start_time = time.clock()
	userid = opts.userId
	recommend = getRecommendedItems(opts.userId,opts.genre)
	print ",".join(recommend)
	end_time = time.clock()
	#print("Time taken: "+str(end_time - start_time)+" seconds.\n")

if __name__ == '__main__':
	main()		
				

