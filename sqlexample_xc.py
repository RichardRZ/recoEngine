import projSql

conn = projSql.get_sql_connection()
c = conn.cursor()
genre = "Action"
sql = "SELECT m.id,r.userid,r.rating FROM movies AS m JOIN reviewsdata AS r on m.id = r.movieid WHERE " + genre + " = 1"
c.execute(sql)

prefs = {}
for row in c:
	(movieid, userid, rating) = row
	prefs.setdefault(userid,{})
	prefs[userid][movieid]=float(rating)
print prefs
	

c.close()