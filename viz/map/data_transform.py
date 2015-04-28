import sys
import csv



user_dict = {}



userscsv = csv.reader(open('users.dat'),delimiter='@')

for movie in moviecsv:
    genres_list = [0] * 18
    genres = movie[2].split('|')
    for g in genres:
        genres_list[int(genre_dict[g])] = 1
    genre_str = ''
    for x in genres_list:
        genre_str=genre_str+str(x)+'|'
    print movie[0]+'|'+movie[1]+'|'+genre_str