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

#Returns the Pearson correlation coefficient for p1 and p2	
# def sim_pearson(prefs,p1,p2):
# 	p1si = []
# 	p2si = []
# 	for item in prefs[p1]:
# 		if item in prefs[p2]:
# 			p1si.append(float(prefs[p1][item]))
# 			p2si.append(float(prefs[p2][item]))
# 	n = len(p1si)
#
# 	if n==0: return 0
#
# 	corr = np.corrcoef(p1si,p2si)[0,1]
# 	if math.isnan(corr): return 0
# 	return corr

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
	
	
def topMatches(prefs,person,n=5,similarity=sim_pearson):
	scores = [(similarity(prefs,person,other),other) for other in prefs if other!=person]	
	scores.sort()
	scores.reverse()
	return scores[0:n]
		
		

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
	

def getRecommendedItems(prefs,itemMatch,user):
	userRatings=prefs[user]
	scores={}
	totalSim={}
	# Loop over items rated by this user
	for (item,rating) in userRatings.items():
		# Loop over items similar to this one
		for (similarity,item2) in itemMatch[item]:
			# Ignore if this user has already rated this item
			if item2 in userRatings: continue
			# Weighted sum of rating times similarity
			scores.setdefault(item2,0)
			scores[item2]+=similarity*rating
			# Sum of all the similarities
			totalSim.setdefault(item2,0)
			totalSim[item2]+=similarity
		
		# Divide each total score by total weighting to get an average 
		rankings=[(score/totalSim[item],item) for item,score in scores.items()]
		
		# Return the rankings from highest to lowest rankings.sort( )
		rankings.reverse( )
		recommend = [str(item) for (score,item) in rankings]
		return recommend
				

def calculateSimilarItems(prefs,n=10):
	# Create a dictionary of items showing which other items they
	# are most similar to.
	result={}
	# Invert the preference matrix to be item-centric
	itemPrefs=transformPrefs(prefs)
	c=0
	for item in itemPrefs:
		# Status updates for large datasets
		c+=1
		if c%100==0: print "%d / %d" % (c,len(itemPrefs))
		# Find the most similar items to this one
		scores=topMatches(itemPrefs,item,n=n,similarity=sim_distance)
		result[item]=scores
	return result

				
def loadMovieLens(path,genre=None):
	# Get movie titles
	movies = {}
	genres = movieType(path + '/u.genre')
	for line in open(path+'/u.item'):
		movielist = line.split('|')
		if genre!=None:
			if movielist[int(float(genres[genre]))+5]=='0':
				continue		
		(Id,title) = movielist[0:2]
		movies[Id] = title
		
	# Load data	
	prefs = {}
	for line in open(path+'/u.data'):
		(user,movieid,rating,ts) = line.split('\t')
		prefs.setdefault(user,{})
		if movieid in movies:
			prefs[user][movies[movieid]]=float(rating)
	return prefs
	
	
def loadMoviesFromServer(genre=None):
	conn = projSql.get_sql_connection()
	data = conn.cursor()
	if genre == None:
		sql = "SELECT m.id,r.userid,r.rating FROM movies AS m JOIN ((SELECT * FROM reviewsdata) UNION (SELECT * FROM user_reviews)) AS r ON m.id = r.movieid"
	else:
		sql = "SELECT m.id,r.userid,r.rating FROM movies AS m JOIN ((SELECT * FROM reviewsdata) UNION (SELECT * FROM user_reviews)) AS r ON m.id = r.movieid WHERE " + genre + " = 1"
<<<<<<< HEAD
	# if genre == None:
	# 	sql = "SELECT m.id,r.userid,r.rating FROM movies AS m JOIN reviewsdata AS r ON m.id = r.movieid"
	# else:
	# 	sql = "SELECT m.id,r.userid,r.rating FROM movies AS m JOIN reviewsdata AS r ON m.id = r.movieid WHERE " + genre + " = 1"
=======
>>>>>>> b2f7f32da2eb04081711ff25100a82845e469c13
	data.execute(sql)
	prefs = {}
	for row in data:
		(movieid, userid, rating) = row
		prefs.setdefault(userid,{})
		prefs[userid][movieid]=float(rating)
	return prefs
		
		

def transformPrefs(prefs):
	result = {}
	for person in prefs:
		for item in prefs[person]:
			result.setdefault(item,{})
			# Flip item and person
			result[item][person] = prefs[person][item]
	return result				
				
				
def movieType(path):
	genre = {}
	for line in open(path):
		if '\n' in line:
			line = line.replace('\n','')
		if len(line)==0: continue
		(name,number) = line.split('|')
		genre[name] = number
	return genre
						
				
def main():
	parser = argparse.ArgumentParser()
	parser.add_argument('-path', required=False, help='movieLen directory')
	parser.add_argument('-genre', required=False, help='Movie genre')
	parser.add_argument('-userId',required=True, help='recommend movies to the person with userId')
	opts = parser.parse_args()
	
	start_time = time.clock()
	#user-based dictionary
	#user_critics = loadMovieLens(opts.path,opts.genre)
	user_critics = loadMoviesFromServer(opts.genre)
	recommend = getRecommendations(user_critics, int(float(opts.userId)))
	print ",".join(recommend)
	
	#item-based
	# moviesim = calculateSimilarItems(user_critics)
	# recommend = getRecommendedItems(user_critics,moviesim,opts.userId)
	# print ",".join(recommend)

	end_time = time.clock()
	#print("Time taken: "+str(end_time - start_time)+" seconds.\n")

if __name__ == '__main__':
	main()		
				

