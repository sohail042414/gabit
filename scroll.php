<!DOCTYPE html>
<html>
  <head>
    <title>Title of the document</title>
    <style>
      .notice-bar{
        background-color: #1c87c9;
        color: #fff;
        padding: 5px;
      }
      .notice-bar > p {
        -moz-animation: marquee 25s linear infinite;
        -webkit-animation: marquee 25s linear infinite;
        animation: marquee 25s linear infinite;
      }
      @-moz-keyframes marquee {
        0% {
          transform: translateX(100%);
        }
        100% {
          transform: translateX(-100%);
        }
      }
      @-webkit-keyframes marquee {
        0% {
          transform: translateX(100%);
        }
        100% {
          transform: translateX(-100%);
        }
      }
      @keyframes marquee {
        0% {
          -moz-transform: translateX(100%);
          -webkit-transform: translateX(100%);
          transform: translateX(100%)
        }
        100% {
          -moz-transform: translateX(-100%);
          -webkit-transform: translateX(-100%);
          transform: translateX(-100%);
        }
      }
    </style>
  </head>
  <body>
    <div class="notice-bar">
      <p>This is a horizontally scrolling text without a marquee tag. This is a horizontally scrolling text without a marquee tag. This is a horizontally scrolling text without a marquee tag. This is a horizontally scrolling text without a marquee tag. This is a horizontally scrolling text without a marquee tag </p>
    </div>
  </body>
</html>