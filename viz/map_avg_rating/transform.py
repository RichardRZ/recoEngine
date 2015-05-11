import sys
import csv



genre_dict = {
    "Action": '0',
    "Adventure": '1',
    "Animation": '2',
    "Children's": '3',
    "Comedy": '4',
    "Crime": '5',
    "Documentary": '6',
    "Drama": '7',
    "Fantasy": '8',
    "Film-Noir": '9',
    "Horror": '10',
    "Musical": '11',
    "Mystery": '12',
    "Romance": '13',
    "Sci-Fi": '14',
    "Thriller": '15',
    "War": '16',
    "Western": '17',
}



moviecsv = csv.reader(open('movies.dat'),delimiter='@')

for movie in moviecsv:
    genres_list = [0] * 18
    genres = movie[2].split('|')
    for g in genres:
        genres_list[int(genre_dict[g])] = 1
    genre_str = ''
    for x in genres_list:
        genre_str=genre_str+str(x)+'|'
    print movie[0]+'|'+movie[1]+'|'+genre_str