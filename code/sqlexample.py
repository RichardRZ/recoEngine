import projSql

conn = projSql.get_sql_connection()

c = conn.cursor()

c.execute("""SELECT * FROM `movies` WHERE `title` LIKE 'twelve%' ORDER BY title""")

for row in c:
        print (row)

c.close()