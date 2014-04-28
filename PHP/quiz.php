<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml" lang="en">
<head>
  <title>HW2 Page</title>
  <meta charset="utf-8" />
  <meta name="Author" content="Andy Yeung" />
  <meta name="generator" content="pico" />
  
    <!-- Be sure mobile devices don't try to scale up. -->
  <meta name="viewport" content="width=device-width" />
  <meta name="viewport" content="initial-scale=1.0" />

  <!-- NOTE: Do not put "title" attribute unless there are
       alternate stylesheets! -->
  <link rel="stylesheet" type="text/css" href="./layout700+.css" />
  <link rel="stylesheet" type="text/css" href="./layout699-.css" />
  
  <link rel="shortcut icon" href="/~yeunga46/images/tardis.png" />
  <link rel="stylesheet" href="webline.css" />


  <style type="text/css">
      h1{
        text-align:center;
      }
      #startmenu {
        width: 70%;
        height: 600px;
         margin-left: auto ;
        margin-right: auto ;
        padding: 0 0 0 0;
        vertical-align: middle;
        border: 2px solid #000000;

      }
      #startmenu ul li {
         list-style-type: none;
         text-align: center;

      }
      #startmenu h1 {
         text-align: center;
      }
      table#navbar {
        width: 100%;
        height: 10%;
     
        padding: 0 0 0 0;
        color: #F8F8FF;
        background: #1E90FF; 
        border: 1px solid #000000;
        border-collapse: collapse;
    }

      table#navbar tr {
          text-align: center;
          margin: 0px;
          padding: 0px;
          border: 1px solid #000000;
      }

      table#navbar tr td {
          border:  1px solid #000000;
          margin: 0px;
          padding: 0px;
      }

      table#navbar tr td a {
          text-decoration: none;
          margin: 0px;
          padding: 0px;
      }

      table#navbar tr td a:hover {
          text-decoration: underline;
      }

      table#webline {
          width: 100%;
          color: #3f1a0a;
          background: #dfdbc3; 
          border: 1px solid #3f1a0a;
          border-collapse: collapse;
      }

      table#webline tr {
          text-align: center;
          margin: 0px;
          padding: 0px;
          border: 1px solid #3f1a0a;
      }

      table#webline tr td {
          border:  1px solid #3f1a0a;
          margin: 0px;
          padding: 0px;
      }

      table#webline tr td a {
          text-decoration: none;
          margin: 0px;
          padding: 0px;
      }

      table#webline tr td a:hover {
          text-decoration: underline;
      }

      table#webline tr td img {
          vertical-align:middle;
          border:none;
          margin: 0px;
          padding: 0px;
      }
    </style>
</head>

<body>


<h1>High-Score</h1>

<div id = "startmenu" >
  <table id="navbar">
  <tr>
    <td> <a >Longest Time</a></td>
    <td> <a >Shortest Time</a></td>
    <td> <a href="">Most Correct</a></td>
    <td> <a href="">Longest Time and Most Correct</a></td>
    <td> <a href="">Fastest Average with Most Correct</a></td>
  </tr>
</table>


<div>QUESTION</div>
<form id="fillin">
Answer:  <input type="text" name='phone'><br>
<input type = "submit">
</form>
<form id="choice">
Answer:<br>
<input type="radio" id="a" name="choose" value="a">a<br>
<input type="radio" id="b" name="choose" value="b">b<br>
<input type="radio" id="c" name="choose" value="c">c<br>
<input type="radio" id="d" name="choose" value="d">d<br>
<input type="submit">
</form>

<button type="button" onclick="alert('Next')">Next</button>
<button type="button" onclick="alert('Quit')">Quit</button>
</div>




</body>
<footer>
  <div id = "validation">
<table id="webline">
  <tr>
    <td> <a href="http://elvis.rowan.edu/~yeunga46/web/" 
            title="Link to web directory">
             <img src="/~yeunga46/images/tardis.png" alt="" />
             A. Yeung
         </a>
    </td>

    <td style="word-spacing:1em;">Valid:
     <a href="http://validator.w3.org/check/referer">HTML5</a>
     <a href="http://jigsaw.w3.org/css-validator/check/referer?profile=css3">
     CSS3</a>
    </td>
  </tr>
</table>
</div>
</footer>
</html>
