import projSql

conn = projSql.get_sql_connection()
c = conn.cursor()
genre = "Action"
sql = "SELECT r.userid,r.rating FROM user_reviews AS r WHERE r.userid = 1000023"
c.execute(sql)

prefs = {}
for row in c:
	print row

c.close()