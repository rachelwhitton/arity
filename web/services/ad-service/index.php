<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>AnswerMarketplace Offers Test Service</title>
</head>
<body>
<style>
     .wrapper {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;

     }
     .webview-wrap {
         box-sizing: border-box;
         padding: 20px;
         background-color: whitesmoke;
         width: 300px;
         height: 250px;
     }
 </style>
 <body>

<div class="wrapper">

    <div class="webview-wrap">
        <?php echo 'Hello ' . htmlspecialchars($_GET["name"]) . '!' ; ?><br /><br />
        <?php echo 'Your driving score is ' . htmlspecialchars($_GET["rte"]) . '.'; ?><br /><br />
        <?php echo 'Your publisher ID  ' . htmlspecialchars($_GET["publisher"]) . '.'; ?><br /><br /><br />
        <?php echo 'Let me get that ad for you...'; ?>
    </div>

</div>

</body>
</html>




