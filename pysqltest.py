import projSql.py

conn = get_sql_connection()

c = conn.cursor()

c.execute("""SELECT `title` FROM `movies` WHERE `title` LIKE 'twelve%' ORDER BY title""")

for row in c:
        print (row)

c.close()