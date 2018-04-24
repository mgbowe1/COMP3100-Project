# Web Interface
The purpose of this website is to provide a useful tool to update and query the database.
The query requirements are as follows:

1. Find the post that has the most number of likes
2. Find the person who has the most number of followers
3. Count the number of posts that contains the keyword “flu”, display the location of the users who have made the posts as well (use “GROUP BY location”). - Implemented by keyword search feature. Query in php/keyword_search.php
4. User input a person’s twitter name, find all the posts made by that person - Implemented by user search feature. Query in php/get_user_feed.php
5. User input a year, find the person who twits the most in that year - Implemented by year search feature
6. After log in, find all the senders of messages to the user - Implemented in index.php
7. After log in, user posts a new twit - Implemented by post twit feature. Query located in post_twit.php
8. After log in, user follows/unfollows another user - UI in php/index.php, queries split between php/follow.php and php/unfollow.php
9. After log in, user adds comment to a post - UI in get_user_feed.php, query in post_comment.php
10. After log in, user deletes a particular comment to a post he/she has created - UI in get_user_feed.php, query in delete_comment.php

# Intructions

1. Edit db_header.php (comments indicate meaning of each variable)
2. All functions should be working on site

# Additional Features

After login, a user can view a feed of posts containing posts from anybody they follow.
