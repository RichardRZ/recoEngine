import json
import projSql
import time

start_time = time.clock()
conn = projSql.get_sql_connection()
data = conn.cursor()
sql = "SELECT m.id,r.userid,r.rating FROM movies AS m JOIN ((SELECT * FROM reviewsdata) UNION (SELECT * FROM user_reviews)) AS r ON m.id = r.movieid"
data.execute(sql)
prefs = {}
for row in data:
	(movieid, userid, rating) = row
	prefs.setdefault(userid,{})
	prefs[userid][movieid]=float(rating)
with open('user_ratings.json', 'w') as outfile:
    json.dump(prefs, outfile)
			
print("Time taken: "+str(time.clock() - start_time)+" seconds.\n")
