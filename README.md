# Surfing Chef 3.0 - CSS Grid WordPress Theme

> The `starter` branch ~~is~~ will be a stable blank WordPress Starter theme. Other branches are for various stages of development and deployment.

###  Surfing Chef 3.0 is the latest incarnation of a WordPress starter theme aiming to modernize, organize and enhance some aspects of WordPress theme development.

## Usage
- Start with a fresh, working WordPress install   
- Copy `starter` branch zip and install to the new theme folder.  DO NOT CLONE PLEASE   
- Navigate to project root in terminal and install packages, `npm install`   
- Change browserSync proxy path in gulpfile.js (line 29) to point to the WordPress install  
- import the test data from [wptest.io](http://wptest.io/) for development  
- Start tweeking  

## License
Surfing Chef 3.0 theme is licensed under the [GNU license](https://www.gnu.org/licenses/old-licenses/gpl-2.0.html).  

## Dev Notes
- Chrome didnt like .site with display: grid and grid-gap.  Research revealed over-nesting to be the reason. 
- Chrome didn't break long lines like URLs automatically, had to add `word-break:break-word` to normalize.
- Chrome required width to be set on some elements in order to maintain a responsive nature  

## To Do  
Work on main navigation search button:  shoul click to reveal a search box